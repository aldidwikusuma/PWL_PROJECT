@extends('admin.layouts.main')

@section('container')
    <a class="btn btn-primary mb-3" href="{{ route(config("data.route.admin.roomcategory.create")) }}">Create new Room Category</a>
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
					<th scope="col">Category Name</th>
					<th scope="col">Price</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
                @foreach ($categories as $category)                
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->category }}</td>
                        <td>Rp {{ $category->price }}</td>
                        <td>
                            <a href="{{ route(config("data.route.admin.roomcategory.edit"), $category->id) }}" class="btn btn-warning mx-2">Edit</a>
                            <form action="{{ route(config("data.route.admin.roomcategory.delete"), $category->id) }}" class="d-inline" method="post">
                                @csrf
                                @method("delete")
                                <button onclick="return confirm('Warning !!!\nDeleting data makes it possible to delete data related to this data\nSpecially table data ROOMS, SCHEDULES, CHAIRS_ROOMS, and TRANSACTION\nStill Delete ?')" class="btn btn-danger border-0">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
			</tbody>
		</table>
	</div>
    <div class="d-flex justify-content-center">
        {{ $categories->links() }}
    </div>
@endsection