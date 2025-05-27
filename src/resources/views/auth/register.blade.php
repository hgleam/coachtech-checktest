@extends('layouts.app')

@section('css')
<link rel='stylesheet' href="{{ asset('css/register.css') }}" />
@endsection

@section('title', '会員登録')

@section('header_actions')
<a href="{{ route('login') }}" class='site-header__link'>login</a>
@endsection

@section('content')
<div class='auth-page__body'>
    <h2 class='auth-page__title'>Register</h2>
    <div class='auth-page__form-wrapper'>
        <div class='auth-form'>
            <form method='post' action="{{ route('register') }}" novalidate>
                @csrf
                <div class='auth-form__group'>
                    <label>お名前</label>
                    <input type='text' name='name' placeholder='例：山田　太郎' value="{{ old('name') }}">
                </div>
                @error('name')
                <div class='auth-form__error'>{{ $message }}</div>
                @enderror
                <div class='auth-form__group'>
                    <label>メールアドレス</label>
                    <input type='email' name='email' placeholder='例：test@example.com' value="{{ old('email') }}">
                </div>
                @error('email')
                <div class='auth-form__error'>{{ $message }}</div>
                @enderror
                <div class="auth-form__group">
                    <label>パスワード</label>
                    <input type='password' name='password' placeholder='例：coachtech1106'>
                </div>
                @error('password')
                <div class='auth-form__error'>{{ $message }}</div>
                @enderror
                <div class='auth-form__actions'>
                    <button type='submit'>登録</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
