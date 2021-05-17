 		<!-- BEGIN #sidebar -->
		<div id="sidebar" class="app-sidebar">
			<!-- BEGIN scrollbar -->
			<div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
				<!-- BEGIN menu -->
				<div class="menu">
					<div class="menu-header">{{ __('messages.Navigation')}}</div>
					<div class="menu-item active">
						<a href="{{route('pharmacy-index')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-laptop"></i></span>
							<span class="menu-text">{{ __('messages.dashboard')}}</span>
						</a>
					</div>

			         <div class="menu-item">
						<a href="{{route('pharmacybannervendor')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-image"></i></span>
							<span class="menu-text">{{ __('messages.banner_management')}}</span>
						</a>
					</div>
	
					<div class="menu-divider"></div>
					<div class="menu-header">{{ __('messages.Categories')}} | {{ __('messages.Deal')}} | {{ __('messages.Products')}}</div>
					<div class="menu-item">
						<a href="{{route('pharmacycategory')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-cube"></i></span>
							<span class="menu-text">{{ __('messages.Categories')}}</span>
						</a>
					</div>
				
			
					
					<div class="menu-item">
						<a href="{{route('pharmacyproduct')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-cog"></i></span>
							<span class="menu-text">{{ __('messages.Products')}}</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="{{route('pharmacydealroduct')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-shopping-basket"></i></span>
							<span class="menu-text">{{ __('messages.Deal')}} {{ __('messages.Products')}}</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="{{route('pharmacybulkup')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-upload"></i></span>
							<span class="menu-text">{{ __('messages.Bulk_Upload')}}</span>
						</a>
					</div>
					
					<div class="menu-divider"></div>
					<div class="menu-header">{{ __('messages.Area')}} | {{ __('messages.Delivery_Boy')}} | {{ __('messages.Incentive')}}</div>
					<div class="menu-item">
						<a href="{{route('pharmacyarea')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-map-marker"></i></span>
							<span class="menu-text">{{ __('messages.Area')}}</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="{{route('pharmacydelivery_boy')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-motorcycle"></i></span>
							<span class="menu-text">{{ __('messages.Delivery_Boy')}}</span>
						</a>
					</div>
						<div class="menu-item">
						<a href="{{route('pharmacydelivery_boy_comission')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-book"></i></span>
							<span class="menu-text">{{ __('messages.Delivery_Boy_Comission')}}</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="{{route('pharmacycityadmindelivery_boy')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-bicycle"></i></span>
							<span class="menu-text">{{ __('messages.City_Admin_Delivery_Boys')}}</span>
						</a>
					</div>
				    <div class="menu-divider"></div>
					<div class="menu-header">{{ __('messages.Incentive')}} | {{ __('messages.Coupon')}}</div>
					
				    <div class="menu-item">
						<a href="{{route('pharmacycouponlist')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-gift"></i></span>
							<span class="menu-text">{{ __('messages.Coupon')}}</span>
						</a>
					</div>
				
					<div class="menu-divider"></div>
					<div class="menu-header">{{ __('messages.Vendor')}} | {{ __('messages.Orders')}} | {{ __('messages.Comission')}}</div>
					<div class="menu-item">
						<a href="{{route('parmacy_order_list')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-envelope"></i></span>
							<span class="menu-text"> {{ __('messages.Order_by_Image')}}</span>
						</a>
					</div>
					
					<div class="menu-item">
						<a href="{{route('today_order_pharmacy')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-cart-plus"></i></span>
							<span class="menu-text">{{ __('messages.Today_orders')}}</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="{{route('pharmacynext_day')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-shopping-bag"></i></span>
							<span class="menu-text">{{ __('messages.Next_Day_Order')}}</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="{{route('pharmacy_complete_order')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-thumbs-up"></i></span>
							<span class="menu-text">{{ __('messages.Completed_orders')}}</span>
						</a>
					</div>
					
					<div class="menu-item">
						<a href="{{route('pharmacy_cancelled_order')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-ban"></i></span>
							<span class="menu-text">{{ __('messages.Cancelled Order')}}</span>
						</a>
					</div>
					
					<div class="menu-item">
						<a href="{{route('pharmacycomission')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-book"></i></span>
							<span class="menu-text">{{ __('messages.Admin')}} | {{ __('messages.Comission')}}</span>
						</a>
					</div>
					
					<div class="menu-divider"></div>
					<div class="menu-header">{{ __('messages.Vendor_Settings')}}</div>
				        <div class="menu-item">
						<a href="{{route('pharmacytimeslot')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-clock"></i></span>
							<span class="menu-text">{{ __('messages.Delivery_Time_Slot')}}</span>
						</a>
					</div>
					 
					
				</div>
				<!-- END menu -->
			</div>
			<!-- END scrollbar -->
			
			<!-- BEGIN mobile-sidebar-backdrop -->
			<button class="app-sidebar-mobile-backdrop" data-dismiss="sidebar-mobile"></button>
			<!-- END mobile-sidebar-backdrop -->
		</div>
		<!-- END #sidebar -->
		






 
