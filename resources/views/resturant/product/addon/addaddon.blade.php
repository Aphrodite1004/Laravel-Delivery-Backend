@extends('resturant.layout.app')
<style>
sup {
    color:red;
    position: initial;
    font-size: 111%;
}
</style>
@section ('content')
<div class="content-wrapper">
          <div class="row">
		  <div class="col-md-2">
		  </div>
            
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Addon</h4>
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
                  <form class="forms-sample" action="{{route('resturantAddNewproductaddon')}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}

                      <input type="hidden" name="id" value="{{$id}}">

                
                <div class="form-group">
                      <label for="exampleInputName1">Addon Name</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="addon_name" placeholder="Enter Addon Name">
                    </div>
                   
                 <div class="form-group">
                      <label for="exampleInputName1">Addon Price</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="addon_price" placeholder="Enter price">
                    </div>  
                 
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                   
                     <a href="{{route('resturantaddon',$id)}}" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
             <div class="col-md-2">
		  </div>
     
          </div>
        </div>
       </div> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
        	$(document).ready(function(){
        	
                $(".des_price").hide();
                
        		$(".img").on('change', function(){
        	        $(".des_price").show();
        			
        	});
        	});
</script>

@endsection