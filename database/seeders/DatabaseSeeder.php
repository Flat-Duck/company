<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);
        $this->call(PermissionsSeeder::class);

        $this->call(AdministrationSeeder::class);
        $this->call(AttachmentSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(ExtoutboxSeeder::class);
        $this->call(InboxSeeder::class);
        $this->call(IntoutboxSeeder::class);
        $this->call(MainFolderSeeder::class);
        $this->call(MemoSeeder::class);
        $this->call(OfficeSeeder::class);
        $this->call(SubFolderSeeder::class);
        $this->call(UserSeeder::class);
    }
}
