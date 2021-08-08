@extends('layouts.books')
@section('title', 'Create new book')

@section('books_section')
    <h1>Create new book</h1>

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data" name="create_book_form">
        @csrf

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                <input id="author" type="text" class="form-control @error('author') is-invalid @enderror" name="author" value="{{ old('author') }}" required autocomplete="author" autofocus>

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
                <input id="isbn" type="text" class="form-control @error('isbn') is-invalid @enderror" name="isbn" value="{{ old('isbn') }}" autocomplete="isbn" autofocus>

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
                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description">{{ trim(old('description')) }}</textarea>
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
            </div>
        </div>

        <div class="form-group row">
            <label for="categories" class="col-md-4 col-form-label text-md-right">Select Categories  <span class="text-info">(ctrl+click)</span></label>
            <div class="col-md-6 offset-md-4">
                <select id="categories" class="form-control @error('categories') is-invalid @enderror" name="categories[]" multiple="">
                    @foreach($user_categories as $user_category)
                        <option value="{{$user_category->id}}">{{$user_category->name}}</option>
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
                    ADD BOOK
                </button>
            </div>
        </div>
    </form>
@endsection