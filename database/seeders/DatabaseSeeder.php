<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Import your seeder classes
use Database\Seeders\ApplicantTypeSeeder;
use Database\Seeders\ApplicationTypeSeeder;
use Database\Seeders\BusinessNatureSeeder;
use Database\Seeders\BusinessStatusSeeder;
use Database\Seeders\CapitalizationSeeder;
use Database\Seeders\ZoningSeeder;

use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

         $this->call([
            ApplicantTypeSeeder::class,
            ApplicationTypeSeeder::class,
            BusinessNatureSeeder::class,
            BusinessStatusSeeder::class,
            CapitalizationSeeder::class,
            ZoningSeeder::class,
            // add any others here
        ]);
    }
}


//run to: >php artisan db:seed