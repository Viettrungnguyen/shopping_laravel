@extends('layouts.admin')
@section('title')
    <title>User</title>
@endsection
@section('content')
    @include('partials.admin.content-header', ['name' => 'User', 'page' => 'List'])
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <strong>{{ $message }}</strong>
        </div>
    @endif

    <div class="text-end upgrade-btn">
        <a href="{{ route('user.add') }}" class="btn btn-success float-right m-2">ADD</a>
    </div>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Gender</th>
                <th scope="col">Education</th>
                <th scope="col">Location</th>
                <th scope="col">Skills</th>
                <th scope="col">Note</th>
                <th scope="col">Birthday</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->gender }}</td>
                    <td>{{ $user->education }}</td>
                    <td>{{ $user->location }}</td>
                    <td>{{ $user->skills }}</td>
                    <td>{{ $user->note }}</td>
                    <td>{{ $user->birthday }}</td>
                    <td>{{ $user->is_active }}</td>

                    <td>
                        <a href="{{ route('user.edit', ['slug' => $user->slug]) }}" class="btn btn-default">Edit</a>
                        <a href="{{ route('user.delete', ['id' => $user->id]) }}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
@endsection

