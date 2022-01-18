<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\ProductAttributeAssoc;
use App\Models\ProductCategory;
use App\Models\ProductImage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //Add Products
    public function AddProduct(){
        $subcategory=SubCategory::all();
        return view('Product.AddProduct',compact('subcategory'));
    }
    public function PostAddProduct(Request $req){
        $validate=$req->validate([
            'name'=>['required','min:3'],
            'subcat'=>['required'],
            'color'=>['required'],
            'price'=>['required'],
            'quantity'=>['required'],
            'description'=>['max:15'],
            'image'=>['required']
        ]);
        if($validate){
            $name=$req->name;
            $subcat=$req->subcat;
            $color=$req->color;
            $price=$req->price;
            $quantity=$req->quantity;
            $description=$req->description;

            $product=new Product();
            $product->name=$name;
            $product->sub_category_id=$subcat;
            $product->price=$price;
            $product->quantity=$quantity;
            $product->description=$description;
            if($product->save())
            {
                $prod=Product::latest()->first();
                $subcat=SubCategory::whereId($subcat)->first();
                $cat_id=$subcat->category_id;
                $prod_cat=new ProductCategory();
                $prod_cat->sub_cat_id=$subcat->id;
                $prod_cat->cat_id=$cat_id;
                if($prod->prod_category()->save($prod_cat))
                {
                    $attrAssoc=new ProductAttributeAssoc();
                    $attrAssoc->product_id=$prod->id;
                    $attrAssoc->color=$color;
                    if($prod->assoc()->save($attrAssoc)){
                        if($files=$req->file('image')){
                            foreach($files as $file):
                                $prod_image = new ProductImage();
                                $filename=$file->getClientOriginalName();
                                $fname=rand() . "-" . time() . "-" .$filename;
                                $prod_image->product_id=$prod->id;
                                $prod_image->image=$fname;
                                $dest=public_path("/ProductImages");
                                if($file->move($dest,$fname))
                                    {
                                        $prod->images()->save($prod_image);
                                    }
                            endforeach;
                            return back()->with("success","Successfully inserted");
                    }
                }
            }
        }
    }

}

    //edit Product
    public function EditProduct($id){
        $product=Product::whereId($id)->first();
        return view('Product.EditProduct',compact('product'));
    }
    //Show Products
    public function ShowProducts(){
        $products=Product::all();
        $assoc=ProductAttributeAssoc::all();
        $subcategory=SubCategory::all();
        return view('Product.ShowProduct',compact('products','subcategory','assoc'));
    }

    //Delete Product
    public function DeleteProduct(Request $req){
        $product=Product::whereId($req->pid)->first();
        if($product->delete()){
            return back()->withSuccess('Product deleted successffully');
        }
        else{
            return back()->withErrors("Product not deleted!!!");
        }
    }
}
