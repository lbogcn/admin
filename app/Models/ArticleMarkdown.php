<?php

namespace App\Models;

use App\Components\CacheName;
use Cache;
use RedisClient;

class ArticleMarkdown extends \Eloquent
{

    protected $fillable = [
        'article_id', 'content'
    ];


}
