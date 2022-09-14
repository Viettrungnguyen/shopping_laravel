@extends('layouts.web')
@section('title')
    <title>Edit Profile</title>
@endsection
@section('css')
    {{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> --}}
    <link rel="stylesheet" href="{{ asset('webs/profile/profile.css') }}">
@endsection
@section('content')
    <div class="container emp-profile">
        <form action="{{ route('update.profile') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-img">
                        <img src="{{ asset(Auth::user()->avatar_url) }}" alt="" />
                        <div class="file btn btn-lg btn-primary">
                            Change Photo
                            <input type="file" class="form-control" name="avatar_url"
                                value="{{ Auth::user()->avatar_url }}">
                            <input type="text" name="avatar_url" value="{{ Auth::user()->avatar_url }}" hidden>
                        </div>
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
                                <a class="nav-link active" id="home-tab" data-toggle=""
                                    href="{{ route('edit.profile') }}" role="tab" aria-controls="home"
                                    aria-selected="true">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle=""
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
                        @if (Auth::user())
                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="">
                                        <h4>Name</h4>
                                    </label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ Auth::user()->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="">
                                        <h4>Email</h4>
                                    </label>
                                    <input type="email" class="form-control" name="email"
                                        value="{{ Auth::user()->email }}">
                                </div>
                            </div>                             

                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="">
                                        <h4>Gender</h4>
                                    </label>
                                    <input type="text" class="form-control" name="gender"
                                        value="{{ Auth::user()->gender }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="">
                                        <h4>Education</h4>
                                    </label>
                                    <input type="text" class="form-control" name="education"
                                        value="{{ Auth::user()->education }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="">
                                        <h4>Title</h4>
                                    </label>
                                    <input type="text" class="form-control" name="title"
                                        value="{{ Auth::user()->title }}">
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="">
                                        <h4>Location</h4>
                                    </label>
                                    <input type="text" class="form-control" name="location"
                                        value="{{ Auth::user()->location }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="">
                                        <h4>Skill</h4>
                                    </label>
                                    <input type="text" class="form-control" name="skills"
                                        value="{{ Auth::user()->skills }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="">
                                        <h4>Birthday</h4>
                                    </label>
                                    <input type="date" class="form-control" name="birthday"
                                        value="{{ Auth::user()->birthday }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="">
                                        <h4>Note</h4>
                                    </label>
                                    <input type="text" class="form-control" name="note"
                                        value="{{ Auth::user()->note }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="">
                                        <h4>Phone</h4>
                                    </label>
                                    <input type="text" class="form-control" name="phone"
                                        value="{{ Auth::user()->phone }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <br>
                                    <button class="btn btn-lg btn-success" type="submit"><i
                                            class="glyphicon glyphicon-ok-sign"></i> Save</button>
                                </div>
                            </div>
                        @endif
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
