<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\MockObject\Stub\ReturnReference;

class Coupon extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code','type','status','value'];


    // use for coupon apply time in cartcontroller
    public function discount($total){
        if ($this->type =='fixed') {
            return number_format(round($this->value),2);
        }elseif ($this->type == 'percent') {
           return number_format(round(($this->value/100) * $total),2);
        }else {
            return 0;
        }
    }
}
