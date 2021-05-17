<?php

namespace App\Composers;

use DB;
use Session;

/**
 * 
 */
class VendorComposer
{
	
	public function compose($view)
	{
		if(Session::has('vendor')){
			$vendor_email = Session::get('vendor');

			$adminData = DB::table('vendor')
							->where('vendor_email', $vendor_email)
							->first();

			$view->with('vendor_name', $adminData->vendor_name)
				 ->with('vendor_logo', $adminData->vendor_logo)
				 ->with('vendor_email', $adminData->vendor_email);
		}
	}
}