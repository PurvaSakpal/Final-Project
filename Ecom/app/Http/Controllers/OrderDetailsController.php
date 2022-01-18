<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Coupon;
use App\Models\CouponsUsed;
use App\Models\OrderDetails;
use App\Models\UserAddress;

class OrderDetailsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   public function ShowOrderDetails(){
       $users=User::with('useraddress')->get();
       return view('Order Details.ShowOrderDetails',compact('users'));
   }
   public function OrderInfo($id){
       $products=Product::with('images','assoc')->get();
        $coupons=Coupon::all();
        $useraddress=UserAddress::with('couponused','Orderdetail','userorder')->whereId($id)->get();

       return view('Order Details.OrderInfo',compact('useraddress','products','coupons'));
   }
}
