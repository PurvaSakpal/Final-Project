<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\User;
// use Tymon\JWTAuth\Facades\JWTAuth;
// use Tymon\JWTAuth\Exceptions\JWTException;
// use Tymon\JWTAuth\Facades\JWTFactory;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function AddUser(){
        $roles=Role::all();
        return view('users.AddUser',compact('roles'));
    }
    public function ShowUser(){
        $users = User::all()->except(Auth::id());
        $roles=Role::all();
        return view('Users.ShowUser',compact('users','roles'));
    }
    public function PostAddUser(Request $req){
        $validate=$req->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation'=>['required'],
            'role_id' => ['required'],
            'status' => ['required']
        ]);
        if($validate){
            $firstname=$req->firstname;
            $lastname=$req->lastname;
            $email=$req->email;
            $password=$req->password;
            $status=$req->status;
            $role_id=$req->role_id;
            try{
            $user=new User();
            $user->first_name=$firstname;
            $user->last_name=$lastname;
            $user->email=$email;
            $user->password=Hash::make($password);
            $user->status=$status;
            $user->role_id=$role_id;
            if($user->save()){
                return back()->with('success',"User created successfully");
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            // dd($ex->getMessage());
            return back()->with('error',dd($ex->getMessage()));
            // Note any method of class PDOException can be called on $ex.
          }
            // else{
            //     return back()->with('error',"Error while creating user");
            // }
        }
    }
    public function EditUser($id){
        $user=User::whereId($id)->first();
        $roles=Role::all();
        return view('Users.EditUser',compact('user','roles'));
    }
    public function PostEditUser(Request $req){
        $id=$req->user_id;
        $validate=$req->validate([
            'firstname'=>'required|string|min:2|max:20',
            'lastname'=>'required|string|min:2|max:20',
            // 'email'=>'required|email',
            // 'email'=>'unique:users,'.$this->id,
            'role_id'=>'required',
            'status'=>'required'
        ]);
        if($validate)
        {
            try{
            User::where('id',$id)->update([
                'first_name'=> $req->firstname,
                'last_name'=> $req->lastname,
                'email'=> $req->email,
                'status'=> $req->status,
                'role_id'=> $req->role_id
            ]);
            return back()->with('success',"User updated successfully");
        }
        catch(\Illuminate\Database\QueryException $ex){
            dd($ex->getMessage());
            // Note any method of class PDOException can be called on $ex.
          }
        }
    }
    public function DeleteUser(Request $req){
        User::whereId($req->uid)->delete();
        return back()->with('success',"User Deleted Successfully");
    }
}
