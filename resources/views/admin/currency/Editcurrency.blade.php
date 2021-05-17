@extends('admin.layout.app')

@section ('content')
<div class="row">
  
<div class="col-md-3"></div>
		 <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Currency</h4>
                  <!-- <p class="card-description">
                    Basic form elements
                  </p> -->
                  <form class="forms-sample" action="{{route('update-currency',[$currency->currency_id])}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                     @if (count($errors) > 0)
                    @if($errors->any())
                   <div class="alert alert-primary" role="alert">
                  <strong>SUCCESS : </strong>{{$errors->first()}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
                  </div>
                  @endif
                 @endif
                    <div class="form-group">
                      <label for="exampleInputName1">Currency Name</label>
                      <input type="text" class="form-control" name="currency" value="{{$currency->currency}}" id="exampleInputName1" placeholder="Name">
                    </div>
                  <div class="form-group">
                      <label for="exampleInputName1">Currency Sign</label>
                      <input type="text" class="form-control" name="currency_sign" value="{{$currency->currency_sign}}" id="exampleInputName1">
                    </div>
    
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                   <!--  <button class="btn btn-light">Cancel</button> -->
                  </form>
                </div>
              </div>
            </div>
  <div class="col-md-3"></div>

</div>
</div>
@endsection