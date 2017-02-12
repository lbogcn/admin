<?php

namespace App\Models;


use App\Components\CacheName;

class ArticleTag extends \Eloquent
{

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
}