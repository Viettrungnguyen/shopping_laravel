@extends('layouts.admin')
@section('title')
    <title>Tags</title>
@endsection
@section('content')
    @include('partials.admin.content-header', ['name' => 'Tags', 'page' => 'List'])
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <strong>{{ $message }}</strong>
        </div>
    @endif

    <div class="text-end upgrade-btn">
        <a href="{{ route('tags.add') }}" class="btn btn-success float-right m-2">ADD</a>
    </div>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tags as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->name }}</td>

                    <td>
                        <a href="{{ route('tags.edit', ['id' => $item->id]) }}" class="btn btn-default">Edit</a>
                        <a href="{{ route('tags.delete', ['id' => $item->id]) }}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $tags->links() }}
@endsection
