<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\StudyGroup;
use Illuminate\Http\Request;

class StudyGroupController extends Controller {
    public static function search(Request $request) {
        $search = $request->validate([
            'query.study_group.id' => ['required', 'string'],
            'query.study_group.page_index' => ['required', 'integer'],
            'query.study_group.page_count' => ['required', 'integer']
        ])['query']['study_group'];

        $groupsFiltered = StudyGroup::where('id', 'like', $search['id'] . '%')->orderBy('id');

        return [
            'studyGroups' => (clone $groupsFiltered)
                ->skip($search['page_index'] * $search['page_count'])
                ->take($search['page_count'])
                ->get(),
            'count' => $groupsFiltered->count(),
        ];
    }
}
