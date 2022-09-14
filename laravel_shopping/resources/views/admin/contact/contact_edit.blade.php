@extends('layouts.admin')
@section('title')
    <title>Edit Contact</title>
@endsection
@section('content')
    @include('partials.admin.content-header', ['name' => 'Contact', 'page' => 'Edit'])

    <form action="{{ route('contact.update', ['id' => $contact->id]) }}" method="post">
        @method('patch')
        @csrf
        <div class="row">
            <div class="col mb-3">
                <label>Email</label>
                <input type="text" class="form-control" name="email" value="{{ $contact->email }}">
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="col mb-3">
                <label>Name</label>
                <input type="text" class="form-control" name="name" value="{{ $contact->name }}">
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="col mb-3">
                <label>Phone</label>
                <input type="text" class="form-control" name="phone" value="{{ $contact->phone }}">
                @if ($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
            </div>
            <div class="col mb-3">
                <label>Status</label>
                <select class="form-control select2_init" name="status">
                    <option value="{{ $contact->status }}">{{ $contact->status }}</option>
                    @foreach ($status as $item)
                        <option value="{{ $item }}"> {{ $item }}
                        </option>
                    @endforeach
                </select>

                @if ($errors->has('category_id'))
                    <span class="text-danger">{{ $errors->first('category_id') }}</span>
                @endif
            </div>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
@endsection
