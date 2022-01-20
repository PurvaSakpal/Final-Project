<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmationMail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use App\Models\Banner;
use App\Models\ContactUs;
use App\Models\Category;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\CouponsUsed;
use App\Models\OrderDetails;
use App\Models\UserAddress;
use App\Models\UserOrder;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Mail;
use Egulias\EmailValidator\Exception\UnclosedComment;
use App\Mail\UserRegistrationMail;
use App\Models\CMSAddress;
use App\Models\CMSHeader;

class ApiController extends Controller
{
    public function Index()
    {
        $user = User::all();
        return response()->json($user);
    }
    public function Login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        } else {
            if (!$token = auth()->guard('api')->attempt($validator->validated())) {
                return response()->json(['err' => 1,'msg'=>'Credentials does not match']);
            } else {

                $user = User::where('email', $request->email)->first();
                return response()->json([
                    'err' => 0,
                    'token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => auth()->guard('api')->factory()->getTTL() * 60,
                    'user' => $user
                ]);
            }
        }
    }


    public function Register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required', 'string', 'max:255',
            'lastname' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'unique:users',
            'password' => 'required', 'string', 'min:6', 'confirmed',
            'confirmpassword' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        } else {
            $user = new User();
            $user->first_name = $request->firstname;
            $user->last_name = $request->lastname;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->status = 1;
            $user->role_id = 5;
            $user->save();

            Mail::to($request->email)->send(new UserRegistrationMail($request->all()));
            return response()->json(['error' => 0]);
        }
    }

    //Contact Us API
    public function ContactUs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'unique:users',
            'subject' => 'required', 'string', 'min:2',
            'message' => 'required', 'min:3',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        } else {
            $contact = new ContactUs();
            $contact->name = $request->name;
            $contact->emai = $request->email;
            $contact->subject = $request->subject;
            $contact->message = $request->message;
            $contact->save();
            return response()->json(['error' => 0]);
        }
    }

    //Banner API
    public function Banners()
    {
        $banners = Banner::all();
        return response()->json(['banners' => $banners]);
    }

    //Categories API
    public function Categories()
    {
        $categories = Category::with('subcategory')->get();
        return response()->json(['categories' => $categories]);
    }

    //Products API
    public function Products()
    {
        $products = Product::with('images', 'assoc')->get();
        return response()->json(['products' => $products]);
    }
    public function GetProduct($id)
    {
        $product = Product::whereId($id)->with('images', 'assoc')->first();
        return response()->json(['product' => $product]);
    }
    public function GetSubCategory($id)
    {
        $products = Product::where('sub_category_id', $id)->with('images', 'assoc')->get();
        return response()->json(['products' => $products]);
    }
    // public function GetCategory($id){
    //     $catproducts=Product::with('subcategory')->all();
    //     $product=
    //     return response()->json(['catproducts'=>$catproducts]);
    // }
    public function ChangePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'oldpass' => 'required',
            'newpass' => 'required', 'min:6',
            'confirmpass' => 'required', 'min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        } else {
            $user = User::whereId($request->id)->first();
            if (Hash::check($request->oldpass, $user->password)) {
                $user->update([
                    'password' => Hash::make($request->newpass)
                ]);
                return response()->json(['success' => "Password updated!!"]);
            } else {
                return response()->json(['err' => "Old password is wrong"]);
            }
        }
    }

    //User Information
    public function UserInfo()
    {
        $profile = auth('api')->user();
        return response()->json(['user' => $profile]);
    }

    //Edit User
    public function EditUser(Request $req)
    {
        if (User::whereId($req->userid)->update([
            'first_name' => $req->firstname,
            'last_name' => $req->lastname,
            'email' => $req->email
        ])) {
            return response()->json(['success' => 'User updated successfully!', 'err' => 0]);
        } else {
            return response()->json(['err' => 'Error while registering']);
        }
    }
    public function Coupons()
    {
        $coupons = Coupon::all();
        return response()->json(['coupons' => $coupons]);
    }
    public function ApplyCoupon(Request $req)
    {
        $coupon = Coupon::where('code', $req->code)->where('cart_value', '<=', $req->carttotal)->first();
        if (!$coupon) {
            return response()->json(['err' => "Invalid coupon"]);
        } else {
            $couponvalue = $coupon->value;
            $couponid = $coupon->id;
            return response()->json(['success' => "Coupon applied sucessfully", 'cvalue' => $couponvalue, 'couponid' => $couponid, 'err' => 0]);
        }

    }
    public function AddToWishlist(Request $req)
    {
        $wishlist = new Wishlist();
        $wishlist->user_id = $req->user;
        $wishlist->product_id = $req->pid;
        $wishlist->product_name = $req->pname;
        $wishlist->product_price = $req->price;
        $wishlist->product_image = $req->image;
        $wishlist->product_description = $req->description;
        if ($wishlist->save()) {
            return response()->json(['err' => 0,'msg' => 'Added to wishlist!!!']);
        } else {
            return response()->json(['err' => 1, 'msg' => 'Error']);
        }
    }

    public function WishlistProduct($id)
    {
        $products = Wishlist::where('user_id', $id)->get();
        return response()->json(['products' => $products]);
    }
    public function DeleteItem(Request $req)
    {
        if (Wishlist::whereId($req->pid)->delete()) {
            return response()->json(['err' => 0]);
        } else {
            return response()->json(['err' => 1, 'msg' => "not able to delete"]);
        }
    }

    //PlaceOrder
    public function PlaceOrder(Request $req)
    {
        try{
        $email = $req->email;
        $firstname = $req->firstname;
        $middlename = $req->middlename;
        $lastname = $req->lastname;
        $address1 = $req->address1;
        $address2 = $req->address2;
        $pcode = $req->pcode;
        $mobile = $req->mobile;
        $user_id = $req->user;
        // $coupon_id = $req->coupon_id;
        $cart_sub_total = $req->cart_sub_total;
        $shipping_cost = $req->shipping_cost;
        $total = $req->total;
        $carts = $req->cart;

        $user = User::whereId($user_id)->first();
        $useradd = new UserAddress();
        $useradd->user_id = $user->id;
        $useradd->email = $email;
        $useradd->first_name = $firstname;
        $useradd->middle_name = $middlename;
        $useradd->last_name = $lastname;
        $useradd->address1 = $address1;
        $useradd->address2 = $address2;
        $useradd->postal_code = $pcode;
        $useradd->mobile_no = $mobile;
        $user->useraddress()->save($useradd);

        $useraddressid = UserAddress::latest()->first();

        $orderdetail = new OrderDetails();
        $orderdetail->user_id = $user->id;
        $orderdetail->cart_sub_total = $cart_sub_total;
        $orderdetail->shipping_cost = $shipping_cost;
        $orderdetail->total = $total;
        // $orderdetail->coupon_id = $coup->id;
        if ($req->coupon_id) {
            $coupon = new CouponsUsed();
            $coupon->user_address_id = $useraddressid->id;
            $coupon->coupon_id = $req->coupon_id;
            $useraddressid->couponused()->save($coupon);

            $cused=CouponsUsed::latest()->first();
            $orderdetail->coupon_id = $cused->id;
        }
        $orderdetail->user_address_id = $useraddressid->id;

        if ($useraddressid->orderdetail()->save($orderdetail)) {
            $orderid = OrderDetails::latest()->first();
            foreach ($carts as $cart) {
                $userorder = new UserOrder();
                $userorder->user_address_id = $useraddressid->id;
                $userorder->order_id = $orderid->id;
                $userorder->product_id = $cart['pid'];
                $userorder->product_quantity = $cart['quantity'];
                $useraddressid->userorder()->save($userorder);
            }
            Mail::to($req->email)->send(new OrderConfirmationMail($req->all()));
            return response()->json(['success' => "Order Placed Successfully", 'err' => 0]);
        }
    }
    catch (\Illuminate\Database\QueryException $ex) {
        return response()->json(['err' => 1,'msg'=> $ex->getMessage()]);
    }
    }

    public function MyOrders($id)
    {
        try{
        $products = Product::with('images', 'assoc','prod_category')->get();
        $useraddress = UserAddress::with('couponused','orderdetail', 'userorder')->where('user_id', $id)->get();
        // $prodcart=[];
        // foreach($products as $product){
        //     foreach($useraddress->userorder as $userord){
        //         if($userord->product_id == $product->id){
        //             array_push($prodcart,$product);
        //         }
        //     }
        // }
        // $coupon = Coupon::all();
        // foreach ($useraddress->couponused as $couponuse){
        //     foreach ($coupon as $coup){
        //     if($couponuse->coupon_id == $coup->id){
        //         $usedcoupon=$coup;
        //     }
        // }
        // }
        return response()->json(['useraddress' => $useraddress, 'products' => $products]);
    }
    catch (\Illuminate\Database\QueryException $ex) {
        return response()->json(['err' => 1,'error'=> $ex->getMessage()]);
    }
    }


    public function Logout()
    {
        auth()->logout();
        return response()->json(["success" => "User Logout Successfully"]);
    }
    public function BannerImage()
    {
        $banners = CMSHeader::latest()->first();
        return response()->json(['banners' => $banners]);
    }
    public function CmsAddress()
    {
        $add = CMSAddress::latest()->first();
        return response()->json(['add' => $add]);
    }
}
