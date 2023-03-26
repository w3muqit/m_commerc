<?php

namespace App\Http\Controllers;

use App\Models\coupon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;
use Str;
use Image;
use Illuminate\Support\Carbon;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    function user(){
        $users=user::all();
        return view('admin.users.user',[
            'user'=>$users,
        ]);
    }

    function profile(){
        return view('admin.users.edit_profile');
    }

    function edit_profile(Request $request){
        user::find(Auth::id())->update([
            'name'=>$request->name,
            'email'=>$request->email,
        ]);
        return back();
    }

    function edit_password(Request $request){
        $request->validate([
            'old_password'=>'required',
            'password'=>'required|confirmed',
            'password_confirmation'=>'required',
        ]);

        if(Hash::check($request->old_password, Auth::user()->password)){

        user::find(Auth::id())->update([
            'password'=>bcrypt($request->password),
        ]);
        return back();
        }
        else{
            return back()->with('warning','old password dose not match');
        }
    }

    function edit_photo(Request $request){
        $request->validate([
            'photo'=>'required|file|max:512|mimes:jpg,bmp,png,webp',
        ]);

        $profile_photo=Auth::user()->photo;
       if($profile_photo==null){
            $photo=$request->photo;
            $extension=$photo->GetClientOriginalExtension();
            $file_name=Str::random(8).rand(10,60).Auth::user()->id.'.'.$extension;
            $image = Image::make($photo)->resize(300, 200)->save(public_path('upload/user/'.$file_name));

            user::find(Auth::id())->update([
                'photo'=>$file_name,
            ]);
            return back();
       }

       else{

        $delete_from=public_path('upload/user/'.$profile_photo);
        unlink($delete_from);


           $photo=$request->photo;
            $extension=$photo->GetClientOriginalExtension();
            $file_name=Str::random(8).rand(10,60).Auth::user()->id.'.'.$extension;
            $image = Image::make($photo)->resize(300, 200)->save(public_path('upload/user/'.$file_name));

            user::find(Auth::id())->update([
                'photo'=>$file_name,
            ]);
            return back();

       }
    }


    function user_delete($user_id){
        user::find($user_id)->delete();
        return back();
     }

     function coupon(){
        $coupons=coupon::all();
        return view('admin.cupon.coupon',[
            'coupon'=>$coupons,
        ]);
     }

     function coupon_store(Request $request){
        coupon::insert([
            'coupon_name'=>$request->coupon,
            'discount'=>$request->discount,
            'type'=>$request->type,
            'expire'=>$request->expire,
            'created_at'=>carbon::Now(),
        ]);
        return back();
     }
}
