<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('books.index', ['books'=>Auth::user()->books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create', ['user_categories'=>Auth::user()->categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        $path = '';
        if ($request->hasFile('photo_file_name')) {
            $path = $request->file('photo_file_name')->store('uploads', 'public');
        }

        $book = new Book();

        $book->name = $request->name;
        $book->author = $request->author;
        $book->isbn = $request->isbn;
        $book->description = $request->description;
        $book->photo_file_name = $path;
        $book->user_id = Auth::id();
        $book->save();

        if (!empty($request->categories)) {
            $book->categories()->attach($request->categories);
        }

        return redirect()->route('books.index')->with('message', 'Successfully created book!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::where('user_id', Auth::id())->findOrFail($id);

        return view('books.show', ['book'=>$book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::where('user_id', Auth::id())->with('categories')->findOrFail($id);

        return view('books.edit', ['book'=>$book, 'user_categories'=>Auth::user()->categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, $id)
    {
        $book = Book::where('user_id', Auth::id())->findOrFail($id);

        if ($request->hasFile('photo_file_name')) {
            if (!empty($book->photo_file_name)) Storage::disk('public')->delete($book->photo_file_name);
            $path = $request->file('photo_file_name')->store('uploads', 'public');
        } else {
            $path = $book->photo_file_name;
        }

        $book->name = $request->name;
        $book->author = $request->author;
        $book->isbn = $request->isbn;
        $book->description = $request->description;
        $book->photo_file_name = $path;
        $book->user_id = Auth::id();
        $book->save();

        $book->categories()->detach();
        if (!empty($request->categories)) {
            $book->categories()->attach($request->categories);
        }

        return redirect()->route('books.index')->with('message', 'Successfully updated book!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::where('user_id', Auth::id())->findOrFail($id);

        if (!empty($book->photo_file_name)) Storage::disk('public')->delete($book->photo_file_name);

        $book->categories()->detach();
        $book->delete();

        return redirect()->route('books.index')->with('message', 'Successfully deleted book!');
    }
}