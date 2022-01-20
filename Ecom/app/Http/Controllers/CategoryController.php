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
    public function AddCategory()
    {
        return view('Category.AddCategory');
    }
    public function AddPostCategory(Request $req)
    {
        try {
            $validate = $req->validate([
                'name' => ['required', 'string', 'min:3', 'max:20','unique:categories'],
                'description' => ['max:200']
            ]);
            if ($validate) {
                $name = $req->name;
                $description = $req->description;
                $cat = new Category();
                $cat->name = $name;
                $cat->description = $description;
                $cat->save();
                return redirect('/category/showcategory')->with('success', "Category Added Successfully");
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('404');
        }
    }

    //show category
    public function ShowCategory()
    {
        $category = Category::orderBy('created_at', 'desc')->paginate(10);
        return view('Category.ShowCategory', compact('category'));
    }

    //Edit Category
    public function EditCategory($id)
    {
        $cat = Category::whereId($id)->first();
        return view('Category.EditCategory', compact('cat'));
    }

    public function PostEditCategory(Request $req)
    {
        try {
            $id = $req->id;
            $name = $req->name;
            $description = $req->description;
            $validate = $req->validate([
                'name' => ['required', 'string', 'min:3', 'max:20', 'unique:categories,name,'.$req->id],
                'description' => ['max:100']
            ]);
            if ($validate) {

                Category::whereId($id)->update([
                    'name' => $name,
                    'description' => $description
                ]);
                return redirect('/category/showcategory')->with('success', "Successfully updated");
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('404');
        }
    }

    //Delete Category
    public function DeleteCategory(Request $req)
    {
        try {
            $cat = Category::whereId($req->cid)->first();
            if ($cat->delete()) {
                return back()->with('success', "Deleted Succcessfully");
            } else {
                return back()->with('error', "Error while deleting category");
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('404');
        }
    }
}
