@extends('layouts.app')

@section('css')
<link rel='stylesheet' href="{{ asset('css/login.css') }}" />
@endsection

@section('title', 'ログイン')

@section('header_actions')
<a href="{{ route('register') }}" class='site-header__link'>register</a>
@endsection

@section('content')
<div class='login-page__body'>
    <h2 class='login-page__title'>Login</h2>
    <div class='login-page__form-wrapper'>
        <div class='login-form'>
            <div class='login-form__fields'>
                <form method='post' action="{{ route('login') }}" novalidate>
                    @csrf
                    <div class='login-form__group'>
                        <label>メールアドレス</label>
                        <input type='email' name='email' placeholder='例：test@example.com' value="{{ old('email') }}">
                    </div>
                    @error('email')
                    <div class='login-form__error'>{{ $message }}</div>
                    @enderror
                    <div class='login-form__group'>
                        <label>パスワード</label>
                        <input type='password' name='password' placeholder='例：coachtech1106'>
                    </div>
                    @error('password')
                    <div class='login-form__error'>{{ $message }}</div>
                    @enderror
                    <div class='login-form__actions'>
                        <button type='submit'>ログイン</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
