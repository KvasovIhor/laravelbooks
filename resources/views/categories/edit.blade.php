@extends('layouts.categories')
@section('title', 'Edit my category')

@section('categories_section')
    <h1>Edit my category {{$category->name}}</h1>

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <form method="POST" action="{{ route('categories.update', $category->id) }}" name="edit_category_form">
        @csrf
        @method('put')
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $category->name }}" required autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                @enderror
            </div>
        </div>
        
        <div class="form-group row">
            <label for="books" class="col-md-4 col-form-label text-md-right">Select Categories <span class="text-info">(ctrl+click)</span></label>
            <div class="col-md-6 offset-md-4">
                <select id="books" class="form-control @error('categories') is-invalid @enderror" name="books[]" multiple="">
                    @foreach($user_books as $user_book)
                        <option value="{{$user_book->id}}"@if($category->books->contains('id', $user_book->id)) selected=""@endif>
                            {{$user_book->name}}
                        </option>
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
                    EDIT
                </button>
            </div>
        </div>
    </form>
@endsection
