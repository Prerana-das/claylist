<?php

namespace App\Http\Controllers;

use App\Report;
use App\Comment;
use App\Product;
use App\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller 
{
    //

    public function report(Request $request){
        $data = $request->all();
        // \Log::info($data);
        return Report::create($data);
    }

    public function post_comment(Request $request){
        $data = $request->all();
        $commentData =Comment::create($data);
        return Comment::with('user')->orderBy('id','desc')->first();
    }

    public function single_ads(Request $request){
        $product_id = $request->product_id;
        $user_id = 0;
        if(Auth::check()){
            $user_id = Auth::user()->id;
        }
        return Product::with('category','allImages','wishlist')->with(['wishlist' => function($query) use ($user_id){$query->where('user_id',$user_id);}])->where('id',$product_id)->get();
    }

    public function get_comment(Request $request){
        $product_id = $request->product_id;
        return Comment::with('user')->where('product_id',$product_id)->get();
    }

    public function count_total_view(Request $request){
        return Wishlist::where('product_id',$request->product_id)->count();
    }
}
