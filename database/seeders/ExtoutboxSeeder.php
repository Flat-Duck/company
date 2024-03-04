<?php

namespace Database\Seeders;

use App\Models\Extoutbox;
use Illuminate\Database\Seeder;

class ExtoutboxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Extoutbox::factory()
            ->count(5)
            ->create();
    }
}
