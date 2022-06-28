<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chair;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::orderBy("room_name")->paginate(5);
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

        return view(config("data.view.admin.rooms.create"), [
            "title" => "Room Create",
            "row" => $row,
            "col" => $col
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
            "room_name" => "required|max:255|unique:rooms",
            "chair_row" => "required|integer|between:$row_min,$row_max",
            "chair_col" => "required|integer|between:$col_min,$col_max"
        ];

        $validatedData = $request->validate($rulesData);

        Room::create($validatedData);
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

        return view(config("data.view.admin.rooms.edit"), [
            "title" => "Edit Rooms",
            "room" => $room,
            "row" => $row,
            "col" => $col,
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
        $row_min = config("data.chairRooms.row.min");
        $row_max = config("data.chairRooms.row.max");
        $col_min = config("data.chairRooms.col.min");
        $col_max = config("data.chairRooms.col.max");
        $rulesData = [
            "chair_row" => "required|integer|between:$row_min,$row_max",
            "chair_col" => "required|integer|between:$col_min,$col_max"
        ];

        if ($room->room_name != $request->room_name) {
            $rulesData["room_name"] = "required|max:255|unique:rooms";
        }

        $validatedData = $request->validate($rulesData);
        Room::where("id", $room->id)->update($validatedData);

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
}
