<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'name' => 'Information Technology',
                'description' => 'Software development, system administration, and technical support',
                'is_active' => true
            ],
            [
                'name' => 'Human Resources',
                'description' => 'Employee management, recruitment, and organizational development',
                'is_active' => true
            ],
            [
                'name' => 'Finance & Accounting',
                'description' => 'Financial planning, accounting, and budget management',
                'is_active' => true
            ],
            [
                'name' => 'Marketing & Sales',
                'description' => 'Brand promotion, customer acquisition, and sales management',
                'is_active' => true
            ],
            [
                'name' => 'Operations',
                'description' => 'Daily operations, process management, and quality control',
                'is_active' => true
            ],
            [
                'name' => 'Design & Creative',
                'description' => 'Graphic design, UI/UX, and creative content development',
                'is_active' => true
            ],
            [
                'name' => 'Customer Support',
                'description' => 'Client assistance, complaint resolution, and customer satisfaction',
                'is_active' => true
            ],
            [
                'name' => 'Legal & Compliance',
                'description' => 'Legal affairs, regulatory compliance, and risk management',
                'is_active' => true
            ]
        ];

        foreach ($departments as $department) {
            Department::firstOrCreate(
                ['name' => $department['name']],
                $department
            );
        }
    }
}
