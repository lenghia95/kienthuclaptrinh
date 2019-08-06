<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ContactRequest extends FormRequest
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
            'name'     => 'required|min:2|max:50',
            'email'    => 'required|email',
            'phone'    => 'required|numeric|digits_between:10,11',
            'content'  => 'required|max:1000',
        ];
       
    }

    public function messages()
    {
        return [
            'name.required'     => 'Vui lòng nhập vào vào trường này!!',
            'name.min'     => 'Hãy nhập tên ít nhất 2 ký tự!!',
            'name.max'     => 'Hãy nhập tên nhiều nhất 50 ký tự!!',
            'email.required'    => 'Vui lòng nhập vào vào trường này!!',
            'email.email'    => 'Email không đúng định dạng',
            'phone.required'    => 'Vui lòng nhập vào vào trường này!!',
            'phone.numeric'    => 'Số điện thoại không chính xác',
            'phone.digits_between'    => 'Số điện thoại phải là 10 hoặc 11 số',
            'content.required'  => 'Vui lòng nhập vào vào trường này!!',
            'content.max'  => 'Nội dung tối đa được nhập là 1000 ký tự',
        ];
       
    }
}
