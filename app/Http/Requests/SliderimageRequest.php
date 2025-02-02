<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderimageRequest extends FormRequest
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
            'title'   => 'required',
            // 'image'   => 'max:10000|file|mimes:jpg,png,jepg',
            'key'     => 'required',
        ];
    }
}
