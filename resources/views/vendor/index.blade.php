@extends('vendor.layout.app')

@section ('content')



        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            	<h1 class="page-header mb-3">
				Hi, {{$vendor->owner}}. <small>{{ __('messages.happening')}}</small>
			</h1>
          </div>

          <!-- BEGIN row -->
            <div class="row">
                <!-- BEGIN col-6 -->
                <div class="col-xl-6">
                    <!-- BEGIN card -->
                    <div class="card text-white-transparent-7 mb-3 overflow-hidden">
                        <!-- BEGIN card-img-overlay -->
                        <div class="card-img-overlay d-block d-lg-none bg-blue rounded"></div>
                        <!-- END card-img-overlay -->
                        
                        <!-- BEGIN card-img-overlay -->
                        <div class="card-img-overlay d-none d-md-block bg-blue rounded" style="background-image:url('assets/img/bg/wave-bg.png') ; background-position: right bottom; background-repeat: no-repeat; background-size: 100%;"></div>
                        <!-- END card-img-overlay -->
                        
                        <!-- BEGIN card-img-overlay -->
                        <div class="card-img-overlay d-none d-md-block bottom-0 top-auto">
                            <div class="row">
                                <div class="col-md-8 col-xl-6"></div>
                                <div class="col-md-4 col-xl-6 mb-n2">
                                    <img src="{{url('assets/img/page/dashboard.svg')}}" alt="" class="d-block ml-n3 mb-5" style="max-height: 310px" />
                                </div>
                            </div>
                        </div>
                        <!-- END card-img-overlay -->
                        
                        <!-- BEGIN card-body -->
                        <div class="card-body position-relative">
                            <!-- BEGIN row -->
                            <div class="row">
                                <!-- BEGIN col-8 -->
                                <div class="col-md-8">
                                    <!-- stat-top -->
                                    <div class="d-flex">
                                        <div class="mr-auto">
                                            <h5 class="text-white-transparent-8 mb-3">{{ __('messages.Total_Earning')}}</h5>
                                            <h3 class="text-white mt-n1 mb-1">{{$currency->currency_sign}}{{$total_cash}}</h3>
                                            <p class="mb-1 text-white-transparent-6 text-truncate">
                                                 <b></b>{{ __('messages.total_earning_by_all_the_vendors')}}
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <hr class="hr-transparent bg-white-transparent-2 mt-3 mb-3" />
                                    
                                    <!-- stat-bottom -->
                                    <div class="row">
                                        <div class="col-6 col-lg-5">
                                            <div class="mt-1">
                                                <i class="fa fa-fw fa-shopping-bag fs-28px text-black-transparent-5"></i>
                                            </div>
                                            <div class="mt-1">
                                                <div>{{ __('messages.Total_Sales')}}</div>
                                                <div class="font-weight-600 text-white">{{$currency->currency_sign}}{{$total_cash}}</div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-lg-5">
                                            <div class="mt-1">
                                                <i class="fa fa-fw fa-retweet fs-28px text-black-transparent-5"></i>
                                            </div>
                                            <div class="mt-1">
                                                <div>{{ __('messages.Referral_Sales')}}</div>
                                                <div class="font-weight-600 text-white">{{$currency->currency_sign}}{{$reffer_arning}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <hr class="hr-transparent bg-white-transparent-2 mt-3 mb-3" />
                                    
                                    <div class="mt-3 mb-2">
                                        <a href="{{ route('allexcelgenerator') }}" class="btn btn-yellow btn-rounded btn-sm pl-5 pr-5 pt-2 pb-2 fs-14px font-weight-600"><i class="fa fa-wallet mr-2 ml-n2"></i>{{ __('messages.Download_Report')}}</a>
                                    </div>
                                    
                                </div>
                                <!-- END col-8 -->
                                
                                <!-- BEGIN col-4 -->
                                <div class="col-md-4 d-none d-md-block" style="min-height: 380px;"></div>
                                <!-- END col-4 -->
                            </div>
                            <!-- END row -->
                        </div>
                        <!-- END card-body -->
                    </div>
                    <!-- END card -->
                </div>
                <!-- END col-6 -->
                
                <!-- BEGIN col-6 -->
                <div class="col-xl-6">
                    <!-- BEGIN row -->
                    <div class="row">
                        <!-- BEGIN col-6 -->
                        <div class="col-sm-6">
                            <!-- BEGIN card -->
                            <div class="card mb-3 overflow-hidden fs-13px border-0 bg-gradient-custom-orange" style="min-height: 202px;">
                                <!-- BEGIN card-img-overlay -->
                                <div class="card-img-overlay mb-n4 mr-n4 d-flex" style="bottom: 0; top: auto;">
                                    <img src="{{url('assets/img/icon/order.svg')}}" alt="" class="ml-auto d-block mb-n3" style="max-height: 105px" />
                                </div>
                                <!-- END card-img-overlay -->
                                
                                <!-- BEGIN card-body -->
                                <div class="card-body position-relative">
                                    <h5 class="text-white-transparent-8 mb-3 fs-16px">{{ __('messages.Total_Orders')}}</h5>
                                    <h3 class="text-white mt-n1">{{$total_earnings}}</h3>
                                    <div class="progress bg-black-transparent-5 mb-2" style="height: 6px">
                                        <div class="progrss-bar progress-bar-striped bg-white" style="width: 80%"></div>
                                    </div>
                                    <div class="text-white-transparent-8 mb-4"></i> {{ __('messages.here_count_total')}}<br />{{ __('messages.Confirmed_Order')}}</div>
                                    
                                </div>
                                <!-- BEGIN card-body -->
                            </div>
                            <!-- END card -->
                            
                            <!-- BEGIN card -->
                            <div class="card mb-3 overflow-hidden fs-13px border-0 bg-gradient-custom-teal" style="min-height: 202px;">
                                <!-- BEGIN card-img-overlay -->
                                <div class="card-img-overlay mb-n4 mr-n4 d-flex" style="bottom: 0; top: auto;">
                                    <img src="{{url('assets/img/icon/visitor.svg')}}" alt="" class="ml-auto d-block mb-n3" style="max-height: 105px" />
                                </div>
                                <!-- END card-img-overlay -->
                                
                                <!-- BEGIN card-body -->
                                <div class="card-body position-relative">
                                    <h5 class="text-white-transparent-8 mb-3 fs-16px">{{ __('messages.Today_orders')}}</h5>
                                    <h3 class="text-white mt-n1">{{$complete}}</h3>
                                    <div class="progress bg-black-transparent-5 mb-2" style="height: 6px">
                                        <div class="progrss-bar progress-bar-striped bg-white" style="width: 50%"></div>
                                    </div>
                                    <div class="text-white-transparent-8 mb-4"></i>{{ __('messages.here_all_your_partners')}} <br />{{ __('messages.add_by_city_Admin')}}</div>
                                    
                                </div>
                                <!-- END card-body -->
                            </div>
                            <!-- END card -->
                        </div>
                        <!-- END col-6 -->
                        
                        <!-- BEGIN col-6 -->
                        <div class="col-sm-6">
                            <!-- BEGIN card -->
                            <div class="card mb-3 overflow-hidden fs-13px border-0 bg-gradient-custom-pink" style="min-height: 202px;">
                                <!-- BEGIN card-img-overlay -->
                                <div class="card-img-overlay mb-n4 mr-n4 d-flex" style="bottom: 0; top: auto;">
                                    <img src="{{url('assets/img/icon/email.svg')}}" alt="" class="ml-auto d-block mb-n3" style="max-height: 105px" />
                                </div>
                                <!-- END card-img-overlay -->
                                
                                <!-- BEGIN card-body -->
                                <div class="card-body position-relative">
                                    <h5 class="text-white-transparent-8 mb-3 fs-16px">{{ __('messages.Completed_orders')}}</h5>
                                    <h3 class="text-white mt-n1">{{$orders}}</h3>
                                    <div class="progress bg-black-transparent-5 mb-2" style="height: 6px">
                                        <div class="progrss-bar progress-bar-striped bg-white" style="width: 80%"></div>
                                    </div>
                                    <div class="text-white-transparent-8 mb-4"></i> {{ __('messages.here_is_the_count')}}<br /> {{ __('messages.all_completed_orders')}}</div>
                                   
                                </div>
                                <!-- END card-body -->
                            </div>
                            <!-- END card -->
                            
                            <!-- BEGIN card -->
                            <div class="card mb-3 overflow-hidden fs-13px border-0 bg-gradient-custom-indigo" style="min-height: 202px;">
                                <!-- BEGIN card-img-overlay -->
                                <div class="card-img-overlay mb-n4 mr-n4 d-flex" style="bottom: 0; top: auto;">
                                    <img src="{{url('assets/img/icon/browser.svg')}}" alt="" class="ml-auto d-block mb-n3" style="max-height: 105px" />
                                </div>
                                <!-- end card-img-overlay -->
                                
                                <!-- BEGIN card-body -->
                                <div class="card-body position-relative">
                                    <h5 class="text-white-transparent-8 mb-3 fs-16px">{{ __('messages.Delivery_Boys')}}</h5>
                                    <h3 class="text-white mt-n1">{{$ongoing}}</h3>
                                    <div class="progress bg-black-transparent-5 mb-2" style="height: 6px">
                                        <div class="progrss-bar progress-bar-striped bg-white" style="width: 80%"></div>
                                    </div>
                                    <div class="text-white-transparent-8 mb-4"></i>{{ __('messages.here_is_the_count')}} <br />{{ __('messages.all_delivery_boys')}}</div>
                                    
                                </div>
                                <!-- END card-body -->
                            </div>
                            <!-- END card -->
                        </div>
                        <!-- BEGIN col-6 -->
                    </div>
                    <!-- END row -->
                </div>
                <!-- END col-6 -->
            </div>
            <!-- END row -->
            
            <!-- BEGIN row -->
            <div class="row">
                <!-- BEGIN col-6 -->
                <div class="col-xl-6">
                    <!-- BEGIN row -->
                    <div class="row">
                        <!-- BEGIN col-6 -->
                        <div class="col-6">
                            <!-- BEGIN card -->
                            <div class="card mb-3">
                                <!-- BEGIN card-body -->
                                <div class="card-body">
                                    <div class="d-flex mb-3">
                                        <div class="flex-grow-1">
                                            <h5 class="mb-1">{{ __('messages.Total_Users')}}</h5>
                                            <div> {{ __('messages.User_account_registration')}}</div>
                                        </div>
                                        <a href="#" data-toggle="dropdown" class="text-muted"></i></a>
                                    </div>
                                    
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <h3 class="mb-1">{{$user}}</h3>
                                            <div class="text-success font-weight-600 fs-13px">
                                                <i class="fa fa-caret-up"></i>
                                            </div>
                                        </div>
                                        <div class="width-50 height-50 bg-primary-transparent-2 rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fa fa-user fa-lg text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                                <!-- END card-body -->
                            </div>
                            <!-- END card -->
                            
                            <!-- BEGIN card -->
                            <div class="card mb-3">
                                <!-- BEGIN card-body -->
                                <div class="card-body">
                                    <div class="d-flex mb-3">
                                        <div class="flex-grow-1">
                                            <h5 class="mb-1">{{ __('messages.App_Feedback')}}</h5>
                                            <div>{{ __('messages.support_quries_order_Complaints')}}</div>
                                        </div>
                                        <a href="#" data-toggle="dropdown" class="text-muted"></i></a>
                                    </div>
                                    
                                    <!-- BEGIN row -->
                                    <div class="row">
                                        <!-- BEGIN col-6 -->
                                        <div class="col-6 text-center">
                                            <div class="width-50 height-50 bg-primary-transparent-2 rounded-circle d-flex align-items-center justify-content-center mb-2 ml-auto mr-auto">
                                                <i class="fa fa-bullhorn"></i>
                                            </div>
                                            <div class="font-weight-600 text-dark">{{$cancel}}</div>
                                            <div class="fs-13px">{{ __('messages.Order_Complaints')}}</div>
                                        </div>
                                        <!-- END col-6 -->
                                        
                                        <!-- BEGIN col-6 -->
                                        <div class="col-6 text-center">
                                            <div class="width-50 height-50 bg-primary-transparent-2 rounded-circle d-flex align-items-center justify-content-center mb-2 ml-auto mr-auto">
                                                <i class="fa fa-comments fa-lg text-primary"></i>
                                            </div>
                                            <div class="font-weight-600 text-dark">{{$comment}}</div>
                                            <div class="fs-13px">{{ __('messages.Feedbacks')}}</div>
                                        </div>
                                        <!-- END col-6 -->
                                    </div>
                                    <!-- END row -->
                                </div>
                                <!-- END card-body -->
                            </div>
                            <!-- END card -->
                        </div>
                        <!-- END col-6 -->
                        
                        <!-- BEGIN col-6 -->
                        <div class="col-6">
                             <!--BEGIN card -->
                            <div class="card mb-3"> 
                                 <!--BEGIN card-body -->
                                <div class="card-body">
                                    <div class="d-flex mb-3">
                                        <div class="flex-grow-1">
                                            <h5 class="mb-1">{{ __('messages.App_share')}}</h5>
                                            <div class="fs-13px">{{ __('messages.total_share_amount_user')}}</div>
                                        </div>
                                        <a href="#" data-toggle="dropdown" class="text-muted"><i class="fa fa-redo"></i></a>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <h3 class="mb-1">{{$app_share}}</h3>
                                        <div class="text-success fs-13px font-weight-600">
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="progress mb-4" style="height: 10px;">
                                        <div class="progress-bar" style="width: 42.66%"></div>
                                        <div class="progress-bar bg-teal" style="width: 36.80%"></div>
                                        <div class="progress-bar bg-yellow" style="width: 15.34%"></div>
                                        <div class="progress-bar bg-pink" style="width: 9.20%"></div>
                                        <div class="progress-bar bg-gray-200" style="width: 5.00%"></div>
                                    </div>
                                    
                                    <div class="fs-13px">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="flex-grow-1 d-flex align-items-center">
                                                <i class="fa fa-circle fs-9px fa-fw text-primary mr-2"></i> {{ __('messages.Today_Share')}}
                                            </div>
                                            <div class="font-weight-600 text-dark">{{$today}}%</div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="flex-grow-1 d-flex align-items-center">
                                                <i class="fa fa-circle fs-9px fa-fw text-teal mr-2"></i> {{ __('messages.Next_Day')}}
                                            </div>
                                            <div class="font-weight-600 text-dark">36.80%</div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="flex-grow-1 d-flex align-items-center">
                                                <i class="fa fa-circle fs-9px fa-fw text-warning mr-2"></i> {{ __('messages.Week')}}
                                            </div>
                                            <div class="font-weight-600 text-dark">15.34%</div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="flex-grow-1 d-flex align-items-center">
                                                <i class="fa fa-circle fs-9px fa-fw text-danger mr-2"></i> {{ __('messages.Month')}} 
                                            </div>
                                            <div class="font-weight-600 text-dark">9.20%</div>
                                        </div>
                                        <div class="d-flex align-items-center mb-15px">
                                            <div class="flex-grow-1 d-flex align-items-center">
                                                <i class="fa fa-circle fs-9px fa-fw text-gray-200 mr-2"></i> {{ __('messages.Year')}}
                                            </div>
                                            <div class="font-weight-600 text-dark">5.00%</div>
                                        </div>
                                        <div class="fs-12px text-right">
                                            <span class="fs-10px">powered by </span>
                                            <span class="d-inline-flex font-weight-600">
                                                <span class="text-primary">T</span>
                                                <span class="text-primary">e</span>
                                                <span class="text-primary">c</span>
                                                <span class="text-primary">M</span>
                                                <span class="text-primary">a</span>
                                                <span class="text-primary">n</span>
                                                <span class="text-primary">i</span>
                                                <span class="text-primary">c</span>
                                            </span>
                                            <span class="fs-10px">made with <i class="fa fa-heart" aria-hidden="true"></i>
                                                            </span>
                                        </div>
                                    </div>
                                </div>
                                 <!--END card-body -->
                            </div>
                             <!--END card -->
                        </div>
                         <!--END col-6 -->
                    </div>
                     <!--END row -->
                </div>
                 <!--END col-6 -->
                
                 <!--BEGIN col-6 -->
                <div class="col-xl-6">
                     <!--BEGIN card -->
                     <div class="card">
                         <!--BEGIN card-body -->
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="flex-grow-1">
                                    <h5 class="mb-1">{{ __('messages.Transaction')}}</h5>
                                    <div class="fs-13px">{{ __('messages.Latest_transaction_history')}}</div>
                                </div>
                                
                            </div>
                            
                             <!--BEGIN table-responsive -->
                            <div class="table-responsive mb-n2">
                                <table class="table table-borderless mb-0">
                                    <thead>
                                        <tr class="text-dark">
                                            <th class="pl-0">{{ __('messages.No')}}</th>
                                            <th>Cart id</th>
                                            <th class="text-center">{{ __('messages.Status')}}</th>
                                            <th class="text-right pr-0">{{ __('messages.Amount')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($recent_order)>0)
                                          @php $i=1; @endphp
                                          @foreach($recent_order as $recent_orders)
                         <tr>
                            <td>{{$i}}</td>
                                            <td>
                                                    <div class="ml-3 flex-grow-1">
                                                        <div class="font-weight-600 text-dark">{{$recent_orders->cart_id}}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center"><span class="label bg-success-transparent-2 text-success" style="min-width: 60px;">{{$recent_orders->payment_status}}</span></td>
                                            <td class="text-right pr-0">{{$recent_orders->rem_price}}</td>
                            
                          
                        </tr>
                        @php $i++; @endphp
                        @endforeach
                      @else
                        <tr>
                          <td>{{ __('messages.No_data_found')}}</td>
                        </tr>
                      @endif
                                    </tbody>
                                </table>
                            </div>
                             <!--END table-responsive -->
                        </div>
                         <!--END card-body -->
                    </div>
                    </div>
                     <!--END card -->
                </div>
                 <!--END col-6 -->
                
                 
            </div>
             <!--END row -->
        </div>

@endsection