<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grades = [
            [
                'name' => 'A',
                'level' => 'X',
                'specialization' => null,
                'class_code' => 'X-A',
                'capacity' => 32,
                'is_active' => true,
                'description' => 'Grade X - Class A for general mathematics'
            ],
            [
                'name' => 'B',
                'level' => 'X',
                'specialization' => null,
                'class_code' => 'X-B',
                'capacity' => 30,
                'is_active' => true,
                'description' => 'Grade X - Class B for general mathematics'
            ],
            [
                'name' => 'IPA-1',
                'level' => 'XI',
                'specialization' => 'IPA',
                'class_code' => 'XI-IPA-1',
                'capacity' => 28,
                'is_active' => true,
                'description' => 'Grade XI IPA - Class 1 for advanced mathematics and sciences'
            ],
            [
                'name' => 'IPA-2',
                'level' => 'XI',
                'specialization' => 'IPA',
                'class_code' => 'XI-IPA-2',
                'capacity' => 30,
                'is_active' => true,
                'description' => 'Grade XI IPA - Class 2 for advanced mathematics and sciences'
            ],
            [
                'name' => 'IPS-1',
                'level' => 'XI',
                'specialization' => 'IPS',
                'class_code' => 'XI-IPS-1',
                'capacity' => 25,
                'is_active' => true,
                'description' => 'Grade XI IPS - Class 1 for social sciences'
            ],
            [
                'name' => 'IPA-1',
                'level' => 'XII',
                'specialization' => 'IPA',
                'class_code' => 'XII-IPA-1',
                'capacity' => 30,
                'is_active' => true,
                'description' => 'Grade XII IPA - Class 1 for final year sciences'
            ]
        ];

        foreach ($grades as $grade) {
            Grade::create($grade);
        }
    }
}
