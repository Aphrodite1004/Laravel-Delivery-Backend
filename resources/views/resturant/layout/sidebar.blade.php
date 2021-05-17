 		<!-- BEGIN #sidebar -->
		<div id="sidebar" class="app-sidebar">
			<!-- BEGIN scrollbar -->
			<div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
				<!-- BEGIN menu -->
				<div class="menu">
					<div class="menu-header">{{ __('messages.Navigation')}}</div>
					<div class="menu-item active">
						<a href="{{route('resturant-index')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-laptop"></i></span>
							<span class="menu-text">{{ __('messages.dashboard')}}</span>
						</a>
					</div>

			         <div class="menu-item">
						<a href="{{route('resturantbannervendor')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-image"></i></span>
							<span class="menu-text">{{ __('messages.banner_management')}}</span>
						</a>
					</div>
				
					<div class="menu-divider"></div>
					<div class="menu-header">{{ __('messages.Categories')}} | {{ __('messages.Deals')}} |  {{ __('messages.Products')}}</div>
					<div class="menu-item">
						<a href="{{route('resturantcategory')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-cube"></i></span>
							<span class="menu-text">{{ __('messages.Categories')}}</span>
						</a>
					</div>
				
			
					
					<div class="menu-item">
						<a href="{{route('resturantproduct')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-cog"></i></span>
							<span class="menu-text">{{ __('messages.Products')}}</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="{{route('resturantdealroduct')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-shopping-basket"></i></span>
							<span class="menu-text">{{ __('messages.Deals')}} {{ __('messages.Products')}}</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="{{route('restaurantbulkup')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-upload"></i></span>
							<span class="menu-text">{{ __('messages.Bulk_Upload')}}</span>
						</a>
					</div>
					
					<div class="menu-divider"></div>
					<div class="menu-header">{{ __('messages.Area')}} | {{ __('messages.Delivery_Boy')}} | {{ __('messages.Incentive')}}</div>
					<div class="menu-item">
						<a href="{{route('restaurantarea')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-map-marker"></i></span>
							<span class="menu-text">{{ __('messages.Area')}}</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="{{route('resturantdelivery_boy')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-motorcycle"></i></span>
							<span class="menu-text">{{ __('messages.Delivery_Boy')}}</span>
						</a>
					</div>
						<div class="menu-item">
						<a href="{{route('resturantdelivery_boy_comission')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-book"></i></span>
							<span class="menu-text">{{ __('messages.Delivery_Boy_Comission')}}</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="{{route('resturantcityadmindelivery_boy')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-bicycle"></i></span>
							<span class="menu-text">{{ __('messages.City_Admin_Delivery_Boys')}}</span>
						</a>
					</div>
				    <div class="menu-divider"></div>
					<div class="menu-header">{{ __('messages.Incentive')}} | {{ __('messages.Coupon')}}</div>
					
				    <div class="menu-item">
						<a href="{{route('resturantcouponlist')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-gift"></i></span>
							<span class="menu-text">{{ __('messages.Coupon')}}</span>
						</a>
					</div>
				
					<div class="menu-divider"></div>
					<div class="menu-header">{{ __('messages.vendor')}} | {{ __('messages.Orders')}} | {{ __('messages.Comission')}}</div>
					<div class="menu-item">
						<a href="{{route('today_order_restaurant')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-cart-plus"></i></span>
							<span class="menu-text">{{ __('messages.Today')}} | {{ __('messages.Orders')}}</span>
						</a>
					</div>
				
					<div class="menu-item">
						<a href="{{route('resturant_complete_order')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-thumbs-up"></i></span>
							<span class="menu-text">{{ __('messages.Completed')}} | {{ __('messages.Orders')}}</span>
						</a>
					</div>
						<div class="menu-item">
						<a href="{{route('resturant_cancelled_order')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-ban"></i></span>
							<span class="menu-text">{{ __('messages.Cancelled Order')}}</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="{{route('resturantcomission')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-book"></i></span>
							<span class="menu-text">{{ __('messages.Admin')}} | {{ __('messages.Comission')}}</span>
						</a>
					</div>
					
					<div class="menu-divider"></div>
					<div class="menu-header">{{ __('messages.Vendor_Settings')}}</div>
				        <div class="menu-item">
						<a href="{{route('resturanttimeslot')}}" class="menu-link">
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
		






 
