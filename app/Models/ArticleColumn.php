<?php

namespace App\Models;

use App\Components\CacheName;
use Cache;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int id
 * @property int type
 * @property string column_name
 */
class ArticleColumn extends \Eloquent
{
    use SoftDeletes;

    /** 显示 */
    const IS_SHOW_TRUE = 1;

    /** 不显示 */
    const IS_SHOW_FALSE = 2;

    /** 类型-列表 */
    const TYPE_LIST = 1;

    /** 类型-页面 */
    const TYPE_PAGE = 2;

    protected $fillable = [
        'column_name', 'type', 'alias', 'weight', 'is_show', 'parent_id'
    ];

    protected $appends = [
        'is_show_text',
        'type_text'
    ];

    /**
     * 首页栏目
     * @return array
     */
    public static function homeColumns()
    {
        $key = CacheName::HOME_ARTICLE_COLUMN[0];

        if (!Cache::has($key)) {
            $rows = self::where('is_show', self::IS_SHOW_TRUE)
                ->orderBy('weight', 'desc')
                ->get()
                ->toArray();

            Cache::forever($key, $rows);
        }

        return Cache::get($key);
    }

    /**
     * 获取栏目总数
     * @return int
     */
    public static function getTotal()
    {
        return count(self::homeColumns());
    }

    /**
     * 通过别名获取
     * @param $alias
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public static function findByAliasOrFail($alias)
    {
        return self::where('alias', $alias)
            ->firstOrFail();
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

    public function getTypeTextAttribute()
    {
        if (isset($this->attributes['type']) && $this->attributes['type'] == self::TYPE_PAGE) {
            return '页面';
        } else {
            return '列表';
        }
    }

    /**
     * 清理缓存
     */
    private static function clearCache()
    {
        $key = CacheName::HOME_ARTICLE_COLUMN[0];

        Cache::forget($key);
    }
}
