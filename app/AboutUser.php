<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AboutUser extends Model
{
    //
    protected $fillable = ['about', 'contact', 'projects'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
