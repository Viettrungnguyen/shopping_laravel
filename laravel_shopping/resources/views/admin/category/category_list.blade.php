@extends('layouts.admin')
@section('title')
    <title>Category</title>
@endsection
@section('content')
    @include('partials.admin.content-header', ['name' => 'Category', 'page' => 'List'])
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <strong>{{ $message }}</strong>
        </div>
    @endif

    <div class="input-group rounded">
        <form action="{{ route('category.list') }}" method="get">
            <div class="input-group">
                <input type="search" name="search" value="{{ $searchTerm }}" class="form-control rounded"
                    placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                <button type="submit" class="btn btn-outline-primary">search</button>
            </div>
        </form>
    </div>

    <div class="text-end upgrade-btn">

        <a href="{{ route('category.add') }}" class="btn btn-success float-right m-2">ADD</a>
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
            @foreach ($categories as $category)
                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    <td>{{ $category->name }}</td>

                    <td>
                        <a href="{{ route('category.edit', ['slug' => $category->slug]) }}" class="btn btn-default">Edit</a>
                        <a href="{{ route('category.delete', ['id' => $category->id]) }}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $categories->links() }}
@endsection
