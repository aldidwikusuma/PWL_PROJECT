@extends('admin.layouts.main')

@section('container')
	<h2 class="mb-3">Create new Chair Name</h2>
	<div class="col-md-8 p-0 mb-3">
		<a class="btn btn-primary me-5" href="{{ route(config("data.route.admin.chairs.index")) }}">Back to Dashboard</a>
	</div>
	<div class="col-md-8 mb-5 p-0">
		<form action="{{ route(config("data.route.admin.chairs.store")) }}" method="post">
			@csrf
			<div class="mb-3">
				<label for="name" class="form-label">Chair Name</label>
				<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old("name") }}" required autofocus>
				@error('name')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
			<button type="submit" class="btn btn-primary">Add New Chair Name</button>
		</form>
	</div>
@endsection