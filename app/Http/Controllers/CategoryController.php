<?php

namespace App\Http\Controllers;

use App\Category;
use App\Package;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function all_category(Request $request){
        return Category::all();
    }
    public function all_subcriptions(Request $request){
        return Package::all();
    }

    public function getCategorywithLimit(){
        return Category::limit(5)->get();
    }
    
}
