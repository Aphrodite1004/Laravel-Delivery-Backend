@extends('admin.layout.app')

@section ('content')


<!-- Begin Page Content -->
<div class="container-fluid">
 

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Currency</h6>
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
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
            <th>Currency</th>
            <th>Currency sign</th>
            <th>Action</th>
            </tr>
          </thead>
         
          <tbody>
          @if(count($currency)>0)
                          @php $i=1; @endphp
                          @foreach($currency as $currency)
                        <tr>
                            <td>{{$currency->currency}}</td>
                            
                            <td>{{$currency->currency_sign}}</td>                            
                            <td>
                               
                            <a href="{{route('edit-currency',$currency->currency_id)}}" style="width: 146px; padding-left: 6px;" class="btn btn-info">Edit Currency</a>
							
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

@endsection