<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:4|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前は必須項目です。',
            'email.required' => 'メールアドレスは必須項目です。',
            'email.unique' => 'このメールアドレスはすでに使用されています。',
            'password.required' => 'パスワードは必須項目です。',
            'password.min' => 'パスワードは4文字以上である必要があります。',
            'password.confirmed' => 'パスワードが一致しません。',
        ];
    }
}
