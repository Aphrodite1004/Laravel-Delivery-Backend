 		<!-- BEGIN #sidebar -->
		<div id="sidebar" class="app-sidebar">
			<!-- BEGIN scrollbar -->
			<div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
				<!-- BEGIN menu -->
				<div class="menu">
					<div class="menu-header">{{ __('messages.Navigation')}}</div>
					<div class="menu-item active">
						<a href="{{route('admin-index')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-laptop"></i></span>
							<span class="menu-text">{{ __('messages.dashboard')}}</span>
						</a>
					</div>
					<div class="menu-divider"></div>
					<div class="menu-header">{{ __('messages.notification')}} | {{ __('messages.To User')}} | {{ __('messages.vendor')}}</div>
					<div class="menu-item">
						<a href="{{route('adminNotification')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-bell"></i></span>
							<span class="menu-text">{{ __('messages.To User')}}</span>
						</a>
					</div>
					
					<div class="menu-item">
						<a href="{{route('Notification_to_store')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-bell"></i></span>
							<span class="menu-text">{{ __('messages.vendor')}}</span>
						</a>
					</div>
				     <div class="menu-divider"></div>
					<div class="menu-header">{{ __('messages.cities')}} | {{ __('messages.city admin')}}</div>
					<div class="menu-item">
						<a href="{{route('city')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-map-marker-alt"></i></span>
							<span class="menu-text">{{ __('messages.cities')}}</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="{{route('cityadmin')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-users"></i></span>
							<span class="menu-text">{{ __('messages.city admin')}}</span>
						</a>
					</div>
				
					<div class="menu-divider"></div>
					<div class="menu-header"> {{ __('messages.banner')}} | {{ __('messages.ui')}}</div>
				
					<div class="menu-item">
						<a href="{{route('adminbanner')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-image"></i></span>
							<span class="menu-text">{{ __('messages.banner')}}</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="{{route('vendorlist')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-circle"></i></span>
							<span class="menu-text">{{ __('messages.ui')}}</span>
						</a>
					</div>
					<div class="menu-divider"></div>
					<div class="menu-header">{{ __('messages.user management')}}</div>
						<div class="menu-item">
						<a href="{{route('alluser')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-user-circle"></i></span>
							<span class="menu-text">{{ __('messages.app user')}}</span>
						</a>
					</div>
				
					 <div class="menu-divider"></div>
					<div class="menu-header">{{ __('messages.order complaint')}} | {{ __('messages.cancel reason')}}</div>
					<div class="menu-item">
						<a href="{{route('complain')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-bullhorn"></i></span>
							<span class="menu-text">{{ __('messages.order complaint')}}</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="{{route('cancel_reason')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-ban"></i></span>
							<span class="menu-text">{{ __('messages.cancel reason')}}</span>
						</a>
					</div>
					
					<div class="menu-divider"></div>
					<div class="menu-header">{{ __('messages.rewards')}} | {{ __('messages.redeem point')}} | {{ __('messages.reffer')}}</div>
					<div class="menu-item">
						<a href="{{route('RewardList')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-trophy"></i></span>
							<span class="menu-text">{{ __('messages.rewards')}}</span>
						</a>
					</div>
					
					<div class="menu-item">
						<a href="{{route('reedem')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-gift"></i></span>
							<span class="menu-text">{{ __('messages.redeem point')}}</span>
						</a>
					</div>
					
						<div class="menu-item">
						<a href="{{route('reffer')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-share-alt"></i></span>
							<span class="menu-text">{{ __('messages.reffer')}}</span>
						</a>
					</div>
						<div class="menu-item">
						<a href="{{route('admincomission')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-book"></i></span>
							<span class="menu-text">{{ __('messages.comission')}}</span>
						</a>
					</div>
					<div class="menu-divider"></div>
					<div class="menu-header">{{ __('messages.term condition')}} | {{ __('messages.about us')}} | {{ __('messages.feedback')}}</div>
					<div class="menu-item">
						<a href="{{route('termcondition')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-file"></i></span>
							<span class="menu-text">{{ __('messages.term condition')}}</span>
						</a>
					</div>
					
					<div class="menu-item">
						<a href="{{route('aboutus')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-book"></i></span>
							<span class="menu-text">{{ __('messages.about us')}}</span>
						</a>
					</div>
					
					<div class="menu-item">
						<a href="{{route('Feedback')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-comments"></i></span>
							<span class="menu-text">{{ __('messages.feedback')}}</span>
						</a>
					</div>
					
					
						<div class="menu-divider"></div>
					<div class="menu-header">{{ __('messages.Wallet | Offers')}}</div>
						<div class="menu-item">
						<a href="{{route('amountlist')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-list"></i></span>
							<span class="menu-text">{{ __('messages.Normal Plans')}}</span>
						</a>
					</div>
					
					<div class="menu-item">
						<a href="{{route('offer_list')}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-gift"></i></span>
							<span class="menu-text">{{ __('messages.Offer Plans')}}</span>
						</a>
					</div>
					
					<div class="menu-divider"></div>
					<div class="menu-header"> {{ __('messages.global setting')}}</div>
					
                  
					<div class="menu-item">
						<a href="{{route('edit-admin',[$admin->id])}}" class="menu-link">
							<span class="menu-icon"><i class="fa fa-cog"></i></span>
							<span class="menu-text">{{ __('messages.global setting')}}</span>
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
 
 
 
 
 

