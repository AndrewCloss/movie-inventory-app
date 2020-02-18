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
}
