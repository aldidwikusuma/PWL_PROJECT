<?php

namespace App\Http\Controllers\Admin;

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
        if ($request["fk_id_film"] && $request["time"]) {
            $film = Film::find((integer)$request->fk_id_film);
            $film["hour"] = (integer) floor($film->duration / 60);
            $film["minute"] = $film->duration % 60;
            $duration = $film->hour . ":" . $film->minute;
            $request["endtime"] = date("H:i", (strtotime($duration) + strtotime($request->time)));
        }

        $rulesData = [
            "date" => "required|date",
            "time" => "required",
            "endtime" => "required",
            "fk_id_film" => "required",
            "fk_id_room" => "required"
        ];

        $schedules = Schedule::where("date", $request->date)->get()->toArray();
        
        $validator = Validator::make($request->all(), $rulesData);
        
        // return dd($validator->);
        // if ($schedules) {
        //     $validator->after(function ($validator) {
        //         return dd($schedules);
        //         foreach ($schedules as $schedule) {
        //             if ((strtotime($request->time) >= strtotime($schedule["time"])) || (strtotime($request->endtime) <= strtotime($schedule["endtime"]))) {
        //                 $validator->errors()->add(
        //                     'time', 'Waktu ini telah digunakan'
        //                 );
        //             }
        //         }
        //     });
        // }


        if ($schedules) {
            foreach ($schedules as $schedule) {
                if ((strtotime($request->time) >= strtotime($schedule["time"])) || (strtotime($request->endtime) <= strtotime($schedule["endtime"]))) {
                    $validator->errors()->add(
                        'time', 'Waktu ini telah digunakan'
                    );
                }
                // dd("Request Time = " . ($request->time) . " | Schedule Time = " . $schedule["time"] . " | Hasilnya " . (bool)(strtotime($request->time) >= strtotime($schedule["time"])) .  "Request End Time = " . ($request->endtime) . " | Schedule End Time = " . $schedule["endtime"] . " | Hasilnya " . (bool)(strtotime($request->endtime) <= strtotime($schedule["endtime"])));
            }
        }

        // return dd($waktumulai > strtotime($request->time) && strtotime($request->time) < $waktuselesai);
        // return dd(strtotime($request->time) >= $waktumulai && strtotime($request->time) <= $waktuselesai);

        return dd($validator->failed());

        if ($validator->fails()) {
            return dd("Waktu salah");
            return redirect('post/create')->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();
        // return dd($validatedData);

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
        $schedule->film["hour"] = (integer) floor($schedule->film["duration"] / 60);
        $schedule->film["minute"] = $schedule->film["duration"] % 60;
        $duration = $schedule->film->hour . ":" . $schedule->film->minute;
        

        $schedule["endplaying"] = date("H:i", (strtotime($duration) + strtotime($schedule->time)));
        // return dd($schedule->endplaying);
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
        //
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
}
