<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AppointmentStudyGroup extends Pivot
{
    use HasFactory;

    protected $primaryKey = false;

    public $timestamps = false;
}
