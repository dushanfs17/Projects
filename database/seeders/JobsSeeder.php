<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class JobsSeeder extends Seeder
{

  public function run(){$faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {  // Generate 50 jobs
            DB::table('jobs')->insert([
                'title' => $faker->jobTitle,
                'description' => $faker->text(200),
                'type' => $faker->randomElement(['full-time', 'part-time']),
                'work_mode' => $faker->randomElement(['hybrid', 'on-site']),
                'location' => $faker->city,
                'published_at' => $faker->dateTimeBetween('-1 year', 'now'), // Fake published_at within the past year
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}