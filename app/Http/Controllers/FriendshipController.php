<?php

namespace App\Http\Controllers;

use App\Enums\FriendStatus;
use App\Models\Appointment;
use App\Models\Friendship;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class FriendshipController extends Controller {

    public function store(Request $request) {
        $data = $request->validate([
            'name' => ['required', 'exists:users'],
        ]);

        $requestedFriend = User::where('name', $data['name'])->firstOrFail();
        $user = $request->user();

        abort_if($requestedFriend->id == $user->id, 400, 'friendship to oneself is not allowed');

        $existingFriendship = Friendship::existingFriendship($user, $requestedFriend);

        abort_if(!!$existingFriendship, 400, 'friendship already exists');

        Friendship::createRequest($user, $requestedFriend);
    }

    public function update(Request $request) {
        $data = $request->validate([
            'friend_id' => ['required', 'exists:users,id']
        ]);

        $requester = User::findOrFail($data['friend_id']);
        $user = $request->user();

        $existingFriendship = Friendship::existingFriendship($requester, $user);

        abort_if(!$existingFriendship, 400, 'friendship has not been requested');
        abort_if($existingFriendship->hasRequested($user), 400, 'has not been requested');

        $existingFriendship->acceptRequest();
    }


    public function destroy(Request $request) {
        $data = $request->validate([
            'friend_id' => 'exists:users,id'
        ]);

        $friend = User::findOrFail($data['friend_id']);
        $user = $request->user();

        Friendship::declineRequest($user, $friend);
    }
}
