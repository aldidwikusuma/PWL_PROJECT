@extends('admin.layouts.main')

@section('container')
    <style>
        .chair{
            width: 50px;
            height: 50px;
            padding: 0;
            border: 2px solid;
            border-radius: 0.5rem;
        }

        .screen-bioskop{
            width: 90%;
            height: 50px;
            border-radius: 0.5rem;
            line-height: 50px;
            letter-spacing: 1rem
        }

        .bioskop-partial{
            width: 45%;
            gap: 10px;
        }

        select.chair-form{
            appearance: none !important;
            margin: 0 !important;
            padding: 0 !important;
            background-image: none !important;
            text-align: center;
            width: 100%;
            height: 100%;
        }
        .card-body.bioskop{
            overflow-x: auto;
            background-color: aquamarine;
        }

        .room-bioskop{
            width: 1150px;
        }
    </style>

    <h2 class="mb-3">Detail Room {{ $room->room_name }}</h2>
    <div class="col-md-8 p-0 mb-4">
        <a class="btn btn-primary me-5" href="{{ route(config("data.route.admin.rooms.index")) }}">Back to Dashboard</a>
        <a class="btn btn-warning" href="{{ route(config("data.route.admin.rooms.edit"), $room->id) }}">Edit</a>
    </div>
    <div class="col-lg-6 mb-5 p-0">
        <div class="row my-3 p-0">
            <div class="col-md-4">
                <span class="form-control border-1 border-primary">Room Name</span>
            </div>
            <div class="col-md-8">
                <span class="form-control border-1 border-primary">{{ $room->room_name }}</span>
            </div>
        </div>
        <div class="row my-3 p-0">
            <div class="col-md-4">
                <span class="form-control border-1 border-primary">Chair Row</span>
            </div>
            <div class="col-md-8">
                <span class="form-control border-1 border-primary">{{ $room->chair_row }}</span>
            </div>
        </div>
        <div class="row my-3 p-0">
            <div class="col-md-4">
                <span class="form-control border-1 border-primary">Chair Column</span>
            </div>
            <div class="col-md-8">
                <span class="form-control border-1 border-primary">{{ $room->chair_col }}</span>
            </div>
        </div>
    </div>

    <div class="d-flex w-100">
        <div class="card shadow border-1 border-primary p-0">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary">Preview Room</h5>
            </div>
            <!-- Card Body -->
            <div class="card-body bioskop">
                <div class="room-bioskop px-2">
                    <div class="screen-bioskop bg-primary mx-auto mb-5 text-center text-white text-uppercase font-weight-bold">Screen</div>
                    <div class="chair-bioskop w-100 mb-3">
                        @for ($i = 0; $i < $room->chair_row; $i++)
                            <div class="d-flex mb-3 justify-content-between">
                            @for ($j = 0; $j < $room->chair_col; $j++)
                                    @if ($j == 0)
                                        <div class="d-flex justify-content-start bioskop-partial">
                                        <div class="chair border-2 border-primary">
                                            <select class="form-select form-select-lg chair-form">
                                            <option value="{{ "X" }}">{{ "A01" }}</option>
                                            {{-- @foreach ($data as $datakursi)
                                                @if ($datakursi == $data[$j])
                                                    <option value="{{ $datakursi }}" selected>{{ $datakursi }}</option>
                                                @else
                                                    <option value="{{ $datakursi }}">{{ $datakursi }}</option>
                                                @endif
                                            @endforeach --}}
                                        </select>
                                        </div>
                                    @elseif($j == $room->chair_col / 2)
                                        </div>
                                        <div class="d-flex justify-content-end bioskop-partial">
                                        <div class="chair border-2 border-primary">
                                            <select class="form-select form-select-lg chair-form">
                                            <option value="{{ "X" }}">{{ "X" }}</option>
                                            {{-- @foreach ($data as $datakursi)
                                                @if ($datakursi == $data[$j])
                                                    <option value="{{ $datakursi }}" selected>{{ $datakursi }}</option>
                                                @else
                                                    <option value="{{ $datakursi }}">{{ $datakursi }}</option>
                                                @endif
                                            @endforeach --}}
                                        </select>
                                        </div>
                                    @elseif($j == $room->chair_col - 1)
                                        <div class="chair border-2 border-primary">
                                            <select class="form-select form-select-lg chair-form">
                                                <option value="{{ "X" }}">{{ "X" }}</option>
                                                {{-- @foreach ($data as $datakursi)
                                                    @if ($datakursi == $data[$j])
                                                        <option value="{{ $datakursi }}" selected>{{ $datakursi }}</option>
                                                    @else
                                                        <option value="{{ $datakursi }}">{{ $datakursi }}</option>
                                                    @endif
                                                @endforeach --}}
                                            </select>
                                        </div>
                                        </div>
                                    @else
                                        <div class="chair border-2 border-primary">
                                            <select class="form-select form-select-lg chair-form">
                                                <option value="{{ "X" }}">{{ "X" }}</option>
                                                {{-- @foreach ($data as $datakursi)
                                                    @if ($datakursi == $data[$j])
                                                        <option value="{{ $datakursi }}" selected>{{ $datakursi }}</option>
                                                    @else
                                                        <option value="{{ $datakursi }}">{{ $datakursi }}</option>
                                                    @endif
                                                @endforeach --}}
                                            </select>
                                        </div>
                                    @endif 
                                @endfor
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection