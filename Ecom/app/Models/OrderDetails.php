<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    public function userO(){
        return $this->belongsTo(User::class);
     }
     public function userAdd(){
        return $this->belongsTo(UserAddress::class);
     }
}
