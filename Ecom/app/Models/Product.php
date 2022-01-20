<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable= [
        'name',
        'sub_category_id',
        'quantity',
        'price',
        'description',

    ];
    public function images(){
        return $this->hasMany(ProductImage::class);
    }
    public function assoc(){
        return $this->hasMany(ProductAttributeAssoc::class);
    }
    public function prod_category(){
        return $this->hasMany(ProductCategory::class);
    }
}
