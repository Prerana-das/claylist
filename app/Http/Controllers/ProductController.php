<?php

namespace App\Http\Controllers;
use App\Colour;
use App\Product;
use App\Setting;
use App\Category;
use App\Wishlist;
use App\ProductTag;
use App\ProductImage;
use App\AnimalType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //
    public function listing_details ($id){ 
        // \Log::info($id);
        $user_id = 0;
        if(Auth::check()){
            $user_id = Auth::user()->id;
        }
        $settings=Setting::orderBy('id', 'desc')
                ->latest()
                ->first();
        $product = Product::with('category','allImages','user','breed','animal_type')->with(['wishlist' => function($query) use ($user_id){$query->where('user_id',$user_id);}])->where('id',$id)->first();
        $flag = 1;
        $user = Auth::user();
        if(Auth::check()){
            if($product->user_id == $user->id) $flag == 0;
        }
        if($flag==1) Product::where('id',$id)->update([
            'view_count'=> DB::raw( 'view_count + 1')
        ]);
        return view('listing_details ')->with(['product'=>$product])->with('settings',$settings);  
    }

    public function add_listing(Request $request){
        $data = $request->all();

        $rules = [
            'price' => 'required|regex:/^\d*\.?\d*$/'
        ];
    
        $customMessages = [
            'required' => 'Price is required!',
            'regex' => 'Invalid price format!',
        ];
    
        $this->validate($request, $rules, $customMessages);
        

        $uploadList = $data['image'];
        $tags = $data['tags'];
        unset($data['image']);
        unset($data['tags']);
        // \Log::info($data);

        $createData = Product::create($data);
        
        $size = sizeof($uploadList);
        $allImgItem=[];
        if($createData ){
            for($i = 0 ; $i<$size; $i++){
                $ob = ([
                    'product_id' => $createData->id,
                    'image' => $uploadList[$i]['image'],
                ]);
                array_push($allImgItem,$ob);
                
            }
        }
        ProductImage::insert($allImgItem);

        \Log::info($tags);
        $tagSize = sizeof($tags);
        $allTagItem=[];
        if($createData ){
            for($i = 0 ; $i<$tagSize; $i++){
                $ob = ([
                    'product_id' => $createData->id,
                    'tag_id' => $tags[$i],
                ]);
                array_push($allTagItem,$ob);  
            }
        }
        ProductTag::insert($allTagItem);

        return $createData;
    }

    public function all_lists(Request $request){
        $isFeatured = $request->isFeatured;
        $user_id = 0;
        if(Auth::check()){
            $user_id = Auth::user()->id;
        }
        $data = Product::where('status','Approved')->with(['category','allImages','user'])->with(['wishlist' => function($query) use ($user_id){
            $query->where('user_id',$user_id);
        }]);
        
        
        if($isFeatured){
            
            $data->where('isFeatured',$isFeatured);
        }
        return $data->orderBy('id','desc')->get();
    }
    public function all_listing_pagi(Request $request){
        $user_id = 0;
        if(Auth::check()){
            $user_id = Auth::user()->id;
        }
        $total = $request->total;
        $key = $request->key;
        $categoryId = $request->categoryId;
        $cityZip = $request->cityZip;
        $distance = $request->distance;
        $lat = $request->lat;
        $lng = $request->lng;
        $categories = $request->categories;
        $animalTypes = $request->animalTypes;
        $discipline = $request->discipline;
        $color = $request->color;
        $breeds = $request->breeds;
        $min = $request->min;
        $max = $request->max;
        $age_max = $request->age_max;
        $gender = $request->gender;
        $age_min = $request->age_min;
        $orderBy = $request->orderBy;
        // $data = Product::with('category','allImages','wishlist');
        $data = Product::where('status','Approved')->with(['category','allImages','breed'])->with(['wishlist' => function($query) use ($user_id){
            $query->where('user_id',$user_id);
        }]);
        if($key){
            $data->where(function ($query) use ($key){
                $query->where('title', 'like', '%'.$key.'%');
                $query->orWhere('description', 'like', '%'.$key.'%');
            });
        } 
        
        // if($cityZip && $distance && $lat && $lng){
        //     $data->where(function ($query) use ($cityZip){
        //         $query->where('city', 'like', '%'.$cityZip.'%');
        //         $query->orWhere('zip_code', 'like', '%'.$cityZip.'%');
        //     });
        // }
        if($cityZip && $distance && $lat && $lng){ 
            $data->select('*',DB::raw("cast(((((acos(sin(($lat*pi()/180)) * sin((lat*pi()/180))+cos(($lat*pi()/180)) * cos((lat*pi()/180)) * cos((($lng-lng)*pi()/180))))*180/pi())*60*1.1515*1.609344)*0.621371) as decimal(10,2)) as distance "));
            $data->having('distance','<', $distance);
        }
        
        if($gender){
            $data->where('gender', $gender);
        }
        if($min){
            $data->where('price','>=' ,$min);
        }
        if($max){
            $data->where('price','<=' ,$max);
        }
        if($age_min){
            $data->where('age','>=' ,$age_min);
        }
        if($age_max){
            $data->where('age','<=' ,$age_max);
        }
        if ($breeds){
            // \Log::info($breeds);
            $breedsss = explode(',', $breeds);
            $data->whereIn('breed_id', $breedsss);
        }
        if($categoryId){
            $data->where('category_id', $categoryId);
        }
        else if ($categories){
            $cats = explode(',', $categories);
            $data->whereIn('category_id', $cats);
        }
        if ($animalTypes){
            $cats = explode(',', $animalTypes);
            $data->whereIn('animal_type_id', $cats);
        }
        if ($color){
            $cats = explode(',', $color);
            $data->whereIn('color', $cats);
        }
        if ($discipline){
            $cats = explode(',', $discipline);
            $data->whereHas('tags', function ($query) use ($cats){
                $query->whereIn('tag_id', $cats);
            });
        }
        if($orderBy){
            $order = explode(',', $orderBy);
            $data->orderBy($order[0],$order[1]);
        }
        return $data->paginate($total);
    }

    public function all_listing_user(Request $request){
        $total = $request->total;
        $user_id = $request->user_id;
        $data = Product::with('category','allImages','breed')->where('user_id',$user_id)->orderBy('id','desc');
        return $data->paginate($total);
    }

    public function all_category(){
        return Category::all();
    }

    public function edit_listing(Request $request){
        $data = $request->all();

        $rules = [
            'price' => 'required|regex:/^\d*\.?\d*$/'
        ];
        $customMessages = [
            'required' => 'Price is required!',
            'regex' => 'Invalid price format!',
        ];
        $this->validate($request, $rules, $customMessages);

        $uploadList = $data['uploadList'];
        unset($data['uploadList']);
        $beforeEdit= Product::where('id', $request->id)->first();
        
        $updateData =Product::where('id', $request->id)->update($data);  
        $list = [];
       
        foreach ($uploadList as $value) {
            $ob = ([
                'product_id' => $request->id,
                'image' => $value['image'],
            ]);
            array_push($list,$ob);
            
        }
        ProductImage::where('product_id',$request->id)->delete();
        ProductImage::insert($list);

            if($request->price!=$beforeEdit->price){
                
                $wishItem =Wishlist::with('user')->where('product_id',$request->id)->get();
                
                foreach ($wishItem as $wishobject) {
                    $allEmail = $wishobject->user->email;
                        $from_address = env('MAIL_FROM_ADDRESS');
                        $data['msg'] = $request->title;
                        \Mail::send('email/test', $data, function ($message) use ($allEmail,$from_address){
                            $message->from($from_address, 'Listing Price Change');
                            $message->to($allEmail)->subject('Listing price is changed!');
                        });
                    
                }
            }
        
         return Product::with('category','allImages','user','breed','animal_type')->where('id', $request->id)->first();
        
        
    }
    public function change_package(Request $request){
        $data = $request->all();
        Product::where('id', $request->id)->update($data);  
        return Product::with('category','allImages','breed')->where('id', $request->id)->first();
        
        
    }

    public function listing_delete(Request $request){
        $data = $request->all();
        Product::where('id',$data['id'])->delete();
        $total = $request->total;
        $dataaa = Product::with('category','allImages','user','breed')->where('user_id',$data['user_id'])->orderBy('id','desc');
        return $dataaa->paginate($total);
    }

    public function get_favorite_list(Request $request){
        $user_id = $request->user_id;         
        $total = $request->total;         
        $data = Wishlist::with('user','product.allImages','product.category')->where('user_id',$user_id)->orderBy('id','desc');
        return $data->paginate($total);
    }

    public function cancelWishlist(Request $request){
        $data = $request->all();
        Wishlist::where('id',$data['id'])->delete();
        $total = $request->total;
        $dataaa = Wishlist::with('user','product.allImages','product.category')->where('user_id',$data['user_id'])->orderBy('id','desc');
        return $dataaa->paginate($total);
    }

    public function latest_lists(Request $request){
        $user_id = 0;
        if(Auth::check()){
            $user_id = Auth::user()->id;
        }
        $data = Product::with(['category','allImages','user'])->with(['wishlist' => function($query) use ($user_id){
            $query->where('user_id',$user_id);
        }])->where('isFeatured',0)->orderBy('id','desc')->limit(6)->get();
        return $data;
    }

    public function getCategorywithLimit(){
        return Category::all();
    }

    public function all_color(){
        return Colour::all();
    }

    public function all_animal_type(){
        return AnimalType::all();
    }

    public function getAnimalTypewithLimit(){
        return AnimalType::limit(5)->get();
    }


}
