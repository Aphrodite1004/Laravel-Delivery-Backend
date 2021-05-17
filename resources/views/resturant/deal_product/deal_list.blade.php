@extends('resturant.layout.app')

@section ('content')


<!-- Begin Page Content -->
<div class="container-fluid">
 

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">{{ __('messages.Deal_Product')}}</h6>
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
        <a class="btn btn-success m-auto" style="float: right;" href="{{route('resturantAddDealproduct')}}">{{ __('messages.Add')}} | {{ __('messages.Deal_Product')}}</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
            <th>{{ __('messages.product_Name')}}</th>
            <th>{{ __('messages.Deal_Price')}}</th>
            <th>{{ __('messages.Status')}}</th>
            <th>{{ __('messages.Action')}}</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
            <th>{{ __('messages.product_Name')}}</th>
            <th>{{ __('messages.Deal_Price')}}</th>
            <th>{{ __('messages.Status')}}</th>
            <th>{{ __('messages.Action')}}</th>
            </tr>
          </tfoot>
          <tbody>
           @if(count($deal_p)>0)
          @php $i=1; @endphp
          @foreach($deal_p as $deal)
                        <tr>
                            
            <td>{{$deal->product_name}} ({{$deal->quantity}}{{$deal->unit}})</td>
            <td>{{$deal->deal_price}}</td>
             @if($deal->status==1)
            <td style="color:green">Deal Active</td>
            @endif
            
            
                            <td>
							<button type="button" style="width: 28px; padding-left: 6px;" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$deal->deal_product_id}}"><i class="fa fa-trash"></i></button>
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
@foreach($deal_p as $deal)
<!-- Modal -->
<div class="modal fade" id="exampleModal{{$deal->deal_product_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Delete Deal product</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
			</div>
			<div class="modal-body">
				Are you want to delete Deal.
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<a href="{{route('resturantDeleteDealproduct', $deal->deal_product_id)}}" class="btn btn-primary">Delete</a>
			</div>
		</div>
	</div>
</div>
@endforeach   
@endsection