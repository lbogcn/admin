<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleColumn extends \Eloquent
{
    use SoftDeletes;

    /** 显示 */
    const IS_SHOW_TRUE = 1;

    /** 不显示 */
    const IS_SHOW_FALSE = 2;

    protected $fillable = [
        'column_name', 'weight', 'is_show'
    ];

    protected $appends = [
        'is_show_text'
    ];

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
}
