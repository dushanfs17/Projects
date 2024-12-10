<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ServiceCategoriesSeeder extends Seeder

{
    /**
     * Run the database seeds.
     */
    public function run(){$faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {  
            DB::table('service_categories')->insert([
                'name' => $faker->randomElement(['Web Development', 'Mobile App Development', 'UI/UX Design', 'Digital Marketing', 'Cybersecurity', 'IT Consulting', 'Cloud Services', 'Data Analytics', 'Artificial Intelligence', 'Internet of Things']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
