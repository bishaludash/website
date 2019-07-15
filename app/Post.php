<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'post_title',
        'category_id',
        'image_path',
        'post_body',
        'user_id',
        'is_featured',
        'archive',
    ];
}
