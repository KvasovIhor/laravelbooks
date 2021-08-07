@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <nav class="navbar navbar-inverse">
                            <div class="navbar-header"></div>
                            <ul class="nav navbar-nav">
                                @if(Route::current()->getName() != 'books.index')
                                    <li><a class="btn btn-small" href="{{ route('books.index') }}">All books</a></li>
                                @endif
                                @if((Route::current()->getName() == 'books.show'))
                                    <li><a class="btn btn-small mt-2" href="{{ route('books.edit', $book->id) }}">Edit this book</a>
                                @elseif(Route::current()->getName() == 'books.index')
                                    <li><a class="btn btn-small btn-primary mt-2" href="{{ route('books.create') }}">Add book</a>
                                @endif
                            </ul>
                        </nav>
                        @yield('books_section')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
