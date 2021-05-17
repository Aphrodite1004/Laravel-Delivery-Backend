@extends('resturant.layout.app')

@section ('content')
<div class="content-wrapper">
          <div class="row">
		  <div class="col-md-2">
		  </div>
            
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Area</h4>
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
                  <form class="forms-sample" action="{{route('AddInsertareavendor')}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                    <div class="form-group">
                       @foreach($city as $city)
                      <input type="hidden" class="form-control" id="exampleInputName1" name="vendor_id" value="{{$city->vendor_id}}">
                     <h3><b align="center">{{$city->area_name}}</b></h3>
                      @endforeach
                    </div>
                    
                    
                    <div class="form-group">
                      <label for="exampleInputName1">area Name</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="area_name" placeholder="Enter area name">
                    </div>
                    
                    <!--<div class="form-group">-->
                    <!--  <label for="cod">COD</label>-->
                    <!--  <select class="form-control" name="cod">-->
                    <!--      <option>--Select--</option>-->
                    <!--      <option value="Yes">Yes</option>-->
                    <!--      <option value="No">No</option>-->
                    <!--  </select>-->
                    <!--</div>-->
                    
                    <div class="form-group">
                      <label for="deliverycharge">Delivery Charge</label>
                      <input type="text" class="form-control" id="deliverycharge" name="delivery_charge" placeholder="Enter Delivery Charge">
                    </div>
                
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <!--
                    <button class="btn btn-light">Cancel</button>
                    -->
                     <a href="{{route('areavendor')}}" class="btn btn-light">Cancel</a>
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