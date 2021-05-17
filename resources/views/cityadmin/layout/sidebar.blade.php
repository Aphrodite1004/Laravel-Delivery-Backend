 		<!-- BEGIN #sidebar -->
		<div id="sidebar" class="app-sidebar">
			<!-- BEGIN scrollbar -->
			<div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
				<!-- BEGIN menu -->
				<div class="menu">
					<div class="menu-header">{{ __('messages.Navigation')}}</div>
					<div class="menu-item active">
						<a href="{{route('cityadmin-index')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-laptop"></i></span>
							<span class="menu-text">{{ __('messages.dashboard')}}</span>
						</a>
					</div>
							<div class="menu-divider"></div>
					<div class="menu-header">{{ __('messages.notification')}} | {{ __('messages.To User')}} | {{ __('messages.vendor')}}</div>
					<div class="menu-item">
						<a href="{{route('cityadminNotification')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-bell"></i></span>
							<span class="menu-text">{{ __('messages.To User')}}</span>
						</a>
					</div>
					
					<div class="menu-item">
						<a href="{{route('CNotification_to_store')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-bell"></i></span>
							<span class="menu-text">{{ __('messages.vendor')}}</span>
						</a>
					</div>
				
				
			  
					<div class="menu-divider"></div>
					<div class="menu-header">| {{ __('messages.Delivery_Boy')}} | {{ __('messages.Area')}}</div>
				
					<div class="menu-item">
						<a href="{{route('delivery_boy')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-male"></i></span>
							<span class="menu-text">{{ __('messages.Delivery_Boy')}}</span>
						</a>
					</div>
						<div class="menu-item">
						<a href="{{route('cdelivery_boy_comission')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-male"></i></span>
							<span class="menu-text">{{ __('messages.Delivery_Boy_Comission')}}</span>
						</a>
					</div>
					
					<div class="menu-item">
						<a href="{{route('area')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-map-marker"></i></span>
							<span class="menu-text">{{ __('messages.Area')}}</span>
						</a>
					</div>
					<div class="menu-divider"></div>
					<div class="menu-header">{{ __('messages.Vendor')}} | {{ __('messages.Vendor')}}</div>
					<div class="menu-item">
						<a href="{{route('vendor')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-users"></i></span>
							<span class="menu-text"> {{ __('messages.Vendor')}}</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="{{route('vendor_list')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-bullseye"></i></span>
							<span class="menu-text"> {{ __('messages.Today')}} | {{ __('messages.Completed')}}</span>
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
 
