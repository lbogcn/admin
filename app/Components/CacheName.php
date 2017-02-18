<?php

namespace App\Components;

use App\Models\Option;

class CacheName
{
    const HOME_ARTICLE_COLUMN = [
        'home_article_column',
        '首页文章栏目'
    ];

    const OPTIONS = [
        'options:',
        '选项配置'
    ];

    const PAGE_ARTICLE = [
        'page_article',
        '页面-文章详情'
    ];

    const PAGE_HOME = [
        'page_home',
        '页面-首页'
    ];

    const PAGE_BLOG_LIST = [
        'page_blog_list',
        '页面-博客列表'
    ];

    const ARTICLE_TOTAL = [
        'article_total',
        '文章总数'
    ];

    const ARTICLE_TAG_TOTAL = [
        'article_tag_total',
        '文章标签总数'
    ];

    const ARTICLE_TAGS = [
        'article_tags',
        '文章标签列表'
    ];

    /**
     * 获取所有缓存key
     */
    public static function getAllKey()
    {
        $ref = new \ReflectionClass(self::class);

        return $ref->getConstants();
    }

    /**
     * 清除缓存key
     * @param array $keys
     */
    public static function clear(array $keys)
    {
        foreach ($keys as $key) {
            $func = 'clear' . trim(studly_case($key), ':');
            if (method_exists(self::class, $func)) {
                self::$func($key);
            } else {
                \Cache::forget($key);
            }
        }
    }

    /**
     * 清除option:缓存
     * @param $keyPrefix
     */
    protected static function clearOptions($keyPrefix)
    {
        $options = Option::get()->toArray();
        $options = array_column($options, 'option_name');

        foreach ($options as $option) {
            $key = "{$keyPrefix}{$option}";
            \Cache::forget($key);
        }
    }

}