<?php

namespace App\Models;

use App\Components\CacheName;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @property int status
 */
class Article extends \Eloquent
{
    use SoftDeletes;

    /** 状态-发布 */
    const STATUS_RELEASE = 1;

    /** 状态-下线 */
    const STATUS_DRAFT = 2;

    /** 类型-文章 */
    const TYPE_ARTICLE = 1;

    /** 类型-页面 */
    const TYPE_PAGE = 2;

    /** 封面类型-无 */
    const COVER_TYPE_NONE = 1;

    /** 封面类型-小图 */
    const COVER_TYPE_SMALL = 2;

    /** 封面类型-大图 */
    const COVER_TYPE_BIG = 3;

    protected $fillable = [
        'title', 'user_id', 'author', 'status', 'type', 'excerpt', 'author', 'write_time', 'cover_type', 'cover_url'
    ];

    /** 需要额外显示的字段 @var array */
    protected $appends = ['status_text', 'type_text'];

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
    public function add(array $data, $column, $tag, $content)
    {
        return \DB::transaction(function() use ($data, $column, $tag, $content) {
            $model = self::create($data);

            list($contents, $columns, $tags) = $this->getRelationsData($model->id, $content, $column, $tag, $data['write_time']);

            $model->contents()->saveMany($contents);
            $model->columns()->attach($columns);
            $model->tags()->saveMany($tags);

            return $model;
        });
    }

    /**
     * 更新文章
     * @param $data
     * @param $column
     * @param $tag
     * @param $content
     * @return static
     */
    public function put(array $data, $column, $tag, $content)
    {
        return \DB::transaction(function () use ($data, $column, $tag, $content) {
            $this->update($data);

            list($contents, $columns, $tags) = $this->getRelationsData($this->id, $content, $column, $tag, $data['write_time']);

            $this->tags()->delete();
            $this->contents()->delete();
            $this->columns()->detach();

            $this->contents()->saveMany($contents);
            $this->columns()->attach($columns);
            $this->tags()->saveMany($tags);

            return $this;
        });
    }

    /**
     * 获取关联数据
     * @param $id
     * @param $content
     * @param $column
     * @param $tag
     * @param $writeTime
     * @return array
     */
    private function getRelationsData($id, $content, $column, $tag, $writeTime)
    {
        $contents = array();
        if (!empty($content)) {
            $contents = ArticleContent::cut($id, $content);
        }

        $columns = array();
        if (!empty($column)) {
            $rows = ArticleColumn::select('id')->whereIn('id', $column)->get();
            foreach ($rows as $row) {
                $columns[$row['id']] = array(
                    'write_time' => $writeTime
                );
            }
        }

        $tags = array();
        if (!empty($tag)) {
            $tags = ArticleTag::getNewTags($id, $tag);
        }

        return [$contents, $columns, $tags];
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
     * 发布
     * @param $id
     * @return bool
     */
    public static function up($id)
    {
        return self::patch($id, array('status' => self::STATUS_RELEASE));
    }

    /**
     * 下线
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
            ->where('type', self::TYPE_ARTICLE)
            ->orderBy('write_time', 'desc')
            ->orderBy('id', 'desc')
            ->limit($pageSize)
            ->get();
    }

    /**
     * 获取指定栏目文章
     * @param $columnId
     * @param $page
     * @param $pageSize
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getColumnArticles($columnId, $page, $pageSize)
    {
        LengthAwarePaginator::currentPageResolver(function() use ($page) {
            return $page;
        });

        $relationTable = (new ArticleColumnsRelation())->getTable();
        $selfTable = (new self)->getTable();

        return self::select("{$selfTable}.*")
            ->join($relationTable, function(JoinClause $join) use ($columnId) {
                $join->on('article_id', '=', 'id')->where('column_id', $columnId);
            })
            ->where('type', self::TYPE_ARTICLE)
            ->where('status', self::STATUS_RELEASE)
            ->orderBy('write_time', 'desc')
            ->orderBy('id', 'desc')
            ->paginate($pageSize);
    }

    /**
     * 获取指定栏目的第一篇文章，若不存在，抛出异常
     * @param $columnId
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public static function getFirstOrFailColumnArticles($columnId)
    {
        $relationTable = (new ArticleColumnsRelation())->getTable();
        $selfTable = (new self)->getTable();

        return self::select("{$selfTable}.*")
            ->join($relationTable, function(JoinClause $join) use ($columnId) {
                $join->on('article_id', '=', 'id')->where('column_id', $columnId);
            })
            ->with('tags')
            ->where('status', self::STATUS_RELEASE)
            ->where('type', self::TYPE_PAGE)
            ->orderBy('id', 'desc')
            ->firstOrFail();
    }

    /**
     * 获取所有文章
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getAllArticles()
    {
        return self::where('status', self::STATUS_RELEASE)
            ->where('type', self::TYPE_ARTICLE)
            ->orderBy('write_time', 'desc')
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * 获取文章总数
     * @return int
     */
    public static function getTotal()
    {
        $key = CacheName::ARTICLE_TOTAL[0];

        if (!\Cache::has($key)) {
            $total = self::where('status', self::STATUS_RELEASE)
                ->where('type', self::TYPE_ARTICLE)
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
            return '发布';
        } else {
            return '下线';
        }
    }


    /**
     * 类型文本
     * @return string
     */
    public function getTypeTextAttribute()
    {
        switch ($this->attributes['type']) {
            case self::TYPE_ARTICLE:
                return '文章';
            case self::TYPE_PAGE:
                return '页面';
            default:
                return '未知';
        }
    }

    /**
     * 清除文章相关缓存
     */
    public static function clearCache()
    {
        \Cache::forget(CacheName::PAGE_HOME[0]);
        \Cache::forget(CacheName::PAGE_BLOG_LIST[0]);
        \Cache::forget(CacheName::ARTICLE_TOTAL[0]);
        \Cache::forget(CacheName::ARTICLE_TAG_TOTAL[0]);
        \Cache::forget(CacheName::ARTICLE_TAGS[0]);
        \Cache::forget(CacheName::PAGE_ARTICLE[0]);

    }

}
