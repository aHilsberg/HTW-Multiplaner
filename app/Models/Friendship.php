<?php

namespace App\Models;

use App\Enums\FriendStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Friendship extends Pivot {
    use HasFactory;

    protected $table = 'friends';
    public $timestamps = false;
    protected $primaryKey = false;


    protected $fillable = [
        'user_first_id',
        'user_second_id',
        'friendship_state',
    ];

    protected $hidden = [
        'user_first_id',
        'user_second_id',
    ];

    protected $casts = [
        'friendship_state' => FriendStatus::class
    ];


    public static function existingFriendship(User $friendOne, User $friendTwo): Friendship|null {
        $firstId = min($friendOne->id, $friendTwo->id);
        $secondId = max($friendOne->id, $friendTwo->id);

        return Friendship::where('user_first_id', $firstId)->where('user_second_id', $secondId)->first();
    }


    public static function allFriends(User $user) {
        $friendsTo = $user->friendsTo()->get();

        $friendsFrom = $user->friendsFrom()->get();
        foreach ($friendsFrom as $friend) {
            $state = $friend->friendship->friendship_state;
            // reverse request relationship
            if ($state != FriendStatus::Befriended)
                $friend->friendship->friendship_state = $state == FriendStatus::FirstRequested ? 1 : 0;
        }

        return $friendsTo->merge($friendsFrom);
    }


    //-----------------------------------------------------------------------------------------------------


    public function hasRequested(User $user): bool {
        $first = $this->user_first_id == $user->id;
        abort_if(!$first && $this->user_second_id != $user->id, 500, "friendship isn't related to given user");

        return match ($this->friendship_state) {
            FriendStatus::Befriended => true,
            FriendStatus::FirstRequested => $first,
            FriendStatus::SecondRequested => !$first,
            default => abort(500, 'invalid friendship state'),
        };
    }

    public static function createRequest(User $requester, User $requested): Friendship {
        $firstId = min($requester->id, $requested->id);
        $secondId = max($requester->id, $requested->id);

        return Friendship::create([
            'user_first_id' => $firstId,
            'user_second_id' => $secondId,
            'friendship_state' => ($firstId == $requester->id ? FriendStatus::FirstRequested : FriendStatus::SecondRequested)->value,
        ]);
    }

    public function acceptRequest() {
        User::findOrFail($this->user_first_id)->friendsTo()->updateExistingPivot($this->user_second_id, [
            'friendship_state' => FriendStatus::Befriended
        ]);
    }

    public static function declineRequest(User $friendOne, User $friendTwo): bool|int|null {
        $firstId = min($friendOne->id, $friendTwo->id);
        $secondId = max($friendOne->id, $friendTwo->id);

        return Friendship::where('user_first_id', $firstId)->where('user_second_id', $secondId)->delete();
    }
}
