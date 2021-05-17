<?php

namespace App\Http\Controllers\Cityadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Hash;

class ProfileController extends Controller
{
    public function cityadminProfile(Request $request)
    {
     if(Session::has('cityadmin'))
     {
    	 $cityadmin_email=Session::get('cityadmin');
    	 $profile= DB::table('cityadmin')
    	 		   ->where('cityadmin_email',$cityadmin_email)
    	 		   ->first();
    	
           return view('cityadmin.profile',compact("cityadmin_email","profile"));
    }
	else
	 {
	    return redirect()->route('cityadminlogin')->withErrors('please login first');
	 }  

    }
   

    public function cityadminUpdateProfile(Request $request)
    {
       
     if(Session::has('cityadmin'))
     {
        $cityadmin_id = $request->id;
        $cityadmin_name = $request->cityadmin_name;
        $cityadmin_email = $request->cityadmin_email;
        $old_cityadmin_image = $request->old_cityadmin_image;
        $updated_at = date("d-m-y h:i a");
        $date=date('d-m-y');
        
        $this->validate(
            $request,
                [
                    'cityadmin_name' => 'required',
                    'cityadmin_email' => 'required',
                    'cityadmin_image' => 'mimes:jpeg,png,jpg|max:400',
                    'old_cityadmin_image'=>'required',
                ],
                [
                    'cityadmin_name.required' => 'Enter your name.',
                    'cityadmin_email.required' => 'Enter new email.',
                    'old_cityadmin_image.required' => 'choose profile picture.',
                ]
        );

        $getImage = DB::table('cityadmin')
                        ->where('cityadmin_id', $cityadmin_id)
                        ->first();

        $image = $getImage->cityadmin_image;  

        if($request->hasFile('cityadmin_image')){
             if(file_exists($image)){
                unlink($image);
            }
            $cityadmin_image = $request->cityadmin_image;
            $fileName = date('dmyhisa').'-'.$cityadmin_image->getClientOriginalName();
            $fileName = str_replace(" ", "-", $fileName);
            $cityadmin_image->move('images/cityadmin/profile/'.$date.'/', $fileName);
            $cityadmin_image = 'images/cityadmin/profile/'.$date.'/'.$fileName;
        }
        else{
            $cityadmin_image = $old_cityadmin_image;
        }

        $cityadminChangeProfile = DB::table('cityadmin')
                                ->where('cityadmin_id', $cityadmin_id)
                                ->update(['cityadmin_name'=>$cityadmin_name, 'cityadmin_email'=>$cityadmin_email, 'cityadmin_image'=>$cityadmin_image, 'updated_at'=>$updated_at]);

        if($cityadminChangeProfile){

             session::put('cityadmin',$cityadmin_email);

            return redirect()->back()->withErrors('profile updated successfully');
        }
        else{
            return redirect()->back()->withErrors("something wents wrong.");
        }
	 }
	else
	 {
	    return redirect()->route('cityadminlogin')->withErrors('please login first');
	 }
    }

    public function cityadminChangePass(Request $request)
    {
       
     if(Session::has('cityadmin'))
     {
        
        $cityadmin_email=Session::get('cityadmin');
         $pass= DB::table('cityadmin')
                   ->where('cityadmin_email',$cityadmin_email)
                   ->first();
        
           return view('cityadmin.change_pass',compact("cityadmin_email","pass"));
    }
	else
	 {
	    return redirect()->route('cityadminlogin')->withErrors('please login first');
	 }   
    }
    
   public function cityadminChangePassword(Request $request)
    {
       
      if(Session::has('cityadmin'))
     {
        
        $this->validate(
            $request,
                [
                    'current_pass' => 'required',
                    'new_pass' => 'required',
                ],
                [
                    'current_pass.required' => 'Enter current password.',
                    'new_pass.required' => 'Enter new password.',
                ]
           );

        $cityadmin_id = $request->id;
        $current_pass = $request->current_pass;

        $getcityadmin = DB::table('cityadmin')
                    ->where('cityadmin_id', $cityadmin_id)
                    ->first();

        if(Hash::check($current_pass,$getcityadmin->cityadmin_pass))
            {
            $new_pass = Hash::make($request->new_pass);
            $updated_at = date("d-m-y h:i a");

            $cityadminChangePassword = DB::table('cityadmin')
                                    ->where('cityadmin_id', $cityadmin_id)
                                    ->update(['cityadmin_pass'=>$new_pass,'updated_at'=>$updated_at]);

            if($cityadminChangePassword)
            {
                

                return redirect()->back()->withErrors("password changed! login again.");
            }
            else{
                return redirect()->back()->withErrors("something wents wrong.");
            }
        }
        else{
            return redirect()->back()->withErrors("current password does not match.");
        }
	 }
	else
	 {
	    return redirect()->route('cityadminlogin')->withErrors('please login first');
	 }
     }
     public function cityadminLogout(Request $request)
     {
         
      if(Session::has('cityadmin'))
     {
          $request->session()->flush();
           return redirect()->route('cityadminlogin');
	 }
	else
	 {
	    return redirect()->route('cityadminlogin')->withErrors('please login first');
	 }
     }
}

 