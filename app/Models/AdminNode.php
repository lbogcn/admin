<?php

namespace App\Models;


class AdminNode extends \Eloquent
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['node', 'route'];

    /**
     * 按路由控制器分组
     * @return array
     */
    public static function groupByCtlAll()
    {
        $nodes = self::all();
        $group = array();
        $exists = array();

        foreach ($nodes as $node) {
            list($ctl) = explode('@', $node->route);

            if (!isset($group[$ctl])) {
                $group[$ctl] = array();
                $exists[$ctl] = array();
            }

            if (!isset($exists[$ctl][$node->id])) {
                $group[$ctl][] = $node->toArray();
                $exists[$ctl][$node->id] = true;
            }
        }

        return $group;
    }

    /**
     * 角色
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(AdminRole::class, 'admin_permissions', 'node_id', 'role_id');
    }

    /**
     * 菜单
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menus()
    {
        return $this->hasMany(AdminMenu::class, 'node_id');
    }

}