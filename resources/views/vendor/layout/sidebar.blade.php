 		<!-- BEGIN #sidebar -->
		<div id="sidebar" class="app-sidebar">
			<!-- BEGIN scrollbar -->
			<div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
				<!-- BEGIN menu -->
				<div class="menu">
					<div class="menu-header">{{ __('messages.Navigation')}}</div>
					<div class="menu-item active">
						<a href="{{route('vendor-index')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-laptop"></i></span>
							<span class="menu-text">{{ __('messages.dashboard')}}</span>
						</a>
					</div>

			         <div class="menu-item">
						<a href="{{route('bannervendor')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-image"></i></span>
							<span class="menu-text">{{ __('messages.banner_management')}}</span>
						</a>
					</div>
				    <div class="menu-item">
						<a href="{{route('low_stock')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-truck"></i></span>
							<span class="menu-text">{{ __('messages.Low_stock_alert')}}</span>
						</a>
					</div>
					<div class="menu-divider"></div>
					<div class="menu-header">{{ __('messages.Categories')}} | {{ __('messages.Deals')}} | {{ __('messages.Products')}}</div>
					<div class="menu-item">
						<a href="{{route('vendorcategory')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-cube"></i></span>
							<span class="menu-text">{{ __('messages.Categories')}}</span>
						</a>
					</div>
				
					<div class="menu-item">
						<a href="{{route('vendorsubcat')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-cubes"></i></span>
							<span class="menu-text">{{ __('messages.Sub_Category')}}</span>
						</a>
					</div>
					
					<div class="menu-item">
						<a href="{{route('vendorproduct')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-cog"></i></span>
							<span class="menu-text">{{ __('messages.Product')}}</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="{{route('dealroduct')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-shopping-basket"></i></span>
							<span class="menu-text">{{ __('messages.Deal_Products')}}</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="{{route('bulkup')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-upload"></i></span>
							<span class="menu-text">{{ __('messages.Bulk_Upload')}}</span>
						</a>
					</div>
					
					<div class="menu-divider"></div>
					<div class="menu-header">{{ __('messages.Area')}} | {{ __('messages.Delivery_Boy')}}</div>
					<div class="menu-item">
						<a href="{{route('vendorarea')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-map-marker"></i></span>
							<span class="menu-text">{{ __('messages.Area')}}</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="{{route('vendordelivery_boy')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-motorcycle"></i></span>
							<span class="menu-text">{{ __('messages.Delivery_Boy')}}</span>
						</a>
					</div>
						<div class="menu-item">
						<a href="{{route('delivery_boy_comission')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-book"></i></span>
							<span class="menu-text">{{ __('messages.Delivery_Boy_Comission')}}</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="{{route('cityadmindelivery_boy')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-bicycle"></i></span>
							<span class="menu-text">{{ __('messages.City_Admin_Delivery_Boys')}}</span>
						</a>
					</div>
				    <div class="menu-divider"></div>
					<div class="menu-header">{{ __('messages.Coupon_Management')}}</div>
				
				    <div class="menu-item">
						<a href="{{route('couponlist')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-gift"></i></span>
							<span class="menu-text">{{ __('messages.Coupon')}}</span>
						</a>
					</div>
				
					<div class="menu-divider"></div>
					<div class="menu-header">{{ __('messages.Vendor')}} | {{ __('messages.Orders')}} | {{ __('messages.Comission')}}</div>
					
						<div class="menu-item">
						<a href="{{route('user_list')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-envelope"></i></span>
							<span class="menu-text"> {{ __('messages.Order_by_Image')}}</span>
						</a>
					</div>
					
					<div class="menu-item">
						<a href="{{route('today_order_vendor')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-cart-plus"></i></span>
							<span class="menu-text">{{ __('messages.Today_orders')}}</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="{{route('next_day_order_vendor')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-shopping-bag"></i></span>
							<span class="menu-text">{{ __('messages.Next_Day_Order')}}</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="{{route('complete_order')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-thumbs-up"></i></span>
							<span class="menu-text">{{ __('messages.Completed_orders')}}</span>
						</a>
					</div>
					
					<div class="menu-item">
						<a href="{{route('cancel_order_grocery')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-ban"></i></span>
							<span class="menu-text">{{ __('messages.Cancelled Order')}}</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="{{route('comission')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-book"></i></span>
							<span class="menu-text">{{ __('messages.Admin_Comission')}}</span>
						</a>
					</div>
					
					<div class="menu-divider"></div>
					<div class="menu-header">{{ __('messages.Vendor_Settings')}}</div>
				        <div class="menu-item">
						<a href="{{route('timeslot')}}" class="menu-link">
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
		






 
