<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * 新規登録リクエスト
 */
class RegisterRequest extends FormRequest
{
    /**
     * ユーザーがこのリクエストを許可されているかどうかを判断
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * バリデーションルールの定義
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required',],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }

    /**
     * バリデーションエラーメッセージ
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'お名前を入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください',
            'password.required' => 'パスワードを入力してください',
        ];
    }
}
