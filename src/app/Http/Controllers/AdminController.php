<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Services\ContactCsvExportService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * 1ページあたりの表示件数
     */
    const PER_PAGE = 7;

    /**
     * お問い合わせ一覧画面
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // 初期表示時は検索条件なしで全件表示（ページネーションあり）
        $contacts = Contact::with('category')->orderBy('created_at', 'desc')->paginate(self::PER_PAGE);
        $categories = Category::all()->keyBy('id'); // カテゴリ一覧を取得
        return view('admin.index', compact('contacts', 'categories'));
    }

    /**
     * お問い合わせ検索画面
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function search(Request $request)
    {
        $contacts = Contact::query()
            ->with('category')
            ->applySearchFilters($request)
            ->orderBy('created_at', 'desc')
            ->paginate(self::PER_PAGE)
            ->appends($request->query());

        $categories = Category::all()->keyBy('id');

        return view('admin.index', compact('contacts', 'categories'));
    }

    /**
     * お問い合わせ削除画面
     * @param Contact $contact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->back()->with('success', 'お問い合わせを削除しました');
    }

    /**
     * お問い合わせ情報をCSV形式でエクスポートします。
     *
     * @param Request $request
     * @param ContactCsvExportService $csvExportService
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function exportCsv(Request $request, ContactCsvExportService $csvExportService)
    {
        return $csvExportService->export($request);
    }
}
