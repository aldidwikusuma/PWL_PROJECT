@extends('admin.layouts.main')

@section('container')
    <div class="d-flex flex-wrap mb-5 align-items-center justify-content-between">
        <form action="{{ route(config("data.route.admin.chairs.search")) }}" method="post" class="d-inline-block navbar-search" style="width: 60%">
            @csrf
            @method("post")
            <div class="input-group">
                <input id="inputkey" type="text" name="key" value="{{ request("key") }}" autofocus="" autocomplete="off" class="form-control bg-light border-1 border-primary small" placeholder="Search by Chair Name" />
                <input id="inputtabel" type="hidden" value="{{ "test" }}" />
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>
        <a class="btn btn-primary" href="{{ route(config("data.route.admin.chairs.create")) }}">Create new Chair Name</a>
        @if ($chairs->count() > 0)
            {{-- <form action="{{ route(config("data.route.admin.genres.print")) }}" class="d-inline" method="post">
                @csrf
                @method("post")
                <button class="btn btn-success border-0">Generete Report</button>
            </form> --}}
            <a class="btn btn-success" href="{{ route(config("data.route.admin.chairs.print")) }}">Generate Report</a>
        @endif
    </div>
    @if (session()->has("success")) 
        <div class="col-md-5 p-0">  
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session("success") }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    @if ($chairs->count() > 0)
        <div class="table-responsive mb-5">
            <table class="table table-striped table-sm">
                <style>
                    table.table thead tr th:nth-child(1)    , 
                    table.table tbody tr td:nth-child(1){
                        text-align: center
                    }

                    table.table tbody tr td{
                        vertical-align: middle !important;
                    }
                </style>
                <thead>
                    <tr>
                        <th scope="col">Number</th>
                        <th scope="col">Chair Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($chairs as $chair)                
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $chair->name }}</td>
                            <td>
                                <a href="{{ route(config("data.route.admin.chairs.edit"), $chair->id) }}" class="btn btn-warning mx-2">Edit</a>
                                <form action="{{ route(config("data.route.admin.chairs.delete"), $chair->id) }}" class="d-inline" method="post">
                                    @csrf
                                    @method("delete")
                                    <button onclick="return confirm('Warning !!!\nDeleting data makes it possible to delete data related to this data\nSpecially table data CHAIRS_ROOMS, SCHEDULES and TRANSACTION\nStill Delete ?')" class="btn btn-danger border-0">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {{ $chairs->links() }}
        </div>
    @else
        <div class="d-flex">
            <h3>No Data</h3>
        </div>
    @endif

@endsection