<?php

namespace App\Console\Commands;

use App\Enums\AppointmentInfo;
use App\Enums\RecurrenceState;
use App\Enums\Weekday;
use App\Models\Appointment;
use App\Models\Module;
use App\Models\StudyGroup;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class UpdateTimetable extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:timetable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update timetable entries from crawled data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        // read an update
        $files = Storage::disk('webcrawler')->allFiles('timetable');

        foreach ($files as $file) {
            $path = Storage::disk('webcrawler')->path($file);
            $data = json_decode(file_get_contents($path));

            foreach ($data as $timeRange => $appointmentList) {
                $startTime = substr($timeRange, 0, 5);
                $endTime = substr($timeRange, 8, 5);
                $weekday = Weekday::convert(substr($timeRange, 14));

                $originDate = Carbon::now()->setISODate(2000, 1, $weekday->value);

                foreach ($appointmentList as $appointment) {
                    $moduleIds = [];
                    {
                        $idText = $appointment->module_id;
                        $moduleIds = explode('/', $idText);
                        foreach ($moduleIds as $key => $moduleId) {
                            $iSubCourse = strpos($moduleId, '-');
                            if ($iSubCourse !== false)
                                $moduleId = $moduleIds[$key] = substr($moduleId, 0, $iSubCourse);
                            $iSubclass = strpos($moduleId, '_');
                            if ($iSubclass !== false)
                                $moduleIds[$key] = substr($moduleId, $iSubclass + 1);
                        }
                    }

                    $type = (property_exists($appointment, 'module_type') ? match ($appointment->module_type) {
                        'Übung' => AppointmentInfo::Exercise,
                        'Vorlesung' => AppointmentInfo::Lecture,
                        'Praktikum' => AppointmentInfo::Practical,
                        default => AppointmentInfo::None
                    } : AppointmentInfo::None)->value;
                    $online = $appointment->online ? AppointmentInfo::Online->value : 0;
                    $recurrence = match ($appointment->turnus) {
                        'Ungerade Woche' => RecurrenceState::Biweekly,
                        'wöchentlich' => RecurrenceState::Weekly,
                    };
                    $studyGroups = explode(', ', rtrim($appointment->study_groups, '×'));


                    $moduleIds = array_filter($moduleIds, function ($moduleId) {
                        if (strlen($moduleId) < 3) return false;

                        $exists = Module::where('id', $moduleId)->exists();
                        if (!$exists)
                            error_log($moduleId . " doesn't exist");
                        return $exists;
                    });
                    foreach ($moduleIds as $moduleId) {
                        $appointment = Appointment::create([
                            'origin_date' => $originDate,
                            'start_time' => $startTime,
                            'end_time' => $endTime,
                            'recurrence' => $recurrence,
                            'location' => $appointment->room,
                            'details' => property_exists($appointment, 'lecturer') ? $appointment->lecturer : null,
                            'info' => $type | $online,
                        ]);
                        $appointment->appointable()->save(Module::findOrFail($moduleId));


                        $studyGroups = array_filter($studyGroups, function ($studyGroup) {
                            return $studyGroup != 'International Track';
                        });
                        foreach ($studyGroups as $studyGroup) {

                            StudyGroup::firstOrCreate([
                                'id' => $studyGroup
                            ]);
                        }
                        $appointment->studyGroups()->sync($studyGroups);
                    }
                }
            }
        }

        return Command::SUCCESS;
    }
}
