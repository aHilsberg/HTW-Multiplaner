<?php

namespace App\Models;

use App\Enums\RecurrenceState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Appointment extends Model {
    use HasFactory;


    /**
     * the attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'owner_id',
        'origin_date',
        'start_time',
        'end_time',
        'recurrence',
        'location',
        'details',
        'info',
        'appointable_id',
        'appointable_type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'origin_date' => 'datetime',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'location' => 'array',
        'recurrence' => RecurrenceState::class
    ];


    public function appointable(): MorphTo {
        return $this->morphTo();
    }

    public function voters() {
        return $this->belongsToMany(User::class, EventVotes::class)->as('voters');
    }

    public function watchers() {
        return $this->belongsToMany(User::class);
    }

    public function studyGroups() {
        return $this->belongsToMany(StudyGroup::class, AppointmentStudyGroup::class);
    }
}
