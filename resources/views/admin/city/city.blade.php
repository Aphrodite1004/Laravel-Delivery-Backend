@extends('admin.layout.app')
@section ('content')


<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">{{ __('messages.city list')}}</h6>
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
        <a class="btn btn-success m-auto" style="float: right;" href="{{route('addcity')}}">{{ __('messages.add')}}</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
            <th>{{ __('messages.serial no')}}</th>
            <th>{{ __('messages.city name')}}</th>
            <th>{{ __('messages.image')}}</th>
            <th>{{ __('messages.action')}}</th>
            </tr>
          </thead>
    
          <tbody>
          @if(count($city)>0)
                          @php $i=1; @endphp
                          @foreach($city as $cities)
                        <tr>
                            <td>{{$i}}</td>
                            @if(session()->get('locale')=="en")
                              <td>{{$cities->city_name}}</td>
                            @else
                              <td>{{$cities->city_name_arabic}}</td>
                            @endif
                            <td align="center"><img src="{{url($cities->city_image)}}" style="width: 27px;"></td>
                            <td>
                               
                            <a href="{{route('edit-city',$cities->city_id)}}" style="width: 28px; padding-left: 6px;" class="btn btn-info"  style="width: 10px;padding-left: 9px;" style="color: #fff;"><i class="fa fa-edit" style="width: 10px;"></i></a>
							<button type="button" style="width: 28px; padding-left: 6px;" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$cities->city_id}}"><i class="fa fa-trash"></i></button>
							
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
@foreach($city as $cities)
<!-- Modal -->
<div class="modal fade" id="exampleModal{{$cities->city_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">{{ __('messages.delete')}}</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
			</div>
			<div class="modal-body">
				{{ __('messages.Are you want to delete')}}
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.Close')}}</button>
				<a href="{{route('delete-city', $cities->city_id)}}" class="btn btn-primary">{{ __('messages.delete')}}</a>
			</div>
		</div>
	</div>
</div>
@endforeach
@endsection