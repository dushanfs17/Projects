<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(){$faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {  
            DB::table('services')->insert([
                'name' => $faker->company(),
                'description' => $faker->text(200),
                'service_category_id' => $faker->numberBetween(1, 50),
                'industry_id' => $faker->numberBetween(1, 50),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
