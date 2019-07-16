<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['cat_name'];

    public function getCatNameAttribute($value){
        return ucwords($value);
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }
}
