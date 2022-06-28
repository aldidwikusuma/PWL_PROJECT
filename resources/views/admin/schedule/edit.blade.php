@extends('admin.layouts.main')

@section('container')
    <h2 class="mb-3">Edit Schedule ID {{ $schedule->id }} </h2>
	<div class="col-md-8 p-0 mb-3">
        <a class="btn btn-primary me-5" href="{{ route(config("data.route.admin.schedules.index")) }}">Back to Dashboard</a>
    </div>
    <div class="col-md-8 mb-5 p-0">
        <form action="{{ route(config("data.route.admin.schedules.update"), $schedule->id) }}" method="post">
			@csrf
            @method("put")
			<input type="hidden" name="endtime" value="{{ $schedule->endtime }}">
			<div class="mb-3">
				<label for="date" class="form-label">Date & Time</label>
				<div class="input-group">
					<label for="date" class="input-group-text">Date</label>
					<input type="date" name="date" class="form-control @error('date') is-invalid @enderror" id="date" value="{{ old("date", $schedule->date) }}" required autofocus>
					<label for="time" class="input-group-text">Time</label>
					<input type="time" name="time" class="form-control @error('time') is-invalid @enderror" id="time" value="{{ old("time", $schedule->time) }}" required>
					@error('date')
						<div class="invalid-feedback">
							{!! $message !!}
						</div>
					@enderror
					@error('time')
						<div class="invalid-feedback">
							{!! $message !!}
						</div>
					@enderror
				</div>
			</div>
			<div class="mb-3">
				<label for="fk_id_film" class="form-label @error('fk_id_film') is-invalid @enderror">Title Film</label>
				@if ($films)
					<select class="form-select" name="fk_id_film" id="fk_id_film" required>
						@foreach ($films as $film)
							@if (old("fk_id_film", $schedule->fk_id_film) == $film["id"])
								<option value="{{ $film["id"] }}" selected>{{ $film["title"] }}</option>
							@else
								<option value="{{ $film["id"] }}">{{ $film["title"] }}</option>
							@endif
						@endforeach
					</select>
				@else
					<div class="form-control is-invalid">No Film. Please add Film <a href="{{ route(config("data.route.admin.films.index")) }}">here</a></div>
				@endif
				@error('fk_id_film')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
			<div class="mb-3">
				<label for="fk_id_room" class="form-label @error('fk_id_room') is-invalid @enderror">Rooms</label>
				@if ($rooms)
					<select class="form-select" name="fk_id_room" id="fk_id_room" required>
						@foreach ($rooms as $room)
							@if (old("fk_id_room", $schedule->fk_id_room) == $room["id"])
								<option value="{{ $room["id"] }}" selected>{{ $room["room_name"] }}</option>
							@else
								<option value="{{ $room["id"] }}">{{ $room["room_name"] }}</option>
							@endif
						@endforeach
					</select>
				@else
					<div class="form-control is-invalid">No Room. Please add Room <a href="{{ route(config("data.route.admin.rooms.index")) }}">here</a></div>
				@endif
				@error('fk_id_room')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>

			<button type="submit" class="btn btn-warning">Update Schedule</button>
		</form>
    </div>
@endsection