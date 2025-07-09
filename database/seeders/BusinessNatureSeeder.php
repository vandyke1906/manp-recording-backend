<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessNatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Boarding House',
            'Commercial Building (Agri-Veterinary Supply, Fertilizers, Pesticides)',
            'Commercial Building (Hardware and Construction Materials)',
            'Commercial Building (Packing Facility for Banana, Bodega)',
            'Commercial Building (Pawnshop, Money Transfer, Lending, Micro-finance, Banking)',
            'Commercial Building (Space for Rent)',
            'Commercial Building (Retail and General Merchandise, Pharmacy)',
            'Cooperative',
            'Communication Facility (Communication Tower)',
            'Food and Beverage (Restaurant, Eatery, Coffee Shop, etc.)',
            'Government Infrastructure (Government Buildings, Gym, School, Road, Utilities, etc)',
            'Large Scale Agriculture: Banana Plantation',
            'Large Scale Agriculture: High Value Crops',
            'Large Scale Aquaculture: Fish Pond',
            'Power Transmission/ Distribution',
            'Private Clinic/ Hospital',
            'Private Rest House/ Villa/ Guesthouse/ Holiday Home',
            'Renewable Energy Project (Geothermal, Hydropower, Wind, Solar, etc.)',
            'Resort/ Recreational Facility/ Ecotourism Project',
            'Standard Accommodation: Inn/ Hotel/ Hostel',
            'Transportation Facility',
            'Water Refilling Station',
            'Water Supply and Distribution Services',
            'Special Events',
            'PAMB Clearance',
            'Electrification',
        ];

        foreach ($data as $obj) {
            DB::table('business_natures')->insert(['name' => $obj]);
        }
    }
}
