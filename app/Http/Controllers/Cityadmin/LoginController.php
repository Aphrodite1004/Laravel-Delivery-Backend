<?php

namespace App\Http\Controllers\Cityadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Hash;

class LoginController extends Controller
{
	public function cityadminlogin(Request $request)
    {
        return view('cityadmin.login');
    }
    public function checkcityadminLogin(Request $request)
    {
    	$cityadmin_email=$request->cityadmin_email;
    	$cityadmin_pass=$request->cityadmin_pass;

    	$this->validate(
         $request,
         [
         		'cityadmin_email'=>'required',
         		'cityadmin_pass'=>'required',
         ],
         [

         	'cityadmin_email.required'=>'Enter E-Mail',
         	'cityadmin_pass.required'=>'Enter the password',
         ]

);
    	$checkcityadminLogin = DB::table('cityadmin')
    	                   ->where('cityadmin_email',$cityadmin_email)
    	                   ->first();


    	if($checkcityadminLogin){

         if(Hash::check($cityadmin_pass,$checkcityadminLogin->cityadmin_pass)){
           session::put('cityadmin',$checkcityadminLogin->cityadmin_email);
           return redirect()->route('cityadmin-index');
         }
         else
         {
         	return redirect()->route('cityadminlogin')->withErrors('wrong password');
         }
    	}
    	else
    	{
             return redirect()->route('cityadminlogin')->withErrors('invalid email and password');
    	}

    }
    
}
