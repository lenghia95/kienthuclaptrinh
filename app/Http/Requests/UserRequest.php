<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Route;

class UserRequest extends FormRequest
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
    public function rules(Request $request)
    {

        $rules =  [
            'avatar'     => 'image|mimes:jpeg,png,jpg,gif,svg',
            'phone'      => 'nullable|numeric|digits_between:10,11',
        ];
        if(Route::currentRouteName() != 'users.update'){
            $rules['username']      = 'required|min:2|max:32';
            $rules['email']         = 'required|email|unique:users,email';
            $rules['password']      = 'required|min:6|max:32';
            $rules['repassword']    = 'same:password';
        }
        return $rules;
    }
}
