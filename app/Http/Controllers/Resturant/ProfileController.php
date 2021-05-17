<?php

namespace App\Http\Controllers\Resturant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Hash;

class ProfileController extends Controller
{
    public function resturantProfile(Request $request)
    {
       
     if(Session::has('vendor'))
     {
    	 $vendor_email=Session::get('vendor');
    	 $profile= DB::table('vendor')
    	 		   ->where('vendor_email',$vendor_email)
    	 		   ->first();
    	
           return view('resturant.profile',compact("vendor_email","profile"));
    }
	else
	 {
	    return redirect()->route('vendorlogin')->withErrors('please login first');
	 }  

    }
   
    public function resturantEditvendor(Request $request)
    {
       
         $vendor_email=Session::get('vendor');
         $vendor_id=$request->id;
         $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();

          $logo= DB::table('logo')
            ->first();
            
     
               
         return view('resturant.editvendor.editvendor',compact("vendor_email","vendor_id","vendor"));
    }

    public function resturantvendorUpdateProfile(Request $request)
    {
       
     if(Session::has('vendor'))
     {
        
        $vendor_id = $request->id;
        $vendor_name = $request->vendor_name;
        $vendor_email = $request->vendor_email;
        $old_vendor_image = $request->old_vendor_image;
        $vendor_pass = $request->vendor_pass;
        $vendor_phone = $request->vendor_phone;
        $password2 = $request->password2;
        $updated_at = date("d-m-y h:i a");
        $date=date('d-m-y');
        if($vendor_pass!=$password2){
            return redirect()->back()->withErrors('password are not same');
        }
        else{
        $this->validate(
            $request,
                [
                    'vendor_name' => 'required',
                    'vendor_email' => 'required',
                    'vendor_image' => 'mimes:jpeg,png,jpg|max:400',
                    'old_vendor_image'=>'required',
                ],
                [
                    'vendor_name.required' => 'Enter your name.',
                    'vendor_email.required' => 'Enter new email.',
                    'old_vendor_image.required' => 'choose profile picture.',
                ]
        );

        $getImage = DB::table('vendor')
                        ->where('vendor_id', $vendor_id)
                        ->first();

        $image = $getImage->vendor_logo;  

        if($request->hasFile('vendor_image')){
             if(file_exists($image)){
                unlink($image);
            }
            $vendor_image = $request->vendor_image;
            $fileName = date('dmyhisa').'-'.$vendor_image->getClientOriginalName();
            $fileName = str_replace(" ", "-", $fileName);
            $vendor_image->move('images/vendor/profile/'.$date.'/', $fileName);
            $vendor_image = 'images/vendor/profile/'.$date.'/'.$fileName;
        }
        else{
            $vendor_image = $old_vendor_image;
        }
        if($vendor_pass!="" && $password2!="")
        {
            if($vendor_pass!=$password2){
                return redirect()->back()->withErrors('password are not same');
            }
            else
            {
                $new_pass=Hash::make($vendor_pass);
                $value=array('vendor_name'=>$vendor_name, 'vendor_email'=>$vendor_email, 'vendor_logo'=>$vendor_image,'vendor_pass' =>$new_pass, 'vendor_phone'=>$vendor_phone);
            }
            
        }
        else
        {
            $value=array('vendor_name'=>$vendor_name, 'vendor_email'=>$vendor_email, 'vendor_logo'=>$vendor_image, 'vendor_phone'=>$vendor_phone);
        }
        
        $vendorChangeProfile = DB::table('vendor')
        ->where('vendor_id', $vendor_id)
        ->update($value);
        if($vendorChangeProfile){

             session::put('vendor',$vendor_email);

            return redirect()->back()->withErrors('profile updated successfully');
        }
        else{
            return redirect()->back()->withErrors("something wents wrong.");
        }
	 }
    }  
}

    public function resturantvendorChangePass(Request $request)
    {
       
     if(Session::has('vendor'))
     {
    
        $vendor_email=Session::get('vendor');
         $pass= DB::table('vendor')
                   ->where('vendor_email',$vendor_email)
                   ->first();
        
           return view('resturant.change_pass',compact("vendor_email","pass"));
    }
	else
	 {
	    return redirect()->route('vendorlogin')->withErrors('please login first');
	 }   
    }
    
   public function resturantvendorChangePassword(Request $request)
    {
       
      if(Session::has('vendor'))
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

        $vendor_id = $request->id;
        $current_pass = $request->current_pass;

        $getvendor = DB::table('vendor')
                    ->where('vendor_id', $vendor_id)
                    ->first();

        if(Hash::check($current_pass,$getvendor->vendor_pass))
            {
            $new_pass = Hash::make($request->new_pass);
            $updated_at = date("d-m-y h:i a");

            $vendorChangePassword = DB::table('vendor')
                                    ->where('vendor_id', $vendor_id)
                                    ->update(['vendor_pass'=>$new_pass,'updated_at'=>$updated_at]);

            if($vendorChangePassword)
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
	    return redirect()->route('vendorlogin')->withErrors('please login first');
	 }
     }
     public function resturantvendorLogout(Request $request)
     {
      if(Session::has('vendor'))
     {
          $request->session()->flush();
           return redirect()->route('resturantlogin');
	 }
	else
	 {
	    return redirect()->route('vendorlogin')->withErrors('please login first');
	 }
     }
}

 