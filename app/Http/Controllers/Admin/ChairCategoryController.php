<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChairCategory;
use Illuminate\Http\Request;

class ChairCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = ChairCategory::orderBy("price")->paginate(10);
        return view(config("data.view.admin.chaircategory.index"), [
            "title" => "Table Chair Category",
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
        return view(config("data.view.admin.chaircategory.create"), [
            "title" => "Chair Category Create",
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
        $minprice = config("data.chairPrice.min");
        $maxprice = config("data.chairPrice.max");
        $rulesData = [
            "category" => "required|max:255|unique:chair_categories",
            "price" => "required|integer|min:$minprice|max:$maxprice"
        ];

        $validatedData = $request->validate($rulesData);

        ChairCategory::create($validatedData);
        return redirect(route(config("data.route.admin.chaircategory.index")))->with("success", "Chair Category has been added");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChairCategory  $chairCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ChairCategory $chairCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChairCategory  $chairCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ChairCategory $chairCategory)
    {
        return view(config("data.view.admin.chaircategory.edit"), [
            "title" => "Genres Edit",
            "category" => $chairCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChairCategory  $chairCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChairCategory $chairCategory)
    {
        $minprice = config("data.chairPrice.min");
        $maxprice = config("data.chairPrice.max");
        $rulesData = [
            "price" => "required|integer|min:$minprice|max:$maxprice"
        ];
        if ($chairCategory->category != $request->category) {
            $rulesData["category"] = "required|max:255|unique:chair_categories";
        }

        $validatedData = $request->validate($rulesData);

        ChairCategory::where("id", $chairCategory->id)->update($validatedData);

        return redirect(route(config("data.route.admin.chaircategory.index")))->with("success", "Chair Category has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChairCategory  $chairCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChairCategory $chairCategory)
    {
        ChairCategory::destroy($chairCategory->id);
        return redirect(route(config("data.route.admin.chaircategory.index")))->with("success", "Chair Category has been deleted");
    }
}
