<?php

namespace App\Http\Controllers;

use App\Breed;
use Illuminate\Http\Request;

class BreedController extends Controller
{
    public function all_breed(Request $request){
        return Breed::all();
    }

    public function getBreedwithLimit(Request $request){
        return Breed::limit(5)->get();
    }
}
