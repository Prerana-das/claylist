<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    //
    public function all_tag(Request $request){
        return Tag::all();
    }
}
