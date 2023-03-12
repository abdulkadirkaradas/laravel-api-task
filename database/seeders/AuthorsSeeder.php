<?php

namespace Database\Seeders;

use App\Models\Authors;
use \Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class AuthorsSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        foreach(range(1, 30) as $index)
        {
            $author = new Authors;
            $author->name = $faker->firstName();
            $author->lastname = $faker->lastName();
            $author->save();
        }
    }
}
