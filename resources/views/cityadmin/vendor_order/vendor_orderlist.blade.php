@extends('cityadmin.layout.app')

@section ('content')

          <div class="row">
         <!-- DataTales Example -->
              <div class="card shadow" style="width:100%">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">{{ __('messages.Today_orders')}}</h6>
                  @if (count($errors) > 0)
                              @if($errors->any())
                                <div class="alert alert-primary" role="alert">
                                  {{$errors->first()}}
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                  </button>
                                </div>
                              @endif
                          @endif
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="example2" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                        <th>{{ __('messages.serial no')}}</th>
                       <th>{{ __('messages.Vendor Name')}}</th>
                        <th>{{ __('messages.Vendor Mobile')}}</th>
                        <th>{{ __('messages.Vendor Location')}}</th>
                        <!--<th>Vendor E-mail</th>-->
                        <!--<th>Delivery Date</th>-->
                        <!--<th>Incentive</th>-->
                        <!--<th>Order Type</th>-->
                        <th>Order</th>
                        <!--<th>Action</th>-->
                        </tr>
                      </thead>
                      
                      <tbody>
                      @if(count($vendor)>0)
                                      @php $i=1; @endphp
                                      @foreach($vendor as $vendors)
                                    
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$vendors->vendor_name}}</td>
                                        <td>{{$vendors->vendor_phone}}</td>
                                        <td>{{$vendors->vendor_loc}}</td>
                                        <!--<td>{{$vendors->vendor_email}}</td>-->

                                    <td>
                                              <a href="{{route('today_order1',[$vendors->vendor_id])}}" class="btn btn-primary">{{ __('messages.Today')}}</a>
                                              <!--<a href="{{route('next_order1',[$vendors->vendor_id])}}" class="btn btn-info">Next Order</a>-->
                                              <a href="{{route('completed_order1',[$vendors->vendor_id])}}" class="btn btn-success">{{ __('messages.Completed')}}</a>
                                    </td>
                                    <!-- <td>-->
                                                  <!--<a href="#" class="btn btn-primary">Edit</a>-->
                                                  <!--<a href="#" class="btn btn-danger">Delete</a>-->
                                                  
                                    <!--</td>-->
                                        
                                        
                                
                    
                                    @php $i++; @endphp
                                    @endforeach
                                  @else
                                    <tr>
                                      <td>No data found</td>
                                    </tr>
                                  @endif
                                   
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->



    


@endsection