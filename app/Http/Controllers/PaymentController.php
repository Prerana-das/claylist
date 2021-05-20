<?php

namespace App\Http\Controllers;

use App\User;
use App\Package;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class PaymentController extends Controller
{
    public function getPaymentpage ($id){ 
        // \Log::info($id);
        $product = Product::with('package')->where('id',$id)->first(); 
        return view('payment')->with(['product'=>$product]);  
    }
    public function getchangePaymentpage (Request $request,$id){ 
        // \Log::info($id);
        $total = $request->total;
        $product = Product::with('package')->where('id',$id)->first();
       
        return view('change_plan')->with(['product'=>$product]);  
    }
    public function single_charge(Request $request){
        $data = $request->all();
        $paymentMethod = $data['paymentMethod'];
        if(!Auth::check()){
            return response()->json([
             'message' => 'Please Log in'
            ],422);
        }
         
        $user = Auth::user();
        $product = Product::where('id',$data['product_id'])->with('package')->first();
        $socialPackage = Package::where('id',2)->first();

        $price = $product->package->price;
        if($product->isSocialShare ==1) $price = $price + $socialPackage->price;

        $price = $price * 100;
        try {
            $stripeCharge = $user->charge($price, $paymentMethod);
            $updateData['isActive'] = 1;
            $updateData['due'] = 0;
            $updateData['PaymentStatus'] = 'Paid';
            if($product->status == 'Approved'){
                $date =  Carbon::now();
                
                $updateData['activated_at'] = $date->toDateTimeString();
            } 
            Product::where('id',$data['product_id'])->update($updateData);
        } catch (Exception $e) {
            return response()->json([
                'success' => false, 
                'msg' => 'Your account has been charged successfully and membership has been extended!'
            ],500);
        }
        

        return response()->json([
            'stripeCharge' => $stripeCharge,
            'success' => true, 
            'msg' => 'Your account has been charged successfully and membership has been extended!'
        ],200);
    }
    public function single_change_charge(Request $request){
        $data = $request->all();
        $paymentMethod = $data['paymentMethod'];
        if(!Auth::check()){
            return response()->json([
             'message' => 'Please Log in'
            ],422);
        }
         
        $user = Auth::user();
        $product = Product::where('id',$data['product_id'])->first();
        

        
         $price = $product->due;

        $price = $price * 100;
        try {
            $stripeCharge = $user->charge($price, $paymentMethod);
            $updateData['isActive'] = 1;
            $updateData['due'] = 0;
            $updateData['PaymentStatus'] = 'Paid';
            $date =  Carbon::now();
            $updateData['activated_at'] = $date->toDateTimeString();
            
            Product::where('id',$data['product_id'])->update($updateData);
        } catch (Exception $e) {
            return response()->json([
                'success' => false, 
                'msg' => 'Your account has been charged successfully and membership has been extended!'
            ],500);
        }
        

        return response()->json([
            'stripeCharge' => $stripeCharge,
            'success' => true, 
            'msg' => 'Your account has been charged successfully and membership has been extended!'
        ],200);
    }
    // public function createSubscription(Request $request){
    //     $data = $request->all();
    //     if(!User::checkToken($request)){
    //         return response()->json([
    //          'message' => 'Please Log in'
    //         ],422);
    //     }
         
    //     $user = JWTAuth::parseToken()->authenticate();
    //     $paymentMethod = $request->paymentMethodId;

    //     $flag = $user->newSubscription('main', 'default-plan')->create($paymentMethod);

    //     return response()->json([
    //         'Subscription' => $flag,
    //         'success' => true, 
    //         'msg' => 'Your account has been charged successfully and membership has been extended!'
    //     ],200);
    // }
    
    // public function cancelSubscription(Request $request){
    //     $data = $request->all();
    //     if(!User::checkToken($request)){
    //         return response()->json([
    //          'message' => 'Please Log in'
    //         ],422);
    //     }
         
    //     $user = JWTAuth::parseToken()->authenticate();
    //    // $paymentMethod = 'pm_1G2Z9jA5T5yPnJ5M9798t9Ei';
    //     $flag  = $user->subscription('main')->cancel();

    //     return response()->json([
    //         'Subscription' => $flag,
    //         'success' => true
    //     ],200);
    // }
    // public function getSubscriptionNotification(Request $request){
    //     $data = $request->all();
       
    //      \Log::info('notification data');
    //      \Log::info($data);

    //     return response()->json([ 
    //         'Subscription' => $data,
    //         'success' => true
    //     ],200);
    // }
}
