<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AppointmentController extends Controller
{
    public function index(Request $request){
        // get all appointments of appointable

        return Inertia::render('searchTimetable', [

        ]);
    }


    public function store(Request $request)
    {
        // create new appointment (event / private event)
    }

    public function rename(){
        // update name; room (event / private event)
    }


    public function update(Request $request, Appointment $appointment)
    {
        // join appointment
    }

    public function destroy(Appointment $appointment)
    {
        // leave appointment
    }
}
