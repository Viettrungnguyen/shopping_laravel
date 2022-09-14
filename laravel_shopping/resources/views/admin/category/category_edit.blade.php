@extends('layouts.admin')
@section('title')
    <title>Edit Category</title>
@endsection
@section('content')
    @include('partials.admin.content-header', ['name' => 'Category', 'page' => 'Edit'])

    <form action="{{ route('category.update', ['id' => $category->id]) }}" method="post" enctype="multipart/form-data">
        @method('patch')
        @csrf
        <div class="row">
            <div class="col mb-3">
                <label>Name</label>
                <input type="text" class="form-control" name="name" value="{{ $category->name }}">
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
@endsection
