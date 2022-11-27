<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EventController extends Controller {
    public function store(Request $request) {
        $data = $request->validate([
            'name' => ['required', 'string', 'min:4', 'max:50']
        ]);

        $user = $request->user();

        $event = Event::create([
            'name' => $data['name']
        ]);

        $event->members()->attach($user->id);
    }


    public function rename(Request $request) {
        $user = $request->user();
        $data = $request->validate([
            'event_id' => [
                'required', 'numeric',
                Rule::exists('event_user', 'event_id')->where(function ($query) use ($user) {
                    return $query->where('user_id', $user->id);
                })
            ],
            'name' => ['required', 'string', 'min:4', 'max:50']
        ]);

        Event::where('id', $data['event_id'])->update([
            'name' => $data['name']
        ]);
    }

    public function update(Request $request) {
        $user = $request->user();
        $data = $request->validate([
            'event_id' => [
                'required', 'numeric',
                Rule::exists('event_user', 'event_id')->where(function ($query) use ($user) {
                    return $query->where('user_id', $user->id);
                })
            ],
            'additional_members' => ['required', 'array', 'min:1'],
            'additional_members.*' => ['required', 'numeric', 'exists:users,id']
        ]);

        $validMembers = User::getMovableUsers($user->id);

        foreach ($data['additional_members'] as $member) {
            abort_if(!array_key_exists($member, $validMembers), 400, 'not allowed to add user');
        }

        Event::findOrFail($data['event_id'])->members()->syncWithoutDetaching($data['additional_members']);
    }


    public function destroy(Request $request) {
        $user = $request->user();
        $data = $request->validate([
            'event_id' => [
                'required', 'numeric',
                Rule::exists('event_user', 'event_id')->where(function ($query) use ($user) {
                    return $query->where('user_id', $user->id);
                })
            ]
        ]);

        $event = Event::where('id', $data['event_id'])->withCount('members')->firstOrFail();
        $event->members()->detach($user->id);
        if($event->members_count == 1)
            $event->delete();
    }
}
