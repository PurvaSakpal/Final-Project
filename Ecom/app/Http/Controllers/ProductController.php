<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\ProductAttributeAssoc;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //Add Products
    public function AddProduct()
    {
        $subcategory = SubCategory::all();
        return view('Product.AddProduct', compact('subcategory'));
    }
    public function PostAddProduct(Request $req)
    {
        $validate = $req->validate([
            'name' => ['required', 'min:3','unique:products'],
            'subcat' => ['required'],
            'price' => ['required'],
            'quantity' => ['required'],
            'description' => ['max:15'],
            'image' => ['required']
        ]);
        if ($validate) {
            $name = $req->name;
            $subcat = $req->subcat;
            $price = $req->price;
            $quantity = $req->quantity;
            $description = $req->description;

            $product = new Product();
            $product->name = $name;
            $product->sub_category_id = $subcat;
            $product->price = $price;
            $product->quantity = $quantity;
            $product->description = $description;
            if ($product->save()) {
                $prod = Product::latest()->first();
                $subcat = SubCategory::whereId($subcat)->first();
                $cat_id = $subcat->category_id;
                $prod_cat = new ProductCategory();
                $prod_cat->sub_cat_id = $subcat->id;
                $prod_cat->cat_id = $cat_id;
                if ($prod->prod_category()->save($prod_cat)) {
                    if ($req->attr) {
                        $productid = Product::latest()->first();
                        foreach ($req->attr as $key => $value) {
                            $n = $value;
                            $prodassoc = new ProductAttributeAssoc();
                            $prodassoc->product_id = $productid->id;
                            $prodassoc->attr_name = $n['name'];
                            $prodassoc->arrt_value = $n['value'];
                            $productid->assoc()->save($prodassoc);
                        }
                    }

                    if ($files = $req->file('image')) {
                        foreach ($files as $file) :
                            $prod_image = new ProductImage();
                            $filename = $file->getClientOriginalName();
                            $fname = rand() . "-" . time() . "-" . $filename;
                            $prod_image->product_id = $prod->id;
                            $prod_image->image = $fname;
                            $dest = public_path("/ProductImages");
                            if ($file->move($dest, $fname)) {
                                $prod->images()->save($prod_image);
                            }
                        endforeach;
                        return redirect('/products/showproducts')->with("success", "Successfully inserted");
                    }
                }
            }
        }
    }

    //edit Product
    public function EditProduct($id)
    {
        $subcategory = SubCategory::all();
        $product = Product::whereId($id)->first();
        return view('Product.EditProduct', compact('product', 'subcategory'));
    }

    //Edit Post Product
    public function PostEditProduct(Request $req)
    {
        // try{
        $validate = $req->validate([
            'name' => ['required', 'string', 'min:2','unique:products,name,'.$req->name],
            'subcat' => ['required'],
            'quantity' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
            'description' => ['max:1000'],

        ]);
        if ($validate) {
            $product = Product::where('id', $req->id)->with('images', 'assoc', 'prod_category')->first();
            //  $productimg=$product->assoc;
            //  return $productimg;
            $product->update([
                'name' => $req->name,
                'sub_category_id' => $req->subcat,
                'quantity' => $req->quantity,
                'price' => $req->price,
                'description' => $req->description,
            ]);
            $product->prod_category()->update([
                'sub_cat_id' => $req->subcat
            ]);
            if ($files = $req->file('image')) {
                foreach ($product->images() as $proimage) :

                    $path = public_path('ProductImages/' . $proimage->image);
                    if (File::exists($path)) {
                        unlink($path);
                    }
                endforeach;
                if ($product->images()->delete()) {
                    foreach ($files as $file) :
                        $prod_image = new ProductImage();
                        $filename = $file->getClientOriginalName();
                        $fname = rand() . "-" . time() . "-" . $filename;
                        $prod_image->product_id = $product->id;
                        $prod_image->image = $fname;
                        $dest = public_path("/ProductImages");
                        if ($file->move($dest, $fname)) {
                            $product->images()->save($prod_image);
                        }
                    endforeach;
                }
            }
            if ($req->attr) {
                $productid = Product::where('id', $req->id)->first();
                foreach ($req->attr as $key => $value) {
                    $n = $value;
                    $prodassoc = new ProductAttributeAssoc();
                    $prodassoc->product_id = $product->id;
                    $prodassoc->attr_name = $n['name'];
                    $prodassoc->arrt_value = $n['value'];
                    $productid->assoc()->save($prodassoc);
                }
            }
        }

        return redirect('/products/showproducts')->with('success', "Product updated successfully");
        // }
        // catch (\Illuminate\Database\QueryException $ex) {
        //     return view('404');
        // }
    }

    //Show Products
    public function ShowProducts()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
        $assoc = ProductAttributeAssoc::all();
        $subcategory = SubCategory::all();
        return view('Product.ShowProduct', compact('products', 'subcategory', 'assoc'));
    }

    //Show Product Details
    public function ShowProductdetails($id)
    {
        $cat = Category::all();
        $product = Product::whereId($id)->with('images', 'assoc', 'prod_category')->first();
        return view('Product.ShowProductDetails', compact('product', 'cat'));
    }

    //Delete Product
    public function DeleteProduct(Request $req)
    {
        try {
            $product = Product::whereId($req->pid)->first();
            foreach ($product->images as $image) :

                $path = public_path('ProductImages/' . $image->image);
                if (File::exists($path)) {
                    unlink($path);
                }
            endforeach;
            $product->delete();
            return back()->withSuccess('Product deleted successffully');
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('404');
        }
    }
}
