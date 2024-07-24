<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('students')->insert([
                'name' => $faker->name,
                'age' => $faker->numberBetween(18, 30),
                'residence' => $faker->streetAddress(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
