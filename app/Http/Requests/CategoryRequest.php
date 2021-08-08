<?php

namespace App\Http\Requests;

use App\Models\Book;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:255'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!empty($this->books) &&
                $this->countBooksByUserIdAndBooksIds($this->books) != count($this->books)
            ) {
                $validator->errors()->add('books', 'Some books not found');
            }
        });
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
