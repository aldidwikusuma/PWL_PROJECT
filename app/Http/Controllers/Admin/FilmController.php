<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $films = Film::orderBy("title")->paginate(5);
        foreach ($films as $filmsatuan) {
            $filmsatuan["hour"] = (integer) floor($filmsatuan["duration"] / 60);
            $filmsatuan["minute"] = $filmsatuan["duration"] % 60;
        }

        return view(config("data.view.admin.films.index"), [
            "title" => "Table Films",
            "films" => $films,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = Genre::all()->toArray();
        $duration = [
            "min_hour" => config('data.time.min_hour'),
            "max_hour" => config('data.time.max_hour'),
            "min_minute" => config('data.time.min_minute'),
            "max_minute" => config('data.time.max_minute'),
        ];
        $rating = [
            "min_rating" => config("data.rating.min_rating"),
            "max_rating" => config("data.rating.max_rating")
        ];

        return view(config("data.view.admin.films.create"), [
            "title" => "Create Film",
            "genres" => $genres,
            "duration" => $duration,
            "rating" => $rating
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
        $minyear = config('data.time.min_year');
        $maxyear = config('data.time.max_year');
        $min_rating = config("data.rating.min_rating");
        $max_rating = config("data.rating.max_rating");
        $rulesData = [
            "title" => "required|max:255|unique:films",
            "image" => "required|image|file|max:1024",
            "desc" => "required",
            "hour" => "required|integer|between:0,5",
            "minute" => "required|integer|between:0,59",
            "release_year" => "required|integer|min:$minyear|max:$maxyear",
            "rating" => "required|integer|min:$min_rating|max:$max_rating",
            "fk_id_genre" => "required"
        ];

        $validatedData = $request->validate($rulesData);

        if ($request->file("image")) {
            $pathUpload = $request->file("image")->store("public/images/films");
            $arrayPathUpload = explode("/", $pathUpload);

            unset($arrayPathUpload[0]);
            $validatedData["image"] = implode("/", $arrayPathUpload);
        }

        $validatedData["duration"] = $validatedData["hour"] * 60 + $validatedData["minute"];
        Arr::forget($validatedData, ["hour", "minute"]);

        Film::create($validatedData);
        return redirect(route(config("data.route.admin.films.index")))->with("success", "Film has been added");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function show(Film $film)
    {
        $film["hour"] = (integer) floor($film["duration"] / 60);
        $film["minute"] = $film["duration"] % 60;
        return view(config("data.view.admin.films.detail"), [
            "title" => "Detail Film",
            "film" => $film
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function edit(Film $film)
    {
        $duration = [
            "min_hour" => config('data.time.min_hour'),
            "max_hour" => config('data.time.max_hour'),
            "min_minute" => config('data.time.min_minute'),
            "max_minute" => config('data.time.max_minute'),
        ];
        $rating = [
            "min_rating" => config("data.rating.min_rating"),
            "max_rating" => config("data.rating.max_rating")
        ];

        $film["hour"] = (integer) floor($film["duration"] / 60);
        $film["minute"] = $film["duration"] % 60;
        return view(config("data.view.admin.films.edit"), [
            "title" => "Edit Film",
            "genres" => Genre::all()->toArray(),
            "film" => $film,
            "duration" => $duration,
            "rating" => $rating
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Film $film)
    {
        $minyear = config('data.time.min_year');
        $maxyear = config('data.time.max_year');
        $min_rating = config("data.rating.min_rating");
        $max_rating = config("data.rating.max_rating");

        $rulesData = [
            "desc" => "required",
            "image" => "image|file|max:1024",
            "hour" => "required|integer|between:0,5",
            "minute" => "required|integer|between:0,59",
            "release_year" => "required|integer||min:$minyear|max:$maxyear",
            "rating" => "required|integer|min:$min_rating|max:$max_rating",
            "fk_id_genre" => "required"
        ];

        if ($film->title != $request->title) {
            $rulesData["title"] = "required|max:255|unique:films";
        }

        $validatedData = $request->validate($rulesData);

        if ($request->file("image")) {
            $pathUpload = $request->file("image")->store("public/images/films");
            $arrayPathUpload = explode("/", $pathUpload);
            unset($arrayPathUpload[0]);
            $validatedData["image"] = implode("/", $arrayPathUpload);
            Storage::delete("public/" . $film->image);
        }

        $validatedData["duration"] = $validatedData["hour"] * 60 + $validatedData["minute"];
        Arr::forget($validatedData, ["hour", "minute"]);
        Film::where("id", $film->id)->update($validatedData);

        return redirect(route(config("data.route.admin.films.index")))->with("success", "Film has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function destroy(Film $film)
    {
        if ($film->image) {
            Storage::delete("public/" . $film->image);
        }
        Film::destroy($film->id);
        return redirect(route(config("data.route.admin.films.index")))->with("success", "Film has been deleted");
    }

    public function search(Request $request)
    {
        $films = NULL;
        $genre = Genre::where("genre_name", "like", "%$request->key%")->first();
        if ($genre) {     
            $films = Film::where("fk_id_genre", $genre->id)->paginate(5);
        } else {
            $films = Film::where("title", "like", "%$request->key%")->paginate(5);
        }
        if ($request->key == "") {
            $films = Film::paginate(5);
        }

        if ($films) {
            foreach ($films as $filmsatuan) {
                $filmsatuan["hour"] = (integer) floor($filmsatuan["duration"] / 60);
                $filmsatuan["minute"] = $filmsatuan["duration"] % 60;
            }
        }

        return view(config("data.view.admin.films.index"), [
            "title" => "Table Films",
            "films" => $films,
        ]);
    }

    public function print()
    {
        $films = Film::all();
        return view("admin.film.print", [
            "title" => "Data Table Films",
            "films" => $films,
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
