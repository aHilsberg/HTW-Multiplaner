<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class StudyGroup extends Model
{
    use HasFactory;

    protected $keyType = 'string';



    public function appointments(): BelongsToMany {
        return $this->belongsToMany(Appointment::class);
    }
}
