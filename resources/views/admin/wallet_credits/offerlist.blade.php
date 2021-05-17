@extends('admin.layout.app')

@section ('content')


<!-- Begin Page Content -->
<div class="container-fluid">
 

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">{{ __('messages.offer list')}}</h6>
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
        <a class="btn btn-success m-auto" style="float: right;" href="{{route('offer_amount')}}">Add</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
            <th>{{ __('messages.serial no')}}</th>
            <th>{{ __('messages.Offer Amount')}}</th>
            <th>{{ __('messages.Percentage | Price')}}</th>
            <th>{{ __('messages.Value')}}</th>
            <th>{{ __('messages.action')}}</th>
            </tr>
          </thead>
    
          <tbody>
          @if(count($reward)>0)
                          @php $i=1; @endphp
                          @foreach($reward as $rewards)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$rewards->offer_amount}}</td>
                             <td>{{$rewards->type}}</td>
                             <td>{{$rewards->value}}</td>
                            
                            <td>
                               
							<button type="button" style="width: 28px; padding-left: 6px;" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$rewards->wallet_id}}"><i class="fa fa-trash"></i></button>
							
                            </td>
                        </tr>
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
<!-- /.container-fluid -->
</div>
</div>
@foreach($reward as $rewards)
<!-- Modal -->
<div class="modal fade" id="exampleModal{{$rewards->wallet_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">  <th>{{ __('messages.Delete')}}</th></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
			</div>
			<div class="modal-body">
				{{ __('messages.Are you want to delete')}}
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<a href="{{route('offer_delete', $rewards->wallet_id)}}" class="btn btn-primary">Delete</a>
			</div>
		</div>
	</div>
</div>
@endforeach
@endsection