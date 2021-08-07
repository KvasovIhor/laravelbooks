@extends('layouts.categories')
@section('title', 'My category')

@section('categories_section')
    <h1>My category</h1>

    <div class="row">
        <div class="col-md-4 text-md-right">Name</div>
        <div class="col-md-8">
            <strong>{{ $category->name }}</strong>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 text-md-right">Books</div>
        <div class="col-md-8">
            <strong>{{ implode(', ', $category->books->pluck('name')->all()) }}</strong>
        </div>
    </div>
@endsection