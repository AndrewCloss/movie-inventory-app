<?php

namespace App\Http\Controllers\Api;

use App\Actor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ActorResource;

class ActorsController extends Controller
{
    public function index()
    {
        return ActorResource::collection(Actor::paginate(5));
    }

    public function show(Actor $actor)
    {
        return new ActorResource($actor);
    }

    public function update(Actor $actor, Request $request)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);
        $actor->update($data);

        return new ActorResource($actor);
    }

    public function destroy(Actor $actor)
    {
        $actor->delete();

        return response(null, 204);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);

        return new ActorResource(Actor::create([
            'name' => $data['name']
        ]));
    }
}
