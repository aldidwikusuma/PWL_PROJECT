<?php

namespace App\Http\Controllers\Admin;

use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Barryvdh\DomPDF\Facade as PDF;

// use PDF;
use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Room;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::orderBy("date")->paginate(7);
        if ($schedules) {
            foreach ($schedules as $schedule) {
                $schedule["date"] = date("d-m-Y", strtotime($schedule->date));
            }
        }
        return view(config("data.view.admin.schedules.index"), [
            "title" => "Table Schedules",
            "schedules" => $schedules,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        date_default_timezone_set('Asia/Jakarta');
        $datenow = date("Y-m-d", strtotime("now"));
        $timenow = date("H:i", strtotime("now"));
        $films = Film::all()->toArray();
        $rooms = Room::all()->toArray();
        return view(config("data.view.admin.schedules.create"), [
            "title" => "Create Schedule",
            "films" => $films,
            "rooms" => $rooms,
            "datenow" => $datenow,
            "timenow" => $timenow
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');        

        $rulesData = [
            "date" => "required|date",
            "time" => "required",
            "fk_id_film" => "required",
            "fk_id_room" => "required"
        ];

        $schedules = Schedule::where("date", $request->date)->where("fk_id_room", $request->fk_id_room)->get()->toArray();
        
        $validator = Validator::make($request->all(), $rulesData);
        if(strtotime($request->date) < strtotime(date("Y-m-d", strtotime("now")))){
            $validator->errors()->add(
                'date', "Date is not valid, date cannot be less than the current date ('" . date("d-m-Y", strtotime("now")) . "')"
            );
            return redirect(route(config("data.route.admin.schedules.create")))->withErrors($validator)->withInput();
        } else {
            if (strtotime($request->date) == strtotime(date("Y-m-d", strtotime("now")))) {
                if(strtotime($request->time) < strtotime("now")){
                    $validator->errors()->add(
                        'time', "Time is not valid, time cannot be less than the current time ('" . date("H:i", strtotime("now")) . "')"
                    );
                    return redirect(route(config("data.route.admin.schedules.create")))->withErrors($validator)->withInput();
                };
                
            }
        };

        if ($schedules) {
            foreach ($schedules as $schedule) {
                if ((strtotime($request->time) >= strtotime($schedule["time"])) || (strtotime($request->endtime) <= strtotime($schedule["endtime"]))) {
                    $validator->errors()->add(
                        'time', "Time has been used for movie " . $schedule["film"]["title"] . " from " . $schedule["time"] ." to " . $schedule["endtime"] . ". Detail <a href=". route(config("data.route.admin.schedules.detail"), $schedule["id"]) ." target='_blank'>here</a>"
                    );
                    return redirect(route(config("data.route.admin.schedules.create")))->withErrors($validator)->withInput();
                }
                // dd("Request Time = " . ($request->time) . " | Schedule Time = " . $schedule["time"] . " | Hasilnya " . (bool)(strtotime($request->time) >= strtotime($schedule["time"])) .  "Request End Time = " . ($request->endtime) . " | Schedule End Time = " . $schedule["endtime"] . " | Hasilnya " . (bool)(strtotime($request->endtime) <= strtotime($schedule["endtime"])));
            }
        }

        $validatedData = $validator->validated();

        $film = Film::find((integer)$request->fk_id_film);
        $film["hour"] = (integer) floor($film->duration / 60);
        $film["minute"] = $film->duration % 60;
        $duration = $film->hour . ":" . $film->minute;
        $validatedData["endtime"] = date("H:i", (strtotime($request->time) - strtotime($duration)));


        Schedule::create($validatedData);
        return redirect(route(config("data.route.admin.schedules.index")))->with("success", "Schedule has been added");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        $schedule["date"] = date("d-m-Y", strtotime($schedule->date));
        $schedule->film["hour"] = (integer) floor($schedule->film["duration"] / 60);
        $schedule->film["minute"] = $schedule->film["duration"] % 60;
        
        return view(config("data.view.admin.schedules.detail"), [
            "title" => "Detail Schedule",
            "schedule" => $schedule
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        $films = Film::all()->toArray();
        $rooms = Room::all()->toArray();
        return view(config("data.view.admin.schedules.edit"), [
            "title" => "Edit Schedule",
            "films" => $films,
            "rooms" => $rooms,
            "schedule" => $schedule
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        date_default_timezone_set('Asia/Jakarta');         

        $rulesData = [
            "date" => "required|date",
            "time" => "required",
            "endtime" => "required",
            "fk_id_film" => "required",
            "fk_id_room" => "required"
        ];

        if ($schedule["date"] != $request["date"] && $schedule["fk_id_room"] != $request["fk_id_room"]) {
            $schedules = Schedule::whereNotIn("date", $request->date)->whereNotIn("fk_id_room", $request->fk_id_room)->get()->toArray();
        } else {
            $schedules = Schedule::where("date", $request->date)->where("fk_id_room", $request->fk_id_room)->get()->toArray();
        }

        $validator = Validator::make($request->all(), $rulesData);

        if ($schedule["date"] != $request["date"]) {
            if(strtotime($request->date) < strtotime(date("Y-m-d", strtotime("now")))){
                $validator->errors()->add(
                    'date', "Date is not valid, date cannot be less than the current date ('" . date("d-m-Y", strtotime("now")) . "')"
                );
                return redirect(route(config("data.route.admin.schedules.create")))->withErrors($validator)->withInput();
            } else {
                if (strtotime($request->date) == strtotime(date("Y-m-d", strtotime("now")))) {
                    if(strtotime($request->time) < strtotime("now")){
                        $validator->errors()->add(
                            'time', "Time is not valid, time cannot be less than the current time ('" . date("H:i", strtotime("now")) . "')"
                        );
                        return redirect(route(config("data.route.admin.schedules.create")))->withErrors($validator)->withInput();
                    };
                }
            };
        }

        if ($schedule["time"] != $request["time"]) { 
            if ($schedules) {
                foreach ($schedules as $schedule) {
                    if ((strtotime($request->time) >= strtotime($schedule["time"])) || (strtotime($request->endtime) <= strtotime($schedule["endtime"]))) {
                        $validator->errors()->add(
                            'time', "Time has been used for movie " . $schedule["film"]["title"] . " from " . $schedule["time"] ." to " . $schedule["endtime"] . ". Detail <a href=". route(config("data.route.admin.schedules.detail"), $schedule["id"]) .">here</a>"
                        );
                        return redirect(route(config("data.route.admin.schedules.create")))->withErrors($validator)->withInput();
                    }
                }
            }
        }

        $validatedData = $validator->validated();

        if ($request->time != $schedule->time) {
            $film = Film::find((integer)$request->fk_id_film);
            $film["hour"] = (integer) floor($film->duration / 60);
            $film["minute"] = $film->duration % 60;
            $duration = $film->hour . ":" . $film->minute;
            $validatedData["endtime"] = date("H:i", (strtotime($request->time) - strtotime($duration)));
        }

        return dd($validatedData);

        Schedule::where("id", $schedule->id)->update($validatedData);

        return redirect(route(config("data.route.admin.schedules.index")))->with("success", "Schedule has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        Schedule::destroy($schedule->id);
        return redirect(route(config("data.route.admin.schedules.index")))->with("success", "Schedule has been deleted");
    }

    public function search(Request $request)
    {
        $schedules = [];
        $film = Film::where("title", "like", "%$request->key%")->first();
        if ($film) {     
            $schedules = Schedule::where("fk_id_film", $film->id)->paginate(7);
        } 
        $room = Room::where("name", "like", "%$request->key%")->first();
        if ($room) {
            $schedules = Schedule::where("fk_id_room", $room->id)->paginate(7);
        }
        if (!$room && !$film) {
            $schedules = Schedule::where("date", "x")->paginate(7);
        }
        if ($request->key == "") {
            $schedules = Schedule::paginate(7);
        }
        return view(config("data.view.admin.schedules.index"), [
            "title" => "Table Schedules",
            "schedules" => $schedules,
        ]);
    }

    public function print()
    {
        $schedules = Schedule::all();
        // return view("admin.schedule.print", [
        //     "title" => "Data Table Schedules",
        //     "schedules" => $schedules,
        //     "column" => 12
        // ]);
        // $pdf = PDF::loadview('admin.schedule.print', [
        //     "title" => "Data Table Schedules",
        //     "schedules" => $schedules,
        //     "column" => 12
        // ]);
        $pdf = PDF::loadview('admin.schedule.print', compact("schedules"));

        return $pdf->stream();
    }
}
