<?php

namespace App\Models;

use App\Components\CacheName;
use Cache;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleColumn extends \Eloquent
{
    use SoftDeletes;

    /** 显示 */
    const IS_SHOW_TRUE = 1;

    /** 不显示 */
    const IS_SHOW_FALSE = 2;

    protected $fillable = [
        'column_name', 'alias', 'weight', 'is_show'
    ];

    protected $appends = [
        'is_show_text'
    ];

    /**
     * 首页栏目
     * @return array
     */
    public static function homeColumns()
    {
        $key = CacheName::HOME_ARTICLE_COLUMN;

        if (!Cache::has($key)) {
            $rows = self::where('is_show', self::IS_SHOW_TRUE)
                ->get()
                ->toArray();

            Cache::forever($key, $rows);
        }

        return Cache::get($key);
    }

    /**
     * 创建
     * @param $data
     * @return static
     */
    public static function store($data)
    {
        $model = ArticleColumn::create($data);

        self::clearCache();

        return $model;
    }

    /**
     * 通过id更新
     * @param $id
     * @param $data
     * @return bool
     */
    public static function updateById($id, $data)
    {
        $model = ArticleColumn::findOrFail($id);

        $result = $model->update($data);

        self::clearCache();

        return $result;
    }

    /**
     * 通过id删除
     * @param $id
     * @return bool|null
     */
    public static function deleteById($id)
    {
        $model = ArticleColumn::findOrFail($id);

        $result = $model->delete();

        self::clearCache();

        return $result;
    }

    /**
     * 是否显示文本
     * @return string
     */
    public function getIsShowTextAttribute()
    {
        if (isset($this->attributes['is_show']) && $this->attributes['is_show'] == self::IS_SHOW_TRUE) {
            return '是';
        } else {
            return '否';
        }
    }

    /**
     * 清理缓存
     */
    private static function clearCache()
    {
        $key = CacheName::HOME_ARTICLE_COLUMN;

        Cache::forget($key);
    }
}
