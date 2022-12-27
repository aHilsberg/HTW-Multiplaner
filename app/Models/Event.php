<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Event extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * the attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'resolved',
    ];


    public function appointments() : MorphMany {
        return $this->morphMany(Appointment::class, 'appointable');
    }

    public function members() : BelongsToMany {
        return $this->belongsToMany(User::class);
    }
}
