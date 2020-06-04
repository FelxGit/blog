<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class TagValidate extends FormRequest
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

                 'name' => 'required|max:100',
                 'slug' => 'required|max:100',
                 
        ];
    }


    public function messages()
    {
        return [

                 'name.required' => 'Please fill this field',
                 'name.max' => 'Sorry... must have a limit of 100 characters only',
                 'slug.required' => 'Please fill this field',
                 'slug.max' => 'Sorry... must have a limit of 100 characters only',                         
        ];
    }

}
