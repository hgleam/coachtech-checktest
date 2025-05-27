@extends('layouts.app')

@section('css')
<link rel='stylesheet' href="{{ asset('css/contact.css') }}" />
@endsection

@section('title', 'お問い合わせフォーム - 確認')

@section('content')
<div class='contact-confirm-page__body'>
    <h2 class='contact-confirm-page__title'>Confirm</h2>
    <div class='contact-confirm-page__form-wrapper'>
        <form class='contact-form' action="{{ route('contact.thanks') }}" method='post'>
            @csrf
            <table class='contact-form__table'>
                <tr><th>お名前</th><td>{{ $contact['last_name'] }}　{{ $contact['first_name'] }}</td></tr>
                <tr><th>性別</th><td>{{ config('master.gender')[$contact['gender']] }} </td></tr>
                <tr><th>メールアドレス</th><td>{{ $contact['email'] }}</td></tr>
                <tr><th>電話番号</th><td>{{ $contact['tel1'] }}{{ $contact['tel2'] }}{{ $contact['tel3'] }}</td></tr>
                <tr><th>住所</th><td>{{ $contact['address'] }}</td></tr>
                <tr><th>建物名</th><td>{{ $contact['building'] }}</td></tr>
                <tr><th>お問い合わせの種類</th><td>{{ $categories[$contact['category_id']]->content }}</td></tr>
                <tr><th>お問い合わせ内容</th><td>{!! nl2br(e($contact['detail'])) !!}</td></tr>
            </table>
            <div class='contact-form__actions'>
                <button class='contact-form__submit'>送信</button>
                <a href="{{ route('contact.index', ['back' => true]) }}" class='contact-form__back'>修正</a>
            </div>
        </form>
    </div>
</div>
@endsection
