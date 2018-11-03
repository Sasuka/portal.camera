<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CameraCategories extends Model
{
    //
    protected $table = 'camera_category';

    protected $fillable = ['type_name', 'description', 'deleted', 'published', 'created_at'];
}
