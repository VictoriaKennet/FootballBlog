<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applications extends Model
{
    protected $table = 'application';

    protected $fillable = [
        'name',
        'age',
        'email',
        'phone',
        'optional_time',
        'info'
    ];
}
