<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class TeamMembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(){$faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {  
            DB::table('team_members')->insert([
                'picture' => $faker->imageUrl(),
                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'position_id' => $faker->numberBetween(1, 50),
                'short_profile' => $faker->text(200),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
