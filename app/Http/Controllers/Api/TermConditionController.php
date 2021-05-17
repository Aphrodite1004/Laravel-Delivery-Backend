<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;


class TermConditionController extends Controller
{

   public function termcondition(Request $request)
    {  
        $termcondition = DB::table('termcondition')
                        ->where('id','4')
                        ->select('termcondition')
                       ->get();
    
         if($termcondition){
            $message = array('status'=>'1', 'message'=>'Term & Condition', 'data'=>$termcondition);
            return $message;
            }
        else{
            $message = array('status'=>'0', 'message'=>'Something went Wrong', 'data'=>[]);
            return $message;
        }
    }
    
     public function support(Request $request)
    {  
        $created_at = Carbon::now();
        $user_id = $request->user_id;
        $user_number =$request->user_number;
        $message =$request->message;
        $support = DB::table('support_queries')
                       ->insert([
                                'user_id'=>$user_id,
                                'phone_number'=>$user_number,
                                'message'=>$message,
                                'query_date'=>$created_at,
                                ]);
    
         if($support){
            $message = array('status'=>'1', 'message'=>'Thanks for Valuable Feedback', 'data'=>$support);
            return $message;
            }
        else{
            $message = array('status'=>'0', 'message'=>'Something went Wrong', 'data'=>[]);
            return $message;
        }
    }
    
    public function aboutus(Request $request)
    {  
        $about = DB::table('termcondition')
                        ->where('id','6')
                         ->select('termcondition')
                       ->get();
    
         if($about){
            $message = array('status'=>'1', 'message'=>'About Us', 'data'=>$about);
            return $message;
            }
        else{
            $message = array('status'=>'0', 'message'=>'Something went Wrong', 'data'=>[]);
            return $message;
        }
    }
    
}    