<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleComment extends \Eloquent
{
    use SoftDeletes;

    protected $fillable = [

    ];

    protected $appends = [
        'is_deleted'
    ];

    /**
     * 关联用户
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 关联文章
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * 是否删除
     * @return bool
     */
    public function getIsDeletedAttribute()
    {
        if (empty($this->attributes['deleted_at'])) {
            return false;
        } else {
            return true;
        }
    }
}
