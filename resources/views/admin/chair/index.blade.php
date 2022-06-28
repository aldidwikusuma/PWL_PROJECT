@extends('admin.layouts.main')

@section('container')
    <a class="btn btn-primary mb-3" href="{{ route(config("data.route.admin.chairs.create")) }}">Create new Chair Name</a>
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
@endsection