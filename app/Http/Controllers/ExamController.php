<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function search(Request $request){
        // get search results; json

        $search = $request->validate([
            //TODO
        ]);


        return response()->json(Exam::all());
    }
}
