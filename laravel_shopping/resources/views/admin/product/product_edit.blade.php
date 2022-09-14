@extends('layouts.admin')
@section('title')
    <title>Edit Product</title>
@endsection
@section('content')
    @include('partials.admin.content-header', ['name' => 'Product', 'page' => 'Edit'])

    <form action="{{ route('product.update', ['id' => $product->id]) }}" method="post" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="row">
            <div class="col mb-3">
                <label>Name</label>
                <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="col mb-3">
                <label>Code</label>
                <input type="text" class="form-control" name="code" value="{{ $product->code }}">
                @if ($errors->has('code'))
                    <span class="text-danger">{{ $errors->first('code') }}</span>
                @endif
            </div>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <input type="text" class="form-control" name="description" value="{{ $product->description }}">
            @if ($errors->has('description'))
                <span class="text-danger">{{ $errors->first('description') }}</span>
            @endif
        </div>

        <div class="row">
            <div class="col mb-3">
                <label>Category</label>
                <select class="form-control select2_init" name="category_id">
                    <option value="{{ $product->category_id }}">{{ $product->category->name }}</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}"> {{ $item->name }}
                        </option>
                    @endforeach
                </select>

                @if ($errors->has('category_id'))
                    <span class="text-danger">{{ $errors->first('category_id') }}</span>
                @endif
            </div>

            <div class="col mb-3">
                <label>Image</label>
                <input type="file" class="form-control" name="image_url" value="{{ $product->image_url }}">
                @if ($errors->has('image_url'))
                    <span class="text-danger">{{ $errors->first('image_url') }}</span>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col mb-3">
                <label>Price</label>
                <input type="text" class="form-control" name="price" value="{{ $product->price }}">
                @if ($errors->has('price'))
                    <span class="text-danger">{{ $errors->first('price') }}</span>
                @endif
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
