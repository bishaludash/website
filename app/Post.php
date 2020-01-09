<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DBUtils;    // import DButils traits

class Post extends Model
{
    use DBUtils;
    protected $fillable = [
        'post_title',
        'category_id',
        'image_path',
        'post_body',
        'user_id',
        'is_featured',
        'archive',
        'is_pinned'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
