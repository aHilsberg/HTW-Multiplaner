<?php

namespace App\Models;

use App\Enums\VoteStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class EventVotes extends Pivot {
    use HasFactory;

    protected $table = 'vote_user';
    public $timestamps = false;


    protected $fillable = [
        'user_id',
        'appointment_id',
        'vote_state',
    ];


    protected $casts = [
        'vote_state' => VoteStatus::class
    ];


    public static function countApproved(int $appointmentId){
        return  EventVotes::where('appointment_id', $appointmentId)->count();
    }
}
