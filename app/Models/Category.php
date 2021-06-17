<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'photo',
        'summary',
        'is_parent',
        'parent_id',
        'status',
    ];


    //this function is use for categoryController Destroy method
   public static function shiftChild($cat_id){
        return Category::whereIn('id',$cat_id)->update(['is_parent' => 1]);
    }

    //use for category controller get by child id
    public static function getChildByParentID($cat_id){
        return Category::where('parent_id',$cat_id)->pluck('title','id');
    }


    //join to products
    public function products(){
        return $this->hasMany('App\Models\Product','cat_id','id')->where('status','active');
    }
}
