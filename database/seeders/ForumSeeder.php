<?php

namespace Database\Seeders;

use App\Models\Forum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Forum::insert([
            'id' => 1,
            'type' => 0,
            'name' => 'First forum category',
            'status' => 1,
            'authorId' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Forum::insert([
            'id' => 2,
            'type' => 1,
            'parentId' => 1,
            'name' => 'First forum',
            'status' => 1,
            'authorId' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
