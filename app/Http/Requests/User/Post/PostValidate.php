<?php

namespace App\Http\Requests\User\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostValidate extends FormRequest
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

                 'title'      => 'required|max:225',
                 'subtitle'   => 'required|max:100',
                 'slug'       => 'required|max:100',
                 'body'       => 'required',
                 'categories' => 'required',
                 'tags'       => 'required',
        ];
    }


    public function messages()
    {
        return [

                 // 'title.required' => 'Please fill this field',
                 // 'title.max' => 'Sorry... must have a limit of 225 characters only',
                 
                 // 'subtitle.required' => 'Please fill this field',
                 // 'subtitle.max' => 'Sorry... must have a limit of 100 characters only',
                 
                 // 'slug.required' => 'Please fill this field',
                 // 'slug.max' => 'Sorry... must have a limit of 100 characters only',
                 
                 // 'body.required' => 'Please fill this field',
                 // 'body.max' => 'Sorry... must have a limit of 1000 characters only',
        ];
    }


}
