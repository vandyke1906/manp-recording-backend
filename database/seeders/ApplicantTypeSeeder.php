<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicantTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Cooperative',
            'Corporation',
            'Indigenous People (Individual)',
            'Indigenous People (As an Organization)',
            'Individual',
            'Local Government Unit - Barangay',
            'Local Government Unit - City/Municipality',
            'Local Government Unit - Province',
            'National Government Agency',
            'Peoples Organization',
            'Tenured Migrant',
        ];

        foreach ($types as $type) {
            DB::table('applicant_types')->insert(['name' => $type]);
        }
    }
}
