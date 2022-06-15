@extends('admin.layouts.main')

@section('container')
	<h2 class="mb-3">Edit Genre {{ $genre->title }}</h2>
	<div class="col-md-8 p-0 mb-3">
		<a class="btn btn-primary me-5" href="{{ route(config("data.route.admin.genres.index")) }}">Back to Dashboard</a>
		<form action="{{ route(config("data.route.admin.genres.delete"), $genre->id) }}" class="d-inline" method="post">
			@csrf
			@method("delete")
			<button onclick="return confirm('Confirm Delete')" class="btn btn-danger border-0">Delete</button>
		</form>
		{{-- <a class="btn btn-danger" href="{{ route(config("data.route.admin.genres.delete"), $genre->id) }}">Delete</a> --}}
	</div>
	<div class="col-md-8 mb-5 p-0">
        <form action="{{ route(config("data.route.admin.genres.update"), $genre->id) }}" method="post">
			@csrf
            @method("put")
			<div class="mb-3">
				<label for="genre_name" class="form-label">Genre Name</label>
				<input type="text" name="genre_name" class="form-control @error('genre_name') is-invalid @enderror" id="genre_name" value="{{ old("genre_name", $genre->genre_name) }}" required autofocus>
				@error('genre_name')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
			<button type="submit" class="btn btn-warning">Update Genre</button>
		</form>
    </div>
@endsection