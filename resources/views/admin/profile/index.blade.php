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
                                    <table class="table table-bordered">
                                <tbody><tr>
                                    <td><strong>Username</strong></td>
                                    <td>{{Auth::user()->username}}</td>
                                </tr>

                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td>{{Auth::user()->email}}</td>
                                </tr>

                                <tr>
                                    <td><strong>Umur</strong></td>
                                    <td>{{Auth::user()->umur}}</td>
                                </tr>

                                <tr>
                                    <td><strong>Jenis Kelamin</strong></td>
                                    <td>{{Auth::user()->jenis_kelamin}}</td>
                                </tr>
                                </tbody></table>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="card-footer">
            <a href="{{ route('users.edit',Auth::user()->username) }}" class="btn btn-primary">
                    Edit Profile
            </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Jumbotron -->
</section>
@endsection