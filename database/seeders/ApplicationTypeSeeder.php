<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'PAMB Clearance',
            'Electrification',
        ];

        foreach ($data as $obj) {
            DB::table('application_types')->insert(['name' => $obj]);
        }
    }
}
