<?php

namespace App\Http\Middleware;

use App\Http\Controllers\StudyGroupController;
use App\Models\Appointment;
use App\Models\Friendship;
use App\Models\StudyGroup;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;
use function PHPUnit\Framework\isEmpty;

class HandleInertiaRequests extends Middleware {
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    public function version(Request $request) {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed[]
     */
    public function share(Request $request) {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user() ? $request->user()->only('id', 'email', 'name') : null,
            ],
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'flash' => [
                'message' => $request->session()->get('message')
            ],
            'data' => ($request->user() ? [
                'relationships' => [
                    'friends' => Friendship::allFriends($request->user()),
                    'groups' => $request->user()->groups()->with('members:id,name')->get(),
                    'events' => $request->user()->events()->with('members:id,name')->get(),
                ],
                'timetable' => [
                    'appointments' => $request->user()->appointments()
                ]
            ] : []),
            'query' => function () use ($request) {
                $query = $request->query('query');
                if (!$query)
                    return [];

                if (array_key_exists('study_group', $query)) {
                    return [
                        'studyGroup' => StudyGroupController::search($request)
                    ];
                }
                return [];
            }
        ]);
    }
}
