<?php

use Illuminate\Database\Seeder;

class ActorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Actor::create([
            'name' => 'Mark Hamill'
        ]);

        App\Actor::create([
            'name' => 'Carrie Fisher'
        ]);

        App\Actor::create([
            'name' => 'Harrison Ford'
        ]);

        App\Actor::create([
            'name' => 'Elijah Wood'
        ]);

        App\Actor::create([
            'name' => 'Orlando Bloom & Onion'
        ]);

        App\Actor::create([
            'name' => 'Viggo Mortensen'
        ]);

        App\Actor::create([
            'name' => 'Ian McKellen'
        ]);
    }
}
