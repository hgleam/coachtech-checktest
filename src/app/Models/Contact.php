<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * お問い合わせモデル
 */
class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'category_id',
        'detail',
        // telに結合するために一時的に利用
        'tel1',
        'tel2',
        'tel3',
    ];

    /**
     * モデルの初期起動後に実行される処理
     * @return void
     */
    protected static function booted()
    {
        static::creating(function (Contact $contact) {
            if ($contact->tel1 && $contact->tel2 && $contact->tel3) {
                $contact->tel = $contact->tel1. $contact->tel2. $contact->tel3;
            }
            unset($contact->tel1, $contact->tel2, $contact->tel3);
        });
    }

    /**
     * キーワードで検索するローカルスコープ
     * @param Builder $query
     * @param string|null $keyword
     * @return Builder
     */
    public function scopeSearchByKeyword(Builder $query, $keyword)
    {
        if (!empty($keyword)) {
            return $query->where(function ($q) use ($keyword) {
                $q->where('first_name', 'like', '%' . $keyword . '%')
                    ->orWhere('last_name', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%');
            });
        }
        return $query;
    }

    /**
     * 性別で検索するローカルスコープ
     * @param Builder $query
     * @param string|int|null $gender
     * @return Builder
     */
    public function scopeSearchByGender(Builder $query, $gender)
    {
        if ($gender !== null && $gender !== '') {
            return $query->where('gender', $gender);
        }
        return $query;
    }

    /**
     * カテゴリIDで検索するローカルスコープ
     * @param Builder $query
     * @param int|null $categoryId
     * @return Builder
     */
    public function scopeSearchByCategoryId(Builder $query, $categoryId)
    {
        if (!empty($categoryId)) {
            return $query->where('category_id', $categoryId);
        }
        return $query;
    }

    /**
     * 日付で検索するローカルスコープ
     * @param Builder $query
     * @param string|null $date
     * @return Builder
     */
    public function scopeSearchByDate(Builder $query, $date)
    {
        if (!empty($date)) {
            return $query->whereDate('created_at', $date);
        }
        return $query;
    }

    /**
     * カテゴリとのリレーション
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
