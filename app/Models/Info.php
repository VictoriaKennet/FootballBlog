<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    protected $table = 'information';
    public $timestamps = false;

    protected $fillable = [
        'key',
        'value'
    ];
}
