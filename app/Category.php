<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
//    protected $fillable = [
//        'name', 'parent_id','id', 'slug'
//    ];

    protected $guarded = [];

    public function categoryParent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function categoryChildren()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function productChildren()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

}
