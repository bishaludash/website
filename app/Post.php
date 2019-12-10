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

    public function getlatestPosts(){
        $query = "select p.id, p.post_title, left(p.post_body, 200) as post_body,p.created_at,p.image_path, 
        concat(u.fname,' ', u.lname) as username, c.cat_name from posts p 
        inner join users u on u.id=p.user_id 
        inner join categories c on c.id= p.category_id
        where archive='f'  
        order by p.created_at desc limit 8";

        $latestposts = $this->selectQuery($query);
        return $latestposts;
    } 
}
