<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BookRequest extends FormRequest
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
            'name' => 'required|min:3|max:255',
            'author' => 'required|min:3|max:255',
            'isbn' => 'required|regex:/^[\d-]+$/|min:10|max:32',
            'photo_file_name' => 'image',
            'description' => 'max:21000',
            'categories' => 'array',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!empty($this->categories) &&
                $this->countCategoriesByUserIdAndCategoryIds($this->categories) != count($this->categories)
            ) {
                $validator->errors()->add('categories', 'Some categories not found');
            }
        });
    }

    /**
     * @param $categoriesIds array
     * @return integer
     */
    private function countCategoriesByUserIdAndCategoryIds($categoriesIds)
    {
        if (empty($categoriesIds)) return 0;
        return Category::where('user_id', Auth::id())->whereIn('id', $categoriesIds)->count();
    }
}
