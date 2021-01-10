<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $guarded = [];
    // lấy các row con có parent id là id của row hiện tại
    public function permissionsChildrent()
    {
        return $this->hasMany(Permission::Class, 'parent_id');
    }
    // lấy row parent của row hiện tại thông qua field parent_id
    public function parent()
    {
        return $this->belongsTo(Permission::Class, 'parent_id');
    }
}
