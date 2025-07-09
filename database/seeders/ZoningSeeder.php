<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZoningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $zones = [
            'Strict Protection Zone',
            'Sustainable Use Zone',
            'Rehabilitation Zone',
            'Multiple Use Zone (MUZ)',
            'Buffer Zone',
            'Ecotourism Zone',
        ];

        foreach ($zones as $zone) {
            DB::table('zonings')->insert([
                'name' => $zone,
            ]);
        }
    }
}
