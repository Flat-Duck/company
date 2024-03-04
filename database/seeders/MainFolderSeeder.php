<?php

namespace Database\Seeders;

use App\Models\MainFolder;
use Illuminate\Database\Seeder;

class MainFolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MainFolder::factory()
            ->count(5)
            ->create();
    }
}
