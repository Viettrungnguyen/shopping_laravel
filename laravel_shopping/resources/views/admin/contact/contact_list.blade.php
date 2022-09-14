@extends('layouts.admin')
@section('title')
    <title>Contact</title>
@endsection
@section('content')
    @include('partials.admin.content-header', ['name' => 'Contact', 'page' => 'List'])
    @if ($message = Session::get('message'))
        <div class="alert alert-success alert-block">
            <strong>{{ $message }}</strong>
        </div>
    @endif

    {{-- <div class="text-end upgrade-btn">
        <a href="{{ route('category.add') }}" class="btn btn-success float-right m-2">ADD</a>
    </div> --}}

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <th scope="row">{{ $contact->id }}</th>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->status }}</td>

                    <td>
                        <a href="{{ route('contact.edit', ['slug' => $contact->slug]) }}" class="btn btn-default">Edit</a>
                        <a href="{{ route('contact.delete', ['id' => $contact->id]) }}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $contacts->links() }}
@endsection
