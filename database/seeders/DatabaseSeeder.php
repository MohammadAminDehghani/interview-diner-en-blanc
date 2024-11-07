<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

//        $this->call([
//            UserSeeder::class,
//            InvoiceSeeder::class,
//        ]);


        $totalUsers = 1000000;
        $chunkSize = 5000;

        dump('be patient...');

        for ($i = 0; $i < $totalUsers / $chunkSize; $i++) {

            $users = User::factory()->count($chunkSize)->create();

            foreach ($users as $user) {
                $invoiceCount = rand(1, 3);
                Invoice::factory()->count($invoiceCount)->create([
                    'user_id' => $user->id,
                ]);
            }

            dump((($i+1)*100*$chunkSize/$totalUsers).' %');

            unset($users);
        }
    }
}
