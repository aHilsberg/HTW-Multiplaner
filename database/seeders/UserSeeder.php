<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        User::create([
            'name' => 'User 1',
            'password' => Hash::make('testtest'),
            'email' => 'test1@test.com'
        ]);
        User::create([
            'name' => 'User 2',
            'password' => Hash::make('testtest'),
            'email' => 'test2@test.com'
        ]);
        User::create([
            'name' => 'User 3',
            'password' => Hash::make('testtest'),
            'email' => 'test3@test.com'
        ]);
        User::create([
            'name' => 'User 4',
            'password' => Hash::make('testtest'),
            'email' => 'test4@test.com'
        ]);
    }
}
