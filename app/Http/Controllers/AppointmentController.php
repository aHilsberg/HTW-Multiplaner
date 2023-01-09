<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Event;
use App\Models\Module;
use App\Models\StudyGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class AppointmentController extends Controller {
    public function index(Request $request){
        return Inertia::render('ownTimetable', User::timetableData($request->user()));
    }


    // get all appointments of appointable
    public function search(Request $request) {
        $user = $request->user();
        $queryData = $request->validate([
            'module' => ['required_without_all:event,study_group', 'string', 'exists:modules,id'],
            'event' => ['required_without_all:module,study_group', 'integer', 'exists:events,id', Rule::exists('event_user', 'event_id')->where('user_id', $user->id)],
            'study_group' => ['required_without_all:event,module', 'string', 'min:9', 'max:9', 'exists:study_groups,id']
        ]);


        $contents = User::timetableData($user);

        if (isset($queryData['module'])) {
            $contents['module'] = Module::where('id', $queryData['module'])->with(['appointments', 'name'])->get();
        } else if (isset($queryData['event'])) {
            $contents['event'] = Event::where('id', $queryData['event'])->with(['members', 'appointments'])->get();
        } else if (isset($queryData['study_group'])) {
            $contents['study_group_content'] = StudyGroup::findOrFail($queryData['study_group'])->appointments()->get();
//            $contents['study_group_content'] = Module::withWhereHas('appointments.studyGroups', function ($query) use ($queryData) {
//                $query->where('study_group_id', 'like',  );
//            })->get();
        }

        return Inertia::render('searchTimetable', $contents);
    }


    // create new appointment (event / private event)
    public function store(Request $request) {

    }

    // update details room (event / private event)
    public function rename(Request $request) {
        $data = $request->validate([
            'appointment_id' => ['required', 'numeric', 'exists:appointments,id'],
            'location' => ['string', 'max:50'],
        ]);

        $user = $request->user();
        $appointment = Appointment::findOrFail($data['appointment_id']);

        abort_if($appointment->owner_id != $user->id, 403, 'not the owner');

        $appointment->location = $data['location'];
        $appointment->save();
    }


    // join appointment
    public function update(Request $request) {
        $data = $request->validate([
            'appointment_id' => ['required', 'numeric', 'exists:appointments,id']
        ]);

        $user = $request->user();
        $user->appointments()->syncWithoutDetaching([$data['appointment_id']]);
    }

    // leave appointment
    public function destroy(Request $request) {
        $data = $request->validate([
            'appointment_id' => ['required', 'numeric', 'exists:appointments,id']
        ]);

        $user = $request->user();
        $user->appointments()->detach([$data['appointment_id']]);
    }
}
