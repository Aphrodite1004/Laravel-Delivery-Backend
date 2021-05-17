<?php

namespace App\Http\Controllers\Parcel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class ChargeController extends Controller
{
    public function chargeslist(Request $request)
    {
      $admin_email=Session::get('vendor');
      $admin=DB::table('vendor')->where('vendor_email',$admin_email)->first();
        $data['charges']= DB::table('parcel_charges')->where('vendor_id',$admin->vendor_id)
        ->get();
        return view('parcel.charges.list',$data);
    }
    
    public function addcharge(Request $request)
    {
      $admin_email=Session::get('vendor');
      $admin=DB::table('vendor')->where('vendor_email',$admin_email)->first();
        $data['cities']= DB::table('parcel_city')->where('vendor_id',$admin->vendor_id)->get();
        return view('parcel.charges.add',$data);
    }
    

    public function addchargesave(Request $request)
    {
       
        if(Session::has('vendor'))
        {
			
      $this->validate(
            $request,[
                    'city_from'=>'required',
                    
                    'parcel_charge'=>'required',
                ],[
                    'city_from.required'=>'City From required',

                    'parcel_charge.required'=>'Parcel Charges Required',
                ]);

        $city_from = $request->city_from;

        $parcel_charge = $request->parcel_charge;
        $charge_description = $request->charge_description;

        $admin_email=Session::get('vendor');
        $admin=DB::table('vendor')->where('vendor_email',$admin_email)->first();

        $insert = DB::table('parcel_charges')->insert([
                       'city_from'=>$city_from,

                       'parcel_charge'=>$parcel_charge,
                       'charge_description'=>$charge_description,
                       'vendor_id'=>$admin->vendor_id
				   ]);
     
            return redirect()->back()->withErrors('Added Successfully');
        }
       else
          {
            return redirect()->route('parcellogin')->withErrors('please login first');
          }

    }
    
    
    public function editcharge(Request $request)
    {
      $admin_email=Session::get('vendor');
      $admin=DB::table('vendor')->where('vendor_email',$admin_email)->first();
		$charge_id=$request->id;
		$data['cities']= DB::table('parcel_city')->where('vendor_id',$admin->vendor_id)->get();
		$data['charge']= DB::table('parcel_charges')->where('charge_id',$charge_id)->first();
		$data['charge_id'] = $charge_id;
		return view('parcel.charges.edit',$data);
    }

    public function updatecharge(Request $request)
    {
	if(Session::has('vendor'))
     {
      $this->validate(
            $request,[
                    'city_from'=>'required',

                    'parcel_charge'=>'required',
                ],[
                    'city_from.required'=>'City From required',

                    'parcel_charge.required'=>'Parcel Charges Required',
                ]);

		$charge_id=$request->id;
        $city_from = $request->city_from;

        $parcel_charge = $request->parcel_charge;
        $charge_description = $request->charge_description;

        $admin_email=Session::get('vendor');
        $admin=DB::table('vendor')->where('vendor_email',$admin_email)->first();

        $update = DB::table('parcel_charges')->where('charge_id', $charge_id)
                 ->update([
                       'city_from'=>$city_from,

                       'parcel_charge'=>$parcel_charge,
                       'charge_description'=>$charge_description,
                       'vendor_id'=>$admin->vendor_id
				   ]);
        if($update){
            return redirect()->back()->withErrors(' Updated Successfully');
        } else{
            return redirect()->back()->withErrors("something wents wrong.");
        }
     }
     else
      {
        return redirect()->route('parcellogin')->withErrors('please login first');
      }
    }
  public function deletecharge(Request $request)
    {
        
        $charge_id=$request->id;

        $getfile=DB::table('parcel_charges')
                ->where('charge_id',$charge_id)
                ->first();


    	$delete=DB::table('parcel_charges')->where('charge_id',$charge_id)->delete();
        if($delete)
        {
         return redirect()->back()->withSuccess('Deleted Successfully');
            }
   
        else
        {
           return redirect()->back()->withErrors('Unsuccessfull Delete'); 
        }

    }
	

}


