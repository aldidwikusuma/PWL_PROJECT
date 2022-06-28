@extends('admin.layouts.main')

@section('container')
    <h2 class="mb-3">Detail Schedule | ID Schedule {{ $schedule->id }}</h2>
    <div class="col-md-8 p-0 mb-3">
        <a class="btn btn-primary" href="{{ route(config("data.route.admin.schedules.index")) }}">Back to Dashboard</a>
        <a class="btn btn-warning mx-5" href="{{ route(config("data.route.admin.schedules.edit"), $schedule->id) }}">Edit</a>
        <a class="btn btn-danger" href="{{ route(config("data.route.admin.schedules.delete"), $schedule->id) }}">Delete</a>
    </div>
    <div class="col-xl-8 mb-5 p-0">
        <div class="d-flex">
            <div class="col-md-4 p-0">
                <img src="{{ asset("storage/" . $schedule->film->image) }}" class="rounded shadow-sm border-1 border-primary my-3" width="100%" alt="{{ $schedule->film->title }}" style="display: block; aspect-ratio: 2/3; object-fit:cover; border:solid;"/>
            </div>
            <div class="col-md-8">
                <div class="row my-3 p-0">
                    <div class="col-md-4">
                        <span class="form-control border-1 border-primary">Date Playing</span>
                    </div>
                    <div class="col-md-8">
                        <span class="form-control border-1 border-primary">{{ $schedule->date }}</span>
                    </div>
                </div>
                <div class="row my-3 p-0">
                    <div class="col-md-4">
                        <span class="form-control border-1 border-primary">Time Playing</span>
                    </div>
                    <div class="col-md-8">
                        <span class="form-control border-1 border-primary">{{ $schedule->time }}</span>
                    </div>
                </div>
                <div class="row my-3 p-0">
                    <div class="col-md-4">
                        <span class="form-control border-1 border-primary">End Playing</span>
                    </div>
                    <div class="col-md-8">
                        <span class="form-control border-1 border-primary">{{ $schedule->endtime }}</span>
                    </div>
                </div>
                <div class="row my-3 p-0">
                    <div class="col-md-4">
                        <span class="form-control border-1 border-primary">Film</span>
                    </div>
                    <div class="col-md-8">
                        <span class="form-control border-1 border-primary">{{ $schedule->film->title }}</span>
                    </div>
                </div>
                <div class="row my-3 p-0">
                    <div class="col-md-4">
                        <span class="form-control border-1 border-primary">Film Duration</span>
                    </div>
                    <div class="col-md-8">
                        <span class="form-control border-1 border-primary">{{ $schedule->film->hour }} Hours {{ $schedule->film->minute }} Minutes</span>
                    </div>
                </div>
                <div class="row my-3 p-0">
                    <div class="col-md-4">
                        <span class="form-control border-1 border-primary">Room</span>
                    </div>
                    <div class="col-md-8">
                        <span class="form-control border-1 border-primary">{{ $schedule->room->room_name }}</span>
                    </div>
                </div>
                <div class="row my-3 p-0">
                    <div class="col-md-4">
                        <span class="form-control border-1 border-primary">Room Size</span>
                    </div>
                    <div class="col-md-8">
                        <span class="form-control border-1 border-primary">{{ $schedule->room->chair_row * $schedule->room->chair_col  }} Chairs | {{ $schedule->room->chair_row }} Rows X {{ $schedule->room->chair_col }} Columns</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection