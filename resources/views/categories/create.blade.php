@extends('layouts.categories')
@section('title', 'Create new category')

@section('categories_section')
    <h1>Create new category</h1>

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <form method="POST" action="{{ route('categories.store') }}" name="create_category_form">
        @csrf

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="books" class="col-md-4 col-form-label text-md-right">Select Books  <span class="text-info">(ctrl+click)</span></label>
            <div class="col-md-6 offset-md-4">
                <select id="categories" class="form-control @error('books') is-invalid @enderror" name="books[]" multiple="">
                    @foreach($user_books as $user_book)
                        <option value="{{$user_book->id}}">{{$user_book->name}}</option>
                    @endforeach
                </select>
                @error('books')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    ADD
                </button>
            </div>
        </div>
    </form>
@endsection