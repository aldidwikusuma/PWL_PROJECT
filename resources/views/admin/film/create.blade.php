@extends('admin.layouts.main')

@section('container')
    <h2 class="mb-3">Create new List Film</h2>
	<div class="col-md-8 p-0 mb-3">
        <a class="btn btn-primary me-5" href="{{ route(config("data.route.admin.films.index")) }}">Back to Dashboard</a>
    </div>
    <div class="col-md-8 mb-5 p-0">
        <form action="{{ route("films.store") }}" method="post" enctype="multipart/form-data">
			@csrf
			<div class="mb-3">
				<label for="title" class="form-label">Title</label>
				<input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old("title") }}" required autofocus>
				@error('title')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="image" class="form-label">Image</label>
				<span>
					<img class="img-preview img-fluid mb-3 p-0 border-1 border-primary hidden" id="image-preview" style="border: solid">
				</span>
				<input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image">
				@error('image')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
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
		const inputImage = document.querySelector("#image");
		const previewImage = document.querySelector("#image-preview.img-preview");
		
		inputImage.onchange = function(){
			previewImage.classList.remove("hidden")			
			previewImage.style.display = "block";
			previewImage.style.height = "350px";
			previewImage.style.aspectRatio = "2/3";
			previewImage.style.objectFit = "cover";

			const oFReader = new FileReader();
			oFReader.readAsDataURL(inputImage.files[0]);

			oFReader.onload = function (oFREvent) {
				previewImage.src = oFREvent.target.result;
			}
		}
	</script>
@endsection