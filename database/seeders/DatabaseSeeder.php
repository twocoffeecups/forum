<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\PermissionFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

//         \App\Models\User::factory()->create([
//             'name' => 'Admin',
//             'login' => 'admin',
//             'email' => 'admin@mail.com',
//             'password' => Hash::make('12345678'),
//         ]);
        $this->call([
            SettingSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            RolePermissionSeeder::class,
            UserSeeder::class,
            ForumSeeder::class,
            TagSeeder::class,
            TopicRejectTypeSeeder::class,
            ReportReasonTypeSeeder::class,
            TopicSeeder::class,
            PostSeeder::class,
        ]);
    }
}
