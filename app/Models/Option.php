<?php

namespace App\Models;

use App\Components\CacheName;
use Cache;

class Option extends \Eloquent
{

    protected $fillable = [
        'option_name', 'remark', 'option_value'
    ];

    /**
     * 通过id更新
     * @param $id
     * @param $data
     * @return bool
     */
    public static function updateById($id, $data)
    {
        $model = self::findOrFail($id);

        $result = $model->update($data);

        Cache::forget(CacheName::OPTIONS . md5($data['option_name']));

        return $result;
    }
}
