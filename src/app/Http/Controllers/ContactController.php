<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;

/**
 * お問い合わせコントローラー
 */
class ContactController extends Controller
{
    /**
     * お問い合わせ入力画面
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $categories = Category::all();

        if ($request->has('back') && session()->has('contact_inputs')) {
            return redirect()->route('contact.index')->withInput(session('contact_inputs'));
        }

        return view('contact.index', compact('categories'));
    }

    /**
     * お問い合わせ確認画面
     * @param ContactRequest $request
     * @return \Illuminate\Contracts\View\View
     */
    public function confirm(ContactRequest $request)
    {
        $contact = $request->all();
        $categories = Category::all()->keyBy('id');

        session()->put('contact_inputs', $contact);

        return view('contact.confirm', compact('contact', 'categories'));
    }

    /**
     * お問い合わせ完了画面
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function thanks(Request $request)
    {
        $contact = session()->get('contact_inputs');

        if (!$contact) {
            return redirect()->route('contact.index');
        }

        Contact::create($contact);

        session()->forget('contact_inputs');

        return view('contact/thanks');
    }
}
