@extends('layouts.books')
@section('title', 'My book')

@section('books_section')
    <h1>My book</h1>

    <div class="row">
        <div class="col-md-4 text-md-right">Name</div>
        <div class="col-md-8">
            <strong>{{ $book->name }}</strong>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 text-md-right">Author</div>
        <div class="col-md-8">
            <strong>{{ $book->author }}</strong>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 text-md-right">Image</div>
        <div class="col-md-8">
            @if(!empty($book->photo_file_name))<img width="200" src="{{ asset('storage/'.$book->photo_file_name )}}">@endIf
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 text-md-right">ISBN</div>
        <div class="col-md-8">
            <strong>{{ $book->isbn }}</strong>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 text-md-right">Description</div>
        <div class="col-md-8">
            <strong>{{ $book->description }}</strong>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 text-md-right">Categories</div>
        <div class="col-md-8">
            <strong>{{ implode(', ', $book->categories->pluck('name')->all()) }}</strong>
        </div>
    </div>
@endsection