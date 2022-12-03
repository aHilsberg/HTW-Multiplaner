<?php

namespace App\Console\Commands;

use App\Enums\ModuleContent;
use App\Models\Module;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Command\Command as CommandAlias;

class UpdateModulux extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:modulux';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update modulux entries from crawled data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        // read an update
        $files = Storage::disk('webcrawler')->allFiles('modulux');


        foreach ($files as $file) {
            $path = Storage::disk('webcrawler')->path($file);
            $data = json_decode(file_get_contents($path));

            $entryData = [
                'id' => rtrim(ltrim($data->id, '(['), '])'),
                'faculty' => $data->faculty,
                'level' => $data->level,
                'semester_count' => $data->semesterCount,
                'modulux_url' => $data->modulux,
                'opal_url' => empty($data->opal) ? null : $data->opal
            ];

//            error_log(json_encode($entryData));

            if(Module::where('id', $entryData['id'])->exists()){
                error_log('duplucate module: ' . $entryData['id']);
                continue;
            }
            if(gettype($entryData['id']) == 'string' && str_starts_with($entryData['id'], 'MAK')){
                error_log('MAK!');
                continue;
            }

            $module = Module::create($entryData);

            $module->createTextContents(UpdateModulux::getTextContents($data->name), ModuleContent::Name);
            $module->createTextContents(UpdateModulux::getTextContents($data->languages), ModuleContent::Languages);
            $module->createTextContents(UpdateModulux::getTextContents($data->superviser), ModuleContent::Supervisors);
            $module->createTextContents(UpdateModulux::getTextContents($data->lecturer), ModuleContent::Lecturers);
            $module->createTextContents(UpdateModulux::getTextContents($data->events), ModuleContent::Events);
            $module->createTextContents(UpdateModulux::getTextContents($data->workload), ModuleContent::Workload);
            $module->createTextContents(UpdateModulux::getTextContents($data->credits), ModuleContent::Credits);
            $module->createTextContents(UpdateModulux::getTextContents($data->preExaminationWork), ModuleContent::PreExaminationWork);
            $module->createTextContents(UpdateModulux::getTextContents($data->examinationWork), ModuleContent::ExaminationWork);
            $module->createTextContents(UpdateModulux::getTextContents($data->content), ModuleContent::Content);
            $module->createTextContents(UpdateModulux::getTextContents($data->skills), ModuleContent::Skills);
            $module->createTextContents(UpdateModulux::getTextContents($data->requirementsNeeded), ModuleContent::Requirements);
            $module->createTextContents(UpdateModulux::getTextContents($data->requirementsOptional), ModuleContent::OptionalRequirements);
        }

        return CommandAlias::SUCCESS;
    }

    /**
     * @throws \Exception
     */
    private static function getTextContents($jsonElement): array {
        switch (gettype($jsonElement)) {
            case 'object':
                return [
                    [
                        'primary' => $jsonElement->label,
                        'secondary' => $jsonElement->details
                    ]
                ];
            case 'array':
                return array_map(function ($element) {
                    return [
                        'primary' => $element->label,
                        'secondary' => $element->details
                    ];
                }, $jsonElement);
            case 'string':
                if($jsonElement == 'Keine' || $jsonElement == 'Keine Angabe') return [];
                return [
                    [
                        'primary' => $jsonElement,
                    ]
                ];
            default:
                throw new \Exception('unexpected json element');
        }
    }
}
