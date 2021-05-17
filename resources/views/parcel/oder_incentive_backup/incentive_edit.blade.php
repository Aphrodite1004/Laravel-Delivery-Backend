@extends('vendor.layout.app')

@section ('content')



        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
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
            	<form action="{{route('update_incentive_order')}}" method="post">   
                                			{{csrf_field()}}
                                			
                                                <div class="form-group">
                                                  <label for="exampleInputName1">Set incentive amount<sup>*</sup></label>
                                                  <input type="text" class="form-control" id="exampleInputName1" name="incentive_amount" value="{{$incentive}}">
                                                
                                               
                                			</div>
                                			<div class="modal-footer">
                                			    <button type="submit" class="btn btn-success mr-2">Set Incentive</button>
                                				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                			</div>
                                			</form>
                                			
                                			
@endsection                                			
                                			