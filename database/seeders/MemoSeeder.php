<?php

namespace Database\Seeders;

use App\Models\Memo;
use Illuminate\Database\Seeder;

class MemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Memo::factory()
            ->count(5)
            ->create();
    }
}
