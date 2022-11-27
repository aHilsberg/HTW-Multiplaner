<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * the attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function groups(): BelongsToMany {
        return $this->belongsToMany(Group::class);
    }

    public function events(): BelongsToMany {
        return $this->belongsToMany(Event::class);
    }

    public function friendsTo(): BelongsToMany {
        return $this->belongsToMany(User::class, Friendship::class, 'user_first_id', 'user_second_id')->as('friendship')
            ->select(['id', 'name'])
            ->withPivot('friendship_state');
    }

    public function friendsFrom(): BelongsToMany {
        return $this->belongsToMany(User::class, Friendship::class, 'user_second_id', 'user_first_id')->as('friendship')
            ->select(['id', 'name'])
            ->withPivot('friendship_state');
    }

    public function appointments(): BelongsToMany {
        return $this->belongsToMany(Appointment::class);
    }
}
