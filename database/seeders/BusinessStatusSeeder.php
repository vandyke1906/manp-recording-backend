<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Not yet started/ No activity at present',
            'Ongoing construction',
            'Construction completed but not yet operational',
            'Construction completed and operational',
        ];

        foreach ($data as $obj) {
            DB::table('business_statuses')->insert(['name' => $obj]);
        }
    }
}
