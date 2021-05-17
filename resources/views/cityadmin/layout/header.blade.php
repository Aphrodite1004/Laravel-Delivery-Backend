   <!-- BEGIN #header -->
		<div id="header" class="app-header">
			<!-- BEGIN mobile-toggler -->
			<div class="mobile-toggler">
				<button type="button" class="menu-toggler" data-toggle="sidebar-mobile">
					<span class="bar"></span>
					<span class="bar"></span>
				</button>
			</div>
			<!-- END mobile-toggler -->
			
			<!-- BEGIN brand -->
			<div class="brand">
				<div class="desktop-toggler">
					<button type="button" class="menu-toggler" data-toggle="sidebar-minify">
						<span class="bar"></span>
						<span class="bar"></span>
					</button>
				</div>
				
				<a href="#" class="brand-logo">
					<!--<img src="{{url('assets/img/logo.png')}}" alt="" height="20" />-->
					<label for="exampleInputName1">TecManic</label>
				</a>
			</div>
			<!-- END brand -->
			
			<!-- BEGIN menu -->
			<div class="menu">
			    	<div class="col-md-4" align="right">
                <select class="form-control changeLang">
                    <option value="en" {{ session()->get('locale') == 'en'? 'selected' : '' }}>English</option>
                    <!-- <option value="hindi" {{ session()->get('locale') == 'hindi'? 'selected' : '' }}>Hindi</option>
                    <option value="sp" {{ session()->get('locale') == 'sp'? 'selected' : '' }}>Spanish</option> -->
                    <option value="ar" {{ session()->get('locale') == 'ar'? 'selected' : '' }}>عربى</option>
                </select>
            </div>
				<form class="menu-search" method="POST" name="header_search_form">
					<div class="menu-search-icon"><i class="fa fa-search"></i></div>
					<div class="menu-search-input">
						<input type="text" class="form-control" placeholder="Search menu..." />
					</div>
				</form>
				<div class="menu-item dropdown">
					
					<div class="dropdown-menu dropdown-menu-right dropdown-notification">
						<h6 class="dropdown-header text-gray-900 mb-1">Notifications</h6>
						<a href="#" class="dropdown-notification-item">
							<div class="dropdown-notification-icon">
								<i class="fa fa-receipt fa-lg fa-fw text-success"></i>
							</div>
							<div class="dropdown-notification-info">
								<div class="title">Your store has a new order for 2 items totaling $1,299.00</div>
								<div class="time">just now</div>
							</div>
							<div class="dropdown-notification-arrow">
								<i class="fa fa-chevron-right"></i>
							</div>
						</a>
						<a href="#" class="dropdown-notification-item">
							<div class="dropdown-notification-icon">
								<i class="far fa-user-circle fa-lg fa-fw text-muted"></i>
							</div>
							<div class="dropdown-notification-info">
								<div class="title">3 new customer account is created</div>
								<div class="time">2 minutes ago</div>
							</div>
							<div class="dropdown-notification-arrow">
								<i class="fa fa-chevron-right"></i>
							</div>
						</a>
						<a href="#" class="dropdown-notification-item">
							<div class="dropdown-notification-icon">
								<img src="assets/img/icon/android.svg" alt="" width="26" />
							</div>
							<div class="dropdown-notification-info">
								<div class="title">Your android application has been approved</div>
								<div class="time">5 minutes ago</div>
							</div>
							<div class="dropdown-notification-arrow">
								<i class="fa fa-chevron-right"></i>
							</div>
						</a>
						<a href="#" class="dropdown-notification-item">
							<div class="dropdown-notification-icon">
								<img src="assets/img/icon/paypal.svg" alt="" width="26" />
							</div>
							<div class="dropdown-notification-info">
								<div class="title">Paypal payment method has been enabled for your store</div>
								<div class="time">10 minutes ago</div>
							</div>
							<div class="dropdown-notification-arrow">
								<i class="fa fa-chevron-right"></i>
							</div>
						</a>
						<div class="p-2 text-center mb-n1">
							<a href="#" class="text-gray-800 text-decoration-none">See all</a>
						</div>
					</div>
				</div>
				<div class="menu-item dropdown">
					<a href="#" data-toggle="dropdown" data-display="static" class="menu-link">
						<div class="menu-img online">
							<img src="{{url($cityadmin->cityadmin_image)}}" alt="" class="mw-100 mh-100 rounded-circle" />
						</div>
						<div class="menu-text">{{$cityadmin->cityadmin_name}}</div>
					</a>
					<div class="dropdown-menu dropdown-menu-right mr-lg-3">
						<div class="dropdown-divider"></div>
						<a class="dropdown-item d-flex align-items-center" href="{{route('cityadmin-logout')}}">Log Out <i class="fa fa-toggle-off fa-fw ml-auto text-gray-400 f-s-16"></i></a>
					</div>
				</div>
			</div>
			<!-- END menu -->
		</div>
		<!-- END #header -->
   
 