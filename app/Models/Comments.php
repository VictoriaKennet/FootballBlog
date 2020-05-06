<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'name',
        'email',
        'text',
        'news_id'
    ];
}
