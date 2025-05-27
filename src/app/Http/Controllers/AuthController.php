<?php

namespace App\Http\Controllers;

/**
 * 認証コントローラー
 */
class AuthController extends Controller
{
    /**
     * 認証ページを表示
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('index');
    }
}
