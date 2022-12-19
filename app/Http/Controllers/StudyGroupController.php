<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\StudyGroup;
use Illuminate\Http\Request;

class StudyGroupController extends Controller {
    public static function search(Request $request) {
        $search = $request->validate([
            'query.study_group' => ['required', 'string'],
            'query.page_index' => ['required', 'integer'],
            'query.page_count' => ['required', 'integer']
        ])['query'];

        return [
            'studyGroups' => StudyGroup::where('id', 'like', $search['study_group'] . '%')
                ->skip($search['page_index'] * $search['page_count'])
                ->take($search['page_count'])
                ->get(),
            'count' => StudyGroup::where('id', 'like', $search['study_group'] . '%')->count(),
        ];
    }
}
