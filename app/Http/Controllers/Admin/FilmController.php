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
        $films = Film::all();
        foreach ($films as $filmsatuan) {
            $filmsatuan["hour"] = (integer) floor($filmsatuan["duration"] / 60);
            $filmsatuan["minute"] = $filmsatuan["duration"] % 60;
        }

        return view(config("data.view.admin.films.index"), [
            "title" => "Films",
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
            "title" => "Create Films",
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

        $rulesData = [
            "title" => "required|max:255|unique:films",
            "image" => "required|image|file|max:1024",
            "desc" => "required",
            "hour" => "required|integer|between:0,5",
            "minute" => "required|integer|between:0,59",
            "release_year" => "required|integer||min:$minyear|max:$maxyear",
            "rating" => "required|integer|min:6|max:20",
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
        return redirect(route("films.index"))->with("success", "Data berhasil ditambahkan");
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
            "title" => "Detail Films",
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
            "title" => "Edit Films",
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

        $rulesData = [
            "desc" => "required",
            "image" => "image|file|max:1024",
            "hour" => "required|integer|between:0,5",
            "minute" => "required|integer|between:0,59",
            "release_year" => "required|integer||min:$minyear|max:$maxyear",
            "rating" => "required|integer|mi    n:6|max:20",
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

        return redirect(route("films.index"))->with("success", "Your posts has been updated");
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
        return redirect(route("films.index"))->with("success", "Data telah dihapus");
    }
}
