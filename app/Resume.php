<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $table = 'resume_collects';

    protected $fillable = ['uuid', 'email', 'status', 'message'];
}
