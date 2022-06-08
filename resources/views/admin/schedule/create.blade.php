@extends('admin.layouts.main')

@section('container')
    <h2 class="mt-3">Create new Schedule Film</h2>
    <div class="col-lg-8 mb-5">
        <form action="{{ route("films.store") }}" method="post">
			@csrf
			<div class="mb-3">
				<label for="day" class="form-label">Day</label>
				<input type="text" name="day" class="form-control @error('day') is-invalid @enderror" id="day" value="{{ old("day") }}" required autofocus>
				@error('day')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
			{{-- <div class="mb-3">
				<label for="image" class="form-label">Hour</label>
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
				<textarea class="form-control @error('desc') is-invalid @enderror" name="desc" id="desc" rows="3">{{ old("desc") }}</textarea>
				@error('desc')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="hour" class="form-label">Duration</label>
				<div class=" input-group">
					<select class="form-select @error('hour') is-invalid @enderror" name="hour" id="hour" required>
						@for ($i = $duration["min_hour"]; $i <= $duration["max_hour"] ; $i++)
							@if (old("hour") == $i)
								<option value="{{ $i }}" selected>{{ $i }}</option>
							@else
								<option value="{{ $i }}">{{ $i }}</option>
							@endif
						@endfor
					</select>
					<span class="input-group-text">Hour</span>
					<select class="form-select @error('minute') is-invalid @enderror" name="minute" id="minute" required>
						@for ($i = $duration["min_minute"]; $i <= $duration["max_minute"] ; $i++)
							@if (old("minute") == $i)
								<option value="{{ $i }}" selected>{{ $i < 10 ? "0" . $i : $i }}</option>
							@else
								<option value="{{ $i }}">{{ $i < 10 ? "0" . $i : $i }}
							@endif
						@endfor
					</select>
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
			{{-- <div class="mb-3">
				<label for="slug" class="form-label">Slug</label>
				<input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug" value="{{ old("slug") }}" required>
				@error('slug')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div> --}}
			<div class="mb-3">
				<label for="genre" class="form-label @error('fk_id_genre') is-invalid @enderror">Genre</label>
				@if ($genres)
					<select class="form-select" name="fk_id_genre" id="genre" required>
						@foreach ($genres as $genresatuan)
							@if (old("fk_id_genre") == $genresatuan["id"])
								<option value="{{ $genresatuan["id"] }}" selected>{{ $genresatuan["genre_name"] }}</option>
							@else
								<option value="{{ $genresatuan["id"] }}">{{ $genresatuan["genre_name"] }}</option>
							@endif
						@endforeach
					</select>
				@else
				{{-- route(config("data.route.admin.genres.index"))  --}}
					<div class="form-control is-invalid">No Genre. Please add Genre <a href="">here</a></div>
				@endif
				@error('fk_id_genre')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>

			<div class="mb-3">
				<label for="release_year" class="form-label">Release Year</label>
				<input type="number" name="release_year" class="form-control @error('release_year') is-invalid @enderror" id="release_year" value="{{ old("release_year") }}" required>
				@error('release_year')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="rating" class="form-label">Rating</label>
				<select class="form-select @error('rating') is-invalid @enderror" name="rating" id="rating" required>
					@for ($i = $rating["min_rating"]; $i <= $rating["max_rating"] ; $i++)
						@if (old("rating") == $i)
							<option value="{{ $i }}" selected>{{ $i }}</option>
						@else
							<option value="{{ $i }}">{{ $i }}</option>
						@endif
					@endfor
				</select>
				@error('rating')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>

			<button type="submit" class="btn btn-primary">Add List Film</button>
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