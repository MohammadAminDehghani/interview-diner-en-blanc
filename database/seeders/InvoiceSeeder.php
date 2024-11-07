<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $chunkSize = 1000;
        for ($i = 0; $i < 20; $i++) {
            Invoice::factory()->count($chunkSize)->create();
        }
    }
}
