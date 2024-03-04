<?php

namespace Database\Seeders;

use App\Models\Intoutbox;
use Illuminate\Database\Seeder;

class IntoutboxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Intoutbox::factory()
            ->count(5)
            ->create();
    }
}
