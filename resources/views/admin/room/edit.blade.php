@extends('admin.layouts.main')

@section('container')
    <h2 class="mb-3">Edit Room {{ $room->name }}</h2>
	<div class="col-md-8 p-0 mb-3">
        <a class="btn btn-primary me-5" href="{{ route(config("data.route.admin.rooms.index")) }}">Back to Dashboard</a>
    </div>
    <div class="col-md-8 mb-5 p-0">
        <form action="{{ route(config("data.route.admin.rooms.update"), $room->id) }}" method="post" enctype="multipart/form-data">
			@csrf
            @method("put")
			<div class="mb-3">
				<label for="name" class="form-label">Room Name</label>
				<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old("name", $room->name) }}" required autofocus>
				@error('name')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="chair_row" class="form-label">Chair Row</label>
				<select class="form-select @error('chair_row') is-invalid @enderror" name="chair_row" id="chair_row" required>
					@for ($i = $row["min"]; $i <= $row["max"] ; $i++)
						@if (old("chair_row", $room->chair_row) == $i)
							<option value="{{ $i }}" selected>{{ $i }}</option>
						@else
							<option value="{{ $i }}">{{ $i }}</option>
						@endif
					@endfor
				</select>
				@error('chair_row')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="chair_col" class="form-label">Chair Column</label>
				<select class="form-select @error('chair_col') is-invalid @enderror" name="chair_col" id="chair_col" required>
					@for ($i = $col["min"]; $i <= $col["max"] ; $i+=2)
						@if (old("chair_col", $room->chair_col) == $i)
							<option value="{{ $i }}" selected>{{ $i }}</option>
						@else
							<option value="{{ $i }}">{{ $i }}</option>
						@endif
					@endfor
				</select>
				@error('chair_col')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="fk_id_room_category" class="form-label @error('fk_id_room_category') is-invalid @enderror">Category</label>
				@if ($roomCategories)
					<select class="form-select" name="fk_id_room_category" id="fk_id_room_category" required>
						@foreach ($roomCategories as $roomCategory)
							@if (old("fk_id_room_category", $room->fk_id_room_category) == $roomCategory["id"])
								<option value="{{ $roomCategory["id"] }}" selected>{{ $roomCategory["category"] }} (Rp. {{ $roomCategory["price"] }})</option>
							@else
								<option value="{{ $roomCategory["id"] }}">{{ $roomCategory["category"] }} (Rp. {{ $roomCategory["price"] }})</option>
							@endif
						@endforeach
					</select>
				@else
					<div class="form-control is-invalid">No Room Category. Please add Room Category <a href="{{ route(config("data.route.admin.roomcategory.index")) }}">here</a></div>
				@endif
				@error('fk_id_room_category')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
			<button type="submit" class="btn btn-warning" onclick="return confirm('Warning !!!\nEditing the data allows changing the preview of the room\nStill Edit ?')">Update Film</button>
		</form>
    </div>
@endsection