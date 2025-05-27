@extends('layouts.app')

@section('css')
<link rel='stylesheet' href="{{ asset('css/contact.css') }}" />
@endsection

@section('title', 'お問い合わせフォーム - 完了')

@section('main_class', 'main-content--center')

@section('content')
<div class='contact-thanks-page__body'>
    <h2 class='contact-thanks-page__title'>お問い合わせありがとうございました</h2>
    <a href="{{ route('contact.index') }}" class='contact-thanks-page__home-button'>HOME</a>
</div>
@endsection
