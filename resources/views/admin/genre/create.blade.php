@extends('admin.layouts.main')

@section('container')
    <h2 class="mt-3">Create new Film Genre</h2>
    <div class="col-lg-8 mb-5">
        <form action="{{ route("genres.store") }}" method="post">
			@csrf
			<div class="mb-3">
				<label for="genre_name" class="form-label">Film Genre Name</label>
				<input type="text" name="genre_name" class="form-control @error('genre_name') is-invalid @enderror" id="genre_name" value="{{ old("genre_name") }}" required autofocus>
				@error('genre_name')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
			
			<!-- {{-- <div class="mb-3">
				<label for="slug" class="form-label">Slug</label>
				<input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug" value="{{ old("slug") }}" required>
				@error('slug')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div> --}} -->

			<button type="submit" class="btn btn-primary">Add New Genre</button>
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