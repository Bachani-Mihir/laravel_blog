<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminPostRequest extends FormRequest
{
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
            'title' => 'required|max:255',
            'slug' => 'required|max:255',
            'thumbnail' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file type and size as needed
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id', // Assuming categories table has an'id' column
        ];
    }
}
