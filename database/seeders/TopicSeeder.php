<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Topic::insert([
            'id' => 1,
            'title' => 'You first topic',
            'forumId' => 2,
            'userId' => 1,
            'content' => 'Lorem ipsum dolor sit amet.
                              Ad facilis quidem sit incidunt quod rem quasi asperiores qui distinctio atque in quas alias.
                              Et earum nihil sit blanditiis illum ut dignissimos aliquam eum
                              provident ratione sit earum dicta sed dolor ratione ex amet nihil!',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
