<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

class Product extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title','slug','summary','description','additional_info','return_cancellation','size_guide','stock','brand_id','cat_id','child_cat_id','user_id','photo','price','offer_price','discount','size','conditions','status','added_by'];

    //jon with brands
    public function brands(){
        return $this->belongsTo('App\Models\Brand');
    }

    //related products
    public function rel_prods(){
        return $this->hasMany('App\Models\Product','cat_id','cat_id')->where('status','active');
    }

    //use for add to cart and wishlist to get all data
    public static function getProductByCart($product_id){
        return self::where('id',$product_id)->get()->toArray();
    }

    //////// User for order items
    public function orders(){
        return $this->belongsToMany(Order::class,'order_items')->withPivot('quantity')->withTimestamps();
    }
}
