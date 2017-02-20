<?php

namespace App\Models;

use Eloquent;

abstract class Model extends Eloquent
{

    /**
     * 获取表名
     * @return string
     */
    public static function tableName()
    {
        static $tableName = null;

        if (empty($tableName)) {
            $tableName = (new static())->getTable();
        }

        return $tableName;
    }


}