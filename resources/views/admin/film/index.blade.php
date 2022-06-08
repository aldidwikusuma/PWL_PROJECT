@extends('admin.layouts.main')

@section('container')
	{{-- <h2 class="mt-3">{{ auth()->user()->name }} Posts | Total = {{ $total }}</h2> --}}
    <a class="btn btn-primary mb-3" href="{{ route(config("data.route.admin.films.create")) }}">Create new Film</a>
    @if (session()->has("success")) 
        <div class="col-md-5 p-0">  
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session("success") }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
	<div class="table-responsive">
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
					<th scope="col">Title</th>
					<th scope="col">Duration</th>
					<th scope="col">Rating</th>
					<th scope="col">Genre</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
                @foreach ($films as $filmsatuan)                
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $filmsatuan->title }}</td>
                        <td>{{ $filmsatuan->hour }} Hours {{ $filmsatuan->minute }} Minutes</td>
                        <td>{{ $filmsatuan->rating }}</td>
                        <td>{{ $filmsatuan->genre->genre_name }}</td>
                        <td>
                            <a href="{{ route("films.show", $filmsatuan->id) }}" class="btn btn-info">Detail</a>
                            <a href="{{ route("films.edit", $filmsatuan->id) }}" class="btn btn-warning mx-2">Edit</a>
                            <form action="{{ route("films.destroy", $filmsatuan->id) }}" class="d-inline" method="post">
                                @csrf
                                @method("delete")
                                <button onclick="return confirm('Konfirmasi Hapus')" class="btn btn-danger border-0">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
			</tbody>
		</table>
	</div>
@endsection