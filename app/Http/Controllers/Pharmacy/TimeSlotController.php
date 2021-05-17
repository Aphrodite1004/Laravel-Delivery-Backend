<?php

namespace App\Http\Controllers\Pharmacy;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class TimeSlotController extends Controller
{

    public function pharmacytimeslot(Request $request)
    {
          $vendor_email=Session::get('vendor');
        
                    $vendor=DB::table('vendor')
                    ->where('vendor_email',$vendor_email)
                    ->first();
       
        
        $city = DB::table('time_slot')
                ->where('vendor_id',$vendor->vendor_id)
                    ->first();
                
                
        return view('pharmacy.time_slot.time_slot', compact("vendor_email",'vendor','city'));    
        
        
    }

    
    public function pharmacytimeslotupdate(Request $request)
    {
        $time_slot_id = $request->time_slot_id;
        $open_hrs = $request->open_hour;
        $close_hrs = $request->close_hour;
        $interval = $request->time_slot;
        

         $insert = DB::table('time_slot')
                    ->where('time_slot_id',$time_slot_id)
                    ->update([
                        'open_hour'=>$open_hrs,
                        'close_hour'=>$close_hrs,
                        'time_slot'=>$interval
                        ]);
     
         return redirect()->back()->withSuccess('Updated Successfully');

    }

}