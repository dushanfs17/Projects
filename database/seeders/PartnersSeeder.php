<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PartnersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(){$faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {  
            DB::table('partners')->insert([
                'company_name' => $faker->company(),
                'industry_id' => $faker->numberBetween(1, 50),
                'logo' => $faker->imageUrl(),
                'collaboration_description' => $faker->text(200),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
