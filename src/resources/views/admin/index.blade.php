@extends('layouts.app')

@section('css')
<link rel='stylesheet' href="{{ asset('css/admin/index.css') }}">
@endsection

@section('title', '管理画面')

@section('header_class', 'site-header admin-page__header')

@section('header_actions')
    <form method='post' action="{{ route('logout') }}" class='site-header__logout-form'>
        @csrf
        <a href='#' class='site-header__link site-header__link--logout'
            onclick="event.preventDefault(); this.closest('form').submit();">
            logout
        </a>
    </form>
@endsection

@section('content')
<div class='admin-page__body'>
    <h2 class='admin-page__title'>Admin</h2>

    @if (session('success'))
        <div class='admin-page__flash-message admin-page__flash-message--success'>
            {{ session('success') }}
        </div>
    @endif

    <form method='get' action="{{ route('admin.search') }}" class='admin-page__search-form'>
    <div class='admin-page__filter admin-filter'>
        <input type='text' class='admin-filter__input admin-filter__input--text' name='keyword' placeholder='名前やメールアドレスを入力してください' value="{{ old('keyword', request('keyword')) }}">
        <select class='admin-filter__select' name='gender'>
            <option value='' {{ old('gender', request('gender')) == null ? 'selected' : '' }}>性別</option>
            @foreach (config('master.gender') as $key => $value)
            <option value='{{ $key }}' {{ old('gender', request('gender')) == $key ? 'selected': ''}}>
                {{ $value }}
            </option>
            @endforeach
        </select>
        <select class='admin-filter__select' name='category_id'>
            <option value='' {{ old('category_id', request('category_id')) == null ? 'selected': '' }}>お問い合わせの種類</option>
            @foreach ($categories as $category)
            <option value='{{ $category->id }}' {{ old('category_id', request('category_id')) == $category->id ? 'selected': ''}}>
                {{ $category->content }}
            </option>
            @endforeach
        </select>
        <input type='date' class='admin-filter__input admin-filter__input--date' name='date' value="{{ old('date', request('date')) }}">
        <button type='submit' class='admin-filter__button admin-filter__button--search'>検索</button>
        <a href="{{ route('admin.index') }}" class='admin-filter__button admin-filter__button--reset'>リセット</a>
    </div>
    </form>

    <div class='admin-page__actions-and-pagination'>
        <div class='admin-page__actions'>
            <a href="{{ route('admin.export', request()->query()) }}" class='admin-page__button admin-page__button--export'>エクスポート</a>
        </div>

        <div class='admin-page__pagination'>
            {{ $contacts->links() }}
        </div>
    </div>

    <table class='admin-page__table admin-table'>
        <thead>
            <tr>
                <th class='admin-table__header'>お名前</th>
                <th class='admin-table__header'>性別</th>
                <th class='admin-table__header'>メールアドレス</th>
                <th class='admin-table__header'>お問い合わせの種類</th>
                <th class='admin-table__header admin-table__header--action'></th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td class='admin-table__data'>{{ $contact->last_name }}　{{ $contact->first_name }}</td>
                <td class='admin-table__data'>{{ $contact->getGenderText() }}</td>
                <td class='admin-table__data'>{{ $contact->email }}</td>
                <td class='admin-table__data'>{{ $contact->category->content ?? 'カテゴリなし' }}</td>
                <td class='admin-table__data admin-table__data--action'>
                    <a href='#' class='admin-table__action-link js-open-modal'
                        data-contact-id='{{ $contact->id }}'
                        data-name='{{ $contact->last_name }} {{ $contact->first_name }}'
                        data-gender='{{ $contact->getGenderText() }}'
                        data-email='{{ $contact->email }}'
                        data-tel='{{ $contact->tel }}'
                        data-address='{{ $contact->address }}'
                        data-building='{{ $contact->building_name }}'
                        data-category-content='{{ $contact->category->content }}'
                        data-detail='{{ $contact->detail }}'>
                        詳細
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @include('admin.partials.contact_detail_modal')
</div>
@endsection

@push('scripts')
@endpush
