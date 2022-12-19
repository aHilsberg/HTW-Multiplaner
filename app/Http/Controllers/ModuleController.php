<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller {
    public static function search(Request $request) {
        $search = $request->validate([
            'query.module.faculty' => ['string'],
            'query.module.id' => ['string', 'max:9'],
            'query.module.lecturer' => ['string'],
            'query.module.page_index' => ['required', 'integer'],
            'query.module.page_count' => ['required', 'integer']
        ])['query'];

        $modulesFiltered = Module::orderBy('id');

        if ($search['faculty']) {
            $modulesFiltered = $modulesFiltered->where('faculty', $search['faculty']);
        }
        if ($search['id']) {
            $modulesFiltered = $modulesFiltered->where('id', 'like', '%' . $search['id'] . '%');
        }
        if ($search['lecturer']) {
            $modulesFiltered = $modulesFiltered->whereHas('lecturers', function ($query) use ($search) {
                $query->where('primary', 'like', '%' . $search . '%');
            });
        }

        return [
            'modules' => (clone $modulesFiltered)
                ->skip($search['page_index'] * $search['page_count'])
                ->take($search['page_count'])
                ->get(),
            'count' => $modulesFiltered->count(),
        ];
    }
}
