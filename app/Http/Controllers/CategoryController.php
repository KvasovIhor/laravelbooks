<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('categories.index', ['categories'=>Auth::user()->categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create', ['user_books'=>Auth::user()->books]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        $validator->after(function ($validator) use ($request) {
            if (!empty($request->books) &&
                $this->countBooksByUserIdAndBooksIds($request->books) != count($request->books)
            ) {
                $validator->errors()->add('categories', 'Some books not found');
            }
        });

        if ($validator->fails()) {
            return  redirect()->route('categories.create')
                ->withErrors($validator)
                ->withInput();
        }

        $category = new Category();

        $category->name = $request->name;
        $category->user_id = Auth::id();
        $category->save();

        if (!empty($request->books)) {
            $category->books()->attach($request->books);
        }

        return redirect()->route('categories.index')->with('message', 'Successfully created category!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::where('user_id', Auth::id())->findOrFail($id);

        return view('categories.show', ['category'=>$category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::where('user_id', Auth::id())->findOrFail($id);

        return view('categories.edit', ['category'=>$category, 'user_books'=>Auth::user()->books]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::where('user_id', Auth::id())->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        $validator->after(function ($validator) use ($request) {
            if (!empty($request->books) &&
                $this->countBooksByUserIdAndBooksIds($request->books) != count($request->books)
            ) {
                $validator->errors()->add('categories', 'Some books not found');
            }
        });

        if ($validator->fails()) {
            return  redirect()->route('categories.create')
                ->withErrors($validator)
                ->withInput();
        }

        $category->name = $request->name;
        $category->user_id = Auth::id();
        $category->save();

        $category->books()->detach();
        if (!empty($request->books)) {
            $category->books()->attach($request->books);
        }

        return redirect()->route('categories.index')->with('message', 'Successfully updated category!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::where('user_id', Auth::id())->findOrFail($id);
        $category->books()->detach();
        $category->delete();

        return redirect()->route('categories.index')->with('message', 'Successfully deleted category!');
    }

    /**
     * @param $booksIds array
     * @return integer
     */
    private function countBooksByUserIdAndBooksIds($booksIds)
    {
        if (empty($booksIds)) return 0;
        return Book::where('user_id', Auth::id())->whereIn('id', $booksIds)->count();
    }
}
