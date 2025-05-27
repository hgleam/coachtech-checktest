<?php

namespace App\Http\Requests;

use Laravel\Fortify\Http\Requests\LoginRequest;

/**
 * カスタムログインリクエスト
 */
class CustomLoginRequest extends LoginRequest
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
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください',
            'password.required' => 'パスワードを入力してください',
        ];
    }
}
