@extends('admin.layouts.main')

@section('container')
	<h2 class="mb-3">Create new Genre Film</h2>
	<div class="col-md-8 p-0 mb-3">
		<a class="btn btn-primary me-5" href="{{ route(config("data.route.admin.genres.index")) }}">Back to Dashboard</a>
	</div>
	<div class="col-md-8 mb-5 p-0">
		<form action="{{ route(config("data.route.admin.genres.store")) }}" method="post">
			@csrf
			<div class="mb-3">
				<label for="genre_name" class="form-label">Genre Name</label>
				<input type="text" name="genre_name" class="form-control @error('genre_name') is-invalid @enderror" id="genre_name" value="{{ old("genre_name") }}" required autofocus>
				@error('genre_name')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
			<button type="submit" class="btn btn-primary">Add New Genre</button>
		</form>
	</div>
@endsection