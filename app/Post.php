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
        'is_pinned'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }


    // Query scope
    public function scopeFeatured($query){
        return $query->where('is_featured', 1)
            ->where('archive',0)
            ->latest()
            ->limit(1)
            ->get(['id', 'post_title','updated_at','category_id', 'image_path', 'post_body']);
    }

    public function scopePinnedPosts($query){
        return $query->where('is_pinned', 1)
        ->latest()
        ->limit(2)
        ->get(['id', 'post_title','updated_at','category_id']);
    }

    public function scopePosts($query){
        return $query->where('is_featured', 0)
        ->where('archive',0)
        ->limit(10)
        ->get();
    } 

    public function scopeArchive($query){
        return $query->selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')->groupBy('year', 'month')
        ->orderByRaw('min(created_at) desc')
        ->get()
        ->toArray();
    }
}
