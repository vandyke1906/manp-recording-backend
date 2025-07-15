<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Carbon;

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
        $this->insertBasicUsers();
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


    private function insertBasicUsers(){
        DB::table('users')->insert([
            [
                'id' => 1,
                'first_name' => 'Ronie',
                'middle_name' => 'Porras',
                'last_name' => 'Penara',
                'suffix' => 'Jr.',
                'mobile_number' => null,
                'address' => null,
                'telephone_number' => null,
                'email' => 'vandyke1906@gmail.com',
                'password' => '$2y$12$U7DH.1zLmYQ1lT81qQjdzOdLbCU3uviSk/mljIHInfvre55mVgHzy',
                'role' => 1,
                'remember_token' => null,
                'email_verified_at' => Carbon::parse('2025-07-10 00:31'),
                'verification_code' => 'ItWuRV',
                'created_at' => Carbon::parse('2025-07-10 00:30'),
                'updated_at' => Carbon::parse('2025-07-10 00:31'),
            ],
            [
                'id' => 2,
                'first_name' => 'RPS',
                'middle_name' => '',
                'last_name' => 'MANP',
                'suffix' => '',
                'mobile_number' => null,
                'address' => null,
                'telephone_number' => null,
                'email' => 'rps.manp@gmail.com',
                'password' => '$2y$12$U7DH.1zLmYQ1lT81qQjdzOdLbCU3uviSk/mljIHInfvre55mVgHzy',
                'role' => 2,
                'remember_token' => null,
                'email_verified_at' => Carbon::parse('2025-07-10 00:31'),
                'verification_code' => 'ItWuRV',
                'created_at' => Carbon::parse('2025-07-10 00:30'),
                'updated_at' => Carbon::parse('2025-07-10 00:31'),
            ],
            [
                'id' => 3,
                'first_name' => 'Manager',
                'middle_name' => '',
                'last_name' => 'MANP',
                'suffix' => '',
                'mobile_number' => null,
                'address' => null,
                'telephone_number' => null,
                'email' => 'manager.manp@gmail.com',
                'password' => '$2y$12$U7DH.1zLmYQ1lT81qQjdzOdLbCU3uviSk/mljIHInfvre55mVgHzy',
                'role' => 2,
                'remember_token' => null,
                'email_verified_at' => Carbon::parse('2025-07-10 00:31'),
                'verification_code' => 'ItWuRV',
                'created_at' => Carbon::parse('2025-07-10 00:30'),
                'updated_at' => Carbon::parse('2025-07-10 00:31'),
            ],
            [
                'id' => 4,
                'first_name' => 'Administrator',
                'middle_name' => '',
                'last_name' => 'MANP',
                'suffix' => '',
                'mobile_number' => null,
                'address' => null,
                'telephone_number' => null,
                'email' => 'admin.manp@gmail.com',
                'password' => '$2y$12$U7DH.1zLmYQ1lT81qQjdzOdLbCU3uviSk/mljIHInfvre55mVgHzy',
                'role' => 2,
                'remember_token' => null,
                'email_verified_at' => Carbon::parse('2025-07-10 00:31'),
                'verification_code' => 'ItWuRV',
                'created_at' => Carbon::parse('2025-07-10 00:30'),
                'updated_at' => Carbon::parse('2025-07-10 00:31'),
            ],
        ]);
    }
}


//run to: >php artisan db:seed