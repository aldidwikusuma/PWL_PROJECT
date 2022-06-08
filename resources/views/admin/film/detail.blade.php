@extends('admin.layouts.main')

@section('container')
    <h2 class="mb-3">Detail Film {{ $film->title }}</h2>
    <div class="col-md-8 p-0 mb-3">
        <a class="btn btn-primary" href="{{ route(config("data.route.admin.films.index")) }}">Back to Dashboard</a>
        <a class="btn btn-warning mx-5" href="{{ route(config("data.route.admin.films.edit"), $film->id) }}">Edit Data</a>
        <a class="btn btn-danger" href="{{ route(config("data.route.admin.films.delete"), $film->id) }}">Delete Data</a>
    </div>
    <div class="col-md-8 mb-5 p-0">
        <div class="d-flex">
            <div class="col-md-4 p-0">
                <img src="{{ asset("storage/" . $film->image) }}" class="rounded shadow-sm border-1 border-primary my-3" width="100%" alt="{{ $film->title }}" style="display: block; aspect-ratio: 2/3; object-fit:cover; border:solid;"/>
            </div>
            <div class="col-md-8">
                <div class="row my-3 p-0">
                    <div class="col-md-4">
                        <span class="form-control border-1 border-primary">Title</span>
                    </div>
                    <div class="col-md-8">
                        <span class="form-control border-1 border-primary">{{ $film->title }}</span>
                    </div>
                </div>
                <div class="row my-3 p-0">
                    <div class="col-md-4">
                        <span class="form-control border-1 border-primary">Release Year</span>
                    </div>
                    <div class="col-md-8">
                        <span class="form-control border-1 border-primary">{{ $film->release_year }}</span>
                    </div>
                </div>
                <div class="row my-3 p-0">
                    <div class="col-md-4">
                        <span class="form-control border-1 border-primary">Duration</span>
                    </div>
                    <div class="col-md-8">
                        <span class="form-control border-1 border-primary">{{ $film->hour }} Hours {{ $film->minute }} Minutes</span>
                    </div>
                </div>
                <div class="row my-3 p-0">
                    <div class="col-md-4">
                        <span class="form-control border-1 border-primary">Rating</span>
                    </div>
                    <div class="col-md-8">
                        <span class="form-control border-1 border-primary">{{ $film->rating }}</span>
                    </div>
                </div>
                <div class="row my-3 p-0 flex-column">
                    <div class="col mb-3">
                        <span class="form-control border-1 border-primary">Description</span>
                    </div>
                    <div class="col">
                        <span class="form-control border-1 border-primary text-justify overflow-auto" style="height: 150px"> {{ $film->desc }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection