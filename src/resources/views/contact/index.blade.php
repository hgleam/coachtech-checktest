@extends('layouts.app')

@section('title', 'お問い合わせフォーム - 入力')

@section('css')
<link rel='stylesheet' href="{{ asset('css/contact.css') }}">
@endsection

@section('content')
<div class='contact-page__body'>
    <h2 class='contact-page__title'>Contact</h2>
    <div class='contact-page__form-wrapper'>
        <form class='contact-form' action="{{ route('contact.confirm') }}" method='post' novalidate>
            @csrf
            <div class='contact-form__row'>
                <label class='contact-form__label'>お名前 <span class='contact-form__required'>※</span></label>
                <div class='contact-form__field-group'>
                    <input type='text' name='last_name' placeholder='山田' class='contact-form__input' value="{{ old('last_name') }}">
                    <input type='text' name='first_name' placeholder='太郎' class='contact-form__input' value="{{ old('first_name') }}">
                </div>
            </div>
            @error('last_name')
            <div class='contact-form__error'>{{ $message }}</div>
            @enderror
            @error('first_name')
            <div class='contact-form__error'>{{ $message }}</div>
            @enderror
            <div class='contact-form__row'>
                <label class='contact-form__label'>性別 <span class='contact-form__required'>※</span></label>
                <div class='contact-form__field-group'>
                    @foreach (config('master.gender') as $key => $value)
                    <label><input type='radio' name='gender' value='{{ $key }}' {{ old('gender', 1) == $key ? 'checked' : '' }}>{{ $value }}</label>
                    @endforeach
                </div>
            </div>
            @error('gender')
            <div class='contact-form__error'>{{ $message }}</div>
            @enderror
            <div class='contact-form__row'>
                <label class='contact-form__label'>メールアドレス <span class='contact-form__required'>※</span></label>
                <div class='contact-form__field-group'>
                    <input type='email' name='email' class='contact-form__input' placeholder='test@example.com' value="{{ old('email') }}">
                </div>
            </div>
            @error('email')
            <div class='contact-form__error'>{{ $message }}</div>
            @enderror
            <div class='contact-form__row'>
                <label class='contact-form__label'>電話番号 <span class='contact-form__required'>※</span></label>
                <div class='contact-form__field-group'>
                    <input type='text' name='tel1' class='contact-form__input' placeholder='080' value="{{ old('tel1') }}">
                    <input type='text' name='tel2' class='contact-form__input' placeholder='1234' value="{{ old('tel2') }}">
                    <input type='text' name='tel3' class='contact-form__input' placeholder='5678' value="{{ old('tel3') }}">
                </div>
            </div>
            @error('tel1')
            <div class='contact-form__error'>{{ $errors->first('tel1') }}</div>
            @enderror
            @error('tel2')
            <div class='contact-form__error'>{{ $message }}</div>
            @enderror
            @error('tel3')
            <div class='contact-form__error'>{{ $message }}</div>
            @enderror
            <div class='contact-form__row'>
                <label class='contact-form__label'>住所 <span class='contact-form__required'>※</span></label>
                <div class='contact-form__field-group'>
                    <input type='text' name='address' class='contact-form__input' placeholder='東京都渋谷区千駄ヶ谷1-2-3' value="{{ old('address') }}" >
                </div>
            </div>
            @error('address')
            <div class='contact-form__error'>{{ $message }}</div>
            @enderror
            <div class='contact-form__row'>
                <label class='contact-form__label'>建物名</label>
                <div class='contact-form__field-group'>
                    <input type='text' name='building' class='contact-form__input' placeholder='千駄ヶ谷マンション101' value="{{ old('building') }}">
                </div>
            </div>
            <div class='contact-form__row'>
                <label class='contact-form__label'>お問い合わせの種類 <span class='contact-form__required'>※</span></label>
                <div class='contact-form__field-group'>
                    <select name='category_id' class='contact-form__input' style="height: 46px;">
                        <option value='' disabled {{ old('category_id') == null ? 'selected' : '' }}>選択してください</option>
                        @foreach ($categories as $category)
                            <option value='{{ $category->id }}' {{ old('category_id') == $category->id ? 'selected': ''}}>
                                {{ $category->content }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            @error('category_id')
            <div class='contact-form__error'>{{ $message }}</div>
            @enderror
            <div class='contact-form__row'>
                <label class='contact-form__label'>お問い合わせ内容 <span class='contact-form__required'>※</span></label>
                <div class='contact-form__field-group'>
                    <textarea name='detail' class='contact-form__input' rows='6' placeholder='お問い合わせ内容をご記載ください'>{{ old('detail') }}</textarea>
                </div>
            </div>
            @error('detail')
            <div class='contact-form__error'>{{ $message }}</div>
            @enderror
            <div class='contact-form__actions'>
                <button type='submit' class='contact-form__submit'>確認画面</button>
            </div>
        </form>
    </div>
</div>
@endsection
