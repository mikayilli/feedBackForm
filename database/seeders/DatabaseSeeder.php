<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "username" => 'admin',
            "password" => bcrypt('123'),
            'name' => "X",
            'email_verified_at' => now(),
            'remember_token' => Str::random(10)
        ]);
    }
}
