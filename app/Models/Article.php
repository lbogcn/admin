<?php

namespace App\Models;

use App\Components\CacheName;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int status
 */
class Article extends \Eloquent
{
    use SoftDeletes;

    /** 状态-发布 */
    const STATUS_RELEASE = 1;

    /** 状态-草稿 */
    const STATUS_DRAFT = 2;

    /** 类型-文章 */
    const TYPE_ARTICLE = 1;

    /** 类型-页面 */
    const TYPE_PAGE = 2;

    protected $fillable = [
        'title', 'user_id', 'author', 'status', 'type', 'excerpt'
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
     * 关联栏目
     */
    public function columns()
    {
        return $this->belongsToMany(ArticleColumn::class, 'article_columns_relations', 'article_id', 'column_id');
    }

    /**
     * 添加文章
     * @param array $data
     * @param $column
     * @param $tag
     * @param $content
     * @return static
     */
    public static function add(array $data, array $column, array $tag, $content)
    {
        return \DB::transaction(function() use ($data, $column, $tag, $content) {
            $model = self::create($data);

            $contents = ArticleContent::cut($model->id, $content);
            $columns = ArticleColumn::whereIn('id', $column)->get();
            $tags = ArticleTag::getNewTags($model->id, $tag);

            $model->contents()->saveMany($contents);
            $model->columns()->saveMany($columns);
            $model->tags()->saveMany($tags);

            return $model;
        });
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
        return self::patch($id, array('status' => self::STATUS_RELEASE));
    }

    /**
     * 下架
     * @param $id
     * @return bool
     */
    public static function down($id)
    {
        return self::patch($id, array('status' => self::STATUS_DRAFT));
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
        return self::where('status', self::STATUS_RELEASE)
            ->orderBy('id', 'desc')
            ->limit($pageSize)
            ->get();
    }

    /**
     * 获取所有文章
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getAllArticles()
    {
        return self::where('status', self::STATUS_RELEASE)
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * 获取文章总数
     * @return int
     */
    public static function getTotal()
    {
        $key = CacheName::ARTICLE_TOTAL;

        if (!\Cache::has($key)) {
            $total = self::where('status', self::STATUS_RELEASE)
                ->count();

            \Cache::forever($key, $total);
        }

        return (int)\Cache::get($key);
    }

    /**
     * 状态文本
     * @return string
     */
    public function getStatusTextAttribute()
    {
        if (isset($this->attributes['status']) && $this->attributes['status'] == self::STATUS_RELEASE) {
            return '上架';
        } else {
            return '下架';
        }
    }
}
