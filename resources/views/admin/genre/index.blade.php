@extends('admin.layouts.main')

@section('container')
	{{-- <h2 class="mt-3">{{ auth()->user()->name }} Posts | Total = {{ $total }}</h2> --}}
    <a class="btn btn-primary mb-3" href="{{ route(config("data.route.admin.genres.create")) }}">Create new Film Genre</a>
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
					<th scope="col">Genre Name</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
                @foreach ($genres as $genre)                
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $genre->genre_name }}</td>
                        <td>
                            <a href="{{ route(config("data.route.admin.genres.edit"), $genre->id) }}" class="btn btn-warning mx-2">Edit</a>
                            <form action="{{ route(config("data.route.admin.genres.delete"), $genre->id) }}" class="d-inline" method="post">
                                @csrf
                                @method("delete")
                                <button onclick="return confirm('Confirm Delete')" class="btn btn-danger border-0">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
			</tbody>
		</table>
	</div>
    <div class="d-flex justify-content-center">
        {{ $genres->links() }}
    </div>
@endsection