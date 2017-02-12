<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int status
 */
class Article extends \Eloquent
{
    use SoftDeletes;

    const STATUS_UP = 1;

    const STATUS_DOWN = 2;

    protected $fillable = [
        'status',
    ];

    /** 需要额外显示的字段 @var array */
    protected $appends = ['status_text'];

    /**
     * 关联内容
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contents()
    {
        return $this->hasMany(ArticleContent::class);
    }

    /**
     * 关联标签
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tags()
    {
        return $this->hasMany(ArticleTag::class);
    }

    /**
     * 上架
     * @param $id
     * @return bool
     */
    public static function up($id)
    {
        return self::patch($id, array('status' => self::STATUS_UP));
    }

    /**
     * 下架
     * @param $id
     * @return bool
     */
    public static function down($id)
    {
        return self::patch($id, array('status' => self::STATUS_DOWN));
    }

    /**
     * 更新
     * @param $id
     * @param array $data
     * @return bool
     */
    private static function patch($id, array $data)
    {
        $article = self::findOrFail($id);

        foreach ($data as $key => $value) {
            $article->$key = $value;
        }

        return $article->saveOrFail();
    }

    /**
     * 删除
     * @param $id
     * @return int
     */
    public static function del($id)
    {
        /** @var self $model */
        $model = self::findOrFail($id);

        \DB::beginTransaction();
        $model->delete();
        $model->contents()->delete();
        \DB::commit();

        return self::destroy($id);
    }

    /**
     * 获取首页文章
     * @param $pageSize
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getHomeArticles($pageSize = 30)
    {
        return self::where('status', self::STATUS_UP)
            ->orderBy('id', 'desc')
            ->limit($pageSize)
            ->get();
    }

    /**
     * 状态文本
     * @return string
     */
    public function getStatusTextAttribute()
    {
        if (isset($this->attributes['status']) && $this->attributes['status'] == self::STATUS_UP) {
            return '上架';
        } else {
            return '下架';
        }
    }
}
