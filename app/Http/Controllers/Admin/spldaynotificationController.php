<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;

class spldaynotificationController extends Controller
{
    public function splnotification(Request $request)
    {
    	$spldaynotification = DB::table('spldaynotification')
    	                 ->join('spldays', 'spldaynotification.spldays_id', '=', 'spldays.spldays_id')
    	                 ->join('tbl_user', 'spldaynotification.user_id','=', 'tbl_user.user_id')
    			         ->get();
        
        $message=array('title' => 'GoSubscribe', 'body' => $spldaynotification -> wishmsg ,'sound'=>'Default','image'=>'Notification Image');



          $q = $this->db->query("Select device_id from tbl_user");
                $registers = $q->result();
          foreach($registers as $regs){
                 if($regs->device_id!=""){
                         $registatoin_ids[] = $regs->device_id;
                         $result = $gcm->send_notification($regs->device_id, $message,"android");
                 }
          }
        
    }
}