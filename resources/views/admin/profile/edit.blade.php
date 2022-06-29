@extends('admin.layouts.main')

@section('container')
<!-- Section: Design Block -->
<section class="hero-section" id="hero">
    <!-- Jumbotron -->
    <div class="p-3 text-center" >
        <div class="container">
            <div class="row align-items-center"  style="margin-top: 40px;">
                <div class="col">
                    <div class="card">

                                    <h4>Your Profile</h4>
                                <div class="table-responsive">
                            <form action="{{ route('users.update',Auth::user()->username)}}" method="post">
                                @method('PUT')
                                @csrf
                                <table class="table table-bordered">
                                <tbody><tr>
                                    <td><strong>Username</strong></td>
                                    <td><input value="{{Auth::user()->username}}" type="text" name="username" disabled></td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td><input type="email" value="{{Auth::user()->email}}" name="email" ></td>
                                </tr>
                                <tr>
                                    <td><strong>Umur</strong></td>
                                    <td><input type="text" name="umur" ></td>
                                </tr>
                                <tr>
                                    <td><strong>Jenis Kelamin</strong></td>
                                    <td><input type="text" name="jenis_kelamin" ></td>
                                </tr>

                                            </tbody></table>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                        <div class="card-footer">
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

<!-- Jumbotron -->
</section>
@endsection