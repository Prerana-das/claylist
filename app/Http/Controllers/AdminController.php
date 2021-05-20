<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Role;
use App\User;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    
    public function index(Request $request){
        // first check if you are loggedin and admin user ... 
        // if(!Auth::check() && $request->path() != 'login'){
        //     return redirect('/login');
        // }
        // if(!Auth::check() && $request->path() == 'login' ){
        //     return view('welcome');
        // }
        // you are already logged in... so check for if you are an admin user.. 
        // $user = Auth::user();
        // if($user->userType =='User'){
        //     return redirect('/login');
        // }
        // if($request->path() == 'login'){
        //     return redirect('/');
        // }

        // if($request->segment(1)=='user_profile'){
        //     return view('user_profile');
        // } 
        \Log::info("yes Coming");
        return view('welcome');
        
    }
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

  
   
  
    public function createUser(Request $request){
         // validate request 
         $this->validate($request, [
            'fullName' => 'required',
            'email' => 'bail|required|email|unique:users',
            'password' => 'bail|required|min:6',
            'role_id' => 'required',
        ]);
        $password = bcrypt($request->password);
        $user = User::create([
            'fullName' => $request->fullName,
            'email' => $request->email,
            'password' => $password,
            'userType' => $request->userType,
        ]);
        return $user;
    }
   

    public function getUsers(){
        return User::get();
    }


    public function upload(Request $request){
        $this->validate($request, [
            'file' => 'required|mimes:jpeg,jpg,png'
        ]); 
        $picName = time().'.'.$request->file->extension();
        $request->file->move(public_path('uploads'),$picName );
        $url = env('APP_URL');
        $picName = "$url/uploads/$picName";
        return $picName;
    }


    //Delete image from server
    public function deleteImage(Request $request){
        $fileName = $request->imageName; 
        $this->deleteFileFromServer($fileName, false);
        return 'done';
    }
    public function deleteFileFromServer($fileName, $hasFullPath = false){
        if(!$hasFullPath){
            $filePath = public_path().$fileName;
        }
        if(file_exists($filePath)){
            @unlink($filePath);
        }
        return;
    }

    public function get_settings(Request $request){
        return Setting::orderBy('id', 'desc')
                    ->latest()
                    ->first();
     }


}


