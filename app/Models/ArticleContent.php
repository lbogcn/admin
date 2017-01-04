<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleContent extends \Eloquent
{
    use SoftDeletes;

    protected $fillable = [
        'article_id', 'content'
    ];
}
