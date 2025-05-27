<?php

namespace App\Services;

use App\Models\Contact;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Database\Eloquent\Builder;

class ContactCsvExportService
{
    /**
     * チャンクサイズ
     */
    const CHUNK_SIZE = 200;

    /**
     * お問い合わせ情報をCSV形式でエクスポート
     *
     * @param Request $request
     * @return StreamedResponse
     */
    public function export(Request $request): StreamedResponse
    {
        $contactsQuery = $this->fetchContacts($request);
        $headers = $this->getCsvHeaders();
        $fileName = 'contacts_' . date('YmdHis') . '.csv';
        $callback = $this->createCsvWritingCallback($contactsQuery, $headers);

        return $this->createCsvResponse($callback, $fileName);
    }

    /**
     * リクエストに基づいて検索されたお問い合わせデータのクエリビルダを取得
     * @param Request $request
     * @return Builder
     */
    private function fetchContacts(Request $request): Builder
    {
        return Contact::query()
            ->with('category')
            ->applySearchFilters($request)
            ->orderBy('created_at', 'desc');
    }

    /**
     * CSVファイルのヘッダー行を取得
     * @return array
     */
    private function getCsvHeaders(): array
    {
        return [
            'ID',
            'お名前',
            '性別',
            'メールアドレス',
            '電話番号',
            '住所',
            '建物名',
            'お問い合わせの種類',
            'お問い合わせ内容',
            '受付日時',
        ];
    }

    /**
     * ContactモデルをCSVの行データ配列にフォーマット
     * @param Contact $contact
     * @return array
     */
    private function formatContactForCsv(Contact $contact): array
    {
        return [
            $contact->id,
            $contact->last_name . ' ' . $contact->first_name,
            $contact->gender_text,
            $contact->email,
            $contact->tel,
            $contact->address,
            $contact->building,
            $contact->category ? $contact->category->content : '',
            $contact->detail,
            $contact->created_at->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * CSVダウンロード用のStreamedResponseを生成
     * @param callable $callback
     * @param string $fileName
     * @return StreamedResponse
     */
    private function createCsvResponse(callable $callback, string $fileName): StreamedResponse
    {
        $response = new StreamedResponse($callback);
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $fileName . '"');
        return $response;
    }

    /**
     * CSV書き込み処理を行うコールバック関数を生成
     *
     * @param Builder $contactsQuery
     * @param array $headers
     * @return callable
     */
    private function createCsvWritingCallback(Builder $contactsQuery, array $headers): callable
    {
        return function () use ($contactsQuery, $headers) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $headers);

            $contactsQuery->chunk(self::CHUNK_SIZE, function ($contacts) use ($handle) {
                foreach ($contacts as $contact) {
                    fputcsv($handle, $this->formatContactForCsv($contact));
                }
            });
            fclose($handle);
        };
    }
}