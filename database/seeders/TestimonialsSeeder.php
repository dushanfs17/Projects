<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class TestimonialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(){$faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {  
            DB::table('testimonials')->insert([



                'testimonial_text' => $faker->text(200),
                'client_name' => $faker->firstName,
                'client_position' => $faker->randomElement(['Founder', 'CEO', 'CTO', 'CFO', 'Marketing Manager', 'Sales Manager', 'Product Manager', 'Software Engineer', 'Designer', 'QA Engineer']),
                'client_company' => $faker->company,
                'client_profile_picture' => $faker->imageUrl(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
