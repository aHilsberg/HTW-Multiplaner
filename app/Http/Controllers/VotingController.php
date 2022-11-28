<?php

namespace App\Http\Controllers;

use App\Enums\VoteStatus;
use App\Models\Appointment;
use App\Models\Event;
use App\Models\EventVotes;
use Illuminate\Http\Request;

class VotingController extends Controller {
    // vote for event appointment
    public function update(Request $request) {
        $data = $request->validate([
            'appointment_id' => ['required', 'numeric', 'exists:appointments,id'],
            'event_id' => ['required', 'numeric', 'exists:events,id'],
            'sentiment' => ['required', 'boolean']
        ]);


        //TODO check if valid appointment
        abort_if($event->resolved, '400', 'event not votable anymore');

        $voteCount = EventVotes::countApproved($data['appointment_id']);

        if ($voteCount == $event->members_count) {
            // TODO resolve event
        } else {

        }
    }

    public static function UpdateEvent(int $eventId) {
        $event = Event::where('id', $eventId)->withCount('members')->with([
            'appointments' => function ($query) {
                $query->select('id')->withCount([
                    'voters' => function ($query) {
                        $query->wherePivot('vote_state', VoteStatus::Approve);
                    }
                ]);
            }
        ])->first();

        if (!$event) return;
        if ($event->resolved) return;

        foreach ($event->appointments as $appointment) {
            if ($appointment->voters_count == $event->members_count) {
                // resolve
                Appointment::where('appointable_id', $eventId)
                    ->where('appointable_type', $event->getMorphClass())
                    ->whereNot('id', $appointment->id)
                    ->delete();
                EventVotes::where('appointment_id', $appointment->id)->delete();

                $event->resolved = true;
                $event->save();


                // TODO CHECK
//                $appointment->watchers()->syncWithoutDetaching($event->members->only('id'));
            }
        }
    }
}
