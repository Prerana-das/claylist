<?php

namespace App\Http\Controllers;

use App\Wishlist;
use App\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    //
    public function add_wishlists(Request $request){
        $data = $request->all();
        //  \Log::info($data);

        if($data){
            $updateData = Wishlist::where('product_id', $request->product_id)
                ->where('user_id', $request->user_id)
                ->update([
                'isTrue'=>$request->isTrue
            ]);

            if($updateData){
                return;
                // return Product::with('category','allImages','wishlist')->where('id',$request->product_id)->orderBy('id','desc');
            }
            else{
                return Wishlist::create([
                    'user_id'=>$request->user_id,
                    'product_id'=>$request->product_id,
                    'isTrue'=>1,
                ]);
            }
        } 
    }

}
