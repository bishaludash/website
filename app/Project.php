<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['project_title', 'project_body', 'project_url','project_image', 'is_archived'];
}
