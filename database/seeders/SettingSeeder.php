<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Settings::insert([
            [
                'id' => 1,
                'variable' => 'forumName',
                'data' => json_encode([
                    "value" => "Forum",
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'variable' => 'meta',
                'data' => json_encode([
                    "keywords" => "Forum, It",
                    "description" => "Forum meta description",
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'variable' => 'showOnlyLogo',
                'data' => json_encode([
                    "value" => false,
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'variable' => 'topicsOnPage',
                'data' => json_encode([
                    "value" => 10,
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'variable' => 'postsOnPage',
                'data' => json_encode([
                    "value" => 10,
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'variable' => 'logo',
                'data' => json_encode([
                    "value" => "default",
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'variable' => 'background',
                'data' => json_encode([
                    "value" => "default",
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
