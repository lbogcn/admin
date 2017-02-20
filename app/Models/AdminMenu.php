<?php

namespace App\Models;


class AdminMenu extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['pid', 'node_id', 'name', 'route', 'weight'];

    /**
     * 节点
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function node()
    {
        return $this->hasOne(AdminNode::class, 'id', 'node_id');
    }

}