<?php

namespace Database\Seeders;

use App\Models\Related;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RelatedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for($i = 1; $i <= 5; $i++){
            Related::create([
                'name' => $faker->name(),
                'url' => $faker->url(),
            ]);
        }
    }
}
