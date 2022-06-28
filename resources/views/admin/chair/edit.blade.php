@extends('admin.layouts.main')

@section('container')
	<h2 class="mb-3">Edit Chair Name {{ $chair->name }}</h2>
	<div class="col-md-8 p-0 mb-3">
		<a class="btn btn-primary me-5" href="{{ route(config("data.route.admin.genres.index")) }}">Back to Dashboard</a>
		<form action="{{ route(config("data.route.admin.chairs.delete"), $chair->id) }}" class="d-inline" method="post">
			@csrf
			@method("delete")
			<button onclick="return confirm('Confirm Delete')" class="btn btn-danger border-0">Delete</button>
		</form>
	</div>
	<div class="col-md-8 mb-5 p-0">
        <form action="{{ route(config("data.route.admin.chairs.update"), $chair->id) }}" method="post">
			@csrf
            @method("put")
			<div class="mb-3">
				<label for="name" class="form-label">Chair Name</label>
				<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old("name", $chair->name) }}" required autofocus>
				@error('name')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="fk_id_chair_category" class="form-label @error('fk_id_chair_category') is-invalid @enderror">Category</label>
				@if ($chairCategories)
					<select class="form-select" name="fk_id_chair_category" id="fk_id_chair_category" required>
						@foreach ($chairCategories as $chairCategory)
							@if (old("fk_id_chair_category") == $chairCategory["id"])
								<option value="{{ $chairCategory["id"] }}" selected>{{ $chairCategory["category"] }} (Rp. {{ $chairCategory["price"] }})</option>
							@else
								<option value="{{ $chairCategory["id"] }}">{{ $chairCategory["category"] }} (Rp. {{ $chairCategory["price"] }})</option>
							@endif
						@endforeach
					</select>
				@else
					<div class="form-control is-invalid">No Chair Category. Please add Chair Category <a href="{{ route(config("data.route.admin.chaircategory.index")) }}">here</a></div>
				@endif
				@error('fk_id_chair_category')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
			<button type="submit" class="btn btn-warning">Update Chair Name</button>
		</form>
    </div>
@endsection