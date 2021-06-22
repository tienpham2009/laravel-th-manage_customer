<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'name' => 'required|min:2|max:30|unique:customer,name',
            'email' => 'required|email|unique:customer,email',
            'dob' => 'required|date_format:Y-m-d|before:today'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'khong duoc de trong',
            'name.min' => 'ten phai co 2 ki tro len',
            'name.max' => 'ten phai duoi 30 ki tu',
            'name.unique' => 'ten da ton tai',
            'email.required' => 'khong duoc de trong',
            'email.email' => "email khong dung dinh dang",
            'email.unique' => "email da ton tai",
            'dob.required' => "khong duoc de trong",
            'dob.date_format' => 'ngay sinh khong dung dinh dang',
            'dob.before' => 'ngay sinh khong hop le'
        ];

    }
}
