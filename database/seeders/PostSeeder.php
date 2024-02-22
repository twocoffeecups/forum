<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::insert([
            'id' => 1,
            'topicId' => 1,
            'message' => 'Lorem ipsum dolor sit amet.',
            'userId' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
