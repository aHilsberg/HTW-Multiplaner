<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class UpdateTimetable extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:timetable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update crawled timetable';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
//        ShellCommand::execute(base_path() . "/crawler/crawl.sh");

        // read an update
        $files = Storage::disk('webcrawler')->allFiles();


        foreach ($files as $file) {
            $path = Storage::disk('webcrawler')->path($file);
            $data = json_decode(file_get_contents($path));
        }

        return Command::SUCCESS;
    }
}
