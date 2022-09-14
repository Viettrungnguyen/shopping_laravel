@extends('layouts.web')
@section('title')
    <title>Edit Profile</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('webs/profile/profile.css') }}">
@endsection
@section('content')
    <div class="container emp-profile">
        <form action="{{ route('change.password') }}" method="post">
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-img">
                        <img src="{{ asset(Auth::user()->avatar_url) }}" alt="" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-head">
                        @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif

                        @if (Auth::user())
                            <h5>{{ Auth::user()->name }}</h5>
                        @endif
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link " id="home-tab" data-toggle="" href="{{ route('edit.profile') }}"
                                    role="tab" aria-controls="home" aria-selected="true">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" id="profile-tab" data-toggle=""
                                    href="{{ route('show.change.password') }}" aria-controls="profile"
                                    aria-selected="false">Change Password</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('profile') }}">
                        <input type="button" class="profile-edit-btn" name="btnAddMore" value="Profile" />
                    </a>

                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                </div>

                <div class="col-md-8">
                    <div class="tab-content profile-tab" id="">
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label>Enter Old Password :</label>
                                <input type="password" class="form-control" placeholder="Enter old password"
                                    name="oldpassword" value="">
                                @if ($errors->has('oldpassword'))
                                    <span class="text-danger">{{ $errors->first('oldpassword') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label>Enter New Password :</label>
                                <input type="password" placeholder="Enter new password" class="form-control"
                                    name="password">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label>Enter Confirm Password :</label>
                                <input type="password" class="form-control" placeholder="Enter password confirmation"
                                    name="password_confirmation">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <br>
                                <button class="btn btn-lg btn-success" type="submit"><i
                                        class="glyphicon glyphicon-ok-sign"></i> Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@endsection
