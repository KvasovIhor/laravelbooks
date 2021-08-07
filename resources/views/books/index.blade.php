@extends('layouts.books')
@section('title', 'My books')

@section('books_section')
<h1>My books</h1>

@if (Session::has('message'))
    <div class="alert alert-primary font-weight-bold">{{ Session::get('message') }}</div>
@endif

@if(!$books->isEmpty())
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <td>Name</td>
        <td>Image</td>
        <td>ISBN</td>
        <td>Description</td>
        <td>Actions</td>
    </tr>
    </thead>
    <tbody>
    @foreach($books as $book)
        <tr>
            <td>{{ $book->name }}</td>
            <td>@if(!empty($book->photo_file_name))<img width="200" src="{{ asset('storage/'.$book->photo_file_name )}}">@endIf</td>
            <td width="200">{{ $book->isbn }}</td>
            <td>{{ \Illuminate\Support\Str::words($book->description, 10,'...') }}</td>
            <td width="120">
                <a class="btn btn-small btn-success" href="{{ route('books.show',  $book->id) }}">View</a>
                <a class="btn btn-small btn-info" href="{{ route('books.edit',  $book->id) }}">Edit</a>
                <form method="POST" class="pull-right" action="{{ route('books.destroy', $book->id) }}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@else
    <h2 class="mt-5">You don't have books yet</h2>
@endIf
@endsection