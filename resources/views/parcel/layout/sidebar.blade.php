 		<!-- BEGIN #sidebar -->
		<div id="sidebar" class="app-sidebar">
			<!-- BEGIN scrollbar -->
			<div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
				<!-- BEGIN menu -->
				<div class="menu">
					<div class="menu-header">{{ __('messages.Navigation')}}</div>
					<div class="menu-item active">
						<a href="{{route('parcel-index')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-laptop"></i></span>
							<span class="menu-text">{{ __('messages.dashboard')}}</span>
						</a>
					</div>

				
				
		
			
					<div class="menu-divider"></div>
					<div class="menu-header">{{ __('messages.Charges')}}</div>
					<div class="menu-item">
						<a href="{{url('Parcel/charges')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-map-marker-alt"></i></span>
							<span class="menu-text">{{ __('messages.Parcel_Charges_List')}}</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="{{url('Parcel/add-charge')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-map-marker-alt"></i></span>
							<span class="menu-text">{{ __('messages.Add_Charges')}}</span>
						</a>
					</div>

					<div class="menu-divider"></div>
					<div class="menu-header">{{ __('messages.City')}} | {{ __('messages.Area')}} | {{ __('messages.Delivery_Boy')}} </div>
					<div class="menu-item">
						<a href="{{url('Parcel/city')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-map-marker-alt"></i></span>
							<span class="menu-text">{{ __('messages.Cities')}}</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="{{route('parcelarea')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-map-marker"></i></span>
							<span class="menu-text">{{ __('messages.Area')}}</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="{{route('parceldelivery_boy')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-motorcycle"></i></span>
							<span class="menu-text">{{ __('messages.Delivery_Boy')}}</span>
						</a>
					</div>
							<div class="menu-item">
						<a href="{{route('parceldelivery_boy_comission')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-book"></i></span>
							<span class="menu-text">{{ __('messages.Delivery_Boy_Comission')}}</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="{{route('parcelcityadmindelivery_boy')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-bicycle"></i></span>
							<span class="menu-text">{{ __('messages.City_Admin_Delivery_Boys')}}</span>
						</a>
					</div>
				    <div class="menu-divider"></div>
					<div class="menu-header">{{ __('messages.Coupon_Management')}}</div>
					
				    <div class="menu-item">
						<a href="{{route('parcelcouponlist')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-gift"></i></span>
							<span class="menu-text">{{ __('messages.Coupon')}}</span>
						</a>
					</div>
				
					{{--<div class="menu-divider"></div>
					<div class="menu-header">{{ __('messages.vendor')}} | {{ __('messages.Orders')}} | {{ __('messages.Comission')}}</div>
					<div class="menu-item">
						<a href="{{route('parceltoday_order')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-cart-plus"></i></span>
							<span class="menu-text">{{ __('messages.Today')}} | {{ __('messages.Orders')}}</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="{{route('parceltoday_order')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-thumbs-up"></i></span>
							<span class="menu-text">{{ __('messages.Completed')}} | {{ __('messages.Orders')}}</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="{{route('parcelcomission')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-book"></i></span>
							<span class="menu-text">{{ __('messages.Admin')}} | {{ __('messages.Comission')}}</span>
						</a>
					</div>--}}

					<div class="menu-divider"></div>
					<div class="menu-header">{{ __('messages.vendor')}} | {{ __('messages.Orders')}} | {{ __('messages.Comission')}}</div>
					<div class="menu-item">
						<a href="{{route('today_order_parcel')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-cart-plus"></i></span>
							<span class="menu-text"> {{ __('messages.Orders')}}</span>
						</a>
					</div>
				
					<div class="menu-item">
						<a href="{{route('parcel_complete_order')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-thumbs-up"></i></span>
							<span class="menu-text">{{ __('messages.Completed')}} | {{ __('messages.Orders')}}</span>
						</a>
					</div>
					
					<div class="menu-divider"></div>
					<div class="menu-header">{{ __('messages.Vendor_Settings')}}</div>
				        <div class="menu-item">
						<a href="{{route('parceltimeslot')}}" class="menu-link">
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
		






 
