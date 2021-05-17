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
					<a href="#" data-toggle="dropdown" data-display="static" class="menu-link">
						<div class="menu-icon"><i class="fa fa-bell nav-icon"></i></div>
						<a href="{{route('admin-notification')}}">

						<div class="menu-label">
						    						@include('admin.unread')

						</div>
						</a>
					</a>
<?php
	
  $notes = DB::table('payout_notification')->orderBy('payout_notification_id', 'DESC')->limit(10)
  ->get();					
  ?>
  <div class="dropdown-menu dropdown-menu-right dropdown-notification" style="	margin-left: 30px;
	float: left;
	height: 300px;
	width: 65px;
	background: #F5F5F5;
	overflow-y: scroll;
	margin-bottom: 25px;" >
						<h6 class="dropdown-header text-gray-900 mb-1">Notifications</h6>
			@foreach($notes as $note)
                         @if($note->read_by_admin==1)
						<a href="#" class="dropdown-notification-item" style="background:#E4E9F2" >
							<div class="dropdown-notification-icon">
							</div>
							<div class="dropdown-notification-info">
								<div class="title">Hello,<br>you received a payout request from {{$note->vendor_name}}</div>
								<div class="time"></div>
							</div>
							<div class="dropdown-notification-arrow">
								<i class="fa fa-chevron-right"></i>
							</div>
						</a>
				        @else
						<a href="#" class="dropdown-notification-item">
							<div class="dropdown-notification-icon">
							</div>
							<div class="dropdown-notification-info">
							<div class="title">Hello,<br>you received a payout request from {{$note->vendor_name}}</div>
								<div class="time"></div>
							</div>
							<div class="dropdown-notification-arrow">
								<i class="fa fa-chevron-right"></i>
							</div>
						</a>
						@endif
				@endforeach
				<div class="p-2 text-center mb-n1">
							<a href="{{route('admin-notification')}}" class="text-gray-800 text-decoration-none">See all</a>
						</div>
						
					</div>
				</div>
				<div class="menu-item dropdown">
					<a href="#" data-toggle="dropdown" data-display="static" class="menu-link">
						<div class="menu-img online">
							<img src="{{url($admin->admin_image)}}" alt="" class="mw-100 mh-100 rounded-circle" />
						</div>
						<div class="menu-text">{{$admin->admin_email}}</div>
					</a>
					<div class="dropdown-menu dropdown-menu-right mr-lg-3">
						<a class="dropdown-item d-flex align-items-center" href="{{route('edit-admin',[$admin->id])}}">Edit Profile <i class="fa fa-user-circle fa-fw ml-auto text-gray-400 f-s-16"></i></a>
						<!--<a class="dropdown-item d-flex align-items-center" href="#">Inbox <i class="fa fa-envelope fa-fw ml-auto text-gray-400 f-s-16"></i></a>-->
						<!--<a class="dropdown-item d-flex align-items-center" href="#">Calendar <i class="fa fa-calendar-alt fa-fw ml-auto text-gray-400 f-s-16"></i></a>-->
						<!--<a class="dropdown-item d-flex align-items-center" href="#">Setting <i class="fa fa-wrench fa-fw ml-auto text-gray-400 f-s-16"></i></a>-->
						<div class="dropdown-divider"></div>
						<a class="dropdown-item d-flex align-items-center" href="{{route('admin-logout')}}">Log Out <i class="fa fa-toggle-off fa-fw ml-auto text-gray-400 f-s-16"></i></a>
					</div>
				</div>
			</div>
			<!-- END menu -->
		</div>
		<!-- END #header -->

   
 