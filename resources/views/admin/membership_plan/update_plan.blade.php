@extends('admin.layout.app')

@section ('content')


        <div class="content-wrapper">
          <div class="row">
		  <div class="col-md-2">
		  </div>
            
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Plan Update</h4>
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
                  <form class="forms-sample" action="{{route('UpdatePlan', [$membership_plan->plan_id])}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                    <div class="form-group">
                      <label for="exampleInputName1">Plan Name</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="plan_name" placeholder="Plan Name" value="{{$membership_plan->plan_name}}">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Plan Price</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="plan_price" placeholder="Enter plan Price"  value="{{$membership_plan->plan_price}}" requirment>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Days</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="days" value="{{$membership_plan->plan_day}}">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Description</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="description" value="{{$membership_plan->plan_subscription}}">
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <a href="{{route('plan')}}" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
             <div class="col-md-2">
		  </div>
     
          </div>
        </div>
</div>
 @endsection