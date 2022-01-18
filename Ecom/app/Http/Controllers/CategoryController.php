<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //Add Category
    public function AddCategory(){
        return view('Category.AddCategory');
    }
    public function AddPostCategory(Request $req){
        $name=$req->name;
        $description=$req->description;
        $cat=new Category();
        $cat->name=$name;
        $cat->description=$description;
        if($cat->save()){
            return back()->with('success',"Category Added Successfully");
        }
        else{
            return back()->with('error',"Error while adding category");
        }
    }

    //show category
    public function ShowCategory(){
        $category=Category::all();
        return view('Category.ShowCategory',compact('category'));
    }

    //Edit Category
    public function EditCategory($id){
        $cat=Category::whereId($id)->first();
        return view('Category.EditCategory',compact('cat'));
    }

    public function PostEditCategory(Request $req){
        $id=$req->id;
        $name=$req->name;
        $description=$req->description;
        $validate=$req->validate([
            'name'=>['required','string','min:3','max:20'],
            'description'=>['min:3']
        ]);
        if($validate){
            Category::whereId($id)->update([
                'name'=>$name,
                'description'=>$description
            ]);
            return back()->with('success',"Successfully updated");
        }
    }

    //Delete Category
    public function DeleteCategory(Request $req){
        $cat=Category::whereId($req->cid)->first();
        if($cat->delete())
        {
            return back()->with('success',"Deleted Succcessfully");
        }
        else{
            return back()->with('error',"Error while deleting category");
        }
    }
}
