<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextContent extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        'secondary' => 'array'
    ];
}
