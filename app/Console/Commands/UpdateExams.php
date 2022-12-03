<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateExams extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:exams';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update exam entries from crawled data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {



        return Command::SUCCESS;
    }
}
