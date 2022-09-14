@extends('layouts.web')
@section('title')
    <title>Profile</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('webs/profile/profile.css') }}">
@endsection
@section('content')
    <div class="container emp-profile">
        <form method="post">
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-img">
                        <img src="{{asset(Auth::user()->avatar_url)}}"
                            alt="" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-head">

                        @if (Auth::user())
                            <h5>{{ Auth::user()->name }}</h5>
                        @endif

                        {{-- <h6>
                            Web Developer and Designer
                        </h6> --}}
                        {{-- <p class="proile-rating">RANKINGS : <span>8/10</span></p> --}}
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                    aria-controls="home" aria-selected="true">About</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('edit.profile') }}">
                        <input type="button" class="profile-edit-btn" name="btnAddMore" value="Edit Profile" />
                    </a>

                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-8">
                    <div class="tab-content profile-tab" id="">
                        @if (Auth::user())                     
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Gender</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ Auth::user()->gender }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Skill</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{Auth::user()->skills}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Birthday</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{Auth::user()->birthday}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Education</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{Auth::user()->education}}</p>
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
