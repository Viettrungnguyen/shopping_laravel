@extends('layouts.admin')
@section('title')
    <title>Add Tags</title>
@endsection
@section('content')
    @include('partials.admin.content-header', ['name' => 'Tags', 'page' => 'Add'])

    <form action="{{ route('tags.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col mb-3 col-6">
                <label>Name</label>
                <input type="text" class="form-control" name="name" placeholder="Name">
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Add</button>
    </form>
@endsection
