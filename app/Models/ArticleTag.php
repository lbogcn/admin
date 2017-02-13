<?php

namespace App\Models;

use App\Components\CacheName;
use Illuminate\Pagination\LengthAwarePaginator;

class ArticleTag extends \Eloquent
{
    /**
     * 关联文章
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function article()
    {
        return $this->hasOne(Article::class, 'id', 'article_id');
    }

    /**
     * 获取标签总数
     * @return int
     */
    public static function getTotal()
    {
        $key = CacheName::ARTICLE_TAG_TOTAL;

        if (!\Cache::has($key)) {
            $total = self::count(\DB::raw('distinct tag'));

            \Cache::forever($key, $total);
        }

        return (int)\Cache::get($key);
    }

    /**
     * 获取所有标签
     * @return array
     */
    public static function getAllTag()
    {
        $key = CacheName::ARTICLE_TAGS;

        if (!\Cache::has($key)) {
            $tags = self::groupBy('tag')->get()->toArray();

            \Cache::forever($key, $tags);
        }

        return (array)\Cache::get($key);
    }

    /**
     * 获取标签文章
     * @param $tag
     * @param $page
     * @param $pageSize
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getTagArticles($tag, $page, $pageSize)
    {
        LengthAwarePaginator::currentPageResolver(function() use ($page) {
            return $page;
        });

        return self::with('article')
            ->where('tag', $tag)
            ->orderBy('article_id', 'desc')
            ->paginate($pageSize);
    }
}