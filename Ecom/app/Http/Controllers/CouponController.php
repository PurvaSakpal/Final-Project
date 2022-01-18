<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function ShowCoupons(){
        $coupons=Coupon::all();
        return view('Coupons.ShowCoupons',compact('coupons'));
    }
    public function AddCoupon(){
        return view('Coupons.AddCoupon');
    }
    public function AddPostCoupon(Request $req){
        $validate=$req->validate([
            'code'=>'required|unique:coupons',
            'type'=>'required',
            'value'=>'required|numeric',
            'cart_value'=>'required|numeric'
        ]);
        if($validate){
            $coupon=new Coupon();
            $coupon->code=$req->code;
            $coupon->type=$req->type;
            $coupon->value=$req->value;
            $coupon->cart_value=$req->cart_value;
            if($coupon->save()){
                return back()->withSuccess('Coupon added successfully');            }
        }
    }
    public function EditCoupon($id){
        $coupon=Coupon::find($id);
        return view('Coupons.EditCoupon',compact('coupon'));
    }
    public function EditPostCoupon(Request $req){
        $validate=$req->validate([
            'code'=>'required',
            'type'=>'required',
            'value'=>'required|numeric',
            'cart_value'=>'required|numeric'
        ]);
        if($validate){
            $coupon=Coupon::find($req->id);
            $coupon->code=$req->code;
            $coupon->type=$req->type;
            $coupon->value=$req->value;
            $coupon->cart_value=$req->cart_value;
            if($coupon->save()){
                return back()->withSuccess('Coupon updated successfully');
            }
        }
    }
    public function DeleteCoupon(Request $req){
        $coupon=Coupon::find($req->cid);
        if($coupon->delete()){
            return back()->withSuccess('Coupon deleted successfully');
        }
        else
        {
            return back()->withFail('Error while deleting');
        }
    }
}
