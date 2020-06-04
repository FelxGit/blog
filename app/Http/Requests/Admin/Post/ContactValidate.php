<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class ContactValidate extends FormRequest
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
    

    public function rules()
    {
        return [

                 'name'    => 'required|min:3|max:255',
                 'email'   => 'required|email',
                 'phone'   => 'required|min:11|numeric',
                 'message' => 'required|max:2000',
        ];
    }


    public function messages()
    {
        return [

                 'name.required' => 'This field can\'t be empty',
                 'name.max' => 'Name limit reached',
                 
                 'email.required' => 'Please fill this field.',
                 
                 'phone.required' => 'Please fill this field',
                 'phone.min'      => 'We\'ll need a phone number with a minimun of 11 characters.',                         
                 'phone.numeric'  => 'Phone number can only be numeric',

                 'message.required'        => 'Please fill this field',
                 'message.max'             => 'Message limit reached',    
        ];
    }
}
