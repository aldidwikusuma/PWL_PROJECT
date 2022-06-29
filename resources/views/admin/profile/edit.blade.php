@extends('admin.layouts.main')

@section('container')
<!-- Section: Design Block -->
<section class="hero-section" id="hero">
    <div class="p-3 text-center" >
        <div class="container">
            <div class="row align-items-center"  style="margin-top: 40px;">
                <div class="col">
                    <div class="card">
                        <div class="table-responsive">
                            <form class="py-5" action="{{ route('users.update', Auth::user()->username)}}" method="post">
                                <h4>Your Profile</h4>
                                @method('PUT')
                                @csrf
                                    <style>
                                        input{
                                            width: 100%;
                                        }
                                    </style>
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td><strong>Username</strong></td>
                                                <td><input class="form-control" value="{{Auth::user()->username}}" type="text" name="username" disabled></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Email</strong></td>
                                                <td><input class="form-control" type="email" value="{{ old("email", Auth::user()->email) }}" name="email" ></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Umur</strong></td>
                                                <td><input class="form-control" type="number" name="umur" value="{{ old("umur", Auth::user()->umur ? Auth::user()->umur : "0") }}"></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Jenis Kelamin</strong></td>
                                                <td>
                                                    <select class="form-select" name="jenisKelamin" required>
                                                        @if (old("jenisKelamin", Auth::user()->jenisKelamin) == "1")
                                                            <option value="1" selected>Laki-Laki</option>
                                                            <option value="2">Perempuan</option>
                                                        @else
                                                            <option value="1">Laki-Laki</option>
                                                            <option value="2" selected>Perempuan</option>
                                                        @endif
                                                    </select>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div>
                                        <ul>
                                            @error('email')
                                                <li>{{ $message }}</li>
                                            @enderror
                                            @error('umur')
                                                <li>{{ $message }}</li>
                                            @enderror
                                            @error('jenisKelamin')
                                                <li>{{ $message }}</li>
                                            @enderror
                                        </ul>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        Simpan
                                    </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</section>
@endsection