<?php

namespace Database\Seeders;

use App\Models\Inbox;
use Illuminate\Database\Seeder;

class InboxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Inbox::factory()
            ->count(5)
            ->create();
    }
}
