@extends('admin.layouts.main')

@section('container')
	{{-- <h2 class="mt-3">{{ auth()->user()->name }} Posts | Total = {{ $total }}</h2> --}}
    <a class="btn btn-primary mb-3" href="{{ route(config("data.route.admin.schedules.create")) }}">Create new Film Schedule</a>
    @if (session()->has("success")) 
        <div class="col-md-5 p-0">  
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session("success") }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
	<div class="table-responsive">
		<table class="table table-striped table-sm">
            <style>
                table.table thead tr th:nth-child(1)    , 
                table.table tbody tr td:nth-child(1){
                    text-align: center
                }

                table.table tbody tr td{
                    vertical-align: middle !important;
                }
            </style>
			<thead>
				<tr>
					<th scope="col">Nomer</th>
					<th scope="col">Nama Film</th>
					<th scope="col">Ruangan</th>
					<th scope="col">Hari</th>
					<th scope="col">Jam</th>
				</tr>
			</thead>
			<tbody>
                @foreach ($schedules as $schedulesatuan)                
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $schedulesatuan->day }}</td>
                        <td>{{ $schedulesatuan->hour }}</td>
                        <td>{{ $schedulesatuan->film->title }}</td>
                        <td>{{ $schedulesatuan->room->room_name }}</td>
                        <td>
                            <a href="{{ route("schedules.show", $schedules->id) }}" class="btn btn-info">Detail</a>
                            <a href="{{ route("schedules.edit", $schedules->id) }}" class="btn btn-warning mx-2">Edit</a>
                            <form action="{{ route("schedules.destroy", $schedulesatuan->id) }}" class="d-inline" method="post">
                                @csrf
                                @method("delete")
                                <button onclick="return confirm('Konfirmasi Hapus')" class="btn btn-danger border-0">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
			</tbody>
		</table>
	</div>
@endsection