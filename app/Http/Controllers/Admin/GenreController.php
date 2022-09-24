<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Http\Controllers\Controller;
use App\Models\Genre;
// use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
// use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = Genre::paginate(5);
        return view(config("data.view.admin.genres.index"), [
            "title" => "Table Genres",
            "genres" => $genres,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(config("data.view.admin.genres.create"), [
            "title" => "Genres Create",
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
            "genre_name" => "required|max:255|unique:genres",
        ];

        $validatedData = $request->validate($rulesData);

        Genre::create($validatedData);
        return redirect(route(config("data.route.admin.genres.index")))->with("success", "Genre has been added");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function show(Genre $genre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function edit(Genre $genre)
    {
        return view(config("data.view.admin.genres.edit"), [
            "title" => "Genres Edit",
            "genre" => $genre
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Genre $genre)
    {
        $rulesData = [];
        if ($genre->genre_name != $request->genre_name) {
            $rulesData["genre_name"] = "required|max:255|unique:genres";
        }

        $validatedData = $request->validate($rulesData);

        Genre::where("id", $genre->id)->update($validatedData);

        return redirect(route(config("data.route.admin.genres.index")))->with("success", "Genre has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre)
    {
        Genre::destroy($genre->id);
        return redirect(route(config("data.route.admin.genres.index")))->with("success", "Genre has been deleted");
    }

    public function search(Request $request)
    {
        $genres = Genre::where("genre_name", "like", "%$request->key%")->paginate(5);
        return view(config("data.view.admin.genres.index"), [
            "title" => "Table Genres",
            "genres" => $genres,
        ]);
    }

    public function print()
    {
        $genres = Genre::all();
        // return view("admin.genre.print", [
        //     "title" => "Data Table Genres",
        //     "genres" => $genres,
        //     "column" => 6
        // ]);
        $pdf = PDF::loadview('admin.genre.print', [
            "title" => "Data Table Genres",
            "genres" => $genres,
            "column" => 6
        ]);
        return $pdf->stream();
    }
}
