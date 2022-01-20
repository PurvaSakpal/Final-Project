<?php

namespace App\Http\Controllers;

use App\Models\CMSAddress;
use App\Models\CMSHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CMSController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function AddBannerImage()
    {
        return view('CMS.AddBannerImage');
    }
    public function PostAddBannerImage(Request $req)
    {
        try {
            $validate = $req->validate([
                'image' => 'required|mimes:jpg,jpeg,png'
            ]);
            if ($validate) {
                $cmsimage = new CMSHeader();
                $file = $req->file('image');
                $filename = $file->getClientOriginalName();
                $fname = rand() . "-" . time() . "-" . $filename;
                $cmsimage->image = $fname;
                $dest = public_path("/CMSImage");
                if ($file->move($dest, $fname)) {
                    $cmsimage->save();
                    return back()->with('success', "Successfull!!");
                }
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('404');
        }
    }
    public function ShowBannerImage()
    {
        $banner = CMSHeader::orderBy('created_at', 'desc')->paginate(10);
        return view('CMS.ShowBannerImage', compact('banner'));
    }
    public function DeleteBannerImage(Request $req)
    {
        try {
            $banner = CMSHeader::whereId($req->bid)->first();
            $path = public_path('CMSImage/' . $banner->image);
            if (File::exists($path)) {
                unlink($path);
            }
            $banner->delete();
            return back()->with('success', 'Deleted Successfully');
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('404');
        }
    }

    public function AddAddress()
    {
        return view('CMS.AddAddress');
    }
    public function AddPostAddress(Request $req)
    {
        try {
            $validate = $req->validate([
                'name' => 'required',
                'address1' => 'required|min:9',
                'address2' => 'max:255',
                'state' => 'required|min:3',
                'country' => 'required|min:2',
                'mobile' => 'required',
                'fax' => 'required|min:6',
                'email' => 'required|email',
            ]);
            if ($validate) {
                $address = new CMSAddress();
                $address->name = $req->name;
                $address->address1 = $req->address1;
                $address->address2 = $req->address2;
                $address->state = $req->state;
                $address->country = $req->country;
                $address->mobile = $req->mobile;
                $address->fax = $req->fax;
                $address->email = $req->email;
                $address->save();
                return redirect('cms/showaddress')->with('success', "Address Added successfully");
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('404');
        }
    }

    public function ShowAddress()
    {
        $address = CMSAddress::orderBy('created_at', 'desc')->paginate(10);
        return view('CMS.ShowAddress', compact('address'));
    }
    public function DeleteAddress(Request $req)
    {
        try {
            CMSAddress::whereId($req->aid)->delete();
            return redirect('/cms/showaddress')->with('success', "Deleted Successfully");
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('404');
        }
    }
}
