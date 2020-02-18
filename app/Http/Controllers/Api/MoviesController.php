<?php

namespace App\Http\Controllers\Api;

use App\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MovieResource;

class MoviesController extends Controller
{
    // public function create($Request request)
    // {
    //     $crud               = new Movies();
    //     $crud->title        = $request->title;
    //     $crud->release_date = $request->release_date;
    //     $crud->decription   = $request->description;
    //     $crud->genre_type   = $request->genre_type;
    //     $crud->save();
    
    //     return response($crud->jsonSerialize(), Response::HTTP_CREATED);
    // }

    public function index()
    {
        return MovieResource::collection(Movie::paginate(10));
    }

    // public function update(Request $request, $id)
    // {
    //     $crud               = Movies::findOrFail($id);
    //     $crud->title        = $request->title;
    //     $crud->release_date = $request->release_date;
    //     $crud->decription   = $request->description;
    //     $crud->genre_type   = $request->genre_type;

    //     return response(null, Response::HTTP_OK);
    // }

    // public function destroy($id)
    // {
    //     Movies::destroy($id);

    //     return response(null, Response::HTTP_OK);
    // }
}