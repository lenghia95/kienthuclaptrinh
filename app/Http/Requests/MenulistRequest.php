<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class MenulistRequest extends FormRequest
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
        return [
            'name'       => 'required|min:3',
            'parent'     => 'required|numeric',
            //'status'     => 'numeric',
            'url'        => 'required|unique:menulists,url,'.$request->_menulist,
        ];
    }
}
