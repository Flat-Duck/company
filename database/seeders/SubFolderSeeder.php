<?php

namespace Database\Seeders;

use App\Models\SubFolder;
use Illuminate\Database\Seeder;

class SubFolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubFolder::factory()
            ->count(5)
            ->create();
    }
}
