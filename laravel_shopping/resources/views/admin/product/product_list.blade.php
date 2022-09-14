@extends('layouts.admin')
@section('title')
    <title>Product</title>
@endsection
@section('content')
    @include('partials.admin.content-header', ['name' => 'Product', 'page' => 'List'])
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <strong>{{ $message }}</strong>
        </div>
    @endif

    <div class="text-end upgrade-btn">
        <a href="{{ route('product.add') }}" class="btn btn-success float-right m-2">ADD</a>
    </div>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Code</th>
                <th scope="col">Description</th>
                <th scope="col">Image</th>
                <th scope="col">Price</th>
                <th scope="col">Category</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <th scope="row">{{ $product->id }}</th>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->code }}</td>
                    <td>{{ $product->description }}</td>
                    <td><img src="{{ asset("$product->image_url") }}" height="100px" width="100px"></td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>
                        <a href="{{ route('product.edit', ['slug' => $product->slug]) }}" class="btn btn-default">Edit</a>
                        <a href="{{ route('product.delete', ['id' => $product->id]) }}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
@endsection
