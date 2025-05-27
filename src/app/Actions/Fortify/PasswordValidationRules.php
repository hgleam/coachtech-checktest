<?php

namespace App\Actions\Fortify;

use Illuminate\Validation\Rules\Password;

/**
 * パスワードの検証ルール
 */
trait PasswordValidationRules
{
    /**
     * パスワードの検証ルールを取得
     * @return array
     */
    protected function passwordRules(): array
    {
        return ['required', 'string', Password::default(),];
    }
}
