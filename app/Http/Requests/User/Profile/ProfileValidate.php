<?php

namespace App\Http\Requests\User\Profile;

use Illuminate\Foundation\Http\FormRequest;

class ProfileValidate extends FormRequest
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

                 'intro'        => 'required|max:1000',
                 //'name'   =>  'required|max:255', already have the name as user
                 //'email'  =>  'required|max:255', same as email
                 'image'        => 'nullable|image',
                 'gender'       => 'required',
                 'hobby'        => 'required|max:1000',
                 'current_city' => 'required|max:255',
                 'hometown'     => 'required|max:255',
        ];
    }


    public function messages()
    {
        return [
            'image.image' => 'The file must be an image.',

        ];
    }


}
