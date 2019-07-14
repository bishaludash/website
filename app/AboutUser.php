<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AboutUser extends Model
{
    //
    protected $fillable = ['about', 'contact', 'projects', 'git_url'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
