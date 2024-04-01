<?php

namespace Database\Seeders;

use App\Models\TopicRejectType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopicRejectTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TopicRejectType::insert([
            'id' => 1,
            'title' => 'Incorrect design',
            'status' => 1,
            'userId' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
