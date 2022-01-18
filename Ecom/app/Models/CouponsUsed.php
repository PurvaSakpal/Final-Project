<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponsUsed extends Model
{
    use HasFactory;
    public function couponuse(){
        return $this->belongsTo(UserAddress::class);
     }
}
