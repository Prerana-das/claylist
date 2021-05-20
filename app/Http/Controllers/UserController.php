<?php

namespace App\Http\Controllers;
use App\User;
use Validator;
use App\Product;
use App\EmailOpt;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class Usercontroller extends Controller
{

    public function registration(Request $request){

        $this->validate($request,
            [
                'name'=>'required|string|max:50',
                'username'=>'required|string|max:50|unique:users',
                'phone'=>'required|string|max:50',
                'address'=>'required|string|max:50',
                'state'=>'required|string|max:50',
                'city'=>'required|string|max:50',
                'zip_code'=>'required|string|max:50',
                'email'=>'required|string|max:50|email|unique:users',
                'password'=>'required|string|min:6',
            ]
        ); 

        $data = $request->all();

        $data['password']=Hash::make($data['password']);
        $usertoken = rand(100000,999999);
        $token['token'] = Hash::make($usertoken);
        $data['email_verification'] = $token['token'];
        $userCreate = User::create($data);
        $url = env('APP_URL');
        $msg['url'] = $url.'/verification?verify='.$token['token']; 
        $from_address = env('MAIL_FROM_ADDRESS');
        if($userCreate)
        {
           $mail =  Mail::send('email/verification', $msg, function ($message ) use ($request,$from_address) {
                $message->from($from_address, 'Verify Account');
                $message->to($request->email)->subject('Account Verification');
            });

            return $userCreate;
           
        }

        return $userCreate;

    }

    public function resend_email(Request $request){
        $usertoken = rand(100000,999999);
        $token['token'] = Hash::make($usertoken);
        User::where('email',$request->email)->update([
            'email_verification'=>$token['token']
        ]);
        $url = env('APP_URL');
        $msg['url'] = $url.'/verification?verify='.$token['token']; 
        $from_address = env('MAIL_FROM_ADDRESS');
        $mail =  Mail::send('email/verification', $msg, function ($message ) use ($request,$from_address){
            $message->from($from_address, 'Verify Account');
            $message->to($request->email)->subject('Account Verification');
        });
        
    }

    public function login(Request $request){

        if((User::where('email',$request->email)->count())==0){
            return response()->json([
                'msg'=>"Email doesn't exist!",
            ],422);
        }
        if((User::where('email',$request->email)->where('isActive',1)->count())==0){
            $usertoken = rand(100000,999999);
            $token['token'] = Hash::make($usertoken);
            User::where('email',$request->email)->update(['email_verification' => $token['token']]);
            $url = env('APP_URL');
            $msg['url'] = $url.'/verification?verify='.$token['token']; 
            $from_address = env('MAIL_FROM_ADDRESS');
            $mail =  Mail::send('email/verification', $msg, function ($message ) use ($request,$from_address) {
                $message->from($from_address, 'Verify Account');
                $message->to($request->email)->subject('Account Verification');
            });
            return response()->json([
                'msg'=>"Please activate your account!",
            ],421);
        }
        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            $user = Auth::user();
            return $user;
        }
        else{
           return response()->json([
               'msg' => "Password doen't match!",
           ],422);
        }
    }

    public function all_user_pagi(){
        return User::all();
    }

   public function edit_user(Request $request){
        $data = $request->all();
        User::where('id',$data['id'])->update($data);
        return User::where('id',$data['id'])->first();
    }

    public function verification_view(Request $request){
        $key = $request->verify;
        $user = User::where('email_verification', $key)->update(['isActive' => 1]);
        if($user){
            return redirect("/login")->with('error_message',"Verify!");
        }
        return redirect("/register")->with('error_message',"You have some error with your email!");   
    }


    public function passwordToken(Request $request){
        // \Log::info($request->email);
        $isFound = User::where('email',$request->email)->count();
        if($isFound==0){
            return response()->json([
                'msg'=>"Email doesn't match!!",
            ],421);
        }
            $token=rand(100000,999999);
            $email = $request->email;
            \DB::table('password_resets')->where('email',$request->email)->delete();
            $savedData = \DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token, //change 60 to any length you want
                // 'created_at' => \Carbon\Carbon::now()
            ]);

            $from_address = env('MAIL_FROM_ADDRESS');
            $data['token'] = $token; 
            // return $token;
            \Mail::send('email/token', $data, function ($message ) use ($email,$from_address) {
                $message->from($from_address,'Verification Code');
                $message->to($email)->subject('Password reset code');
            });
            // return redirect()->route('reset_password');

            return response()->json([
                'email' => $request->email]
            ,200);
    }

    public function PasswordReset(Request $request){
        \Log::info($request->email);
        $token = $request->token;
        $isTokenFound = \DB::table('password_resets')->where('token',$token)->first();
        if(!$isTokenFound){
            return response()->json([
                'msg'=>"Token doesn't match!!",
            ],421);
        }
        $flag = User::where("email",$request->email)->update(['password' => Hash::make($request->newPassword)]);
        if(!$flag){
            return response()->json([
                'msg'=>"Email doesn't match!!",
            ],421);
        }
        \DB::table('password_resets')->where('email',$request->email)->delete();
        return;
    }

    public function submit_subscription(Request $request){
        $this->validate($request, [
            'email'=>'required|string|max:50|email|unique:users',
        ]);
        $data = $request->all();
        return EmailOpt::create($data);
    }

    public function submit_subscription2(Request $request){
        $validator = Validator::make($request->all(),
        [
            'email'=>'required|string|max:255|email|unique:users',
        ]);

        if ($validator->fails()){
            return Redirect::back()->withErrors($validator);
        }

        $data = $request->all();
        EmailOpt::create($data);
        return redirect()->back();
    }
    public function test(Request $request){
        // $url = env('APP_URL');
        $date =  Carbon::now();
        $product = Product::select('id','activated_at',DB::raw("(activated_at + INTERVAL `validity` DAY) as `expired_at`"))->where('isFeatured',1)->get(); 
        $expired_ids=[];
        foreach ($product as  $value) {
            if($value->expired_at < $date->toDateTimeString() ){
                array_push($expired_ids,$value->id);
            }
        }
        Product::whereIn('id',$expired_ids)->update(['isFeatured'=>0]); 
        return $product;
    }
    public function checkExpiredDate(Request $request){
        // $url = env('APP_URL');
        $date =  Carbon::now();
        $product = Product::select('id','activated_at',DB::raw("(activated_at + INTERVAL `validity` DAY) as `expired_at`"))->where('isFeatured',1)->get(); 
        $expired_ids=[];
        foreach ($product as  $value) {
            if($value->activated_at !=null && $value->expired_at < $date->toDateTimeString() ){
                array_push($expired_ids,$value->id);
            }
        }
        Product::whereIn('id',$expired_ids)->update(['isFeatured'=>0]); 
        return $product;
    }

    public function get_user(Request $request){
        $user_id=$request->user_id;
        return User::where('id',$user_id)->first();
    }

    public function get_approved_listing(Request $request){
        $total = $request->total;
        $user_id = $request->user_id;
        $data = Product::with('category','allImages','breed')
                ->where('status','Approved')
                ->where('user_id',$user_id)
                ->orderBy('id','desc');
        return $data->paginate($total);
    }

    public function privacyChange(Request $request){
       return User::where('id',$request->id)->update([
               'email_isTrue'=>$request->privacyData,
               'phone_isTrue'=>$request->privacyData2,
               ]); 
    }

    

}
