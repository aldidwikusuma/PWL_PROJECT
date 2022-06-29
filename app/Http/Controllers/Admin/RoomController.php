<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chair;
use App\Models\ChairRoom;
use App\Models\Room;
use App\Models\RoomCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::orderBy("name")->paginate(5);
        return view(config("data.view.admin.rooms.index"), [
            "title" => "Table Room",
            "rooms" => $rooms,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $row = [
            "min" => config("data.chairRooms.row.min"),
            "max" => config("data.chairRooms.row.max")
        ];
        $col = [
            "min" => config("data.chairRooms.col.min"),
            "max" => config("data.chairRooms.col.max")
        ];

        $roomCategory = RoomCategory::all()->toArray();

        return view(config("data.view.admin.rooms.create"), [
            "title" => "Room Create",
            "row" => $row,
            "col" => $col,
            "roomCategories" => $roomCategory
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
        $row_min = config("data.chairRooms.row.min");
        $row_max = config("data.chairRooms.row.max");
        $col_min = config("data.chairRooms.col.min");
        $col_max = config("data.chairRooms.col.max");
        $rulesData = [
            "name" => "required|max:255|unique:rooms",
            "chair_row" => "required|integer|between:$row_min,$row_max",
            "chair_col" => "required|integer|between:$col_min,$col_max",
            "fk_id_room_category" => "required"
        ];

        $validatedData = $request->validate($rulesData);

        $room = Room::create($validatedData);

        $row = $room->chair_row;
        $col = $room->chair_col;
        $number = 1;
        for ($i = 0; $i < $row; $i++) { 
            switch ($i) {
                // Chair A
                case 0:
                    $chairs = Chair::where("name", "like", "A%")->get()->toArray();
                    $chairArray = [];
                    for ($j = 0; $j < $col; $j++) { 
                        $chairArray = Arr::add($chairArray, $chairs[$j]["id"], ["number_chair" => $number]);
                        $number++;
                    }
                    $room->chairs()->attach($chairArray);
                    break;
                // Chair B
                case 1:
                    $chairs = Chair::where("name", "like", "B%")->get()->toArray();
                    $chairArray = [];
                    for ($j = 0; $j < $col; $j++) { 
                        $chairArray = Arr::add($chairArray, $chairs[$j]["id"], ["number_chair" => $number]);
                        $number++;
                    }
                    $room->chairs()->attach($chairArray);
                    break;
                // Chair C
                case 2:
                    $chairs = Chair::where("name", "like", "C%")->get()->toArray();
                    $chairArray = [];
                    for ($j = 0; $j < $col; $j++) { 
                        $chairArray = Arr::add($chairArray, $chairs[$j]["id"], ["number_chair" => $number]);
                        $number++;
                    }
                    $room->chairs()->attach($chairArray);
                    break;
                // Chair D
                case 3:
                    $chairs = Chair::where("name", "like", "D%")->get()->toArray();
                    $chairArray = [];
                    for ($j = 0; $j < $col; $j++) { 
                        $chairArray = Arr::add($chairArray, $chairs[$j]["id"], ["number_chair" => $number]);
                        $number++;
                    }
                    $room->chairs()->attach($chairArray);
                    break;
                // Chair E
                case 4:
                    $chairs = Chair::where("name", "like", "E%")->get()->toArray();
                    $chairArray = [];
                    for ($j = 0; $j < $col; $j++) { 
                        $chairArray = Arr::add($chairArray, $chairs[$j]["id"], ["number_chair" => $number]);
                        $number++;
                    }
                    $room->chairs()->attach($chairArray);
                    break;
                // Chair F
                case 5:
                    $chairs = Chair::where("name", "like", "F%")->get()->toArray();
                    $chairArray = [];
                    for ($j = 0; $j < $col; $j++) { 
                        $chairArray = Arr::add($chairArray, $chairs[$j]["id"], ["number_chair" => $number]);
                        $number++;
                    }
                    $room->chairs()->attach($chairArray);
                    break;
                // Chair G
                case 6:
                    $chairs = Chair::where("name", "like", "G%")->get()->toArray();
                    $chairArray = [];
                    for ($j = 0; $j < $col; $j++) { 
                        $chairArray = Arr::add($chairArray, $chairs[$j]["id"], ["number_chair" => $number]);
                        $number++;
                    }
                    $room->chairs()->attach($chairArray);
                    break;
                // Chair H
                case 7:
                    $chairs = Chair::where("name", "like", "H%")->get()->toArray();
                    $chairArray = [];
                    for ($j = 0; $j < $col; $j++) { 
                        $chairArray = Arr::add($chairArray, $chairs[$j]["id"], ["number_chair" => $number]);
                        $number++;
                    }
                    $room->chairs()->attach($chairArray);
                    break;
                // Chair I
                case 8:
                    $chairs = Chair::where("name", "like", "I%")->get()->toArray();
                    $chairArray = [];
                    for ($j = 0; $j < $col; $j++) { 
                        $chairArray = Arr::add($chairArray, $chairs[$j]["id"], ["number_chair" => $number]);
                        $number++;
                    }
                    $room->chairs()->attach($chairArray);
                    break;
                // Chair J
                case 9:
                    $chairs = Chair::where("name", "like", "J%")->get()->toArray();
                    $chairArray = [];
                    for ($j = 0; $j < $col; $j++) { 
                        $chairArray = Arr::add($chairArray, $chairs[$j]["id"], ["number_chair" => $number]);
                        $number++;
                    }
                    $room->chairs()->attach($chairArray);
                    break;
                default:
                    break;
            }
        }

        return redirect(route(config("data.route.admin.rooms.index")))->with("success", "Room has been added");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        return view(config("data.view.admin.rooms.detail"), [
            "title" => "Detail Room",
            "room" => $room
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        $row = [
            "min" => config("data.chairRooms.row.min"),
            "max" => config("data.chairRooms.row.max")
        ];
        $col = [
            "min" => config("data.chairRooms.col.min"),
            "max" => config("data.chairRooms.col.max")
        ];

        $roomCategory = RoomCategory::all()->toArray();

        return view(config("data.view.admin.rooms.edit"), [
            "title" => "Edit Rooms",
            "room" => $room,
            "row" => $row,
            "col" => $col,
            "roomCategories" => $roomCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $roomId = $room->id;
        $row_min = config("data.chairRooms.row.min");
        $row_max = config("data.chairRooms.row.max");
        $col_min = config("data.chairRooms.col.min");
        $col_max = config("data.chairRooms.col.max");
        $rulesData = [
            "chair_row" => "required|integer|between:$row_min,$row_max",
            "chair_col" => "required|integer|between:$col_min,$col_max",
            "fk_id_room_category" => "required"
        ];

        if ($room->name != $request->name) {
            $rulesData["name"] = "required|max:255|unique:rooms";
        }

        $validatedData = $request->validate($rulesData);
        $room = Room::where("id", $roomId)->update($validatedData);

        ChairRoom::where("fk_id_room", $roomId)->delete();

        $room = Room::find($roomId);
        
        $row = $room->chair_row;
        $col = $room->chair_col;
        $number = 1;
        for ($i = 0; $i < $row; $i++) { 
            switch ($i) {
                // Chair A
                case 0:
                    $chairs = Chair::where("name", "like", "A%")->get()->toArray();
                    $chairArray = [];
                    for ($j = 0; $j < $col; $j++) { 
                        $chairArray = Arr::add($chairArray, $chairs[$j]["id"], ["number_chair" => $number]);
                        $number++;
                    }
                    $room->chairs()->attach($chairArray);
                    break;
                // Chair B
                case 1:
                    $chairs = Chair::where("name", "like", "B%")->get()->toArray();
                    $chairArray = [];
                    for ($j = 0; $j < $col; $j++) { 
                        $chairArray = Arr::add($chairArray, $chairs[$j]["id"], ["number_chair" => $number]);
                        $number++;
                    }
                    $room->chairs()->attach($chairArray);
                    break;
                // Chair C
                case 2:
                    $chairs = Chair::where("name", "like", "C%")->get()->toArray();
                    $chairArray = [];
                    for ($j = 0; $j < $col; $j++) { 
                        $chairArray = Arr::add($chairArray, $chairs[$j]["id"], ["number_chair" => $number]);
                        $number++;
                    }
                    $room->chairs()->attach($chairArray);
                    break;
                // Chair D
                case 3:
                    $chairs = Chair::where("name", "like", "D%")->get()->toArray();
                    $chairArray = [];
                    for ($j = 0; $j < $col; $j++) { 
                        $chairArray = Arr::add($chairArray, $chairs[$j]["id"], ["number_chair" => $number]);
                        $number++;
                    }
                    $room->chairs()->attach($chairArray);
                    break;
                // Chair E
                case 4:
                    $chairs = Chair::where("name", "like", "E%")->get()->toArray();
                    $chairArray = [];
                    for ($j = 0; $j < $col; $j++) { 
                        $chairArray = Arr::add($chairArray, $chairs[$j]["id"], ["number_chair" => $number]);
                        $number++;
                    }
                    $room->chairs()->attach($chairArray);
                    break;
                // Chair F
                case 5:
                    $chairs = Chair::where("name", "like", "F%")->get()->toArray();
                    $chairArray = [];
                    for ($j = 0; $j < $col; $j++) { 
                        $chairArray = Arr::add($chairArray, $chairs[$j]["id"], ["number_chair" => $number]);
                        $number++;
                    }
                    $room->chairs()->attach($chairArray);
                    break;
                // Chair G
                case 6:
                    $chairs = Chair::where("name", "like", "G%")->get()->toArray();
                    $chairArray = [];
                    for ($j = 0; $j < $col; $j++) { 
                        $chairArray = Arr::add($chairArray, $chairs[$j]["id"], ["number_chair" => $number]);
                        $number++;
                    }
                    $room->chairs()->attach($chairArray);
                    break;
                // Chair H
                case 7:
                    $chairs = Chair::where("name", "like", "H%")->get()->toArray();
                    $chairArray = [];
                    for ($j = 0; $j < $col; $j++) { 
                        $chairArray = Arr::add($chairArray, $chairs[$j]["id"], ["number_chair" => $number]);
                        $number++;
                    }
                    $room->chairs()->attach($chairArray);
                    break;
                // Chair I
                case 8:
                    $chairs = Chair::where("name", "like", "I%")->get()->toArray();
                    $chairArray = [];
                    for ($j = 0; $j < $col; $j++) { 
                        $chairArray = Arr::add($chairArray, $chairs[$j]["id"], ["number_chair" => $number]);
                        $number++;
                    }
                    $room->chairs()->attach($chairArray);
                    break;
                // Chair J
                case 9:
                    $chairs = Chair::where("name", "like", "J%")->get()->toArray();
                    $chairArray = [];
                    for ($j = 0; $j < $col; $j++) { 
                        $chairArray = Arr::add($chairArray, $chairs[$j]["id"], ["number_chair" => $number]);
                        $number++;
                    }
                    $room->chairs()->attach($chairArray);
                    break;
                default:
                    break;
            }
        }

        return redirect(route(config("data.route.admin.rooms.index")))->with("success", "Room has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        Room::destroy($room->id);
        return redirect(route(config("data.route.admin.rooms.index")))->with("success", "Room has been deleted");
    }

    public function previewRoom(Room $room)
    {
        // Opsi 2
        // $dataChairs = Arr::sort($room->chairs, function ($value) {
        //     return $value->row;
        // });

        $dataChairs = $room->chairs()->orderBy("number_chair")->get()->toArray();   
        $chairs = [];

        // return dd($dataChairs);
        $number = 0;
        for ($i=0; $i < $room->chair_row; $i++) { 
            for ($j=0; $j < $room->chair_col; $j++) { 
                $chairs[$i][$j] = $dataChairs[$number];
                $number++;
            }
        }
        
        return view(config("data.view.admin.rooms.preview.index"), [
            "title" => "Preview Room",
            "room" => $room,
            "chairs" => $chairs
        ]);
    }

    public function search(Request $request)
    {
        $rooms = NULL;
        $category = RoomCategory::where("category", "like", "%$request->key%")->first();
        if ($category) {     
            $rooms = Room::where("fk_id_room_category", $category->id)->paginate(5);
        } else {
            $rooms = Room::where("name", "like", "%$request->key%")->paginate(5);
        }
        if ($request->key == "") {
            $rooms = Room::paginate(5);
        }
        return view(config("data.view.admin.rooms.index"), [
            "title" => "Table Rooms",
            "rooms" => $rooms,
        ]);
    }

    public function print()
    {
        $rooms = Room::all();
        return view("admin.room.print", [
            "title" => "Data Table Rooms",
            "rooms" => $rooms,
            "column" => 12
        ]);
        // $pdf = PDF::loadview('admin.genre.print', [
        //     "title" => "Data Table Genres",
        //     "genres" => $genres,
        //     "column" => 6
        // ]);
        // return $pdf->download();
    }
}
