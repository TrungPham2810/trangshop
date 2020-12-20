<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    protected $guarded = [];

    public function tags()
    {
        return $this->hasOne(Tag::class, 'tag_id');
    }
}
