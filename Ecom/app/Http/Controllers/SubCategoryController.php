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
    public function AddSubCategory()
    {
        $category = Category::all();
        return view('SubCategory.AddSubCategory', compact('category'));
    }
    public function PostAddSubCategory(Request $req)
    {
        $validate = $req->validate([
            'name' => ['required', 'min:3', 'unique:sub_categories'],
            'category' => ['required'],
            'description' => ['max:20']
        ]);
        if ($validate) {
            $name = $req->name;
            $category = $req->category;
            $description = $req->description;
            $cat = Category::whereId($category)->first();
            try {
                $subcat = new SubCategory();
                $subcat->name = $name;
                $subcat->category_id = $cat->id;
                $subcat->desription = $description;
                if ($cat->subcategory()->save($subcat)) {
                    return redirect('/subcategory/showsubcategory')->with('success', "Added successfully");
                } else {
                    return back()->with('error', "Error while adding");
                }
            } catch (\Illuminate\Database\QueryException $ex) {
                return view('404');
            }
        }
    }
    public function ShowSubCategory()
    {
        $category = Category::all();
        $subcategory = SubCategory::orderBy('created_at', 'desc')->paginate(10);
        return view('SubCategory.ShowSubCategory', compact('category', 'subcategory'));
    }

    //Edit Category
    public function EditSubCategory($id)
    {
        $subcat = SubCategory::whereId($id)->first();
        $cat = Category::whereId($subcat->category_id)->first();
        $categories = Category::all();
        return view('SubCategory.EditSubCategory', compact('subcat', 'cat', 'categories'));
    }
    public function PostEditSubCategory(Request $req)
    {
        try {
            $validate = $req->validate([
                'name' => ['required', 'min:3', 'unique:sub_categories,name,' . $req->id],
                'category' => ['required'],
                'description' => ['max:20']
            ]);
            if ($validate) {
                if (SubCategory::whereId($req->id)->update([
                    'name' => $req->name,
                    'category_id' => $req->category,
                    'desription' => $req->description,
                ])) {
                    return redirect('/subcategory/showsubcategory')->with('success', "Successfully Updated ");
                }
                return back()->with('error', "Something went wrong");
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('404');
        }
    }
    public function DeleteSubCategory(Request $req)
    {
        try {
            SubCategory::whereId($req->cid)->delete();
            return back()->with('success', "Deleted Successfully");
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('404');
        }
    }
}
