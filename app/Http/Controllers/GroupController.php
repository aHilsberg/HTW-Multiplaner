<?php

namespace App\Http\Controllers;

use App\Enums\FriendStatus;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GroupController extends Controller {
    public function store(Request $request) {
        $data = $request->validate([
            'name' => ['required', 'string', 'min:4', 'max:50']
        ]);

        $user = $request->user();

        $group = Group::create([
            'name' => $data['name']
        ]);

        $group->members()->attach($user->id);
    }

    public function rename(Request $request) {
        $user = $request->user();
        $data = $request->validate([
            'group_id' => [
                'required', 'numeric',
                Rule::exists('group_user', 'group_id')->where(function ($query) use ($user) {
                    return $query->where('user_id', $user->id);
                })
            ],
            'name' => ['required', 'string', 'min:4', 'max:50']
        ]);

        Group::where('id', $data['group_id'])->update([
            'name' => $data['name']
        ]);
    }

    public function update(Request $request) {
        $user = $request->user();
        $data = $request->validate([
            'group_id' => [
                'required', 'numeric',
                Rule::exists('group_user', 'group_id')->where(function ($query) use ($user) {
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

        Group::findOrFail($data['group_id'])->members()->syncWithoutDetaching($data['additional_members']);
    }


    public function destroy(Request $request) {
        $user = $request->user();
        $data = $request->validate([
            'group_id' => [
                'required', 'numeric',
                Rule::exists('group_user', 'group_id')->where(function ($query) use ($user) {
                    return $query->where('user_id', $user->id);
                })
            ]
        ]);

        $group = Group::where('id', $data['group_id'])->withCount('members')->firstOrFail();
        $group->members()->detach($user->id);
        if($group->members_count == 1)
            $group->delete();
    }
}
