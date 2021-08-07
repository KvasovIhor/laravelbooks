@extends('layouts.categories')
@section('title', 'Categories')

@section('categories_section')
<h1>Categories</h1>

@if (Session::has('message'))
    <div class="alert alert-primary font-weight-bold">{{ Session::get('message') }}</div>
@endif

@if(!$categories->isEmpty())
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <td>Name</td>
        <td>Actions</td>
    </tr>
    </thead>
    <tbody>
    @foreach($categories as $category)
        <tr>
            <td>{{ $category->name }}</td>
            <td width="340">
                <div class="input-group">
                    <a class="btn btn-small btn-success " href="{{ route('categories.show',  $category->id) }}">View</a>
                    <a class="btn btn-small btn-info text-light" href="{{ route('categories.edit',  $category->id) }}">Edit</a>

                    <form method="POST" class="pull-right" action="{{ route('categories.destroy', $category->id) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">
                            Delete
                        </button>
                    </form>
                </div>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@else
    <h2 class="mt-5">You don't have categories yet</h2>
@endIf
@endsection