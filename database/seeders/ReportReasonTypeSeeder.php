<?php

namespace Database\Seeders;

use App\Models\ReportReasonType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReportReasonTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ReportReasonType::insert([
            'id' => 1,
            'name' => 'Offense',
            'status' => 1,
            'authorId' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
