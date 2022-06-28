<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomCategory;
use Illuminate\Http\Request;

class RoomCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = RoomCategory::orderBy("price")->paginate(10);
        return view(config("data.view.admin.roomcategory.index"), [
            "title" => "Table Room Category",
            "categories" => $category,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(config("data.view.admin.roomcategory.create"), [
            "title" => "Room Category Create",
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
        $minprice = config("data.roomPrice.min");
        $maxprice = config("data.roomPrice.max");
        $rulesData = [
            "category" => "required|max:255|unique:room_categories",
            "price" => "required|integer|min:$minprice|max:$maxprice"
        ];

        $validatedData = $request->validate($rulesData);

        RoomCategory::create($validatedData);
        return redirect(route(config("data.route.admin.roomcategory.index")))->with("success", "Room Category has been added");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RoomCategory  $roomCategory
     * @return \Illuminate\Http\Response
     */
    public function show(RoomCategory $roomCategory)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RoomCategory  $roomCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(RoomCategory $roomCategory)
    {
        return view(config("data.view.admin.roomcategory.edit"), [
            "title" => "Room Category Edit",
            "category" => $roomCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RoomCategory  $roomCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoomCategory $roomCategory)
    {
        $minprice = config("data.roomPrice.min");
        $maxprice = config("data.roomPrice.max");
        $rulesData = [
            "price" => "required|integer|min:$minprice|max:$maxprice"
        ];
        if ($roomCategory->category != $request->category) {
            $rulesData["category"] = "required|max:255|unique:room_categories";
        }

        $validatedData = $request->validate($rulesData);

        RoomCategory::where("id", $roomCategory->id)->update($validatedData);

        return redirect(route(config("data.route.admin.roomcategory.index")))->with("success", "Room Category has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RoomCategory  $roomCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoomCategory $roomCategory)
    {
        RoomCategory::destroy($roomCategory->id);
        return redirect(route(config("data.route.admin.roomcategory.index")))->with("success", "Room Category has been deleted");
    }
}
