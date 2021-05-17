@extends('resturant.layout.app')
 
@section ('content')

 <style>
     input[type="file"] {
    background-color:transparent;
    padding:0px;
}

 </style>


<!-- Begin Page Content -->
<div class="container-fluid">
 

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">{{ __('messages.Coupon_List')}}</h6>
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
 
        <a class="btn btn-success m-auto" style="float: right;" href="{{route('resturantcoupon')}}">{{ __('messages.Add_Coupon')}}</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="example8" width="100%" cellspacing="0">
          <thead>
            <tr>
            <th>{{ __('messages.s_n')}}</th>
            <th>{{ __('messages.Coupon_Name')}}</th>
            <th>{{ __('messages.Start_Date')}}</th>
            <th>{{ __('messages.End_Date')}}</th>
            <th>{{ __('messages.User_Restriction')}}</th>
            <th>{{ __('messages.Cart_Value')}}</th>
            <th>{{ __('messages.Action')}}</th>
            </tr>
          </thead>
    
          <tbody>
          @if(count($coupon)>0)
                          @php $i=1; @endphp
                          @foreach($coupon as $coupons)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$coupons->coupon_name}}</td>
                            <td>{{$coupons->start_date}}</td>
                            <td>{{$coupons->end_date}}</td>
                            <td>{{$coupons->uses_restriction}}</td>
                            <td>{{$coupons->cart_value}}</td>
                            <td>
                               <a href="{{route('resturanteditcoupon',$coupons->coupon_id)}}" style="width: 28px; padding-left: 6px;" class="btn btn-info"  style="width: 10px;padding-left: 9px;" style="color: #fff;"><i class="fa fa-edit" style="width: 10px;"></i></a>
							<button type="button" style="width: 28px; padding-left: 6px;" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$coupons->coupon_id}}"><i class="fa fa-trash"></i></button>
						
							</td>
							

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
    </div>
  </div>

</div>
<!-- /.container-fluid -->
</div>
</div>
@foreach($coupon as $coupons)
<!-- Modal -->
<div class="modal fade" id="exampleModal{{$coupons->coupon_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Delete product</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
			</div>
			<div class="modal-body">
				Are you want to delete Coupon.
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<a href="{{route('resturantdeletecoupon', $coupons->coupon_id)}}" class="btn btn-primary">Delete</a>
			</div>
		</div>
	</div>
</div>
@endforeach   
@endsection