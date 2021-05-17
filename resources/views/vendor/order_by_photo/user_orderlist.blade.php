@extends('vendor.layout.app')
<style>
    @media screen {
  #printSection {
      display: none;
  }
}

@media print {
  body * {
    visibility:hidden;
  }
  #printSection, #printSection * {
    visibility:visible;
  }
  #printSection {
    position:absolute;
    left:0;
    top:0;
  }
}

</style>
@section ('content')

          <div class="row">
         <!-- DataTales Example -->
              <div class="card shadow" style="width:100%">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">{{ __('messages.Order_By_Photo')}}</h6>
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
                        <th>{{ __('messages.s_n')}}</th>
                        <th>{{ __('messages.User_Name')}}</th>
                        <th>{{ __('messages.User_Address')}}</th>
                        <th>{{ __('messages.User_Phone')}}</th>
                        <th>{{ __('messages.Action')}}</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                      @if(count($list)>0)
                                      @php $i=1; @endphp
                                      @foreach($list as $lists)
                                      
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$lists->user_name}}</td>
                                        <td>{{$lists->address}}</td>
                                         <td>{{$lists->user_phone}}</td>
                                        <td class="td-actions text-right">
               @if($lists->processed == 0)
                 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1{{$lists->ord_id}}">{{ __('messages.View_Accept')}}</button>
           <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal2{{$lists->ord_id}}">Reject</button>
           @else
           <span style="color:green"><b>Accepted</b></span>
           @endif
            </td>
<div class="modal fade" id="exampleModal1{{$lists->ord_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        	<div class="modal-dialog" role="document">
        		<div class="modal-content">
        			<div class="modal-header">
        				<h5 class="modal-title" id="exampleModalLabel"><b>{{ __('messages.View_Accept')}}</b></h5>
        					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        						<span aria-hidden="true">&times;</span>
        					</button>
        			</div>
        			<div class="container"> <br> 
                       <div class="col-lg-12">
                          <img src="{{url($lists->list_photo)}}" style="width:200 !important;"> 
                       </div><br>
                       <a href="{{route('store_accept_order', $lists->ord_id)}}"  class="btn btn-primary pull-center">Accept Order</a><br>
                     </div>  
        		
        		</div>
        	</div>
        </div>
        
<!-----reject order with cause ------->
 <div class="modal fade" id="exampleModal2{{$lists->ord_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        	<div class="modal-dialog" role="document">
        		<div class="modal-content">
        			<div class="modal-header">
        				<h5 class="modal-title" id="exampleModalLabel">Reject Order</h5>
        					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        						<span aria-hidden="true">&times;</span>
        					</button>
        			</div>
        			<!--//form-->
        		<form class="forms-sample" action="{{route('store_reject_orderbyphoto', $lists->ord_id)}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
        			<div class="row">
        			  <div class="col-md-3" align="center"></div>  
                      <div class="col-md-6" align="center">
                          <br>
                        <div class="form-group">
                           <label>Send Rejection Reason to User</label>    
        		     	   <textarea name="cause" row="5" required></textarea>
        			    </div>
        			<button type="submit" class="btn btn-primary pull-center">Submit</button>
        			</div>
        			</div>
        			  
                    <div class="clearfix"></div>
        			</form>
        		
        		</div>
        	</div>
        </div>
        
        
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
<div>
    </div>
    <!--/////////reject orders///////////-->
 
<style>.buttons-html5 {
    color: white !important;
    background-color: #35d26d !important;
    border-radius: 5px;
    margin: 2px !important;
}
.buttons-print {
    color: white !important;
    background-color: #35d26d !important;
    border-radius: 5px;
    margin: 2px !important;
}</style>
<script>
        $(document).ready( function () {
    $('#myTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]});
} );
    </script>
    @endsection
</div>    
