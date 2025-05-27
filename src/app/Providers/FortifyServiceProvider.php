<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Http\Requests\CustomLoginRequest;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * アプリケーションの全サービスの登録
     */
    public function register(): void
    {
        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse {
        public function toResponse($request)
        {
            return redirect('/login');
        }
    });
    }

    /**
     * アプリケーションの全サービスの登録
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        // Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        // Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        // Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        // RateLimiter::for('login', function (Request $request) {
        //     $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

        //     return Limit::perMinute(5)->by($throttleKey);
        // });

        // RateLimiter::for('two-factor', function (Request $request) {
        //     return Limit::perMinute(5)->by($request->session()->get('login.id'));
        // });

        $this->app->bind(LoginRequest::class, CustomLoginRequest::class);

        Fortify::authenticateUsing(function (CustomLoginRequest $request) {
            $request->validateResolved();

            $user = \App\Models\User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }

            return null;
        });

        /**
         * 新規登録ビュー
         */
        Fortify::registerView(function () {
            return view('auth.register');
        });

        /**
         * ログインビュー
         */
        Fortify::loginView(function() {
            return view('auth.login');
        });

        /**
         * ログインレートリミッター
         */
        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(10)->by($email. $request->ip());
        });
    }
}
