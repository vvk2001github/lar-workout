<?php

namespace Database\Seeders;

use App\Models\Exercise;
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
        // \App\Models\User::factory(10)->create();
        $viktor = new User(['name' => 'Victor', 'email'=>'victor@victor.ru',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => Str::random(10),
            'email_verified_at' => now(),
        ]);
        $nastya = new User(['name' => 'Nastya', 'email'=>'nastya@victor.ru',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => Str::random(10),
            'email_verified_at' => now(),
        ]);
        $viktor->save();
        $nastya->save();

        Exercise::factory()->count(10)->create();
    }
}
