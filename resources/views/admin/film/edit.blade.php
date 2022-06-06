@extends('admin.layouts.main')

@section('container')
    <h2 class="mt-3">Update Film</h2>
    <div class="col-lg-8 mb-5">
        <form action="{{ route("films.update", $film->id) }}" method="post">
			@csrf
            @method("put")
			<div class="mb-3">
				<label for="title" class="form-label">Title</label>
				<input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old("title", $film->title) }}" required autofocus>
				@error('title')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
			{{-- <div class="mb-3">
				<label for="image" class="form-label">Post Image</label>
				<img class="img-preview img-fluid mb-3 col-md-5">
				<input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
				@error('image')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div> --}}
			<div class="mb-3">
				<label for="desc" class="form-label">Description</label>
				<textarea class="form-control @error('desc') is-invalid @enderror" name="desc" id="desc" rows="3">{{ old("desc", $film->desc) }}</textarea>
				@error('desc')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="hour" class="form-label">Duration</label>
				<div class=" input-group">
					<input type="number" class="form-control @error('hour') is-invalid @enderror" name="hour" id="hour" value="{{ old("hour", $film->hour) }}" required>
					<span class="input-group-text">Hour</span>
					<input type="number" class="form-control @error('minute') is-invalid @enderror" name="minute" id="minute" value="{{ old("minute", $film->minute) }}" required>
					<span class="input-group-text">Minute</span>
					@error('hour')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
					@error('minute')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>
			</div>

			<div class="mb-3">
				<label for="genre" class="form-label @error('fk_id_genre') is-invalid @enderror">Genre</label>
				<select class="form-select" name="fk_id_genre" id="genre" required>
					@foreach ($genres as $genresatuan)
						@if (old("fk_id_genre", $film->fk_id_genre) == $genresatuan->id)
							<option value="{{ $genresatuan->id }}" selected>{{ $genresatuan->genre_name }}</option>
						@else
							<option value="{{ $genresatuan->id }}">{{ $genresatuan->genre_name }}</option>
						@endif
					@endforeach
				</select>
				@error('fk_id_genre')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>

			<div class="mb-3">
				<label for="release_year" class="form-label">Release Year</label>
				<input type="number" name="release_year" class="form-control @error('release_year') is-invalid @enderror" id="release_year" value="{{ old("release_year", $film->release_year) }}" required>
				@error('release_year')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>

			<div class="mb-3">
				<label for="rating" class="form-label">Rating</label>
				<input type="number" name="rating" class="form-control @error('rating') is-invalid @enderror" id="rating" value="{{ old("rating", $film->rating) }}" required>
				@error('rating')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>

			
			<button type="submit" class="btn btn-warning">Update Film</button>
		</form>
    </div>

	<script>
		// const title = document.querySelector("#title");
		// const slug = document.querySelector("#slug");

		// title.addEventListener("change", function(){
		// 	fetch("/dashboard/posts/createSlug?title=" + title.value)
		// 	.then(response => response.json())
		// 	.then(data => slug.value = data.slug)
		// })

		// function previewImage(){
		// 	const image = document.querySelector("#image");
		// 	const imgPreview = document.querySelector(".img-preview");

		// 	imgPreview.style.display = "block";
		// 	imgPreview.style.maxHeight = "200px";
		// 	imgPreview.style.maxWidth = "100%";

		// 	const oFReader = new FileReader();
		// 	oFReader.readAsDataURL(image.files[0]);

		// 	oFReader.onload = function (oFREvent) {
		// 		imgPreview.src = oFREvent.target.result;
		// 	}
		// }
	</script>
@endsection