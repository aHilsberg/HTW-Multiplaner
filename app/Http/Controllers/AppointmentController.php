<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AppointmentController extends Controller {

    // get all appointments of appointable
    public function index(Request $request) {

        return Inertia::render('searchTimetable', [

        ]);
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
