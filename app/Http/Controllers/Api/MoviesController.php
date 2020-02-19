<?php

namespace App\Http\Controllers\Api;

use App\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MovieResource;

class MoviesController extends Controller
{
    public function index()
    {
        return MovieResource::collection(Movie::all());
    }

    public function show(Movie $movie)
    {
        return new MovieResource($movie);
    }

    public function update(Movie $movie, Request $request)
    {
        $data = $request->validate([
            'title'        => 'required',
            'release_date' => 'required',
            'description'   => 'required',
            'genre_type'   => 'required'
        ]);
        $movie->update($data);

        return new MovieResource($movie);
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();

        return response(null, 204);
    }

    public function create(Request $request)
    {
        $data = $request->validate([        
            'title'        => 'required',
            'release_date' => 'required',
            'description'   => 'required',
            'genre_type'   => 'required',
        ]);

        return new MovieResource(Movie::create([
            'title' => $data['title'],
            'release_date' => $data['release_date'],
            'description' => $data['description'],
            'genre_type' => $data['genre_type'],
        ]));
    }
}