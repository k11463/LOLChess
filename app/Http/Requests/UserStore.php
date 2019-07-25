<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStore extends FormRequest
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
            'name' => 'required|min:2|max:8',
            'account' => 'required|min:4|max:12|alpha_num',
            'password' => 'required|min:4|max:12|alpha_num',
            'email' => 'required|email'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '請填寫會員名稱',
            'name.min' => '會員名稱不可小於2個字',
            'name.max' => '會員名稱不可大於8個字',
            'account.required' => '請填寫帳號',
            'account.min' => '帳號不可小於4個字',
            'account.max' => '帳號不可大於12個字',
            'password.required' => '請填寫密碼',
            'password.min' => '帳號不可小於4個字',
            'password.max' => '帳號不可大於12個字',
            'email.required' => '請填寫Email',
            'email.email' => 'Email格式錯誤'
        ];
    }
}
