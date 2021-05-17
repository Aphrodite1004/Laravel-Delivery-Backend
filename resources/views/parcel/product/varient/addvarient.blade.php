@extends('parcel.layout.app')
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
                  <h4 class="card-title">Add Varient</h4>
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
                  <form class="forms-sample" action="{{route('parcelAddNewproductvariant')}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}

                      <input type="hidden" name="id" value="{{$id}}">

                
                <div class="form-group">
                      <label for="exampleInputName1">Price</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="price" placeholder="Enter MRP">
                    </div>
                   
                 <div class="form-group">
                      <label for="exampleInputName1">Strick Price</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="strick_price" placeholder="Enter price">
                    </div>  
            
                    <div class="form-group">
                      <label for="exampleInputName1">Quantity</label>
                      <input type="number" class="form-control" id="exampleInputName1" name="quantity" placeholder="250/500/....">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputName1">Unit</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="unit"  placeholder="quator/half/full">
                    </div>  
                 
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                   
                     <a href="{{route('parcelvarient',$id)}}" class="btn btn-light">Cancel</a>
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