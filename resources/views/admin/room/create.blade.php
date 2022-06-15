@extends('admin.layouts.main')

@section('container')
    <h2 class="mb-3">Create new Room</h2>
	<div class="col-md-8 p-0 mb-3">
        <a class="btn btn-primary me-5" href="{{ route(config("data.route.admin.rooms.index")) }}">Back to Dashboard</a>
    </div>
    <div class="col-md-8 mb-5 p-0">
        <form action="{{ route(config("data.route.admin.rooms.store")) }}" method="post" enctype="multipart/form-data">
			@csrf
			<div class="mb-3">
				<label for="room_name" class="form-label">Room Name</label>
				<input type="text" name="room_name" class="form-control @error('room_name') is-invalid @enderror" id="room_name" value="{{ old("room_name") }}" required autofocus>
				@error('room_name')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="chair_row" class="form-label">Chair Row</label>
				<select class="form-select @error('chair_row') is-invalid @enderror" name="chair_row" id="chair_row" required>
					@for ($i = $row["min"]; $i <= $row["max"] ; $i++)
						@if (old("chair_row") == $i)
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
						@if (old("chair_col") == $i)
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

			<button type="submit" class="btn btn-primary">Add Room</button>
		</form>
    </div>
@endsection