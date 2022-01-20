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
    public function ShowCoupons()
    {
        $coupons = Coupon::orderBy('created_at', 'desc')->paginate(10);
        return view('Coupons.ShowCoupons', compact('coupons'));
    }
    public function AddCoupon()
    {
        return view('Coupons.AddCoupon');
    }
    public function AddPostCoupon(Request $req)
    {
        try {
            $validate = $req->validate([
                'code' => 'required|unique:coupons',
                'type' => 'required',
                'value' => 'required|numeric',
                'cart_value' => 'required|numeric'
            ]);
            if ($validate) {
                $coupon = new Coupon();
                $coupon->code = $req->code;
                $coupon->type = $req->type;
                $coupon->value = $req->value;
                $coupon->cart_value = $req->cart_value;
                $coupon->save();
                return redirect('/coupons/showcoupons')->with('success', 'Coupon added successfully');
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('404');
        }
    }
    public function EditCoupon($id)
    {
        $coupon = Coupon::find($id);
        return view('Coupons.EditCoupon', compact('coupon'));
    }
    public function EditPostCoupon(Request $req)
    {
        try {
            $validate = $req->validate([
                'code' => 'required|unique:coupons,code,'.$req->code,
                'type' => 'required',
                'value' => 'required|numeric',
                'cart_value' => 'required|numeric'
            ]);
            if ($validate) {
                $coupon = Coupon::find($req->id);
                $coupon->code = $req->code;
                $coupon->type = $req->type;
                $coupon->value = $req->value;
                $coupon->cart_value = $req->cart_value;
                $coupon->save();
                return redirect('/coupons/showcoupons')->with('success', 'Coupon updated successfully');
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('404');
        }
    }
    public function DeleteCoupon(Request $req)
    {
        try {
            Coupon::find($req->cid)->delete();
            return back()->withSuccess('Coupon deleted successfully');
        } catch (\Illuminate\Database\QueryException $ex) {
            return view('404');
        }
    }
}
