@extends('admin.layout.app')

@section ('content')


        <div class="content-wrapper">
          <div class="row">
		  <div class="col-md-2">
		  </div>
            
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Complain Update</h4>
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
                  <form class="forms-sample" action="{{route('adminUpdatecomplain', [$complain->complain_id])}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                    <div class="form-group">
                      <label for="exampleInputName1">Complain Name</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="complain_name" placeholder="complain name" value="{{$complain->complain_name}}">
                    </div>
                    
                    
                    <div class="form-group">
                      <label for="exampleInputName1">Description</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="description" value="{{$complain->description}}">
                    </div>
                   
                    <button type="submit" class="btn btn-success mr-2">Save</button>
                    <a href="{{route('complain')}}" class="btn btn-light">Cancel</a>
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