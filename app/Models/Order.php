<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','product_id','order_number','sub_total','total_amount','coupon','payment_method','payment_status','condition','delivery_charge','quantity','first_name','last_name','email','phone','country','address','city','state','sfirst_name','slast_name','semail','sphone','scountry','saddress','scity','sstate','note'];
}
