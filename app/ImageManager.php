<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageManager extends Model
{
    protected $fillable =['image_path', 'foreign_id', 'source'];
}
