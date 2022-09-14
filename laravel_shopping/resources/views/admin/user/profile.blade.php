@extends('layouts.admin')
@section('title')
    <title>Profile</title>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <div class="col-lg-4 col-xlg-3 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <center class="m-t-30"> <img src="{{ asset(Auth::user()->avatar_url) }}" class="rounded-circle"
                                width="150" />
                            <h4 class="card-title m-t-10">{{Auth::user()->name}}</h4>
                            {{-- <h6 class="card-subtitle">Accoubts Manager Amix corp</h6>
                            <div class="row text-center justify-content-md-center">
                                <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i>
                                        <font class="font-medium">254</font>
                                    </a></div>
                                <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i>
                                        <font class="font-medium">54</font>
                                    </a></div>
                            </div> --}}
                        </center>
                    </div>
                    <form action="{{ route('change.password1') }}" method="post">
                        @csrf
                        @method('patch')
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
                    </form>
                </div>
            </div>

            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('update.profile1') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            {{-- <div class="form-group">
                                <label class="col-md-12">Name</label>
                                <div class="col-md-12">
                                    <input type="text" name="name" value="{{ Auth::user()->name }}"
                                        class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-email" class="col-md-12">Email</label>
                                <div class="col-md-12">
                                    <input type="email" name="email" value="{{ Auth::user()->email }}"
                                        class="form-control form-control-line" name="example-email" id="example-email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Gender</label>
                                <div class="col-md-12">
                                    <input type="text" name="gender"
                                        value="{{ Auth::user()->gender }}"class="form-control form-control-line">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-12">Avatar</label>
                                <div class="col-md-12">
                                    <input type="file" class="form-control" name="avatar_url" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Education</label>
                                <div class="col-md-12">
                                    <input type="text" name="education"
                                        value="{{ Auth::user()->education }}"class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Title</label>
                                <div class="col-md-12">
                                    <input type="text" name="title"
                                        value="{{ Auth::user()->title }}"class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Location</label>
                                <div class="col-md-12">
                                    <input type="text" name="location"
                                        value="{{ Auth::user()->location }}"class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Skills</label>
                                <div class="col-md-12">
                                    <input type="text" name="skills"
                                        value="{{ Auth::user()->skills }}"class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Birthday</label>
                                <div class="col-md-12">
                                    <input type="date" name="birthday"
                                        value="{{ Auth::user()->birthday }}"class="form-control form-control-line">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-12">Note</label>
                                <div class="col-md-12">
                                    <input type="text" name="note"
                                        value="{{ Auth::user()->note }}"class="form-control form-control-line">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-12">Phone</label>
                                <div class="col-md-12">
                                    <input type="text"name="phone"
                                        value="{{ Auth::user()->phone }}"class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button class="btn btn-success text-white">Update Profile</button>
                                </div>
                            </div> --}}

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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
