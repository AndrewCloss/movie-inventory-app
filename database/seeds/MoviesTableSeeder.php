<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Movie::create([
            'title' => 'A New Hope',
            'release_date' => '1977-05-25',
            'description' => 'A Star Wars Story. Episode 4.',
            'genre_type' => 'scifi'
        ]);

        App\Movie::create([
            'title' => 'The Empire Strikes Back',
            'release_date' => '1980-05-21',
            'description' => 'A Star Wars Story. Episode 5',
            'genre_type' => 'scifi'
        ]);

        App\Movie::create([
            'title' => 'Return of the Jedi',
            'release_date' => '1980-05-25',
            'description' => 'A Star Wars Story. Episode 6',
            'genre_type' => 'scifi'
        ]);
    }
}
