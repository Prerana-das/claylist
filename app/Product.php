<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title','description','price','address','city','state','zip_code','status','category_id',
        'hands','color','gender','age','horses_name','user_id','view_count','isFeatured','validity','package_id','breed_id','animal_type_id','lat','lng','isSocialShare','paymentStatus','due'
    ];

    public function category(){
        return $this->belongsTo('App\Category','category_id');
    }

    public function breed(){
        return $this->belongsTo('App\Breed','breed_id');
    }

    public function animal_type(){
        return $this->belongsTo('App\AnimalType','animal_type_id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    public function package(){
        return $this->belongsTo('App\Package','package_id');
    }

    public function tags(){
        return $this->hasMany('App\ProductTag','product_id');
    }
    public function wishlist(){
        return $this->hasOne('App\Wishlist','product_id');
    }
    public function isWishlist(){
        return $this->hasOne('App\Wishlist','product_id')->select('id','product_id');
    }

    public function allImages() {
        return $this->hasMany("App\ProductImage",'product_id');
    }
}
