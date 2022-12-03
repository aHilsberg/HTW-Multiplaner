<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
//        User::factory()->createMany([
//            [
//                'name' => 'user1',
//                'email' => 'user1@example.com',
//                'password' => 'testtest'
//            ],
//            [
//                'name' => 'user2',
//                'email' => 'user2@example.com',
//                'password' => 'testtest'
//            ],
//            [
//                'name' => 'user3',
//                'email' => 'user3@example.com',
//                'password' => 'testtest'
//            ]
//        ]);
//
//        User::factory(5);
//
        Artisan::call('load:modulux');
        Artisan::call('load:timetable');
    }
}
