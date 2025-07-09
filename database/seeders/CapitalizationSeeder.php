<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CapitalizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $levels = [
            'Less than or equal to ₱100,000.00 (Non-SAPAble)',
            'More than ₱100,000.00 up to Php 400,000.00',
            'More than ₱400,000.00 up to Php 700,000.00',
            'More than ₱700,000.00 up to Php 1,000,000.00',
            'More than ₱1,000,000.00 up to Php 1,500,000.00',
            'More than ₱1,500,000.00 up to Php 2,000,000.00',
            'More than ₱2,000,000.00 up to Php 3,000,000.00',
            'More than ₱3,000,000.00 up to Php 5,000,000.00',
            'More than ₱5,000,000.00 up to Php 10,000,000.00',
            'More than ₱10,000,000.00',
        ];

        foreach ($levels as $label) {
            DB::table('capitalizations')->insert([
                'name' => $label
            ]);
        }
    }
}
