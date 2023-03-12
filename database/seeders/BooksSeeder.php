<?php

namespace Database\Seeders;

use App\Models\Authors;
use App\Models\Books;
use \Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class BooksSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $authorIds = Authors::pluck("id");

        foreach(range(1, 30) as $index)
        {
            $book = new Books();
            $book->name = $faker->word();
            $book->description = $faker->paragraph();
            $book->publishing_date = $faker->date();
            $book->author_id = $faker->randomElement($authorIds);
            $book->save();
        }
    }
}
