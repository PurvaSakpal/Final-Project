<?php

namespace App\Http\Controllers;

use App\Models\CMSHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CMSController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function AddBannerImage(){
        return view('CMS.AddBannerImage');
    }
    public function PostAddBannerImage(Request $req){
        $validate=$req->validate([
            'image'=>'required|mimes:jpg,jpeg,png'
        ]);
        if($validate)
        {
        $cmsimage=new CMSHeader();
        $file=$req->file('image');
        $filename=$file->getClientOriginalName();
        $fname=rand() . "-" . time() . "-" .$filename;
        $cmsimage->image=$fname;
        $dest=public_path("/CMSImage");
        if($file->move($dest,$fname))
            {
                $cmsimage->save();
                return back()->with('success',"Successfull!!");
            }
        }
    }
    public function ShowBannerImage(){
        $banner=CMSHeader::all();
        return view('CMS.ShowBannerImage',compact('banner'));
    }
    public function DeleteBannerImage(Request $req){
        $banner=CMSHeader::whereId($req->bid)->first();
        $path=public_path('CMSImage/'.$banner->image);
        if(File::exists($path))
        {
            unlink($path);
        }
        if($banner->delete())
        {
            return back()->with('success','Deleted Successfully');
        }
        else{
            return back()->with('error',"Error deleting");
        }
    }
}
