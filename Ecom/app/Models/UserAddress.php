<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    public function userA(){
       return $this->belongsTo(User::class);
    }
    public function couponused(){
        return $this->hasOne(CouponsUsed::class);
    }
    public function Orderdetail(){
        return $this->hasOne(OrderDetails::class);
    }
    public function userorder(){
        return $this->hasMany(UserOrder::class);
    }
}
