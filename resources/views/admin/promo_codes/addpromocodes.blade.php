@extends('admin.layout.app')

@section ('content')
<div class="content-wrapper">
          <div class="row">
		  <div class="col-md-2">
		  </div>
            
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Promo Codes</h4>
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
                  <form class="forms-sample" action="{{route('AddNewpromocodes')}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                      <div class="form-group">
                    <label for="exampleFormControlSelect3">promocodes</label>
                    <select class="form-control form-control-sm" id="exampleFormControlSelect3 " name="city_name">
                    <option value="buyonce">Buyonce</option> 
		          	<option value="Wallet_recharge">Wallet Recharge</option>
		          	<!--<option value="Wallet_recharge">First time Wallet Recharge</option>-->
		      
                      
                      
                    </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">promocodes Name</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="promocodes_name" placeholder="Enter promocodes name">
                    </div>
                     <div class="form-group">
                      <label for="exampleInputName1">address</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="promocodes_address" placeholder="Enter Address">
                    </div>
                   
                     <div class="form-group">
                      <label>promocodes Image</label>  
                      
                      <div class="input-group col-xs-12">
                      <input type="file" name="promocodes_image"  class="file-upload-default">                        
                        </div>
                      </div>
                      
                      <div class="form-group">
                      <label for="exampleInputName1">City-Admin Email</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="promocodes_email" placeholder="Enter City-Admin Email">
                    </div>
                     <div class="form-group">
                      <label for="exampleInputName1">City-Admin Phone</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="promocodes_phone" placeholder="Enter City-Admin Phone">
                    </div>
                     <div class="form-group">
                      <label for="exampleInputName1">Password</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="password1" placeholder="Enter password">
                    </div>
                    
                     <div class="form-group">
                      <label for="exampleInputName1">Confirm Password</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="password2" placeholder="confirm password">
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <!--
                    <button class="btn btn-light">Cancel</button>
                    -->
                     <a href="{{route('promocodes')}}" class="btn btn-light">Cancel</a>
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