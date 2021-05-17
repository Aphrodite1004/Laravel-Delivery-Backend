@extends('resturant.layout.app')

@section ('content')
			<!-- BEGIN container -->
			<div class="container">
				<!-- BEGIN row -->
				<div class="row justify-content-center">
					<!-- BEGIN col-10 -->
					<div class="col-xl-10">
						<!-- BEGIN row -->
						<div class="row">
							<!-- BEGIN col-9 -->
							<div class="col-xl-9">
								<!-- BEGIN #general -->
								<div id="general" class="mb-5">
									<h4><i class="far fa-user fa-fw"></i> Account Settings</h4>
									<p>View and update your Account settings.</p>
									<div class="card">
										<div class="list-group list-group-flush">
											 <form class="forms-sample" action="{{route('resturantvendorUpdateProfile',[$vendor->vendor_id])}}" method="post" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                             @if (count($errors) > 0)
                                            @if($errors->any())
                                           <div class="alert alert-primary" role="alert">
                                          <strong>SUCCESS : </strong>{{$errors->first()}}
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">×</span>
                                          </button>
                                          </div>
                                          @endif
                                         @endif
                                            <div class="form-group list-group-item d-flex align-items-center">
                                              <label for="exampleInputName1">Vendor Name</label>
                                              <input type="text" class="form-control" name="vendor_name" value="{{$vendor->vendor_name}}" id="exampleInputName1" placeholder="Name">
                                            </div>
                                            <div class="form-group list-group-item d-flex align-items-center">
                                              <label for="exampleInputName1">Vendor Email</label>
                                              <input type="text" class="form-control" name="vendor_email" value="{{$vendor->vendor_email}}" id="exampleInputName1">
                                            </div>
                                            <div class="form-group list-group-item d-flex align-items-center">
                                              <label for="exampleInputName1">Admin Phone</label>
                                              <input type="text" class="form-control" name="vendor_phone" value="{{$vendor->vendor_phone}}" id="exampleInputName1">
                                            </div>
                                        
                                           <div class="form-group list-group-item d-flex align-items-center">
                                              <label>Vendor Image</label>
                                              <input type="hidden" name="old_vendor_image" value="{{$vendor->vendor_logo}}">
                                              <img src="{{url($vendor->vendor_logo)}}" style="width:50px; height:50px; border-radius:50%"/>&nbsp; &nbsp;
                                              <div class="input-group col-xs-12">
                                              <div class="custom-file">
                                                  <input type="file" name="vendor_image" class="custom-file-input" id="customFile" />
                                                  <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>      
                                              
                                              </div>
                                            </div>
                                            <div class="form-group list-group-item d-flex align-items-center">
                                              <label for="exampleInputName1">Admin password</label>
                                              <input type="password" class="form-control" name="vendor_pass" placeholder="enter new password if you want to change" id="exampleInputName1">
                                            </div>
                                            <div class="form-group list-group-item d-flex align-items-center">
                                              <label for="exampleInputName1">retype password</label>
                                              <input type="password" class="form-control" name="password2"  placeholder="retype password" id="exampleInputName1">
                                            </div>
                                            <div class="form-group list-group-item d-flex align-items-center">
                                            <button type="submit" class="btn btn-success width-100">Submit</button>
                                           <!--  <button class="btn btn-light">Cancel</button> -->
                                           </div>
                                          </form>
										</div>
									
									</div>
								</div>
								<!-- END #general -->
								
								<!-- BEGIN #notifications -->
								<!-- <div id="notifications" class="mb-5">
									<h4><i class="far fa-clock fa-fw"></i> Delivery Timing</h4>
									<p>Edit Delivery Timing.</p>
									<div class="card">
										<div class="list-group list-group-flush">
										  <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                  <thead>
                                                    <tr>
                                                    <th>Delivery Type</th>
                                                    <th>Delivery Timing Text</th>
                                                    <th>Delivery Time Slot</th>
                                                    <th>Action</th>
                                                    </tr>
                                                  </thead>
                                             
                                                </table>
                                              </div>
										</div>
									</div>
								</div> -->
								<!-- END #notifications -->
								
								<!-- BEGIN #privacyAndSecurity -->
								<!-- <div id="privacyAndSecurity" class="mb-5">
									<h4><i class="far fa-bell fa-fw"></i>FCM server Key</h4>
									<p>FCM server key for notifications.</p>
									<div class="card">
										<div class="list-group list-group-flush">
							
										</div>
									</div>
								</div> -->
								<!-- END #privacyAndSecurity -->
								
								<!-- BEGIN #payment -->
								<!-- <div id="payment" class="mb-5">
									<h4><i class="far fa-credit-card fa-fw"></i> Edit App Logo & App Name</h4>
									<p>Edit app logo and name</p>
									<div class="card">
										<div class="list-group list-group-flush">
											
										
										</div>
									</div>
								</div> -->
								<!-- END #payment -->
								
			
								

								
							
							
							</div>
							<!-- END col-9-->
							<!-- BEGIN col-3 -->
							<div class="col-xl-3">
								<!-- BEGIN #sidebar-bootstrap -->
			
								<!-- END #sidebar-bootstrap -->
							</div>
							<!-- END col-3 -->
							
							
							
							
							
						</div>
						<!-- END row -->
					</div>
					<!-- END col-10 -->
				</div>
				<!-- END row -->
			</div>
			<!-- END container -->
			
			
		
		<!-- END #modalEdit -->
@endsection