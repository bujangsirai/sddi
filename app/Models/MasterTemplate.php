<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterTemplate extends Model
{
    protected $table = 'master_template';

    protected $fillable = [
        'detail_progress',
    ];


    protected $casts = [
        'detail_progress' => 'array',
    ];
}
