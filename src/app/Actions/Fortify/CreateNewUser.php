<?php

namespace App\Actions\Fortify;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

/**
 * 新規登録ユーザーを検証して作成
 */
class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * 新規登録ユーザーを検証して作成
     * @param array<string, string> $input
     * @return User
     */
    public function create(array $input): User
    {
        $request = new RegisterRequest();

        $request->merge($input);
        $request->setContainer(app())->setRedirector(app('redirect'));
        $request->validateResolved();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
