<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //Add SubCategory
    public function AddSubCategory(){
        $category=Category::all();
        return view('SubCategory.AddSubCategory',compact('category'));
    }
    public function PostAddCategory(Request $req){
        $validate=$req->validate([
            'name'=>['required','min:3'],
            'category'=>['required'],
            'description'=>['max:20']
        ]);
        if($validate){
            $name=$req->name;
            $category=$req->category;
            $description=$req->description;
            $cat=Category::whereId($category)->first();
            $subcat=new SubCategory();
            $subcat->name=$name;
            $subcat->category_id=$cat->id;
            $subcat->desription=$description;
            if($cat->subcategory()->save($subcat)){
                return back()->with('success',"Added successfully");
            }
            else{
                return back()->with('error',"Error while adding");
            }
        }
    }
    public function ShowSubCategory(){
        $category=Category::all();
        $subcategory=SubCategory::all();
        return view('SubCategory.ShowSubCategory',compact('category','subcategory'));
    }

    //Edit Category
    public function EditSubCategory($id){
        $subcat=SubCategory::whereId($id)->first();
        $cat=Category::whereId($subcat->category_id)->first();
        $categories=Category::all();
        return view('SubCategory.EditSubCategory',compact('subcat','cat','categories'));
    }
    public function PostEditSubCategory(Request $req){
        $validate=$req->validate([
            'name'=>['required','min:3'],
            'category'=>['required'],
            'description'=>['max:20']
        ]);
        if($validate){
            if(SubCategory::whereId($req->id)->update([
                'name'=>$req->name,
                'category_id'=>$req->category,
                'desription'=>$req->description,
            ])){
                return back()->with('success',"Successfully Updated ");
            }
        }
    }
    public function DeleteSubCategory(Request $req){
        $subcat=SubCategory::whereId($req->scid)->first();
        if($subcat->delete()){
            return back()->with('success',"Deleted Successfully");
        }
        else{
            return back()->with('error',"Error while deleting Subcategory");
        }
    }
}
