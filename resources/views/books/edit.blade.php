@extends('layouts.books')
@section('title', 'Edit book '.$book->name)

@section('books_section')
    <h1>Edit my book {{$book->name}}</h1>

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <form method="POST" action="{{ route('books.update', $book->id) }}" enctype="multipart/form-data" name="edit_book_form">
        @csrf
        @method('put')
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $book->name }}" required autocomplete="name" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="author" class="col-md-4 col-form-label text-md-right">Author</label>
            <div class="col-md-6">
                <input id="author" type="text" class="form-control @error('author') is-invalid @enderror" name="author" value="{{ $book->author }}" required autocomplete="author" autofocus>

                @error('author')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="isbn" class="col-md-4 col-form-label text-md-right">ISBN</label>

            <div class="col-md-6">
                <input id="isbn" type="text" class="form-control @error('isbn') is-invalid @enderror" name="isbn" value="{{ $book->isbn}}" autocomplete="isbn" autofocus>
                @error('isbn')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

            <div class="col-md-6">
                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description">{{ $book->description }}</textarea>
                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="photo_file_name" class="col-md-4 col-form-label text-md-right">Image</label>

            <div class="col-md-6">
                <input id="photo_file_name" type="file" class="form-control @error('photo_file_name') is-invalid @enderror" name="photo_file_name">

                @error('photo_file_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @if(!empty($book->photo_file_name))
                    <strong>choose the file to change the image</strong>
                    <img width="200" src="{{ asset('storage/'.$book->photo_file_name )}}">
                @endIf
            </div>
        </div>

        <div class="form-group row">
            <label for="categories" class="col-md-4 col-form-label text-md-right">Select Categories  <span class="text-info">(ctrl+click)</span></label>
            <div class="col-md-6 offset-md-4">
                <select id="categories" class="form-control @error('categories') is-invalid @enderror" name="categories[]" multiple="">
                    @foreach($user_categories as $user_category)
                        <option value="{{$user_category->id}}"@if($book->categories->contains('id', $user_category->id)) selected=""@endif>
                            {{$user_category->name}}
                        </option>
                    @endforeach
                </select>
                @error('categories')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    EDIT
                </button>
            </div>
        </div>
    </form>
@endsection
