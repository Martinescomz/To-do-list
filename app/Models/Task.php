<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $casts = [
        'deadline' => 'datetime'
    ];

//$fillable = campos que podem ser salvos via create() ou update()
    protected $fillable = [
        'title',
        'description',
        'priority',
        'deadline'
    ];
}
