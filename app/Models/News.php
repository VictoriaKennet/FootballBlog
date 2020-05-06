<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'title',
        'photo',
        'text'
    ];

    public function comments() {
        return $this->hasMany('App\Models\Comments', 'news_id');
    }
}
