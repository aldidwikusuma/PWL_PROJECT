@extends('admin.layouts.main')

@section('container')
	{{-- <h2 class="mt-3">{{ auth()->user()->name }} Posts | Total = {{ $total }}</h2> --}}
    <a class="btn btn-primary mb-3" href="{{ route(config("data.route.admin.rooms.create")) }}">Create new Room</a>
    @if (session()->has("success")) 
        <div class="col-md-5 p-0">  
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session("success") }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
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
					<th scope="col">Room Name</th>
					<th scope="col">Chair Row - Col</th>
					<th scope="col">Room Category</th>
					<th scope="col">Room Preview</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
                @foreach ($rooms as $room)                
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $room->name }}</td>
                        <td>{{ $room->chair_row }} Rows - {{ $room->chair_col }} Cols</td>
                        <td>{{ $room->category->category }} (Rp. {{ $room->category->price }})</td>
                        <td><a href="{{ route(config("data.route.admin.rooms.preview.index"), $room->id) }}" class="btn btn-info">Preview</a></td>
                        <td>
                            <a href="{{ route(config("data.route.admin.rooms.detail"), $room->id) }}" class="btn btn-info">Detail</a>
                            <a href="{{ route(config("data.route.admin.rooms.edit"), $room->id) }}" class="btn btn-warning mx-2">Edit</a>
                            <form action="{{ route(config("data.route.admin.rooms.delete"), $room->id) }}" class="d-inline" method="post">
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
        {{ $rooms->links() }}
    </div>
@endsection