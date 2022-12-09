<?php

namespace App\Http\Controllers;

use App\Models\PrivateEvent;
use Illuminate\Http\Request;

class PrivateEventController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PrivateEvent  $privateEvent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PrivateEvent $privateEvent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PrivateEvent  $privateEvent
     * @return \Illuminate\Http\Response
     */
    public function destroy(PrivateEvent $privateEvent)
    {
        //
    }
}
