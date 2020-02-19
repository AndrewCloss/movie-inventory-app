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
            'title' => 'Star Wars: Episode 4 - A New Hope',
            'release_date' => '1977-05-25',
            'description' => 'After Princess Leia, the leader of the Rebel Alliance, is held hostage by Darth Vader, Luke and Han Solo must free her and destroy the powerful weapon created by the Galactic Empire.',
            'genre_type' => 'scifi'
        ]);

        App\Movie::create([
            'title' => 'Star Wars: Episode 5 - The Empire Strikes Back',
            'release_date' => '1980-05-21',
            'description' => 'Darth Vader is adamant about turning Luke Skywalker to the dark side. Master Yoda trains Luke to become a Jedi Knight while his friends try to fend off the Imperial fleet.',
            'genre_type' => 'scifi'
        ]);

        App\Movie::create([
            'title' => 'Star Wars: Episode 6 - Return of the Jedi',
            'release_date' => '1980-05-25',
            'description' => 'Luke Skywalker attempts to bring his father back to the light side of the Force. At the same time, the rebels hatch a plan to destroy the second Death Star.',
            'genre_type' => 'scifi'
        ]);

        App\Movie::create([
            'title' => 'The Lord of the Rings: The Fellowship of the Ring',
            'release_date' => '2001-12-19',
            'description' => 'A young hobbit, Frodo, who has found the One Ring that belongs to the Dark Lord Sauron, begins his journey with eight companions to Mount Doom, the only place where it can be destroyed.',
            'genre_type' => 'fantasy'
        ]);

        App\Movie::create([
            'title' => 'The Lord of the Rings: The Two Towers',
            'release_date' => '2002-12-18',
            'description' => 'Frodo and Sam arrive in Mordor with the help of Gollum. A number of new allies join their former companions to defend Isengard as Saruman launches an assault on it.',
            'genre_type' => 'fantasy'
        ]);

        App\Movie::create([
            'title' => 'The Lord of the Rings: The Return of the King',
            'release_date' => '2003-12-17',
            'description' => 'The former Fellowship members prepare for the final battle. While Frodo and Sam approach Mount Doom to destroy the One Ring, they follow Gollum unaware of the path he is leading them to.',
            'genre_type' => 'fantasy'
        ]);
    }
}
