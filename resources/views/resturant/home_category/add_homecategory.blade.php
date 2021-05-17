@extends('vendor.layout.app')

@section ('content')
<style>
input.form-control.file-upload-info {
    padding: 3px;
    border: 0px;
}
</style>

        <div class="content-wrapper">
          <div class="row">
		  <div class="col-md-2">
		  </div>
            
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Category</h4>
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
                  <form class="forms-sample" action="{{route('inserthomecategory1')}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                    <div class="form-group">
                      <label for="exampleInputName1">Home Category Name</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="category_name" placeholder="Enter Category Name" requirment>
                    </div>
                    <div class="form-group">
                      <label>Home Category Order</label>
                      <input type="text" name="category_order" class="form-control" placeholder="1 To 10" requirment>
                      <input type="hidden" name="vendor_id" value={{$vendor-> vendor_id}}>
                    </div>
                    <div class="form-group">
                      <label>Display In homepage</label></label>
                      <input type="checkbox" name="category_status" value="1" ><br>
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <!--
                    <button class="btn btn-light">Cancel</button>
                    -->
                     <a href="{{route('category')}}" class="btn btn-light">Cancel</a>
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