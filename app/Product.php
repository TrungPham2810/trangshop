<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'price','id', 'content', 'user_id', 'category_id', 'feature_image_path', 'feature_image_name'
    ];

    protected $guarded = [];

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function productTags()
    {
        return $this->hasMany(ProductTag::class, 'product_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id')->withTimestamps();
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
