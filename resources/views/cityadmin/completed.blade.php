@extends('cityadmin.layout.app')

@section ('content')



        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            
            
    
        <div class="row">
         <!-- DataTales Example -->
              <div class="card shadow" style="width:100%">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Completed orders</h6>
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
                    <table class="table table-bordered" id="example4" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                        <th>S.No</th>
                        <th>product Name</th>
                        <th>User ID</th>
                        <th>quantity</th>
                        <th>price</th>
                        <th>cityadmin</th>
                        <th>city</th>
                        <th>delivery_date</th>
                        <th>order type</th>
                        <th>Delivery Boy ID</th>
                        <th>Incentive</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                      @if(count($completed_orders)>0)
                                      @php $i=1; @endphp
                                      @foreach($completed_orders as $completed_orders)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$completed_orders->product_name}}</td>
                                        <td>{{$completed_orders->user_id}}</td>
                                        <td>{{$completed_orders->order_qty}}</td>
                                         <td>{{$completed_orders->price}}</td>
                                        <td>{{$completed_orders->cityadmin_name}}</td>
                                         <td>{{$completed_orders->city_name}}</td>
                                        <td>{{$completed_orders->delivery_date}}</td>
                                        <td>{{$completed_orders->order_type}}</td>
                                        <td>{{$completed_orders->delivery_boy_id}}</td>
                                        <td>{{$completed_orders->delivery_boy_incentive}}</td>
                                    </tr>
                                    @php $i++; @endphp
                                    @endforeach
                                  @else
                                    <tr>
                                      <td colspan="12" class="text-center">No data found</td>
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