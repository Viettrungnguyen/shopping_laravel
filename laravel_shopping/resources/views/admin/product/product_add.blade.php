@extends('layouts.admin')
@section('title')
    <title>Add Product</title>
@endsection
@section('css')
    <link href="{{ asset('vedors/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admins/product/add/add.css') }}" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
@endsection
@section('content')
    @include('partials.admin.content-header', ['name' => 'Product', 'page' => 'Add'])

    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
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
                <label>Code</label>
                <input type="text" class="form-control" name="code" placeholder="Code">
                @if ($errors->has('code'))
                    <span class="text-danger">{{ $errors->first('code') }}</span>
                @endif
            </div>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea class="form-control" id="mytextarea" rows="3" name="description"></textarea>
            @if ($errors->has('description'))
                <span class="text-danger">{{ $errors->first('description') }}</span>
            @endif
        </div>

        <div class="row">
            <div class="col mb-3">
                <label>Category</label>
                <select class="form-control select2_init" name="category_id">
                    <option value="">Select Category</option>
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
                <input type="file" class="form-control" name="image_url" placeholder="Image">
                @if ($errors->has('image_url'))
                    <span class="text-danger">{{ $errors->first('image_url') }}</span>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col mb-3">
                <label>Price</label>
                <input type="text" class="form-control" name="price" placeholder="Price">
                @if ($errors->has('price'))
                    <span class="text-danger">{{ $errors->first('price') }}</span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label>Tags</label>
            <select name="tags[]" class="form-control tags_select-choose" multiple="multiple">
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Add</button>
    </form>
@endsection
@section('js')
    <script src="{{ asset('vedors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('admins/product/add/add.js') }}"></script>
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
