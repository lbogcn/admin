<?php

namespace App\Models;

use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @property Article article
 */
class ArticleColumnsRelation extends \Eloquent
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
     * 获取栏目文章
     * @param $columnId
     * @param $page
     * @param $pageSize
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public static function getColumnArticles($columnId, $page, $pageSize)
    {
        LengthAwarePaginator::currentPageResolver(function() use ($page) {
            return $page;
        });

        return self::with(array('article' => function($query) {
                $query->orderBy('write_time', 'desc');
            }))
            ->where('column_id', $columnId)
            ->paginate($pageSize);
    }

    /**
     * 获取条一条栏目文章
     * @param $columnId
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public static function getFirstOrFailColumnArticles($columnId)
    {
        return self::with('article')
            ->where('column_id', $columnId)
            ->orderBy('article_id', 'desc')
            ->firstOrFail();
    }


}