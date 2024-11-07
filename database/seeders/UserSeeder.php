<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $chunkSize = 1000;

        for ($i = 0; $i < 1000; $i++) {
            dump($i);
            User::factory()->count($chunkSize)->create();
        }
    }
}
