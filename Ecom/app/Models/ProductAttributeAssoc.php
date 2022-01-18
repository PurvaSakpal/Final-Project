<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributeAssoc extends Model
{
    use HasFactory;
    public function productAssoc(){
        return $this->belongsTo(Product::class);
    }
}
