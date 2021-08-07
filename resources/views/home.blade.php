@extends('layouts.app')
@section('title', 'Home')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @auth
                        <h1 class="mb-5">Your list of categories with books</h1>
                        <main>
                        @forelse ($categories as $category)

                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <h3 class="pb-3 mb-4 font-italic border-bottom"><span class="text-muted">category: </span><a class="" href="{{ route('categories.show',  $category->id) }}">{{ $category->name }}</a></h3>
                                        @forelse ($category->books as $book)
                                            <p class="h4 ml-5"><span class="text-muted">book: </span> <a class="" href="{{ route('books.show',  $book->id) }}">{{ $book->name }}</a></p>
                                        @empty
                                            <p>No books in this category</p>
                                        @endforelse

                                    </div>
                                </div>
                        @empty
                            <h1>No categories yet</h1>
                        @endforelse
                        </main>
                    @else
                        <h1>Hi there! You must login or register to manage books and categories</h1>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
