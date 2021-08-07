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
                                @if(Route::current()->getName() != 'categories.index')
                                    <li><a class="btn btn-small" href="{{ route('categories.index') }}">All categories</a></li>
                                @endif
                                @if((Route::current()->getName() == 'categories.show'))
                                    <li><a class="btn btn-small mt-2" href="{{ route('categories.edit', $category->id) }}">Edit this category</a>
                                @elseif(Route::current()->getName() == 'categories.index')
                                    <li><a class="btn btn-small btn-primary mt-2" href="{{ route('categories.create') }}">Add category</a>
                                @endif
                            </ul>
                        </nav>
                        @yield('categories_section')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
