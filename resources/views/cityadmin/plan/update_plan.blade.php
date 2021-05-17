@extends('cityadmin.layout.app')

@section ('content')


        <div class="content-wrapper">
          <div class="row">
		  <div class="col-md-2">
		  </div>
            
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">plan Update</h4>
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
                  <form class="forms-sample" action="{{route('cityadminUpdateplan', [$plan->plan_id])}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                    <div class="form-group">
                      <label for="exampleInputName1">plan Name</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="plan_name" placeholder="plan name" value="{{$plan->plans}}">
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputName1">Days</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="days" value="{{$plan->days}}">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">description</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="description" value="{{$plan->description}}">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">skip days</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="skip_days" value="{{$plan->skip_days}}">
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