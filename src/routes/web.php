<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ContactController::class, 'index'])->name('contact.index'); // お問い合わせフォーム入力画面
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm'); // お問い合わせフォーム確認画面
Route::post('thanks', [ContactController::class, 'thanks'])->name('contact.thanks'); // お問い合せフォームサンクス画面
});
