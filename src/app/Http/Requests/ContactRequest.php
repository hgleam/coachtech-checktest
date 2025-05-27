<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * お問い合わせフォームリクエスト
 */
class ContactRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'last_name' => ['required'],
            'first_name' => ['required'],
            'gender' => ['required'],
            'email' => ['required', 'email'],
            'tel1' => ['required', 'digits_between:1,5'],
            'tel2' => ['required', 'digits_between:1,5'],
            'tel3' => ['required', 'digits_between:1,5'],
            'address' => ['required'],
            'category_id' => ['required'],
            'detail' => ['required', 'max:120'],
        ];
    }

    /**
     * バリデーションエラーメッセージ
     * @return array
     */
    public function messages(): array
    {
        return [
            'last_name.required' => '姓を入力してください',
            'first_name.required' => '名を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'tel1.required' => '電話番号を入力してください',
            'tel1.digits_between' => '電話番号は5桁までの数字で入力してください',
            'tel2.required' => '電話番号を入力してください',
            'tel2.digits_between' => '電話番号は5桁までの数字で入力してください',
            'tel3.required' => '電話番号を入力してください',
            'tel3.digits_between' => '電話番号は5桁までの数字で入力してください',
            'address.required' => '住所を入力してください',
            'category_id.required' => 'お問合せの種類を選択してください',
            'detail.required' => 'お問合せ内容を入力してください',
            'detail.max' => 'お問合せ内容は120文字以内で入力してください',
        ];
    }
}
