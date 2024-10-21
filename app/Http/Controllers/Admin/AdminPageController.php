<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AdminPageController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }
    public function index(){
        return view('admin.adminlogin');
    }
    public function authenticate(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if($validator->passes()){  
            if(Auth::guard('admin')->attempt(['email' =>$request->email,'password'=>$request->password],$request->get('remember'))){
               
                $admin = Auth::guard('admin')->user();

                if($admin->utype == 'ADM'){
                    return redirect()->route('admin.admindashboard');
                }
                else{
                     Auth::guard('admin')->logout();

                    return redirect()->route('admin.adminlogin')->with('error','You are not authorized to access this admin panel');

                }
            }else{

                return redirect()->route('admin.adminlogin')->with('error','Either Email/Password is incorrect');

            }

        }else{
            return redirect()->route('admin.adminlogin')
            ->withErrors($validator)
            ->withInput($request->only('email'));
        }

    }
   
}
