@extends('layouts.admin')
@section('title')
    <title>Add User</title>
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
@endsection
@section('content')
    @include('partials.admin.content-header', ['name' => 'User', 'page' => 'Add'])

    <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col mb-3">
                <label>Name</label>
                <input type="text" class="form-control" name="name" placeholder="Name">
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="col mb-3">
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="email">
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="text" class="form-control" name="password" placeholder="Password">
            @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <div class="mb-3">
            <label>Title</label>
            <textarea class="form-control" id="mytextarea" rows="3" name="title"></textarea>
            @if ($errors->has('title'))
                <span class="text-danger">{{ $errors->first('title') }}</span>
            @endif
        </div>

        <div class="row">
            <div class="col mb-3">
                <label>Gender</label>
                <select class="form-control select2_init" name="gender">
                    <option value="">Select Gender</option>
                    @foreach ($gender as $item)
                        <option value="{{ $item }}"> {{ $item }}
                        </option>
                    @endforeach
                </select>

                @if ($errors->has('gender'))
                    <span class="text-danger">{{ $errors->first('gender') }}</span>
                @endif
            </div>

            <div class="col mb-3">
                <label>Avatar</label>
                <input type="file" class="form-control" name="avatar_url" placeholder="Avatar">
                @if ($errors->has('avatar_url'))
                    <span class="text-danger">{{ $errors->first('avatar_url') }}</span>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col mb-3">
                <label>Education</label>
                <input type="text" class="form-control" name="education" placeholder="Education">
                @if ($errors->has('education'))
                    <span class="text-danger">{{ $errors->first('education') }}</span>
                @endif
            </div>

            <div class="col mb-3">
                <label>Location</label>
                <input type="text" class="form-control" name="location" placeholder="Location">
                @if ($errors->has('location'))
                    <span class="text-danger">{{ $errors->first('location') }}</span>
                @endif
            </div>
            <div class="col mb-3">
                <label>Phone</label>
                <input type="text" class="form-control" name="phone" placeholder="Phone">
                @if ($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
            </div>
        </div>

        <div class="mb-3">
            <label>Note</label>
            <textarea class="form-control" id="mytextarea" rows="3" name="note"></textarea>
            @if ($errors->has('note'))
                <span class="text-danger">{{ $errors->first('note') }}</span>
            @endif
        </div>

        <div class="mb-3">
            <label>Skills</label>
            <textarea class="form-control" id="mytextarea" rows="3" name="skills"></textarea>
            @if ($errors->has('skills'))
                <span class="text-danger">{{ $errors->first('skills') }}</span>
            @endif
        </div>

        <div class="row">
            <div class="col mb-3">
                <label>Birthday</label>
                <input type="date" class="form-control" name="birthday" placeholder="Birthday">
                @if ($errors->has('birthday'))
                    <span class="text-danger">{{ $errors->first('birthday') }}</span>
                @endif
            </div>

            <div class="col mb-3">
                <label>Status</label>
                <select class="form-control select2_init" name="is_active">
                    <option value="">Select Status</option>
                    @foreach ($status as $item)
                        <option value="{{ $item }}"> {{ $item }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('is_active'))
                    <span class="text-danger">{{ $errors->first('is_active') }}</span>
                @endif
            </div>

            <div class="col mb-3">
                <label>Role</label>
                <select class="form-control select2_init" name="role">
                    <option value="">Select Role</option>
                    @foreach ($role as $item)
                        <option value="{{ $item }}"> {{ $item }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('role'))
                    <span class="text-danger">{{ $errors->first('role') }}</span>
                @endif
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Add</button>
    </form>
@endsection
@section('js')
    <script src="https://cdn.tiny.cloud/1/4h8iqee6oaqjqwfi1nxpg1ab1czv0v2bmc3uhbadzthnarn6/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
    </script>
    <script>
        tinymce.init({
            selector: '#mytextarea',
        });
    </script>
@endsection
