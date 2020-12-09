<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'price','id', 'content', 'user_id', 'category_id', 'feature_image_path'
    ];
}
