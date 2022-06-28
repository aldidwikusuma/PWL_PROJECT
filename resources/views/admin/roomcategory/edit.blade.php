@extends('admin.layouts.main')

@section('container')
	<h2 class="mb-3">Edit Room Category {{ $category->category }}</h2>
	<div class="col-md-8 p-0 mb-3">
		<a class="btn btn-primary me-5" href="{{ route(config("data.route.admin.roomcategory.index")) }}">Back to Dashboard</a>
		<form action="{{ route(config("data.route.admin.roomcategory.delete"), $category->id) }}" class="d-inline" method="post">
			@csrf
			@method("delete")
			<button onclick="return confirm('Warning !!!\nDeleting data makes it possible to delete data related to this data\nSpecially table data ROOMS, SCHEDULES, CHAIRS_ROOMS, and TRANSACTION\nStill Delete ?')" class="btn btn-danger border-0">Delete</button>
		</form>
	</div>
	<div class="col-md-8 mb-5 p-0">
        <form action="{{ route(config("data.route.admin.roomcategory.update"), $category->id) }}" method="post">
			@csrf
            @method("put")
			<div class="mb-3">
				<label for="category" class="form-label">Category Name</label>
				<input type="text" name="category" class="form-control @error('category') is-invalid @enderror" id="category" value="{{ old("category", $category->category) }}" required autofocus>
				@error('category')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="price" class="form-label">Price</label>
				<input type="number" step="1000" name="price" class="form-control @error('price') is-invalid @enderror" id="price" value="{{ old("price", $category->price) }}" required>
				@error('price')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
			<button type="submit" class="btn btn-warning">Update Category</button>
		</form>
    </div>
@endsection