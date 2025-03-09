<?php

namespace App\Http\Controllers;

use App\Models\Flim_Actor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FlimActorController extends Controller
{
    public function index(){
        $perPage = 50;
        $query = Flim_Actor::with("actor");

        $flim_actor = $query->paginate($perPage);
        Log::info($flim_actor);
        return view("Flim_Actor", compact("flim_actor"));
    }
}
