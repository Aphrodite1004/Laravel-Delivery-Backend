@extends('parcel.layout.app')

@section ('content')


<!-- Begin Page Content -->
<div class="container-fluid">
 

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">{{ __('messages.Delivery_Boy')}}</h6>
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
        <table class="table table-bordered" id="example10" width="100%" cellspacing="0">
          <thead>
            <tr>
            <th>{{ __('messages.s_n')}}</th>
            <th>{{ __('messages.Delivery_Boy_Name')}}</th>
            <th>{{ __('messages.Delivery_Boy_Image')}}</th>
            <th>{{ __('messages.Delivery_Boy_Phone')}}</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
            <th>{{ __('messages.s_n')}}</th>
            <th>{{ __('messages.Delivery_Boy_Name')}}</th>
            <th>{{ __('messages.Delivery_Boy_Image')}}</th>
            <th>{{ __('messages.Delivery_Boy_Phone')}}</th>
            </tr>
          </tfoot>
          <tbody>
          @if(count($delivery_boy)>0)
                          @php $i=1; @endphp
                          @foreach($delivery_boy as $delivery_boys)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$delivery_boys->delivery_boy_name}}</td>
                            <td align="center" class="image-hover"><img src="{{url($delivery_boys->delivery_boy_image)}}" style="width: 41px;"></td>
                            <td>{{$delivery_boys->delivery_boy_phone}}</td>
                     
                       

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
@foreach($delivery_boy as $delivery_boys)
<!-- Modal -->
<div class="modal fade" id="exampleModal{{$delivery_boys->delivery_boy_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Delete delivery_boy</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
			</div>
			<div class="modal-body">
				Are you want to delete Delivery Boy.
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<a href="{{route('vendordeletedelivery_boy', $delivery_boys->delivery_boy_id)}}" class="btn btn-primary">Delete</a>
			</div>
		</div>
	</div>
</div>
@endforeach   
@endsection