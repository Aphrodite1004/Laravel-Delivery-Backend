<?php
use Illuminate\Support\Facades\Route;
//login
Route::group(['namespace'=>'Admin', 'prefix'=>'admin'],function(){
    Route::get('/', 'LoginController@login')->name('login');
    Route::post('/checklogin', 'LoginController@checkAdminLogin')->name('check-admin-login');
});
 
Route::group(['namespace'=>'Admin',['middleware' => ['per','bamaAdmin']], 'prefix'=>'admin'],function(){
    //Meenu
     
    /// for home
    Route::get('index', 'HomeController@adminIndex')->name('admin-index');
     
    //for admin profile
    Route::get('profile', 'ProfileController@adminProfile')->name('admin-profile');
    
     // Route::post('update/profile/{id}', 'ProfileController@adminUpdateProfile')->name('update-admin-profile');
    Route::get('admin/edit/{id}','ProfileController@Editadmin')->name('edit-admin');
    Route::post('update/profile/{id}','ProfileController@adminUpdateProfile')->name('update-admin');
    Route::get('password','ProfileController@adminChangePass')->name('change_pass');
    Route::post('password/change/{id}','ProfileController@adminChangePassword')->name('admin-change-pass');
    Route::get('logout','ProfileController@adminLogout')->name('admin-logout');
    
    //city 
    Route::get('city','CityController@city')->name('city');
    Route::get('city/add','CityController@Addcity')->name('addcity');
    Route::post('city/add/insert','CityController@AddInsertcity')->name('insert-city');
    Route::get('city/edit/{id}','CityController@Editcity')->name('edit-city');
    Route::post('city/update/{id}','CityController@Updatecity')->name('update-city');
    Route::get('city/delete/{id}','CityController@Deletecity')->name('delete-city');
      
    //vendor category 
    Route::get('vendorlist','VendorCategoryController@vendorlist')->name('vendorlist');
    Route::get('addvendor','VendorCategoryController@addvendor')->name('addvendor');
    Route::post('addnewvendor','VendorCategoryController@addnewvendor')->name('addnewvendor');
    Route::get('editvendor/{vendor_category_id}','VendorCategoryController@editvendor')->name('editvendor');
    Route::post('updatevendor/{vendor_category_id}','VendorCategoryController@updatevendor')->name('updatevendor');
    Route::get('deletevendor/{vendor_category_id}','VendorCategoryController@deletevendor')->name('deletevendor');
      
    //logo 
    Route::get('logo/edit','logoController@Editlogo')->name('edit-logo');
    Route::post('logo/update','logoController@Updatelogo')->name('update-logo');
      
    // admin banner     
    Route::get('adminbanner','BannerController@banner')->name('adminbanner');
    Route::get('addbanner','BannerController@addbanner')->name('addbanner');
    Route::post('addnewbanner','BannerController@addnewbanner')->name('addnewbanner');
    Route::get('editbanner/{banner_id}','BannerController@editbanner')->name('editbanner');
    Route::post('updatebanner/{banner_id}','BannerController@updatebanner')->name('updatebanner');
    Route::get('deletebanner/delete/{id}','BannerController@deletebanner')->name('deletebanner');
    
    // for cityadmin
    Route::get('cityadmin','cityadminController@cityadmin')->name('cityadmin');
    Route::get('cityadmin/add','cityadminController@Addcityadmin')->name('add-cityadmin');
    Route::post('cityadmin/add/new','cityadminController@AddNewcityadmin')->name('AddNewcityadmin');
    Route::get('cityadmin/edit/{id}','cityadminController@Editcityadmin')->name('edit-cityadmin');
    Route::post('cityadmin/update/{id}','cityadminController@Updatecityadmin')->name('update-cityadmin');
    Route::get('cityadmin/delete/{id}','cityadminController@deletecityadmin')->name('delete-cityadmin');
    Route::get('secretlogin/{id}','cityadminController@secretlogin')->name('secret-login');
    Route::get('cityadminvendorlist/{id}','cityadminController@vendorlist')->name('cityadminvendorlist');
    Route::get('secretloginvendor/{id}','cityadminController@secretloginvendor')->name('secretloginvendor');
    Route::get('admincommission/{id}','cityadminController@admincommission')->name('admincommission');
    
     
    // for Member Plan
    Route::get('all_plan','Membership_plan@all_plan')->name('all_plan');
    Route::get('add_plan','Membership_plan@AddPlan')->name('add_plan');
    Route::post('insert_plan','Membership_plan@InsertPlan')->name('InsertPlan');
    Route::get('edit_plan/{id}','Membership_plan@EditPlan')->name('EditPlan');
    Route::post('update_plan/{plan_id}','Membership_plan@UpdatePlan')->name('UpdatePlan');
    Route::get('delete_paln/{id}','Membership_plan@DeletePaln')->name('DeletePaln');
    
     
    // for User Management
    Route::get('users','UsermanageContoller@allusers')->name('alluser');
    Route::get('users/edit/{id}','UsermanageContoller@edituser')->name('edit-users');
    Route::post('users/update/{id}','UsermanageContoller@Updateuser')->name('update-users');
    Route::get('users/delete/{id}','cityadminController@deletecityadmin')->name('delete-cityadmin');
    // for wallet_credits
    
    Route::get('amountlist','WalletController@amountlist')->name('amountlist');
    Route::get('wallet_amount','WalletController@wallet_amount')->name('wallet_amount');
    Route::post('wallet_amount_add','WalletController@wallet_amount_add')->name('wallet_amount_add');
    Route::get('plan_delete/{plan_id}','WalletController@plan_delete')->name('plan_delete'); 
    
    Route::get('offer_list','WalletController@offer_list')->name('offer_list');
    Route::get('offer_amount','WalletController@offer_amount')->name('offer_amount');
    Route::post('offer_amount_add','WalletController@offer_amount_add')->name('offer_amount_add');
    Route::get('offer_delete/{wallet_id}','WalletController@offer_delete')->name('offer_delete'); 
    
    //currency 
    Route::get('currency','currencyController@currency')->name('currency');
    Route::get('currency/edit/{id}','currencyController@Editcurrency')->name('edit-currency');
    Route::post('currency/update/{id}','currencyController@Updatecurrency')->name('update-currency');
      
   
    //delivery_timing 
    Route::get('delivery_timing','delivery_timingController@delivery_timing')->name('delivery_timing');
    Route::get('delivery_timing/edit/{id}','delivery_timingController@Editdelivery_timing')->name('edit-delivery_timing');
    Route::post('delivery_timing/update/{id}','delivery_timingController@Updatedelivery_timing')->name('update-delivery_timing');   
   
      
    //for manage spldays
    Route::get('spldays','spldaysController@spldays')->name('spldays');
    Route::get('spldays/add','spldaysController@adminAddspldays')->name('adminAddspldays');
    Route::post('spldays/add/new','spldaysController@adminAddNewspldays')->name('adminAddNewspldays');
    Route::get('spldays/edit/{spldays_id}','spldaysController@adminEditspldays')->name('adminEditspldays');
    Route::post('spldays/update/{spldays_id}','spldaysController@adminUpdatespldays')->name('adminUpdatespldays');
    Route::get('spldays/delete/{spldays_id}','spldaysController@adminDeletespldays')->name('adminDeletespldays'); 
 
    //for manage plans
    Route::get('plan','PlanController@plan')->name('plan');
    Route::get('plan/add','PlanController@adminAddplan')->name('adminAddplan');
    Route::post('plan/add/new','PlanController@adminAddNewplan')->name('adminAddNewplan');
    Route::get('plan/edit/{plan_id}','PlanController@adminEditplan')->name('adminEditplan');
    Route::post('plan/update/{plan_id}','PlanController@adminUpdateplan')->name('adminUpdateplan');
    Route::get('plan/delete/{plan_id}','PlanController@adminDeleteplan')->name('adminDeleteplan');

    // for reward
	Route::get('RewardList','RewardController@RewardList')->name('RewardList');
	Route::get('reward','RewardController@reward')->name('reward');
	Route::post('rewardadd','RewardController@rewardadd')->name('rewardadd');
	Route::get('rewardedit/{reward_id}','RewardController@rewardedit')->name('rewardedit');
	Route::post('rewardupate','RewardController@rewardupate')->name('rewardupate');
	Route::get('rewarddelete/{reward_id}','RewardController@rewarddelete')->name('rewarddelete');
	
	// for reedem
	Route::get('reedem','RedeemController@reedem')->name('reedem');
	Route::post('reedemupdate','RedeemController@reedemupdate')->name('reedemupdate');
	 
	// App Reffer
	Route::get('reffer','AppRefferController@reffer')->name('reffer');
	Route::post('refferupdate','AppRefferController@refferupdate')->name('refferupdate');
 	   
    //for manage Complain
    Route::get('complain','complainController@complain')->name('complain');
    Route::get('complain/add','complainController@adminAddcomplain')->name('adminAddcomplain');
    Route::post('complain/add/new','complainController@adminAddNewcomplain')->name('adminAddNewcomplain');
    Route::get('complain/edit/{complain_id}','complainController@adminEditcomplain')->name('adminEditcomplain');
    Route::post('complain/update/{complain_id}','complainController@adminUpdatecomplain')->name('adminUpdatecomplain');
    Route::get('complain/delete/{complain_id}','complainController@adminDeletecomplain')->name('adminDeletecomplain');	

    //for manage faq
    Route::get('faq','faqController@faq')->name('faq');
    Route::get('faq/add','faqController@adminAddfaq')->name('adminAddfaq');
    Route::post('faq/add/new','faqController@adminAddNewfaq')->name('adminAddNewfaq');
    Route::get('faq/edit/{faq_id}','faqController@adminEditfaq')->name('adminEditfaq');
    Route::post('faq/update/{faq_id}','faqController@adminUpdatefaq')->name('adminUpdatefaq');
    Route::get('faq/delete/{faq_id}','faqController@adminDeletefaq')->name('adminDeletefaq');
 	   
    //Term & Condition 
    Route::get('termcondition','TermConditionController@termcondition')->name('termcondition');
    Route::post('termconditionupdate/{id}','TermConditionController@termconditionupdate')->name('termconditionupdate');
    
    //About Us 
    Route::get('aboutus','TermConditionController@aboutus')->name('aboutus');
    Route::post('aboutusupdate/{id}','TermConditionController@aboutusupdate')->name('aboutusupdate');
    
    //Feedback
    Route::get('Feedback','TermConditionController@Feedback')->name('Feedback');
    
    //App Share 
    Route::get('termcondition','TermConditionController@termcondition')->name('termcondition');
    Route::post('termconditionupdate/{id}','TermConditionController@termconditionupdate')->name('termconditionupdate');
    
    //for manage cancel_reason
    Route::get('cancel_reason','cancel_reasonController@cancel_reason')->name('cancel_reason');
    Route::get('cancel_reason/add','cancel_reasonController@adminAddcancel_reason')->name('adminAddcancel_reason');
    Route::post('cancel_reason/add/new','cancel_reasonController@adminAddNewcancel_reason')->name('adminAddNewcancel_reason');
    Route::get('cancel_reason/edit/{res_id}','cancel_reasonController@adminEditcancel_reason')->name('adminEditcancel_reason');
    Route::post('cancel_reason/update/{res_id}','cancel_reasonController@adminUpdatecancel_reason')->name('adminUpdatecancel_reason');
    Route::get('cancel_reason/delete/{res_id}','cancel_reasonController@adminDeletecancel_reason')->name('adminDeletecancel_reason');	   	      
    
    
    
    //for notification
    Route::post('spldaynotification', 'spldaynotificationController@splnotification');
    
    //for admob
    Route::post('store/add/insert','StoreController@AddInsertStore')->name('adminAddNewStore');
    Route::get('store/edit/{store_id}','StoreController@EditStore')->name('edit-store');
    Route::post('store/update/{store_id}','StoreController@Updatestore')->name('update-store');
    Route::get('store/delete/{store_id}','StoreController@Deletestore')->name('delete-store');
     
    //for user
	Route::get('user','UserController@adminUser')->name('user'); 
	Route::get('user/add','UserController@adminAddUser')->name('addUser');
	Route::post('user/add/insert','UserController@adminAddUserNew')->name('AddUserNew');
	Route::get('user/edit/{user_id}','UserController@EditUser')->name('edit-user');
	Route::post('user/update/{user_id}','UserController@UpdateEdit')->name('update-user');
    Route::get('user/delete/{user_id}','UserController@adminDeleteUser')->name('delete-banner');
    
    
    // for first wallet recharge deal
    Route::get('deal','dealController@deal')->name('deal');
    Route::get('deal/add','dealController@Adddeal')->name('add-deal');
    Route::post('deal/add/new','dealController@AddNewdeal')->name('AddNewdeal');
    Route::get('deal/edit/{id}','dealController@Editdeal')->name('edit-deal');
    Route::post('deal/update/{id}','dealController@Updatedeal')->name('update-deal');
    Route::get('deal/delete/{id}','dealController@deletedeal')->name('delete-deal');
         
         
         
    //for manage paymentvia
    Route::get('paymentvia','paymentviaController@paymentvia')->name('paymentvia');
    Route::get('paymentvia/add','paymentviaController@adminAddpaymentvia')->name('adminAddpaymentvia');
    Route::post('paymentvia/add/new','paymentviaController@adminAddNewpaymentvia')->name('adminAddNewpaymentvia');
    Route::get('paymentvia/edit/{paymentvia_id}','paymentviaController@adminEditpaymentvia')->name('adminEditpaymentvia');
    Route::post('paymentvia/update/{paymentvia_id}','paymentviaController@adminUpdatepaymentvia')->name('adminUpdatepaymentvia');
    Route::get('paymentvia/delete/{paymentvia_id}','paymentviaController@adminDeletepaymentvia')->name('adminDeletepaymentvia');     
  
    //sms api
    Route::get('edit_sms_api', 'sms_apiController@edit_sms_api')->name('edit_sms_api');
    Route::post('update_sms_api', 'sms_apiController@update_sms_api')->name('update_sms_api');
    Route::post('twilio/update', 'sms_apiController@updatetwilio')->name('updatetwilio');
    Route::post('msgoff', 'sms_apiController@msgoff')->name('msgoff');
	 
    //FCM key
    Route::get('edit_fcm_api', 'Fcm_Controller@edit_fcm_api')->name('edit_fcm_api');
    Route::post('update_fcm_api', 'Fcm_Controller@update_fcm_api')->name('update_fcm');

    // country code
    Route::get('edit_countrycode', 'Fcm_Controller@edit_countrycode')->name('edit_countrycode');
    Route::post('update_countrycode', 'Fcm_Controller@update_countrycode')->name('update_countrycode');

    // firebase
    Route::get('edit_firebase', 'Fcm_Controller@edit_firebase')->name('edit_firebase');
    Route::post('update_firebase', 'Fcm_Controller@update_firebase')->name('update_firebase');
	 
    //for notification
    Route::get('adminNotification', 'notificationController@adminNotification')->name('adminNotification');
    Route::post('adminNotificationSend', 'notificationController@adminNotificationSend')->name('adminNotificationSend');
    
    //for vendor notification
    Route::get('Notification_to_store', 'notificationController@Notification_to_store')->name('Notification_to_store');
    Route::post('Notification_to_store_Send', 'notificationController@Notification_to_store_Send')->name('Notification_to_store_Send');    
    Route::get('map_api','SettingController@mapsettings')->name('mapapi');
    Route::post('map_api/update','SettingController@updategooglemap')->name('updatemap');
    Route::post('mapbox/update','SettingController@updatemapbox')->name('updatemapbox');
    Route::get('admincomission','ComissionController@admincomission')->name('admincomission');
    Route::post('adminsearchcomission','ComissionController@adminsearchcomission')->name('adminsearchcomission');
    Route::get('adminallexcelgenerator','ComissionController@adminallexcelgenerator')->name('adminallexcelgenerator');      
    Route::get('adminexcelgenerator/{startdate}/{enddate}/{vendor_id}', 'ComissionController@adminexcelgenerator')->name('adminexcelgenerator');
    Route::get('adminsendrequest/{com_id}','ComissionController@adminsendrequest')->name('adminsendrequest');
    Route::get('admin_notification', 'notificationController@admin_notification')->name('admin-notification');

    Route::get('vendorallexcelgenerator/{id}','cityadminController@vendorallexcelgenerator')->name('vendorallexcelgenerator');
    Route::post('vendorsearchcomission','cityadminController@vendorsearchcomission')->name('vendorsearchcomission');
    Route::get('vendorexcelgenerator/{startdate}/{enddate}/{vendor_id}', 'cityadminController@vendorexcelgenerator')->name('vendorexcelgenerator');
        
    //for multi-language
    Route::get('lang/home', 'LangController@index');
    Route::get('lang/change', 'LangController@change')->name('changeLang');
    
    // for payment
    Route::post('gateway_option/change','paymentviaController@gateway_status')->name('gateway_status');
    Route::post('payment_gateway/update','paymentviaController@updatepymntvia')->name('updategateway');  
});

	



/////////////////////////////////////////////////	
/////////////for Vendor//////////////////////
////////////////////////////////////////////////
Route::group(['namespace'=>'Vendor', 'prefix'=>'grocery'],function(){	
	Route::get('/', 'LoginController@vendorlogin')->name('vendorlogin');
    Route::post('/checklogin', 'LoginController@checkvendorLogin')->name('checkvendor-login');
});
    
Route::group(['namespace'=>'Vendor','middleware' =>'bamaVendor', 'prefix'=>'grocery'],function(){
    Route::get('index', 'HomeController@vendorIndex')->name('vendor-index');
    Route::get('complete_order_index', 'HomeController@complete_order')->name('complete_order_index');
    //Vendor logout
        Route::get('/vendor/edit/{id}','ProfileController@Editvendor')->name('vendor-edit');
        Route::post('update/profile/{id}','ProfileController@vendorUpdateProfile')->name('vendor-update');
        Route::get('logout','ProfileController@vendorLogout')->name('vendor-logout');

        Route::get('today_order_vendor','TodayOrderNewController@today_order_vendor')->name('today_order_vendor');
        Route::get('next_day','TodayOrderNewController@next_day')->name('next_day_order_vendor');
        Route::get('complete_order','TodayOrderNewController@complete_order')->name('complete_order');
        Route::post('assigned_order', 'TodayOrderNewController@assigned_order')->name('assigned_order');
        Route::get('cancel_order_grocery', 'TodayOrderNewController@cancel_order_grocery')->name('cancel_order_grocery');
        Route::post('assigned_vendor_order', 'DispatchvendorController@assignedvendor')->name('assigned_vendor_order');
           
        Route::get('incentive_order', 'Incentive_orderController@incentive_order')->name('incentive_order');
        Route::post('pay_incentive', 'Incentive_orderController@pay_incentive')->name('pay_incentive');
	    Route::get('edit_incentive_order', 'Incentive_orderController@edit_incentive_order')->name('edit_incentive_order');
	    Route::post('update_incentive_order', 'Incentive_orderController@update_incentive_order')->name('update_incentive_order');
	    
 	    // for banner
        Route::get('bannervendor','BannervendorController@bannervendor')->name('bannervendor');
        Route::get('Addbannervendor','BannervendorController@Addbannervendor')->name('Addbannervendor');
        Route::post('AddNewbannervendor','BannervendorController@AddNewbannervendor')->name('AddNewbannervendor');
        Route::get('Editbannervendor/{id}','BannervendorController@Editbannervendor')->name('Editbannervendor');
        Route::post('Updatebannervendor/{id}','BannervendorController@Updatebannervendor')->name('Updatebannervendor');
        Route::get('deletebannervendor/{id}','BannervendorController@deletebannervendor')->name('deletebannervendor');
         
        // for category 
        Route::get('vendorcategory','CategoryController@category')->name('vendorcategory');
        Route::get('vendorAddCategory','CategoryController@vendorAddCategory')->name('vendorAddCategory');
        Route::post('vendorAddNewCategory','CategoryController@vendorAddNewCategory')->name('vendorAddNewCategory');
        Route::get('vendorEditCategory/{category_id}','CategoryController@vendorEditCategory')->name('vendorEditCategory');
        Route::post('vendorUpdateCategory/{category_id}','CategoryController@vendorUpdateCategory')->name('vendorUpdateCategory');
        Route::get('vendorDeleteCategory/{category_id}','CategoryController@vendorDeleteCategory')->name('vendorDeleteCategory');
         
         // for sub-category
         
        Route::post('searchsubcat','subcatController@searchsubcat')->name('searchsubcat');
        Route::get('vendorsubcat','subcatController@vendorsubcat')->name('vendorsubcat');
        Route::get('vendorAddsubcat','subcatController@vendorAddsubcat')->name('vendorAddsubcat');
        Route::post('vendorAddNewsubcat','subcatController@vendorAddNewsubcat')->name('vendorAddNewsubcat');
        Route::get('vendorEditsubcat/{subcat_id}','subcatController@vendorEditsubcat')->name('vendorEditsubcat');
        Route::post('vendorUpdatesubcat/{subcat_id}','subcatController@vendorUpdatesubcat')->name('vendorUpdatesubcat');
        Route::get('vendordeletesubcat/{subcat_id}','subcatController@vendordeletesubcat')->name('vendordeletesubcat');
         // for Products
        
        Route::get('vendorproduct','ProductController@product')->name('vendorproduct');
        Route::get('vendoraddproduct','ProductController@Addproduct')->name('vendoraddproduct');
        Route::post('vendoraddnewproduct','ProductController@AddNewproduct')->name('vendoraddnewproduct');
        Route::get('vendoreditproduct/{product_id}','ProductController@Editproduct')->name('vendoreditproduct');
        Route::post('vendorupdateproduct/{product_id}','ProductController@Updateproduct')->name('vendorupdateproduct');
        Route::get('vendordeleteproduct/{product_id}','ProductController@vendordeleteproduct')->name('vendordeleteproduct');
        Route::post('searchproduct','ProductController@searchproduct')->name('searchproduct');
        
        // for Products variant 
        Route::get('varient/{id}','VarientController@varient')->name('varient');
        Route::get('Addproductvariant/{id}','VarientController@Addproductvariant')->name('Addproductvariant');
        Route::post('AddNewproductvariant','VarientController@AddNewproductvariant')->name('AddNewproductvariant');
        Route::get('Editproductvariant/{id}','VarientController@Editproductvariant')->name('Editproductvariant');
        Route::post('Updateproductvariant/{id}','VarientController@Updateproductvariant')->name('Updateproductvariant');
        Route::get('deleteproductvariant/{id}','VarientController@deleteproductvariant')->name('deleteproductvariant');
         
        Route::get('dealroduct', 'DealProductController@dealroduct')->name('dealroduct');
        Route::get('AddDealproduct','DealProductController@AddDealproduct')->name('AddDealproduct');
    	Route::post('AddNewDealproduct','DealProductController@AddNewDealproduct')->name('AddNewDealproduct');
    	Route::get('EditDealproduct/{id}','DealProductController@EditDealproduct')->name('EditDealproduct');
     	Route::post('UpdateDealproduct/{id}','DealProductController@UpdateDealproduct')->name('UpdateDealproduct');
     	Route::get('DeleteDealproduct/{id}','DealProductController@DeleteDealproduct')->name('DeleteDealproduct');
     	
     	// for bulk upload
     	Route::get('bulkup', 'BulkuploadController@bulkup')->name('bulkup');   
        Route::post('bulk_upload', 'BulkuploadController@import')->name('bulk_upload');
        Route::post('bulk_v_upload', 'BulkuploadController@import_varients')->name('bulk_v_upload');
     	Route::get('productdownload', 'BulkuploadController@productdownload');
     	Route::get('variantdownload', 'BulkuploadController@variantdownload');
         
        // for area
        Route::get('vendorarea','areaController@vendorarea')->name('vendorarea');
        Route::get('vendorAddarea','areaController@vendorAddarea')->name('vendorAddarea');
        Route::post('vendorAddInsertarea','areaController@vendorAddInsertarea')->name('vendorAddInsertarea');
        Route::get('vendorEditarea/{id}','areaController@vendorEditarea')->name('vendorEditarea');
        Route::post('vendorUpdatearea/{id}','areaController@vendorUpdatearea')->name('vendorUpdatearea');
        Route::get('vendorDeletearea/{id}','areaController@vendorDeletearea')->name('vendorDeletearea');
         
        // for coupon
        Route::get('couponlist','CouponController@couponlist')->name('couponlist');
        Route::get('vendorcoupon','CouponController@vendorcoupon')->name('vendorcoupon');
        Route::post('addcoupon','CouponController@addcoupon')->name('addcoupon');
        Route::get('editcoupon/{coupon_id}','CouponController@editcoupon')->name('editcoupon');
        Route::post('updatecoupon','CouponController@updatecoupon')->name('updatecoupon');
        Route::get('deletecoupon/{coupon_id}','CouponController@deletecoupon')->name('deletecoupon');
	 
        // for delivery time
        Route::get('timeslot','TimeSlotController@timeslot')->name('timeslot');
        Route::post('timeslotupdate','TimeSlotController@timeslotupdate')->name('timeslotupdate');
	 
	 
        // for delivery_boy
        Route::get('vendordelivery_boy','delivery_boyController@vendordelivery_boy')->name('vendordelivery_boy');
        Route::get('vendorAdddelivery_boy','delivery_boyController@vendorAdddelivery_boy')->name('vendorAdddelivery_boy');
        Route::post('vendorAddNewdelivery_boy','delivery_boyController@vendorAddNewdelivery_boy')->name('vendorAddNewdelivery_boy');
        Route::get('vendorEditdelivery_boy/{id}','delivery_boyController@vendorEditdelivery_boy')->name('vendorEditdelivery_boy');
        Route::post('vendorUpdatedelivery_boy/{id}','delivery_boyController@vendorUpdatedelivery_boy')->name('vendorUpdatedelivery_boy');
        Route::get('vendordeletedelivery_boy/{id}','delivery_boyController@vendordeletedelivery_boy')->name('vendordeletedelivery_boy');
        Route::get('vendorconfirmdeliverystatus/{id}/{status}', 'delivery_boyController@vendorconfirmdeliverystatus')->name('vendorconfirmdeliverystatus');
        
        // for order details
 	 
        Route::get('details','Today_OrderController@details')->name('details');
         
        Route::get('inventoryvendor', 'inventoryController@inventoryvendor')->name('inventoryvendor');
        Route::post('paycustomervendor/{order_complain_id}', 'inventoryController@paycustomervendor')->name('paycustomervendor');
          
        Route::get('dispatch_panelvendor', 'DispatchvendorController@dispatch_panelvendor')->name('dispatch_panelvendor');
        Route::post('assignedcashrequestvendor', 'DispatchvendorController@assignedcashrequestvendor')->name('assignedcashrequestvendor');
	     
	    Route::get('comission','ComissionController@comission')->name('comission');
	    Route::post('sendrequest/{com_id}','ComissionController@sendrequest')->name('sendrequest');
	    Route::post('searchcomission','ComissionController@searchcomission')->name('searchcomission');
        Route::get('allexcelgenerator','ComissionController@allexcelgenerator')->name('allexcelgenerator');
        Route::get('excelgenerator/{startdate}/{enddate}', 'ComissionController@excelgenerator')->name('excelgenerator');
	    Route::get('delivery_boy_comission','delivery_boy_comissionController@delivery_boy_comission')->name('delivery_boy_comission'); 
        Route::post('searchdeliveryboy','delivery_boy_comissionController@searchdeliveryboy')->name('searchdeliveryboy');
        Route::get('allexceldownload','delivery_boy_comissionController@allexceldownload')->name('allexceldownload');      
        Route::get('exceldownload/{startdate}/{enddate}', 'delivery_boy_comissionController@exceldownload')->name('exceldownload');
	            
	     Route::post('searchstock','TodayOrderNewController@searchstock')->name('searchstock');
	     Route::get('low_stock','TodayOrderNewController@low_stock')->name('low_stock');
	     Route::post('update_stock','TodayOrderNewController@update_stock')->name('update_stock');
	     
	       //for notification
     Route::get('vendor_notification', 'NotificationController@vendor_notification')->name('vendor-notification');
    Route::get('cityadmindelivery_boy','delivery_boyController@cityadmindelivery_boy')->name('cityadmindelivery_boy');
    
    Route::get('vendorsendrequest/{com_id}','ComissionController@vendorsendrequest')->name('vendorsendrequest');
    
    // order by Photo
    Route::get('user_list','Order_by_imageController@user_list')->name('user_list');
    
    
    Route::post('admin/reject/orderlist/{id}','Order_by_imageController@rejectorder')->name('admin_reject_orderphoto');
 	  
 	  
 	Route::get('store/makeorder/{id}','Order_by_imageController@sel_product')->name('store_accept_order');
 	Route::post('list/product/added/', 'Order_by_imageController@added_product')->name('listadded_product');
 	  	
 Route::get('list/product/delete_from_cart/{id}', 'Order_by_imageController@delete_product')->name('delete_product_from_cart');
 	  	
 	  	Route::post('list/product/add_qty/{id}', 'Order_by_imageController@add_qty')->name('add_qty_to_cart');
 	  	
 	  	Route::post('reject/order/{id}','Order_by_imageController@rejectorder')->name('store_reject_orderbyphoto');
 	  	   
 	  	Route::post('order/processed/{ord_id}','Order_by_imageController@checkout')->name('process_orderby');
         
     });
     
 
    
/////////////////////////////////////////////////	
/////////////for resturant//////////////////////
////////////////////////////////////////////////
Route::group(['namespace'=>'Resturant', 'prefix'=>'restaurant'],function(){	
	
	Route::get('/', 'RestaurantLoginController@resturantlogin')->name('resturantlogin');
    Route::post('/checkresturantLogin', 'RestaurantLoginController@checkresturantLogin')->name('checkresturantLogin');
});
    
     Route::group(['namespace'=>'Resturant','middleware' =>'bamaResturant', 'prefix'=>'restaurant'],function(){
    Route::get('index', 'HomeController@vendorIndex')->name('resturant-index');
    Route::get('complete_order_index', 'HomeController@complete_order')->name('complete_order_index');
    //Vendor logout
         Route::get('resturantEditvendor/{id}','ProfileController@resturantEditvendor')->name('resturantEditvendor');
      Route::post('resturantvendorUpdateProfile/{id}','ProfileController@resturantvendorUpdateProfile')->name('resturantvendorUpdateProfile');
      Route::get('resturantvendorLogout','ProfileController@resturantvendorLogout')->name('resturantvendorLogout');

        Route::get('today_order_restaurant','Today_OrderController@today_order_restaurant')->name('today_order_restaurant');
        
        Route::get('resturant_complete_order','Today_OrderController@resturant_complete_order')->name('resturant_complete_order');
        
        Route::get('resturant_cancelled_order','Today_OrderController@resturant_cancelled_order')->name('resturant_cancelled_order');
        
        Route::post('resturant_assigned_order', 'Today_OrderController@resturant_assigned_order')->name('resturant_assigned_order');
        Route::post('assigned_vendor_order', 'DispatchvendorController@assignedvendor')->name('assigned_vendor_order');
           
        Route::get('incentive_order', 'Incentive_orderController@incentive_order')->name('incentive_order');
        Route::post('pay_incentive', 'Incentive_orderController@pay_incentive')->name('pay_incentive');
	   // Route::get('edit_incentive_order', 'Incentive_orderController@edit_incentive_order')->name('edit_incentive_order');
	   // Route::post('update_incentive_order', 'Incentive_orderController@update_incentive_order')->name('update_incentive_order');
	    
	 
 	      // for banner
         Route::get('resturantbannervendor','BannervendorController@resturantbannervendor')->name('resturantbannervendor');
         Route::get('resturantAddbannervendor','BannervendorController@resturantAddbannervendor')->name('resturantAddbannervendor');
         Route::post('resturantAddNewbannervendor','BannervendorController@resturantAddNewbannervendor')->name('resturantAddNewbannervendor');
         Route::get('resturantEditbannervendor/{id}','BannervendorController@resturantEditbannervendor')->name('resturantEditbannervendor');
         Route::post('resturantUpdatebannervendor/{id}','BannervendorController@resturantUpdatebannervendor')->name('resturantUpdatebannervendor');
         Route::get('resturantdeletebannervendor/{id}','BannervendorController@resturantdeletebannervendor')->name('resturantdeletebannervendor');
         
      // for category
         
          Route::get('resturantcategory','CategoryController@category')->name('resturantcategory');
         Route::get('resturantAddCategory','CategoryController@resturantAddCategory')->name('resturantAddCategory');
         Route::post('resturantAddNewCategory','CategoryController@resturantAddNewCategory')->name('resturantAddNewCategory');
         Route::get('resturantEditCategory/{category_id}','CategoryController@resturantEditCategory')->name('resturantEditCategory');
         Route::post('resturantUpdateCategory/{category_id}','CategoryController@resturantUpdateCategory')->name('resturantUpdateCategory');
         Route::get('resturantDeleteCategory/{category_id}','CategoryController@resturantDeleteCategory')->name('resturantDeleteCategory');
         
         // for sub-category
         
         Route::post('searchsubcat','subcatController@searchsubcat')->name('searchsubcat');
         Route::get('resturantsubcat','subcatController@resturantsubcat')->name('resturantsubcat');
         Route::get('resturantaddsubcat','subcatController@resturantaddsubcat')->name('resturantaddsubcat');
         Route::post('resturantAddNewsubcat','subcatController@resturantAddNewsubcat')->name('resturantAddNewsubcat');
         Route::get('resturantEditsubcat/{subcat_id}','subcatController@resturantEditsubcat')->name('resturantEditsubcat');
         Route::post('resturantUpdatesubcat/{subcat_id}','subcatController@resturantUpdatesubcat')->name('resturantUpdatesubcat');
         Route::get('resturantdeletesubcat/{subcat_id}','subcatController@resturantdeletesubcat')->name('resturantdeletesubcat');

              // for Products
         
         Route::get('resturantproduct','ProductController@product')->name('resturantproduct');
         Route::get('resturantaddproduct','ProductController@Addproduct')->name('resturantaddproduct');
         Route::post('resturantaddnewproduct','ProductController@AddNewproduct')->name('resturantaddnewproduct');
         Route::get('resturanteditproduct/{product_id}','ProductController@Editproduct')->name('resturanteditproduct');
         Route::post('resturantupdateproduct/{product_id}','ProductController@Updateproduct')->name('resturantupdateproduct');
         Route::get('resturantdeleteproduct/{product_id}','ProductController@deleteproduct')->name('resturantdeleteproduct');
         Route::post('searchproduct','ProductController@searchproduct')->name('searchproduct');

         
           // for Products variant 
         
          Route::get('resturantvarient/{id}','VarientController@varient')->name('resturantvarient');
    Route::get('resturantAddproductvariant/{id}','VarientController@Addproductvariant')->name('resturantAddproductvariant');
    Route::post('resturantAddNewproductvariant','VarientController@AddNewproductvariant')->name('resturantAddNewproductvariant');
    Route::get('resturantEditproductvariant/{id}','VarientController@Editproductvariant')->name('resturantEditproductvariant');
    Route::post('resturantUpdateproductvariant/{id}','VarientController@Updateproductvariant')->name('resturantUpdateproductvariant');
    Route::get('deleteproductvariant/{id}','VarientController@deleteproductvariant')->name('deleteproductvariant');
         
               // for Products addons 
         
      Route::get('resturantaddon/{id}','AddonController@addon')->name('resturantaddon');
      Route::get('resturantAddproductaddon/{id}','AddonController@Addproductaddon')->name('resturantAddproductaddon');
      Route::post('resturantAddNewproductaddon','AddonController@AddNewproductaddon')->name('resturantAddNewproductaddon');
      Route::get('resturantEditproductaddon/{id}','AddonController@Editproductaddon')->name('resturantEditproductaddon');
      Route::post('resturantUpdateproductaddon/{id}','AddonController@Updateproductaddon')->name('resturantUpdateproductaddon');
      Route::get('deleteproductaddon/{id}','AddonController@deleteproductaddon')->name('deleteproductaddon');
         // deal Product///
         Route::get('resturantdealroduct', 'DealProductController@resturantdealroduct')->name('resturantdealroduct');
        Route::get('resturantAddDealproduct','DealProductController@resturantAddDealproduct')->name('resturantAddDealproduct');
    	Route::post('resturantAddNewDealproduct','DealProductController@resturantAddNewDealproduct')->name('resturantAddNewDealproduct');
    	Route::get('resturantEditDealproduct/{id}','DealProductController@resturantEditDealproduct')->name('resturantEditDealproduct');
     	Route::post('resturantUpdateDealproduct/{id}','DealProductController@resturantUpdateDealproduct')->name('resturantUpdateDealproduct');
     	Route::get('resturantDeleteDealproduct/{id}','DealProductController@resturantDeleteDealproduct')->name('resturantDeleteDealproduct');
     	
     	// for bulk upload
     	Route::get('restaurantbulkup', 'BulkuploadController@restaurantbulkup')->name('restaurantbulkup');   
        Route::post('restaurantimport', 'BulkuploadController@restaurantimport')->name('restaurantimport');
        Route::post('restaurantimport_varients', 'BulkuploadController@restaurantimport_varients')->name('restaurantimport_varients');
     	Route::get('productdownload', 'BulkuploadController@productdownload');
     	Route::get('variantdownload', 'BulkuploadController@variantdownload');


 	 
         
         // for area
         Route::get('restaurantarea','areaController@restaurantarea')->name('restaurantarea');
         Route::get('restaurantAddarea','areaController@restaurantAddarea')->name('restaurantAddarea');
         Route::post('restaurantAddInsertarea','areaController@restaurantAddInsertarea')->name('restaurantAddInsertarea');
         Route::get('restaurantEditarea/{id}','areaController@restaurantEditarea')->name('restaurantEditarea');
         Route::post('restaurantUpdatearea/{id}','areaController@restaurantUpdatearea')->name('restaurantUpdatearea');
         Route::get('restaurantDeletearea/{id}','areaController@restaurantDeletearea')->name('restaurantDeletearea');
         
          // for coupon
 	 
     Route::get('resturantcouponlist','CouponController@resturantcouponlist')->name('resturantcouponlist');
	 Route::get('resturantcoupon','CouponController@resturantcoupon')->name('resturantcoupon');
	 Route::post('resturantaddcoupon','CouponController@resturantaddcoupon')->name('resturantaddcoupon');
	 Route::get('resturanteditcoupon/{coupon_id}','CouponController@resturanteditcoupon')->name('resturanteditcoupon');
	 Route::post('resturantupdatecoupon','CouponController@resturantupdatecoupon')->name('resturantupdatecoupon');
	 Route::get('resturantdeletecoupon/{coupon_id}','CouponController@resturantdeletecoupon')->name('resturantdeletecoupon');
	 
	 // for delivery time
	 Route::get('resturanttimeslot','TimeSlotController@resturanttimeslot')->name('resturanttimeslot');
	 Route::post('resturanttimeslotupdate','TimeSlotController@resturanttimeslotupdate')->name('resturanttimeslotupdate');
	 
	 
	           // for delivery_boy
         Route::get('resturantdelivery_boy','delivery_boyController@resturantdelivery_boy')->name('resturantdelivery_boy');
         Route::get('resturantAdddelivery_boy','delivery_boyController@resturantAdddelivery_boy')->name('resturantAdddelivery_boy');
         Route::post('resturantAddNewdelivery_boy','delivery_boyController@resturantAddNewdelivery_boy')->name('resturantAddNewdelivery_boy');
         Route::get('resturantEditdelivery_boy/{id}','delivery_boyController@resturantEditdelivery_boy')->name('resturantEditdelivery_boy');
         Route::post('resturantUpdatedelivery_boy/{id}','delivery_boyController@resturantUpdatedelivery_boy')->name('resturantUpdatedelivery_boy');
         Route::get('resturantdeletedelivery_boy/{id}','delivery_boyController@resturantdeletedelivery_boy')->name('resturantdeletedelivery_boy');
         Route::get('resturantconfirmdeliverystatus/{id}/{status}', 'delivery_boyController@resturantconfirmdeliverystatus')->name('resturantconfirmdeliverystatus');
         
         // for order details
 	 
         Route::get('details','Today_OrderController@details')->name('details');
         
        Route::get('inventoryvendor', 'inventoryController@inventoryvendor')->name('inventoryvendor');
        Route::post('paycustomervendor/{order_complain_id}', 'inventoryController@paycustomervendor')->name('paycustomervendor');
          
        Route::get('dispatch_panelvendor', 'DispatchvendorController@dispatch_panelvendor')->name('dispatch_panelvendor');
	     Route::post('assignedcashrequestvendor', 'DispatchvendorController@assignedcashrequestvendor')->name('assignedcashrequestvendor');
	     
	    Route::get('resturantcomission','ComissionController@resturantcomission')->name('resturantcomission');
	    Route::get('resturantsendrequest/{com_id}','ComissionController@resturantsendrequest')->name('resturantsendrequest');
	    Route::post('resturantsearchcomission','ComissionController@resturantsearchcomission')->name('resturantsearchcomission');
        Route::get('resturantallexcelgenerator','ComissionController@resturantallexcelgenerator')->name('resturantallexcelgenerator');
     Route::get('resturantexcelgenerator/{startdate}/{enddate}', 'ComissionController@resturantexcelgenerator')->name('resturantexcelgenerator');
	    Route::get('resturantdelivery_boy_comission','delivery_boy_comissionController@resturantdelivery_boy_comission')->name('resturantdelivery_boy_comission'); 
      Route::post('resturantsearchdeliveryboy','delivery_boy_comissionController@resturantsearchdeliveryboy')->name('resturantsearchdeliveryboy');
      Route::get('resturantallexceldownload','delivery_boy_comissionController@resturantallexceldownload')->name('resturantallexceldownload');      
      Route::get('resturantexceldownload/{startdate}/{enddate}', 'delivery_boy_comissionController@resturantexceldownload')->name('resturantexceldownload');
	            
	   //  Route::post('searchstock','Today_OrderController@searchstock')->name('searchstock');
	   //  Route::get('low_stock','Today_OrderController@low_stock')->name('low_stock');
	   //  Route::post('update_stock','Today_OrderController@update_stock')->name('update_stock');
	     
	       //for notification
     Route::get('restaurant_notification', 'Notification1Controller@restaurant_notification')->name('restaurant-notification');
    Route::get('resturantcityadmindelivery_boy','delivery_boyController@resturantcityadmindelivery_boy')->name('resturantcityadmindelivery_boy');
    
        // Route::get('lang/change', 'LangController@change')->name('changeLang');
    
    });    

    /////////////////////////////////////////////////	
/////////////for Pharmacy//////////////////////
////////////////////////////////////////////////
Route::group(['namespace'=>'Pharmacy', 'prefix'=>'pharmacy'],function(){	
	
	Route::get('/', 'PharmacyLoginController@pharmacylogin')->name('pharmacylogin');
    Route::post('/checkresturantLogin', 'PharmacyLoginController@checkpharmacyLogin')->name('checkpharmacyLogin');
});
     Route::group(['namespace'=>'Pharmacy','middleware' =>'bamaPharmacy', 'prefix'=>'pharmacy'],function(){
    Route::get('index', 'HomeController@vendorIndex')->name('pharmacy-index');
    Route::get('complete_order_index', 'HomeController@complete_order')->name('complete_order_index');
    //Vendor logout
         Route::get('pharmacyEditvendor/{id}','ProfileController@pharmacyEditvendor')->name('pharmacyEditvendor');
      Route::post('pharmacyvendorUpdateProfile/{id}','ProfileController@pharmacyvendorUpdateProfile')->name('pharmacyvendorUpdateProfile');
      Route::get('pharmacyvendorLogout','ProfileController@pharmacyvendorLogout')->name('pharmacyvendorLogout');

        Route::get('today_order_pharmacy','Today_OrderController@today_order_pharmacy')->name('today_order_pharmacy');
        Route::get('pharmacynext_day','Today_OrderController@pharmacynext_day')->name('pharmacynext_day');
        Route::get('pharmacy_complete_order','Today_OrderController@pharmacy_complete_order')->name('pharmacy_complete_order');
        Route::get('pharmacy_cancelled_order','Today_OrderController@pharmacy_cancelled_order')->name('pharmacy_cancelled_order');
        
        Route::post('pharmacy_assigned_order', 'Today_OrderController@pharmacy_assigned_order')->name('pharmacy_assigned_order');
        Route::post('assigned_vendor_order', 'DispatchvendorController@assignedvendor')->name('assigned_vendor_order');
           
        Route::get('incentive_order', 'Incentive_orderController@incentive_order')->name('incentive_order');
        Route::post('pay_incentive', 'Incentive_orderController@pay_incentive')->name('pay_incentive');
	   // Route::get('edit_incentive_order', 'Incentive_orderController@edit_incentive_order')->name('edit_incentive_order');
	   // Route::post('update_incentive_order', 'Incentive_orderController@update_incentive_order')->name('update_incentive_order');
	    
	 
 	      // for banner
         Route::get('pharmacybannervendor','BannervendorController@pharmacybannervendor')->name('pharmacybannervendor');
         Route::get('pharmacyAddbannervendor','BannervendorController@pharmacyAddbannervendor')->name('pharmacyAddbannervendor');
         Route::post('pharmacyAddNewbannervendor','BannervendorController@pharmacyAddNewbannervendor')->name('pharmacyAddNewbannervendor');
         Route::get('pharmacyEditbannervendor/{id}','BannervendorController@pharmacyEditbannervendor')->name('pharmacyEditbannervendor');
         Route::post('pharmacyUpdatebannervendor/{id}','BannervendorController@pharmacyUpdatebannervendor')->name('pharmacyUpdatebannervendor');
         Route::get('pharmacydeletebannervendor/{id}','BannervendorController@pharmacydeletebannervendor')->name('pharmacydeletebannervendor');
         
      // for category
         
          Route::get('pharmacycategory','CategoryController@category')->name('pharmacycategory');
         Route::get('pharmacyAddCategory','CategoryController@pharmacyAddCategory')->name('pharmacyAddCategory');
         Route::post('pharmacyAddNewCategory','CategoryController@pharmacyAddNewCategory')->name('pharmacyAddNewCategory');
         Route::get('pharmacyEditCategory/{category_id}','CategoryController@pharmacyEditCategory')->name('pharmacyEditCategory');
         Route::post('pharmacyUpdateCategory/{category_id}','CategoryController@pharmacyUpdateCategory')->name('pharmacyUpdateCategory');
         Route::get('pharmacyDeleteCategory/{category_id}','CategoryController@pharmacyDeleteCategory')->name('pharmacyDeleteCategory');
         
         // for sub-category
         
         Route::post('searchsubcat','subcatController@searchsubcat')->name('searchsubcat');
         Route::get('pharmacysubcat','subcatController@pharmacysubcat')->name('pharmacysubcat');
         Route::get('pharmacyaddsubcat','subcatController@pharmacyaddsubcat')->name('pharmacyaddsubcat');
         Route::post('pharmacyAddNewsubcat','subcatController@pharmacyAddNewsubcat')->name('pharmacyAddNewsubcat');
         Route::get('pharmacyEditsubcat/{subcat_id}','subcatController@pharmacyEditsubcat')->name('pharmacyEditsubcat');
         Route::post('pharmacyUpdatesubcat/{subcat_id}','subcatController@pharmacyUpdatesubcat')->name('pharmacyUpdatesubcat');
         Route::get('pharmacydeletesubcat/{subcat_id}','subcatController@pharmacydeletesubcat')->name('pharmacydeletesubcat');

              // for Products
         
         Route::get('pharmacyproduct','ProductController@product')->name('pharmacyproduct');
         Route::get('pharmacyaddproduct','ProductController@Addproduct')->name('pharmacyaddproduct');
         Route::post('pharmacyaddnewproduct','ProductController@AddNewproduct')->name('pharmacyaddnewproduct');
         Route::get('pharmacyeditproduct/{product_id}','ProductController@Editproduct')->name('pharmacyeditproduct');
         Route::post('pharmacyupdateproduct/{product_id}','ProductController@Updateproduct')->name('pharmacyupdateproduct');
         Route::get('pharmacydeleteproduct/{product_id}','ProductController@deleteproduct')->name('pharmacydeleteproduct');
         Route::post('searchproduct','ProductController@searchproduct')->name('searchproduct');

         
           // for Products variant 
         
          Route::get('pharmacyvarient/{id}','VarientController@varient')->name('pharmacyvarient');
    Route::get('pharmacyAddproductvariant/{id}','VarientController@Addproductvariant')->name('pharmacyAddproductvariant');
    Route::post('pharmacyAddNewproductvariant','VarientController@AddNewproductvariant')->name('pharmacyAddNewproductvariant');
    Route::get('pharmacyEditproductvariant/{id}','VarientController@Editproductvariant')->name('pharmacyEditproductvariant');
    Route::post('pharmacyUpdateproductvariant/{id}','VarientController@Updateproductvariant')->name('pharmacyUpdateproductvariant');
    Route::get('deleteproductvariant/{id}','VarientController@deleteproductvariant')->name('deleteproductvariant');
         
               // for Products addons 
         
      Route::get('pharmacyaddon/{id}','AddonController@addon')->name('pharmacyaddon');
      Route::get('pharmacyAddproductaddon/{id}','AddonController@Addproductaddon')->name('pharmacyAddproductaddon');
      Route::post('pharmacyAddNewproductaddon','AddonController@AddNewproductaddon')->name('pharmacyAddNewproductaddon');
      Route::get('pharmacyEditproductaddon/{id}','AddonController@Editproductaddon')->name('pharmacyEditproductaddon');
      Route::post('pharmacyUpdateproductaddon/{id}','AddonController@Updateproductaddon')->name('pharmacyUpdateproductaddon');
      Route::get('deleteproductaddon/{id}','AddonController@deleteproductaddon')->name('deleteproductaddon');
         // for deal products//
         Route::get('pharmacydealroduct', 'DealProductController@pharmacydealroduct')->name('pharmacydealroduct');
        Route::get('pharmacyAddDealproduct','DealProductController@pharmacyAddDealproduct')->name('pharmacyAddDealproduct');
    	Route::post('pharmacyAddNewDealproduct','DealProductController@pharmacyAddNewDealproduct')->name('pharmacyAddNewDealproduct');
    	Route::get('pharmacyEditDealproduct/{id}','DealProductController@pharmacyEditDealproduct')->name('pharmacyEditDealproduct');
     	Route::post('pharmacyUpdateDealproduct/{id}','DealProductController@pharmacyUpdateDealproduct')->name('pharmacyUpdateDealproduct');
     	Route::get('pharmacyDeleteDealproduct/{id}','DealProductController@pharmacyDeleteDealproduct')->name('pharmacyDeleteDealproduct');
     	
     	// for bulk upload
     	Route::get('pharmacybulkup', 'BulkuploadController@pharmacybulkup')->name('pharmacybulkup');   
        Route::post('pharmacyimport', 'BulkuploadController@pharmacyimport')->name('pharmacyimport');
        Route::post('pharmacyimport_varients', 'BulkuploadController@pharmacyimport_varients')->name('pharmacyimport_varients');
     	Route::get('productdownload', 'BulkuploadController@productdownload');
     	Route::get('variantdownload', 'BulkuploadController@variantdownload');


 	 
         
         // for area
         Route::get('pharmacyarea','areaController@pharmacyarea')->name('pharmacyarea');
         Route::get('pharmacyAddarea','areaController@pharmacyAddarea')->name('pharmacyAddarea');
         Route::post('pharmacyAddInsertarea','areaController@pharmacyAddInsertarea')->name('pharmacyAddInsertarea');
         Route::get('pharmacyEditarea/{id}','areaController@pharmacyEditarea')->name('pharmacyEditarea');
         Route::post('pharmacyUpdatearea/{id}','areaController@pharmacyUpdatearea')->name('pharmacyUpdatearea');
         Route::get('pharmacyDeletearea/{id}','areaController@pharmacyDeletearea')->name('pharmacyDeletearea');
         
          // for coupon
 	 
     Route::get('pharmacycouponlist','CouponController@pharmacycouponlist')->name('pharmacycouponlist');
	 Route::get('pharmacycoupon','CouponController@pharmacycoupon')->name('pharmacycoupon');
	 Route::post('pharmacyaddcoupon','CouponController@pharmacyaddcoupon')->name('pharmacyaddcoupon');
	 Route::get('pharmacyeditcoupon/{coupon_id}','CouponController@pharmacyeditcoupon')->name('pharmacyeditcoupon');
	 Route::post('pharmacyupdatecoupon','CouponController@pharmacyupdatecoupon')->name('pharmacyupdatecoupon');
	 Route::get('pharmacydeletecoupon/{coupon_id}','CouponController@pharmacydeletecoupon')->name('pharmacydeletecoupon');
	 
	 // for delivery time
	 Route::get('pharmacytimeslot','TimeSlotController@pharmacytimeslot')->name('pharmacytimeslot');
	 Route::post('pharmacytimeslotupdate','TimeSlotController@pharmacytimeslotupdate')->name('pharmacytimeslotupdate');
	 
	 
	           // for delivery_boy
         Route::get('pharmacydelivery_boy','delivery_boyController@pharmacydelivery_boy')->name('pharmacydelivery_boy');
         Route::get('pharmacyAdddelivery_boy','delivery_boyController@pharmacyAdddelivery_boy')->name('pharmacyAdddelivery_boy');
         Route::post('pharmacyAddNewdelivery_boy','delivery_boyController@pharmacyAddNewdelivery_boy')->name('pharmacyAddNewdelivery_boy');
         Route::get('pharmacyEditdelivery_boy/{id}','delivery_boyController@pharmacyEditdelivery_boy')->name('pharmacyEditdelivery_boy');
         Route::post('pharmacyUpdatedelivery_boy/{id}','delivery_boyController@pharmacyUpdatedelivery_boy')->name('pharmacyUpdatedelivery_boy');
         Route::get('pharmacydeletedelivery_boy/{id}','delivery_boyController@pharmacydeletedelivery_boy')->name('pharmacydeletedelivery_boy');
         Route::get('pharmacyconfirmdeliverystatus/{id}/{status}', 'delivery_boyController@pharmacyconfirmdeliverystatus')->name('pharmacyconfirmdeliverystatus');
         
         // for order details
 	 
         Route::get('details','Today_OrderController@details')->name('details');
         
        Route::get('inventoryvendor', 'inventoryController@inventoryvendor')->name('inventoryvendor');
        Route::post('paycustomervendor/{order_complain_id}', 'inventoryController@paycustomervendor')->name('paycustomervendor');
          
        Route::get('dispatch_panelvendor', 'DispatchvendorController@dispatch_panelvendor')->name('dispatch_panelvendor');
	     Route::post('assignedcashrequestvendor', 'DispatchvendorController@assignedcashrequestvendor')->name('assignedcashrequestvendor');
	     
	    Route::get('pharmacycomission','ComissionController@pharmacycomission')->name('pharmacycomission');
	    Route::get('pharmacysendrequest/{com_id}','ComissionController@pharmacysendrequest')->name('pharmacysendrequest');
	    Route::post('pharmacysearchcomission','ComissionController@pharmacysearchcomission')->name('pharmacysearchcomission');
        Route::get('pharmacyallexcelgenerator','ComissionController@pharmacyallexcelgenerator')->name('pharmacyallexcelgenerator');
     Route::get('pharmacyexcelgenerator/{startdate}/{enddate}', 'ComissionController@pharmacyexcelgenerator')->name('pharmacyexcelgenerator');
	    Route::get('pharmacydelivery_boy_comission','delivery_boy_comissionController@pharmacydelivery_boy_comission')->name('pharmacydelivery_boy_comission'); 
      Route::post('pharmacysearchdeliveryboy','delivery_boy_comissionController@pharmacysearchdeliveryboy')->name('pharmacysearchdeliveryboy');
      Route::get('pharmacyallexceldownload','delivery_boy_comissionController@pharmacyallexceldownload')->name('pharmacyallexceldownload');      
      Route::get('pharmacyexceldownload/{startdate}/{enddate}', 'delivery_boy_comissionController@pharmacyexceldownload')->name('pharmacyexceldownload');
	            
	   //  Route::post('searchstock','Today_OrderController@searchstock')->name('searchstock');
	   //  Route::get('low_stock','Today_OrderController@low_stock')->name('low_stock');
	   //  Route::post('update_stock','Today_OrderController@update_stock')->name('update_stock');
	     
	       //for notification
     Route::get('pharmacy_notification', 'Notification2Controller@pharmacy_notification')->name('pharmacy-notification');
    Route::get('pharmacycityadmindelivery_boy','delivery_boyController@pharmacycityadmindelivery_boy')->name('pharmacycityadmindelivery_boy');
    
        // order by Photo
    Route::get('parmacy_order_list','Pharmacy_Order_By_ImageController@parmacy_order_list')->name('parmacy_order_list');
    
    
    Route::post('admin/reject/orderlist/{id}','Pharmacy_Order_By_ImageController@rejectorder')->name('admin_reject_orderphoto');
 	  
 	  
 	Route::get('store/makeorder/{id}','Pharmacy_Order_By_ImageController@pharmacy_sel_product')->name('pharmacy_sel_product');
 	Route::post('list/product/added/', 'Pharmacy_Order_By_ImageController@pharmacy_added_product')->name('pharmacy_added_product');
 	  	
 Route::get('list/product/delete_from_cart/{id}', 'Pharmacy_Order_By_ImageController@pharmacy_delete_product')->name('pharmacy_delete_product');
 	  	
 	  	Route::post('list/product/add_qty/{id}', 'Pharmacy_Order_By_ImageController@pharmacy_add_qty')->name('pharmacy_add_qty');
 	  	
 	  	Route::post('reject/order/{id}','Pharmacy_Order_By_ImageController@pharmacy_rejectorder')->name('pharmacy_rejectorder');
 	  	   
 	  	Route::post('order/processed/{ord_id}','Pharmacy_Order_By_ImageController@parmacy_checkout')->name('parmacy_checkout');
    
    }); 
	
/////////////////////////////////////////////////	
/////////////for city admin//////////////////////
////////////////////////////////////////////////
Route::group(['namespace'=>'Cityadmin', 'prefix'=>'cityadmin'],function(){	
	Route::get('/', 'LoginController@cityadminlogin')->name('cityadminlogin');
    Route::post('/checklogin', 'LoginController@checkcityadminLogin')->name('checkcityadmin-login');
});

Route::group(['namespace'=>'Cityadmin','middleware' =>'bamaCity', 'prefix'=>'cityadmin'],function(){	

    /// for cityadmin home
    Route::get('index', 'HomeController@cityadminIndex')->name('cityadmin-index');
    
    // for area
    Route::get('area','areaController@area')->name('area');
    Route::get('area/add','areaController@Addarea')->name('add-area');
    Route::post('area/add/new','areaController@AddInsertarea')->name('AddNewarea');
    Route::get('area/edit/{id}','areaController@Editarea')->name('edit-area');
    Route::post('area/update/{id}','areaController@Updatearea')->name('update-area');
    Route::get('area/delete/{id}','areaController@deletearea')->name('delete-area');

    //for manage category
    Route::get('category','CategoryController@category')->name('cityadmincategory');
    Route::get('category/add','CategoryController@cityadminAddCategory')->name('cityadminAddCategory');
    Route::post('category/add/new','CategoryController@cityadminAddNewCategory')->name('cityadminAddNewCategory');
    Route::get('category/edit/{category_id}','CategoryController@cityadminEditCategory')->name('cityadminEditCategory');
    Route::post('category/update/{category_id}','CategoryController@cityadminUpdateCategory')->name('cityadminUpdateCategory');
    Route::get('category/delete/{category_id}','CategoryController@cityadminDeleteCategory')->name('cityadminDeleteCategory');
 	  
	// for subcat
    Route::get('subcat','subcatController@subcat')->name('cityadminsubcat');
    Route::get('subcat/add','subcatController@Addsubcat')->name('cityadminaddsubcat');
    Route::post('subcat/add/new','subcatController@AddNewsubcat')->name('cityadminAddNewsubcat');
    Route::get('subcat/edit/{id}','subcatController@Editsubcat')->name('cityadminedit-subcat');
    Route::post('subcat/update/{id}','subcatController@Updatesubcat')->name('cityadminupdate-subcat');
    Route::get('subcat/delete/{id}','subcatController@deletesubcat')->name('cityadmindelete-subcat');
		  
    // for product
    Route::get('product','productController@product')->name('cityadminproduct');
    Route::get('product/add','productController@Addproduct')->name('cityadminadd-product');
    Route::post('product/add/new','productController@AddNewproduct')->name('cityadminAddNewproduct');
    Route::get('product/edit/{id}','productController@Editproduct')->name('cityadminedit-product');
    Route::post('product/update/{id}','productController@Updateproduct')->name('cityadminupdate-product');
    Route::get('product/delete/{id}','productController@deleteproduct')->name('cityadmindelete-product'); 	  
		  
    // for product varient
    Route::get('varient/{id}','varientController@varient')->name('cityadminvarient');
    Route::get('varient/add/{id}','varientController@Addproduct')->name('cityadminadd-varient');
    Route::post('varient/add/new','varientController@AddNewproduct')->name('cityadminAddNewvarient');
    Route::get('varient/edit/{id}','varientController@Editproduct')->name('cityadminedit-varient');
    Route::post('varient/update/{id}','varientController@Updateproduct')->name('cityadminupdate-varient');
    Route::get('varient/delete/{id}','varientController@deleteproduct')->name('cityadmindelete-varient'); 	  
    // homecategory
    Route::get('homecategory','HomeCategoryController@allcategory')->name('allcategory');
    Route::get('addhomecategory','HomeCategoryController@addhomecategory')->name('addhomecategory');
    Route::post('inserthomecategory1','HomeCategoryController@inserthomecategory1')->name('inserthomecategory1');
    Route::get('edithomecategory/{id}','HomeCategoryController@edithomecategory')->name('edithomecategory');
    Route::post('updatehomecategory/{id}','HomeCategoryController@updatehomecategory')->name('updatehomecategory');
    Route::get('deletehomecategory/{id}','HomeCategoryController@deletehomecategory')->name('deletehomecategory');
 	    
    // Assign Home Category
    Route::get('assignhomecategory/{id}','AssignHomeCategoryController@assignhomecategory')->name('assignhomecategory');
    Route::post('inserthomecategory','AssignHomeCategoryController@inserthomecategory')->name('inserthomecategory');
    Route::get('deletehomecatgrpcat/{id}','AssignHomeCategoryController@deletehomecategory')->name('deletehomecatgrpcat');
 	    
    //cityadmin logout
    Route::get('logout','ProfileController@cityadminLogout')->name('cityadmin-logout');
      
    //for notification
    Route::get('cityadminNotification', 'notificationController@cityadminNotification')->name('cityadminNotification');
    Route::post('cityadminNotificationSend', 'notificationController@cityadminNotificationSend')->name('cityadminNotificationSend');
    
    //for vendor notification
    Route::get('CNotification_to_store', 'notificationController@CNotification_to_store')->name('CNotification_to_store');
    Route::post('CNotification_to_store_Send', 'notificationController@CNotification_to_store_Send')->name('CNotification_to_store_Send');
	
    // for banner
    Route::get('banner','BannerImagesController@banner')->name('banner');
    Route::get('Addbanner','BannerImagesController@Addbanner')->name('Addbanner');
    Route::post('AddNewbanner','BannerImagesController@AddNewbanner')->name('AddNewbanner');
    Route::get('banner/edit/{id}','bannerController@Editbanner')->name('edit-banner');
    Route::post('banner/update/{id}','bannerController@Updatebanner')->name('update-banner');
    Route::get('banner/delete/{id}','bannerController@deletebanner')->name('delete-banner');
         
    // for delivery_boy
    Route::post('searchdelivery_boy','delivery_boyController@searchdelivery_boy')->name('searchdelivery_boy');
    Route::get('delivery_boy','delivery_boyController@delivery_boy')->name('delivery_boy');
    Route::get('delivery_boy/add','delivery_boyController@Adddelivery_boy')->name('add-delivery_boy');
    Route::post('delivery_boy/add/new','delivery_boyController@AddNewdelivery_boy')->name('AddNewdelivery_boy');
    Route::get('delivery_boy/edit/{id}','delivery_boyController@Editdelivery_boy')->name('edit-delivery_boy');
    Route::post('delivery_boy/update/{id}','delivery_boyController@Updatedelivery_boy')->name('update-delivery_boy');
    Route::get('delivery_boy/delete/{id}','delivery_boyController@deletedelivery_boy')->name('delete-delivery_boy');
    Route::get('confirm_delivery_status/{id}/{status}', 'delivery_boyController@confirmdeliverystatus')->name('confirm.delivery.status');
    Route::get('cdelivery_boy_comission','delivery_boy_comissionController@cdelivery_boy_comission')->name('cdelivery_boy_comission');
    Route::post('cityadminsearchcomission','delivery_boy_comissionController@cityadminsearchcomission')->name('cityadminsearchcomission');
    Route::get('cityadminallexcelgenerator','delivery_boy_comissionController@cityadminallexcelgenerator')->name('cityadminallexcelgenerator');      
    Route::get('cityadminexcelgenerator/{startdate}/{enddate}/{delivery_boy_id}', 'delivery_boy_comissionController@cityadminexcelgenerator')->name('cityadminexcelgenerator');        
    Route::get('vendor','vendorController@vendor')->name('vendor');
    Route::get('vendor/add','vendorController@Addvendor')->name('add-vendor');
    Route::post('vendor/add/new','vendorController@AddNewvendor')->name('AddNewvendor');
    Route::get('vendor/edit/{id}','vendorController@Editvendor')->name('edit-vendor');
    Route::post('vendor/update/{id}','vendorController@Updatevendor')->name('update-vendor');
    Route::get('vendor/delete/{id}','vendorController@deletevendor')->name('delete-vendor');
    Route::post('searchvendor','vendorController@searchvendor')->name('searchvendor');

    /// for bulk upload
    // Route::post('bulk_upload', 'ImportExcelController@import')->name('bulk_upload');
        
        
    //order management
    Route::get('today_orders', 'OrderController@today_orders')->name('today_orders');
    Route::get('next_day_orders', 'OrderController@next_day_orders')->name('next_day_orders');
    Route::get('completed', 'OrderController@completed')->name('completed');
    Route::get('incentive', 'incentiveController@incentive')->name('incentive');
    
    //Route::post('today_orders', 'OrderController@today_orders')->name('incentive');
    Route::post('assigned', 'OrderController@assigned')->name('assigned');
    Route::post('paid', 'incentiveController@pay')->name('paid');
    Route::get('edit_incentive_amount', 'incentiveController@edit_incentive_amount')->name('edit_incentive_amount');
    Route::post('update_incentive_amount', 'incentiveController@update_incentive_amount')->name('update_incentive_amount');    
	   
    //for notification
    Route::get('send_notification', 'notiController@notification1')->name('notificationCA1');
    Route::post('send_notificationstep2', 'notiController@notification2')->name('notificationCA2');
    
    // for coupon
    Route::get('coupon', 'CouponController@allcoupons')->name('coupon');
    
    //vendor_order
    Route::get('vendor_list', 'Vendor_orderController@vendor_list')->name('vendor_list');
    Route::get('today_order1/{id}', 'Vendor_orderController@today_order1')->name('today_order1');
    Route::get('next_order1/{id}', 'Vendor_orderController@next_order1')->name('next_order1');
    Route::get('completed_order1/{id}', 'Vendor_orderController@completed_order1')->name('completed_order1');
    Route::get('vendorsecretlogin/{id}','vendorController@vendorsecretlogin')->name('vendorsecretlogin');
	    
});	
	
	
	
	
/////////////////////////////////////////////////	
/////////////for API//////////////////////
////////////////////////////////////////////////
Route::group(['prefix'=>'api','namespace'=>'Api'],function(){
     //////address///////
    Route::post('add_address', 'AddressController@address');
    Route::post('city', 'AddressController@city');
    Route::post('area', 'AddressController@society');
    Route::post('show_address', 'NewAddressController@show_address');
    Route::post('select_address', 'NewAddressController@select_address');
    Route::post('edit_address', 'AddressController@edit_add');
    Route::post('remove_address', 'AddressController@rem_user_address');
    Route::post('area_city_charges', 'AddressController@area_city_charges');
    Route::post('address_selection', 'NewAddressController@address_selection');
    // feferal code
    Route::post('signUprefer', 'RefralController@signUprefer');
    
    /////admin Banner
    Route::get('adminbanner', 'AdminBannerController@adminbanner');
    //Vendor Banner
    Route::post('vendorbanner', 'bannerController@vendorbanner');
     //for category and subcategory
    Route::post('appcategory', 'categoryController@category');
    Route::post('appsubcategory', 'categoryController@subcat');
    Route::post('appproduct', 'categoryController@product');
    
    Route::post('newhomecategory', 'categoryController@homecat');
    
    ////coupon
    Route::post('coupon_list', 'CouponController@coupon_list');
    Route::post('apply_coupon', 'CouponController@apply_coupon');
    //for Nearby Store
    Route::post('nearbystore', 'NearbystoreController@nearbystore');
     //order
    Route::post('order', 'OrderController@order');
    Route::post('checkout', 'OrderController@checkout');
    // cancel order
    Route::post('cancel_order', 'OrderController@cancel_order');
    // completed order
    Route::post('completed_orders1', 'OrderController@completed_orders1');
    // cancel order history
    Route::post('cancelorderhistory', 'OrderController@cancelorderhistory');
    // ongoing order
    Route::post('ongoingorders', 'OrderController@ongoingorders');
    
    //for timeslot
    Route::post('timeslot', 'TimeslotController@timeslot');
     //for user 
    Route::post('user_register', 'UserController@signUp');
    Route::post('verify_phone', 'UserController@verifyPhone');
    Route::post('resend_otp', 'UserController@resend_otp');
    Route::post('verify_otp', 'UserController@verifyOtp');
    Route::post('change_password', 'UserController@changePassword');
    Route::post('login', 'UserController@login');
    Route::post('checkotp', 'UserController@checkOTP');
    Route::post('checkuser', 'UserController@checkuser');
    Route::post('verifyotpfirebase', 'UserController@verifyotpfirebase');
    Route::get('firebase', 'UserController@firebase');
    //for profile
    Route::post('myprofile', 'UserController@myprofile');
     //for promocode
    Route::post('promocode_regenerate', 'UserController@promocode_regenerate');
    ///vendor category
    Route::get('vendorcategory', 'VendorCategoryController@vendorcategory');
    // complaint list 
    Route::get('showcomplain', 'complainController@showcomplain');
    //rewads Points 
    Route::post('redeem', 'RewardController@redeem');
    Route::post('rewardvalues', 'RewardController@rewardvalues');
    Route::post('after_order_reward_msg', 'RewardController@after_order_reward_msg');
    Route::post('after_order_reward_msg_new', 'RewardController@after_order_reward_msg_new');
    Route::post('rewardhistory', 'RewardController@rewardhistory');
    Route::post('stock_check', 'RewardController@stock_check');
    //for app currency
    Route::get('currency', 'categoryController@currency');
    //for product search 
    Route::post('search_keyword', 'searchController@searchingFor');
     Route::post('resturantsearchingFor', 'searchController@resturantsearchingFor');
    
    //for Nearby Store
    Route::post('nearbystore', 'NearbystoreController@nearbystore');
    // apply coupon
     Route::post('coupon_list', 'CouponController@coupon_list');
    Route::post('apply_coupon', 'CouponController@apply_coupon');
     //wallet
    Route::post('showcredit', 'walletController@showcredit');
    Route::post('credit_history', 'walletController@credit_history');
     Route::get('wallet_plans', 'walletController@wallet_plans');
     Route::get('country_code', 'walletController@country_code');
     Route::post('wallet_recharge', 'walletController@wallet_recharge');
     //term & condition
    Route::get('termcondition', 'TermConditionController@termcondition');
    Route::post('support', 'TermConditionController@support');
    Route::get('aboutus', 'TermConditionController@aboutus');
    Route::get('reffermessage', 'walletController@reffermessage');
    //for Payment Mode
    Route::post('paymentvia', 'paymentController@payment_mode');
     Route::get('payment_gateways', 'paymentController@gatewaysettings'); 
    //deal products
    Route::post('dealproduct', 'OrderController@dealproduct');
    // invoice
    Route::post('invoice', 'InvoiceController@invoice');
    Route::get('show_map', 'MapController@show_map');
    
   // store
    Route::post('storelogin', 'StoreLoginController@storelogin');
    Route::post('storeverifyphone', 'StoreLoginController@storeverifyphone');
    Route::post('storeprofile', 'StoreLoginController@storeprofile');
    Route::post('store_timming', 'StoreLoginController@store_timming');
    
    Route::post('storeprofile_edit', 'StoreLoginController@storeprofile_edit');
    Route::post('store_status', 'StoreLoginController@store_status');
    Route::post('store_current_status', 'StoreLoginController@store_current_status');
    Route::post('verifyotpfirebase_vendor', 'StoreLoginController@verifyotpfirebase_vendor');
    Route::post('resend_otp_vendor', 'StoreLoginController@resend_otp_vendor');

    Route::post('store_today_order', 'StoreOrderController@store_today_order');
    Route::post('store_next_day_order', 'StoreOrderController@store_next_day_order');
    Route::post('store_complete_order', 'StoreOrderController@store_complete_order');
    
    Route::post('store_delivery_boy', 'StoreOrderController@store_delivery_boy');
    Route::post('assigned_store_order', 'StoreOrderController@assigned_store_order');
    
    Route::post('order_generate_by_store', 'StoreOrderController@order_generate_by_store');
    Route::post('reject_by_vendor', 'StoreOrderController@reject_by_vendor');
    Route::post('pharmacy_product_price', 'PhotoOrderRejectedController@pharmacy_product_price');
   
    
     Route::post('store_category','StoreProductController@store_category');
    Route::post('store_subcategory','StoreProductController@store_subcategory');
    
    Route::post('store_subcategoryshow','StoreProductController@store_subcategoryshow');
    Route::post('store_subcategoryproduct','StoreProductController@store_subcategoryproduct');
        Route::post('store_addproductvariant','StoreProductController@store_addproductvariant');
        Route::post('store_updateproductvariant','StoreProductController@store_updateproductvariant');
    
    Route::post('store_products','StoreProductController@store_products');
    Route::post('store_allproduct','StoreProductController@store_allproduct');
    Route::post('store_addproduct','StoreProductController@store_addproduct');
    Route::post('store_addnewproduct','StoreProductController@store_addnewproduct');
    Route::get('store_editnewproduct/{product_id}','StoreProductController@store_editnewproduct');
    Route::post('store_updatenewproduct','StoreProductController@store_updatenewproduct');
    Route::delete('store_deleteproduct/{product_id}','StoreProductController@store_deleteproduct');
    Route::get('store_varient/{product_id}','StoreProductvarientController@store_varient');
    Route::get('store_addvariant/{product_id}','StoreProductvarientController@store_addvariant');
    Route::post('store_addnewvariant','StoreProductvarientController@store_addnewvariant');
    Route::get('store_editvariant/{varient_id}','StoreProductvarientController@store_editvariant');
    Route::post('store_updatevariant','StoreProductvarientController@store_updatevariant');
    Route::delete('store_deletevariant/{varient_id}','StoreProductvarientController@store_deletevariant'); 
    
    Route::post('store_dealproduct','StoreDealproductController@store_dealproduct');
    Route::post('store_adddealproduct','StoreDealproductController@store_adddealproduct');
    Route::post('store_addnewdealproduct','StoreDealproductController@store_addnewdealproduct');
    Route::get('store_editdealproduct/{deal_id}','StoreDealproductController@store_editdealproduct');
    Route::post('store_updatedealproduct','StoreDealproductController@store_updatedealproduct');
    Route::delete('store_deletedealproduct/{deal_id}','StoreDealproductController@store_deletedealproduct');
   
    Route::post('store_deliveryboy','StoreDeliveryboyController@store_deliveryboy');
    Route::post('store_adddeliveryboy','StoreDeliveryboyController@store_adddeliveryboy');
    Route::post('store_addnewdeliveryboy','StoreDeliveryboyController@store_addnewdeliveryboy');
    Route::get('store_editdeliveryboy/{deliveryboy_id}','StoreDeliveryboyController@store_editdeliveryboy');
    Route::post('store_updatedeliveryboy','StoreDeliveryboyController@store_updatedeliveryboy');
    Route::delete('store_deletedeliveryboy/{deliveryboy_id}','StoreDeliveryboyController@store_deletedeliveryboy');
    Route::post('store_confirmdeliveryboy','StoreDeliveryboyController@store_confirmdeliveryboy');
   
    //for banner
    Route::post('homebanner', 'bannerController@homebanner');
    Route::post('home2banner', 'bannerController@home2banner');
    Route::post('catbanner', 'bannerController@catbanner');
    
    //for subscription plan
    Route::post('planlist', 'planController@planlist');
    
     //For city list
    Route::post('showcity', 'cityController@showcity');
    // Route::post('city', 'cityController@city');
    
    //order by photo
    Route::post('orderlist', 'Order_by_ImageController@orderlist');
    Route::post('venodr_image_order', 'Order_by_ImageController@venodr_image_order');
    
    // Route::post('order', 'OrderController@order');
    
    //for showing area list
     Route::post('showarea', 'cityController@showarea');
      //for showing vendors list
     Route::post('showvendors', 'cityController@showvendors');
     
     // Notification for users
    Route::post('notificationlist', 'notificationController@notificationlist');
    Route::post('read_by_user', 'notificationController@read_by_user');
    Route::post('mark_all_as_read', 'notificationController@mark_all_as_read');
    
    
    //insert data at the time of subscribe
    Route::post('subscribe', 'subController@subscription');
    Route::post('buyonce', 'subController@buyonce');
    
    //for my subscription
    Route::post('modifysubs', 'subController@modifysubs');
    Route::post('pauseorders', 'subController@pause_order');
    Route::post('resumeorders', 'subController@resume_order');
    Route::post('showsubscription', 'subController@showsubscription');
    Route::post('showcart', 'subController@showcart');
    
     //for App Logo
    Route::post('logo', 'logoController@logo');
    
    
    //subscription of the day
    Route::post('subscriptionoftheday', 'subController@subscriptionoftheday');
    
    //delete order
    Route::get('cancelreasons', 'subController@reasonofcancellist');
    Route::post('delete_order', 'subController@delete_order');
    
   
    Route::post('show_recharge_history', 'walletController@show_recharge_history');
    //cash recharge request
    Route::post('cash_recharge', 'collectcashController@cashrequest');
    
    
    
    //complain
    
    Route::post('report_issue', 'complainController@report_issue');
    Route::post('showcompleted', 'complainController@showcompleted');
   
    //for FAQ
    Route::post('faq', 'faqController@faq');
    
    //notificationby
    Route::post('notificationby', 'notificationbyController@notificationby');
    
    //for delivery timing 
    Route::post('subsdelivery_timing', 'delivery_timingController@delivery_timing');
    
    //for schedule
    Route::post('schedule', 'subController@scheduled');
    
    
    
    //total bill ,last recharge, current balance
    Route::post('total_bill', 'walletController@totalbill');
    
    //billing history
    Route::post('credit_history', 'walletController@credit_history');
    Route::post('billing_history', 'walletController@billing_history');
    
     
    //delivery boy
     Route::post('dboylogin', 'deliveryboyController@dboylogin');
     Route::post('dboyprofile', 'deliveryboyController@dboyprofile');
     Route::post('dboytoday_orders', 'deliveryboyController@today_orders');
     Route::post('dboynextday_orders', 'deliveryboyController@nextday_orders');
     
     Route::post('verifyotpfirebase_driver', 'deliveryboyController@verifyotpfirebase_driver');
     Route::post('resend_otp_vendor', 'deliveryboyController@resend_otp_vendor');
     
     Route::post('marked', 'deliveryboyController@marked');
     Route::post('update_loc', 'deliveryboyController@update_loc');
     Route::post('dboyincentive', 'deliveryboyController@dboyincentive');
     Route::post('dboycompleted', 'deliveryboyController@dboycompleted');
     Route::post('not_accepted', 'deliveryboyController@not_accepted');
     Route::post('cityadmin_address', 'deliveryboyController@cityadmin_address');
     Route::post('generateDeliveredOtp', 'deliveryboyController@generateDeliveredOtp');
     Route::get('delievery_boy_city', 'deliveryboyController@delieveryboycity');
     Route::post('delievery_boy_sign_up', 'deliveryboyController@delieveryboysignup');
     
     Route::post('sendotpformarked', 'deliveryboyController@sendotpformarked');
     Route::post('verifyotpformarked', 'deliveryboyController@verifyotpformarked');
     Route::post('dboyforgetpassword', 'deliveryboyController@dboyforgetpassword');
     Route::post('dboyverifyotp', 'deliveryboyController@dboyverifyotp');
     Route::post('dboychangepassword', 'deliveryboyController@dboychangepassword');
     
     //Manager
     Route::post('managerlogin', 'managerController@managerlogin');
     Route::post('managerprofile', 'managerController@managerprofile');
     Route::post('managertoday_orders', 'managerController@managertoday_orders');
     Route::post('managernextday_orders', 'managerController@managernextday_orders');
     Route::post('showdelivery_boys', 'managerController@showdelivery_boys');
     
     Route::post('cancelOrder', 'managerController@cancelOrder');
     
     Route::post('appassign', 'managerController@appassign');
     Route::post('show_product', 'managerController@show_product');
     Route::post('incstock', 'managerController@incstock');
     
     
     //cash recharge
     Route::post('today_cashcollection', 'deliveryboyController@today_cashcollection');
     Route::post('mark_collected', 'deliveryboyController@mark_collected');
    
    //MemberPlanController
    Route::post('memberplanlist', 'MemberController@MemberPlanList');
    Route::post('memberplanpurchase', 'MemberController@MemberPlanPurchase');
    
    
    Route::post('timesloteproduct', 'TimeslotProductController@TimeslotProductController');
    
    Route::post('vendor_orderlist', 'Vendor_OrderController@vendor_orderlist');
    
    Route::post('product_vendor', 'TestController@product_vendor');
    
    Route::post('Today_order', 'TestController@Today_order');
    
    Route::post('Next_order', 'TestController@Next_order');
    
    Route::post('complete_order', 'TestController@complete_order');
    Route::post('cate', 'Restaurant_productController@cate');
    
     Route::post('financial', 'financial_reportController@financial');
     // for request send 
     Route::post('vendor_order_list', 'PaymentRequestController@vendor_order_list');
     Route::post('send_request', 'PaymentRequestController@send_request');
     
     
    /////Delivery Boy//////
    Route::post('driverlogin', 'DriverloginController@driver_login');
    Route::post('driver_profile', 'DriverloginController@driverprofile');
    Route::post('completed_orders', 'DriverOrderController@completed_orders');
    Route::post('ordersfortoday', 'DriverOrderController@ordersfortoday');
    Route::post('ordersfornextday', 'DriverOrderController@ordersfornextday');
    Route::post('delivery_accepted', 'DriverOrderController@delivery_accepted');
    Route::post('delivery_out', 'DriverOrderController@delivery_out');
    Route::post('delivery_completed', 'DriverOrderController@delivery_completed');
    Route::post('dboy_status', 'DriverstatusController@dboy_status');
    Route::post('delievery_boy_phone_verify', 'DriverloginController@delieveryboyphoneverify');
    Route::post('cashcollect', 'DriverOrderController@cashcollect');
    Route::post('driverstatus', 'DriverloginController@driverstatus');
    ////Restaurant/////
    Route::post('homecategory', 'Restaurant_productController@allproduct');
    Route::post('popular_item', 'Restaurant_productController@popular_item');
    Route::post('resturant_banner', 'AdminBannerController@resturant_banner');
    Route::post('returant_order', 'ResturantOrderController@returant_order');
    Route::post('orderplaced', 'ResturantOrderController@orderplaced');
    Route::post('order_cancel', 'ResturantOrderController@order_cancel');
    Route::post('user_completed_orders', 'ResturantOrderController@user_completed_orders');
    Route::post('user_cancel_order_history', 'ResturantOrderController@user_cancel_order_history');
    Route::post('user_ongoing_order', 'ResturantOrderController@user_ongoing_order');
    
    //Restaurant Vendor/////
    Route::post('vendor_today_order', 'RestaurantVendorOrderController@vendor_today_order');
    Route::post('resturant_complete_order', 'RestaurantVendorOrderController@resturant_complete_order');
    Route::post('resturant_products', 'Restaurant_VendorProductController@resturant_products');
    Route::post('resturant_addnewproduct', 'Restaurant_VendorProductController@resturant_addnewproduct');
    Route::post('resturant_updatenewproduct', 'Restaurant_VendorProductController@resturant_updatenewproduct');
    Route::post('resturant_deleteproduct', 'Restaurant_VendorProductController@resturant_deleteproduct');
    Route::post('resturant_category', 'Restaurant_VendorProductController@resturant_category');
    Route::post('resturant_product', 'Restaurant_VendorProductController@resturant_product');
    Route::post('resturant_addproductvariant', 'Restaurant_VendorProductController@resturant_addproductvariant');
    Route::post('resturant_updateproductvariant', 'Restaurant_VendorProductController@resturant_updateproductvariant');
    Route::post('resturant_addnewvariant', 'Restaurant_VendorProductController@resturant_addnewvariant');
    Route::post('resturant_updatevariant', 'Restaurant_VendorProductController@resturant_updatevariant');
    Route::post('resturant_deletevariant', 'Restaurant_VendorProductController@resturant_deletevariant');
    Route::post('resturant_addaddons', 'Restaurant_VendorProductController@resturant_addaddons');
    Route::post('resturant_addaddons_update', 'Restaurant_VendorProductController@resturant_addaddons_update');
    Route::post('resturant_deleteaddon', 'Restaurant_VendorProductController@resturant_deleteaddon');
    
    //Restaurant Delivery Boy
    Route::post('dboy_completed_order', 'RestaurantDriverOrderController@dboy_completed_order');
    Route::post('dboy_today_order', 'RestaurantDriverOrderController@dboy_today_order');
    Route::post('dboy_nextday_order', 'RestaurantDriverOrderController@dboy_nextday_order');
    Route::post('delivery_accepted_by_dboy', 'RestaurantDriverOrderController@delivery_accepted_by_dboy');
    Route::post('resturant_delivery_completed', 'RestaurantDriverOrderController@resturant_delivery_completed');
    Route::post('resturant_delivery_out', 'RestaurantDriverOrderController@resturant_delivery_out');
    Route::post('today_order_count', 'RestaurantDriverOrderController@today_order_count');
    
            ////Pharmacy/////
        Route::post('pharmacy_homecategory', 'Pharmacy_productController@allproduct');
        Route::post('pharmacy_allproducts', 'Pharmacy_productController@pharmacy_allproducts');
        Route::post('pharmacy_popular_item', 'Pharmacy_productController@popular_item');
        Route::post('pharmacy_banner', 'AdminBannerController@pharmacy_banner');
        Route::post('pharmacy_order', 'PharmacyOrderController@pharmacy_order');
        Route::post('pharmacy_orderplaced', 'PharmacyOrderController@pharmacy_orderplaced');
        Route::post('pharmacy_order_cancel', 'PharmacyOrderController@pharmacy_order_cancel');
        Route::post('pharmacy_user_completed_orders', 'PharmacyOrderController@pharmacy_user_completed_orders');
        Route::post('pharmacy_user_cancel_order_history','PharmacyOrderController@pharmacy_user_cancel_order_history');
        Route::post('order_generate_by_pharmacy', 'PharmacyOrderController@order_generate_by_pharmacy');
        Route::post('pharmacy_user_ongoing_order', 'PharmacyOrderController@pharmacy_user_ongoing_order');
        
                    //Pharmacy Vendor/////
    Route::post('pharmacy_today_order', 'PharmacyVendorOrderController@pharmacy_today_order');
    Route::post('pharmacy_next_day_order', 'PharmacyVendorOrderController@pharmacy_next_day_order');
    Route::post('pharmacy_complete_order', 'PharmacyVendorOrderController@pharmacy_complete_order');
    Route::post('pharmacy_products', 'Pharmacy_VendorProductController@pharmacy_products');
    Route::post('pharmacy_addnewproduct', 'Pharmacy_VendorProductController@pharmacy_addnewproduct');
    Route::post('pharmacy_updatenewproduct', 'Pharmacy_VendorProductController@pharmacy_updatenewproduct');
    Route::post('pharmacy_deleteproduct', 'Pharmacy_VendorProductController@pharmacy_deleteproduct');
    Route::post('pharmacy_category', 'Pharmacy_VendorProductController@pharmacy_category');
    Route::post('pharmacy_product', 'Pharmacy_VendorProductController@pharmacy_product');
    Route::post('pharmacy_addproductvariant', 'Pharmacy_VendorProductController@pharmacy_addproductvariant');
    Route::post('pharmacy_updateproductvariant', 'Pharmacy_VendorProductController@pharmacy_updateproductvariant');
    Route::post('pharmacy_addnewvariant', 'Pharmacy_VendorProductController@pharmacy_addnewvariant');
    Route::post('pharmacy_updatevariant', 'Pharmacy_VendorProductController@pharmacy_updatevariant');
    Route::post('pharmacy_deletevariant', 'Pharmacy_VendorProductController@pharmacy_deletevariant');
    Route::post('pharmacy_addaddons', 'Pharmacy_VendorProductController@pharmacy_addaddons');
    Route::post('pharmacy_addaddons_update', 'Pharmacy_VendorProductController@pharmacy_addaddons_update');
    Route::post('pharmacy_deleteaddon', 'Pharmacy_VendorProductController@pharmacy_deleteaddon');
    
           //Pharmacy Delivery Boy
       Route::post('pharmacy_dboy_completed_order', 'PharmacyDriverOrderController@pharmacy_dboy_completed_order');
       Route::post('pharmacy_dboy_today_order', 'PharmacyDriverOrderController@pharmacy_dboy_today_order');
       Route::post('pharmacy_dboy_nextday_order', 'PharmacyDriverOrderController@pharmacy_dboy_nextday_order');
       Route::post('pharmacy_delivery_accepted_by_dboy', 'PharmacyDriverOrderController@pharmacy_delivery_accepted_by_dboy');
       Route::post('pharmacy_delivery_completed', 'PharmacyDriverOrderController@pharmacy_delivery_completed');
       Route::post('pharmacy_delivery_out', 'PharmacyDriverOrderController@pharmacy_delivery_out');
       Route::post('pharmacy_today_order_count', 'PharmacyDriverOrderController@pharmacy_today_order_count');
       
               ////Parcel user/////

        Route::post('parcel_banner', 'AdminBannerController@parcel_banner');
                Route::post('parcel_detail', 'ParcelDetailController@parcel_detail');

                Route::post('parcel_charges', 'ParcelDetailController@parcel_charges');
        Route::post('parcel_orderplaced', 'ParcelDetailController@parcel_orderplaced');
        Route::post('parcel_after_order_reward_msg', 'ParcelDetailController@parcel_after_order_reward_msg');
        Route::post('parcel_user_ongoing_order', 'ParcelDetailController@parcel_user_ongoing_order');
        Route::post('parcel_user_cancel_order', 'ParcelDetailController@parcel_user_cancel_order');
        Route::post('parcel_user_completed_order', 'ParcelDetailController@parcel_user_completed_order');


                        //Parcel Vendor/////
        Route::post('parcel_city', 'ParcelVendorController@parcel_city');
        Route::post('parcel_addcharges', 'ParcelVendorController@parcel_addcharges');

        Route::post('parcel_listcharges', 'ParcelVendorController@parcel_listcharges');
        Route::post('parcel_updatecharges', 'ParcelVendorController@parcel_updatecharges');
        Route::post('parcel_deletecharges', 'ParcelVendorController@parcel_deletecharges');
        
        
               //Parcel Delivery Boy
       Route::post('parcel_dboy_completed_order', 'ParcelDriverOrderController@parcel_dboy_completed_order');
       Route::post('parcel_dboy_today_order', 'ParcelDriverOrderController@parcel_dboy_today_order');
       Route::post('parcel_dboy_nextday_order', 'ParcelDriverOrderController@parcel_dboy_nextday_order');
     Route::post('parcel_delivery_accepted_by_dboy', 'ParcelDriverOrderController@parcel_delivery_accepted_by_dboy');
       Route::post('parcel_delivery_completed', 'ParcelDriverOrderController@parcel_delivery_completed');
       Route::post('parcel_delivery_out', 'ParcelDriverOrderController@parcel_delivery_out');
       Route::post('parcel_today_order_count', 'ParcelDriverOrderController@parcel_today_order_count');

});




/////////////////////////////////////////////////	
/////////////for Parcel//////////////////////
////////////////////////////////////////////////
Route::group(['namespace'=>'Parcel', 'prefix'=>'parcel'],function(){	
	Route::get('/', 'RestaurantLoginController@resturantlogin')->name('parcelogin');
    Route::post('/checkresturantLogin', 'RestaurantLoginController@checkresturantLogin')->name('checkparcelLogin');
});
     Route::group(['namespace'=>'Parcel','middleware' =>'bamaParcel', 'prefix'=>'Parcel'],function(){
    Route::get('index', 'HomeController@vendorIndex')->name('parcel-index');
    Route::get('complete_order_index', 'HomeController@complete_order')->name('complete_order_index');
    //Vendor logout
	 Route::get('resturantEditvendor/{id}','ProfileController@resturantEditvendor')->name('parcelEditvendor');
      Route::post('resturantvendorUpdateProfile/{id}','ProfileController@resturantvendorUpdateProfile')->name('parcelvendorUpdateProfile');
      Route::get('parcelvendorLogout','ProfileController@resturantvendorLogout')->name('parcelvendorLogout');


    //Charges
	Route::get('charges','ChargeController@chargeslist');
	Route::get('editcharge','ChargeController@editcharge')->name('editcharge');
	Route::get('deletecharge/{id}','ChargeController@deletecharge');
	Route::get('add-charge','ChargeController@addcharge')->name('addcharge');
	Route::post('add-charge','ChargeController@addchargesave');
	Route::get('editcharge/{id}','ChargeController@editcharge');
	Route::post('editcharge/{id}','ChargeController@updatecharge');

    //City
	Route::get('city','CityController@city');
	Route::get('add','CityController@Addcity');
	Route::post('insert-city','CityController@AddInsertcity');
	Route::get('edit-city/{id}','CityController@Editcity');
	Route::post('update-city/{id}','CityController@Updatecity');
	Route::get('delete-city/{id}','CityController@Deletecity');

            // Order////

        Route::get('today_order_parcel','Today_OrderController@today_order_parcel')->name('today_order_parcel');
        Route::get('parcel_next_day','Today_OrderController@parcel_next_day')->name('parcel_next_day');
        Route::get('parcel_complete_order','Today_OrderController@parcel_complete_order')->name('parcel_complete_order');
        Route::post('parcel_assigned_order', 'Today_OrderController@parcel_assigned_order')->name('parcel_assigned_order');
        Route::post('parcel_order_details', 'Today_OrderController@parcel_order_details')->name('parcel_order_details');
           
        // Route::get('incentive_order', 'Incentive_orderController@incentive_order')->name('incentive_order');
        // Route::post('pay_incentive', 'Incentive_orderController@pay_incentive')->name('pay_incentive');
	   // Route::get('edit_incentive_order', 'Incentive_orderController@edit_incentive_order')->name('edit_incentive_order');
	   // Route::post('update_incentive_order', 'Incentive_orderController@update_incentive_order')->name('update_incentive_order');
	    
	 
 	      // for banner
         Route::get('resturantbannervendor','BannervendorController@resturantbannervendor')->name('parcelbannervendor');
         Route::get('resturantAddbannervendor','BannervendorController@resturantAddbannervendor')->name('parcelAddbannervendor');
         Route::post('resturantAddNewbannervendor','BannervendorController@resturantAddNewbannervendor')->name('parcelAddNewbannervendor');
         Route::get('resturantEditbannervendor/{id}','BannervendorController@resturantEditbannervendor')->name('parcelEditbannervendor');
         Route::post('resturantUpdatebannervendor/{id}','BannervendorController@resturantUpdatebannervendor')->name('parcelUpdatebannervendor');
         Route::get('resturantdeletebannervendor/{id}','BannervendorController@resturantdeletebannervendor')->name('parceldeletebannervendor');
         

         
         // for sub-category
         
        //  Route::post('searchsubcat','subcatController@searchsubcat')->name('searchsubcat');
        //  Route::get('resturantsubcat','subcatController@parcelsubcat')->name('resturantsubcat');
        //  Route::get('parceladdsubcat','subcatController@resturantaddsubcat')->name('parceladdsubcat');
        //  Route::post('resturantAddNewsubcat','subcatController@parcelAddNewsubcat')->name('resturantAddNewsubcat');
        //  Route::get('parcelEditsubcat/{subcat_id}','subcatController@resturantEditsubcat')->name('parcelEditsubcat');
        //  Route::post('resturantUpdatesubcat/{subcat_id}','subcatController@parcelUpdatesubcat')->name('resturantUpdatesubcat');
        //  Route::get('parceldeletesubcat/{subcat_id}','subcatController@resturantdeletesubcat')->name('parceldeletesubcat');

              // for Products
         
         Route::get('resturantproduct','ProductController@product')->name('parcelproduct');
         Route::get('resturantaddproduct','ProductController@Addproduct')->name('parceladdproduct');
         Route::post('resturantaddnewproduct','ProductController@AddNewproduct')->name('parceladdnewproduct');
         Route::get('resturanteditproduct/{product_id}','ProductController@Editproduct')->name('parceleditproduct');
         Route::post('resturantupdateproduct/{product_id}','ProductController@Updateproduct')->name('parcelupdateproduct');
         Route::get('resturantdeleteproduct/{product_id}','ProductController@deleteproduct')->name('parceldeleteproduct');
         Route::post('searchproduct','ProductController@searchproduct')->name('searchproduct');

         
           // for Products variant 
         
          Route::get('resturantvarient/{id}','VarientController@varient')->name('parcelvarient');
    Route::get('resturantAddproductvariant/{id}','VarientController@Addproductvariant')->name('parcelAddproductvariant');
    Route::post('resturantAddNewproductvariant','VarientController@AddNewproductvariant')->name('parcelAddNewproductvariant');
    Route::get('resturantEditproductvariant/{id}','VarientController@Editproductvariant')->name('parcelEditproductvariant');
    Route::post('resturantUpdateproductvariant/{id}','VarientController@Updateproductvariant')->name('parcelUpdateproductvariant');
    Route::get('deleteproductvariant/{id}','VarientController@deleteproductvariant')->name('deleteproductvariant');
         



 	 
         
        //   for area
         Route::get('parcelarea','areaController@parcelarea')->name('parcelarea');
         Route::get('parcelAddarea','areaController@parcelAddarea')->name('parcelAddarea');
         Route::post('parcelAddInsertarea','areaController@parcelAddInsertarea')->name('parcelAddInsertarea');
         Route::get('parcelEditarea/{id}','areaController@parcelEditarea')->name('parcelEditarea');
         Route::post('parcelUpdatearea/{id}','areaController@parcelUpdatearea')->name('parcelUpdatearea');
         Route::get('parcelDeletearea/{id}','areaController@parcelDeletearea')->name('parcelDeletearea');
         
          // for coupon
 	 
     Route::get('parcelcouponlist','CouponController@parcelcouponlist')->name('parcelcouponlist');
	 Route::get('parcelcoupon','CouponController@parcelcoupon')->name('parcelcoupon');
	 Route::post('parceladdcoupon','CouponController@parceladdcoupon')->name('parceladdcoupon');
	 Route::get('parceleditcoupon/{coupon_id}','CouponController@parceleditcoupon')->name('parceleditcoupon');
	 Route::post('parcelupdatecoupon','CouponController@parcelupdatecoupon')->name('parcelupdatecoupon');
	 Route::get('parceldeletecoupon/{coupon_id}','CouponController@parceldeletecoupon')->name('parceldeletecoupon');
	 
	 // for delivery time
	 Route::get('resturanttimeslot','TimeSlotController@resturanttimeslot')->name('parceltimeslot');
	 Route::post('resturanttimeslotupdate','TimeSlotController@resturanttimeslotupdate')->name('parceltimeslotupdate');
	 
	 
	           // for delivery_boy
         Route::get('parceldelivery_boy','delivery_boyController@parceldelivery_boy')->name('parceldelivery_boy');
         Route::get('parcelAdddelivery_boy','delivery_boyController@parcelAdddelivery_boy')->name('parcelAdddelivery_boy');
         Route::post('parcelAddNewdelivery_boy','delivery_boyController@parcelAddNewdelivery_boy')->name('parcelAddNewdelivery_boy');
         Route::get('parcelEditdelivery_boy/{id}','delivery_boyController@parcelEditdelivery_boy')->name('parcelEditdelivery_boy');
         Route::post('parcelUpdatedelivery_boy/{id}','delivery_boyController@parcelUpdatedelivery_boy')->name('parcelUpdatedelivery_boy');
         Route::get('parceldeletedelivery_boy/{id}','delivery_boyController@parceldeletedelivery_boy')->name('parceldeletedelivery_boy');
         Route::get('parcelconfirmdeliverystatus/{id}/{status}', 'delivery_boyController@parcelconfirmdeliverystatus')->name('parcelconfirmdeliverystatus');
         
         // for order details
 	 
         Route::get('details','Today_OrderController@details')->name('details');
         
        Route::get('inventoryvendor', 'inventoryController@inventoryvendor')->name('inventoryvendor');
        Route::post('paycustomervendor/{order_complain_id}', 'inventoryController@paycustomervendor')->name('paycustomervendor');
          
        Route::get('dispatch_panelvendor', 'DispatchvendorController@dispatch_panelvendor')->name('dispatch_panelvendor');
	     Route::post('assignedcashrequestvendor', 'DispatchvendorController@assignedcashrequestvendor')->name('assignedcashrequestvendor');
	     
	    Route::get('resturantcomission','ComissionController@resturantcomission')->name('parcelcomission');
	    Route::get('resturantsendrequest/{com_id}','ComissionController@resturantsendrequest')->name('parcelsendrequest');
	    Route::post('resturantsearchcomission','ComissionController@resturantsearchcomission')->name('parcelsearchcomission');
        Route::get('resturantallexcelgenerator','ComissionController@resturantallexcelgenerator')->name('parcelallexcelgenerator');
     Route::get('resturantexcelgenerator/{startdate}/{enddate}', 'ComissionController@resturantexcelgenerator')->name('parcelexcelgenerator');
	    Route::get('parceldelivery_boy_comission','delivery_boy_comissionController@parceldelivery_boy_comission')->name('parceldelivery_boy_comission'); 
      Route::post('resturantsearchdeliveryboy','delivery_boy_comissionController@resturantsearchdeliveryboy')->name('parcelsearchdeliveryboy');
      Route::get('resturantallexceldownload','delivery_boy_comissionController@resturantallexceldownload')->name('parcelallexceldownload');      
      Route::get('resturantexceldownload/{startdate}/{enddate}', 'delivery_boy_comissionController@resturantexceldownload')->name('parcelexceldownload');
	            
	   //  Route::post('searchstock','Today_OrderController@searchstock')->name('searchstock');
	   //  Route::get('low_stock','Today_OrderController@low_stock')->name('low_stock');
	   //  Route::post('update_stock','Today_OrderController@update_stock')->name('update_stock');
	     
	       //for notification
     Route::get('parcel_notification', 'Notification3Controller@parcel_notification')->name('parcel-notification');
    Route::get('parcelcityadmindelivery_boy','delivery_boyController@parcelcityadmindelivery_boy')->name('parcelcityadmindelivery_boy');
});


