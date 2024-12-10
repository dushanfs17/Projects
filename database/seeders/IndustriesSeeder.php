<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class IndustriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(){$faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {  
            DB::table('industries')->insert([
                
                'name' => $faker->randomElement(['Agriculture', 'Automotive', 'Banking', 'Chemicals', 'Construction', 'Education', 'Energy', 'Entertainment', 'Finance', 'Food', 'Healthcare', 'Hospitality', 'Manufacturing', 'Media', 'Mining', 'Non-profit', 'Pharmaceuticals', 'Real estate', 'Retail', 'Technology', 'Telecommunications', 'Transportation', 'Utilities']),
                'description' => $faker->text(200),
                'icon' => $faker->imageUrl(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
