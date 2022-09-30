<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chair;
use App\Models\ChairCategory;
use Illuminate\Http\Request;

class ChairController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $chairs = Chair::orderBy("name")->paginate(10);
        return view(config("data.view.admin.chairs.index"), [
            "title" => "Table Chair",
            "chairs" => $chairs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(config("data.view.admin.chairs.create"), [
            "title" => "Chair Name Create",
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
        $rulesData = [
            "name" => "required|max:255|unique:chairs",
        ];

        $validatedData = $request->validate($rulesData);

        Chair::create($validatedData);
        return redirect(route(config("data.route.admin.chairs.store")))->with("success", "Chair has been added");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chair  $chair
     * @return \Illuminate\Http\Response
     */
    public function show(Chair $chair)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chair  $chair
     * @return \Illuminate\Http\Response
     */
    public function edit(Chair $chair)
    {
        return view(config("data.view.admin.chairs.edit"), [
            "title" => "Chair Name Edit",
            "chair" => $chair,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chair  $chair
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chair $chair)
    {
        $rulesData = [  ];
        if ($chair->name != $request->name) {
            $rulesData["name"] = "required|max:255|unique:chairs";
        }

        $validatedData = $request->validate($rulesData);

        Chair::where("id", $chair->id)->update($validatedData);

        return redirect(route(config("data.route.admin.chairs.index")))->with("success", "Chair has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chair  $chair
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chair $chair)
    {
        Chair::destroy($chair->id);
        return redirect(route(config("data.route.admin.chairs.index")))->with("success", "Chair Category has been deleted");
    }

    public function search(Request $request)
    {
        $chairs = Chair::where("name", "like", "%$request->key%")->paginate(10);
        return view(config("data.view.admin.chairs.index"), [
            "title" => "Table Chairs",
            "chairs" => $chairs,
        ]);
    }

    public function print()
    {
        $chairs = Chair::all();
        return view("admin.chair.print", [
            "title" => "Data Table Chairs",
            "chairs" => $chairs,
            "column" => 6
        ]);
    }
}
