<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class CommentValidate extends FormRequest
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
            //if you try to look in the database, the name must be column name
            'id'          => 'required|exists:posts|integer|min:1',
            'title'       => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'approve'     => 'nullable',
        ];
    }
}
