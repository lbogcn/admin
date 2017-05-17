<?php

namespace app\Models;


class DenyKeyword extends \Eloquent
{
    protected $fillable = [
        'keyword'
    ];

    public $timestamps = false;
}