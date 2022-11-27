<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function search(Request $request){
        // get search results; json

        $search = $request->validate([
            //TODO
        ]);


        return response()->json(Module::all());
    }
}
