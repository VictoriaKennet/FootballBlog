<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photo_gallery';

    protected $fillable = [
        'value'
    ];
}
