<html>
    <head>
      
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
       <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
       <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
       <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
    
      <title>GoSubscribe</title>
      <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
      <!-- Custom fonts for this template-->
      <link href="{{url('public/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    
      <!-- Custom styles for this template-->
      <link href="{{url('public/css/sb-admin-2.min.css')}}" rel="stylesheet">
      <link href="{{url('public/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
   <style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  color:white;
  font-weight: 600;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

button.tablinks.newbtn {
    width: 33.33% !important;
    color: black;
}
/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #ffffff;
    color: teal;
    font-weight: 600;
    animation-name: bounce;
}

/* Style the tab content  */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}

.tabcontentnew {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
.newbtn{
  width:33% !important;
}
.mainbtn{
background-color: #ffe003;
}

button.tablinks.mainbtn1 {
    width: 33.33% !important;
    color: black;
}    
  
button.tablinks.mainbtn2 {
    width: 50% !important;
    color: black;
}      
button.tablinks.newbtn {
    text-align: center !important;
    padding-left: 6px;
}    
 
 p {
    margin-top: 0;
    margin-bottom: 0rem;
}   
</style>
    </head>
    <body>
        
<nav class="navbar  navbar-dark bg-dark" style="height:54px">
  <a class="navbar-brand">D I S P A T C H  &nbsp; &nbsp;P A N E L</a>
  <form class="form-inline">
     <a href="{{route('vendor-index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" align="right" style="padding: 11px;"><i class="fas fa-download fa-sm text-white-50"></i> City admin Panel</a>
  </form>
</nav>        
     <div class="col-lg-12 col-sm-12" style="padding-left:0px !important; padding-right:0px !important;">  
    <div class="col-lg-3 col-sm-12" style="padding-left:0px !important; padding-right:0px !important;float:left;height: 87% !important; overflow-y: scroll !important;">
  
 <div class="tab mainbtn">
  <button class="tablinks mainbtn1" id="secondleft" onclick="openCity(event, 'todayorder')" style="font-size: 14px;">Today's Orders</button>
  <button class="tablinks mainbtn1" onclick="openCity(event, 'nextdayorder')" style="font-size: 14px;">Next Day Orders</button>
   <button class="tablinks mainbtn1" onclick="openCity(event, 'cash_request')" style="font-size: 14px;">Cash Collection</button>
</div>
 
<div id="todayorder" class="tabcontent" style="padding:0px !important;">
  <div class="tab">
  <button class="tablinks newbtn" id="firstleft" onclick="openCitynew(event, 'today_unassigned')">Unassigned</button>
  <button class="tablinks newbtn" onclick="openCitynew(event, 'today_assigned')">Assigned</button>
  <button class="tablinks newbtn" onclick="openCitynew(event, 'today_completed')">Completed</button>
</div>
</div>

<div id="nextdayorder" class="tabcontent" style="padding:0px !important;">
<div class="tab">
  <button class="tablinks mainbtn2" onclick="openCitynew(event, 'nextday_unassigned')">Unassigned</button>
  <button class="tablinks mainbtn2" onclick="openCitynew(event, 'nextday_assigned')">Assigned</button>
</div>
  
</div>

<div id="cash_request" class="tabcontent" style="padding:0px !important;">
<div class="tab">
  <button class="tablinks mainbtn2" onclick="openCitynew(event, 'cashrequestunassigned')">Unassigned</button>
  <button class="tablinks mainbtn2" onclick="openCitynew(event, 'cashrequestassigned')">Assigned</button>
</div>
  
</div>


<div id="today_unassigned" class="tabcontentnew" style="padding:0px !important;">
 @foreach($unassignedtodayorder as $todayorders)
  <div class="col-lg-12 col-md-12 col-sm-12" style="padding: 16px; border-bottom: 5px dotted; margin-bottom: 13px;">
    <div class ="col-lg-7 col-md-7 col-sm-7" style="border:1px solid grey; background-color:#f7eeee; float: left;">
        <p style="font-size: 14px;"><span>Cart Id: </span> <b><span style="color:black">{{$todayorders->order_cart_id}} </span></b></p>
    </div>  
    <div class ="col-lg-5 col-md-5 col-sm-5"  style="border:1px solid grey; background-color:#f7eeee; float: left;">
       <p style="font-size: 14px;"><span>User name : </span> <b><span style="color:black">{{$todayorders->user_name}}</span></b></p>
    </div>
    <p>Total Price : <span style="color:black">{{$todayorders->total_price}}</span></p>
     <p>Products Price : <span style="color:black">{{$todayorders->products_price}}</span></p> 
     <p>Delivery Charge : <span style="color:black">{{$todayorders->delivery_charge}}</span></p>
     <p>Delivery Date : <span style="color:black">{{$todayorders->delivery_date}}</span></p> 
     <button type="button" style="width:100%" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$todayorders->order_cart_id}}">Assign</button>
</div>
   <div class="modal fade" id="exampleModal{{$todayorders->order_cart_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    	<div class="modal-dialog" role="document">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="exampleModalLabel">Assign Delivery Boy</h5>
    					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    						<span aria-hidden="true">&times;</span>
    					</button>
    			</div>
    			<!--//form-->
    			<form action="{{route('assigned_vendor_order')}}" method="post">   
    			{{csrf_field()}}
    			<div class="modal-body">
    			 <div class="form-group">
                    <label for="exampleFormControlSelect3">choose a Delivery Boy<sup>*</sup></label>
                    <select class="form-control form-control-sm" id="exampleFormControlSelect3 " name="delivery_boy_name">
                      @foreach($delivery_boy as $delivery_boys)
                      @if($delivery_boys->area_id==$todayorders->area_id)
		          	    <option value="{{$delivery_boys->delivery_boy_id}}"><span style="font-weight:bold">{{$delivery_boys->delivery_boy_name}}</span> 
		          	    </option>
		          	  @endif
		             @endforeach
                      
                      
                    </select>
                    </div>
                    
                      
                      <input type="hidden" class="form-control" name="order_cart_id" value={{$todayorders->order_cart_id}}>
                    
                    
    			</div>
    			<div class="modal-footer">
    			    <button type="submit" class="btn btn-success mr-2">Assign</button>
    				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    			</div>
    			</form>
    			<!--//form-->
    		</div>
    	</div>
    </div>
  
 @endforeach
</div>
<div id="today_assigned" class="tabcontentnew" style="padding:0px !important;">
 @foreach($assignedtodayorder as $todayorderss)    
<div class="col-lg-12 col-md-12 col-sm-12" style="padding: 16px; border-bottom: 5px dotted; margin-bottom: 13px;">
    <div class ="col-lg-7 col-md-7 col-sm-7" style="border:1px solid grey; background-color:#f7eeee; float: left;">
        <p style="font-size: 14px;"><span>Cart Id :</span> <b><span style="color:black">{{$todayorderss->order_cart_id}} </span></b></p>
    </div>  
    <div class ="col-lg-5 col-md-5 col-sm-5"  style="border:1px solid grey; background-color:#f7eeee; float: left;">
       <p style="font-size: 14px;"><span>User Name : </span> <b><span style="color:black">{{$todayorderss->user_name}}</span></b></p>
    </div>
    <p>Total Price : <span style="color:black">{{$todayorderss->total_price}}</span></p>
     <p>Products Price : <span style="color:black">{{$todayorderss->products_price}}</span></p> 
     <p>Delivery Charge : <span style="color:black">{{$todayorderss->delivery_charge}}</span></p>
     <p>Delivery Date : <span style="color:black">{{$todayorderss->delivery_date}}</span></p> 
     <button type="button" style="width:100%" class="btn btn-danger" data-toggle="modal" data-target="#newexampleModal{{$todayorderss->order_cart_id}}">Assigned/edit ({{$todayorderss->delivery_boy_name}})</button>
</div>
   <div class="modal fade" id="newexampleModal{{$todayorderss->order_cart_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    	<div class="modal-dialog" role="document">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="exampleModalLabel">Assign Delivery Boy</h5>
    					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    						<span aria-hidden="true">&times;</span>
    					</button>
    			</div>
    			<!--//form-->
    			<form action="{{route('assigned_vendor_order')}}" method="post">   
    			{{csrf_field()}}
    			<div class="modal-body">
    			 <div class="form-group">
                    <label for="exampleFormControlSelect3">choose a Delivery Boy<sup>*</sup></label>
                    <select class="form-control form-control-sm" id="exampleFormControlSelect3 " name="delivery_boy_name">
                      @foreach($delivery_boy as $delivery_boys)
                      @if($delivery_boys->area_id==$todayorderss->area_id)
		          	    <option value="{{$delivery_boys->delivery_boy_id}}"><span style="font-weight:bold">{{$delivery_boys->delivery_boy_name}}</span> 
		          	    </option>
		          	  @endif
		              @endforeach
                      
                      
                    </select>
                    </div>
                    
                    
                      <input type="hidden" class="form-control" name="order_cart_id" value="{{$todayorderss->order_cart_id}}" >
                    
                    
    			</div>
    			<div class="modal-footer">
    			    <button type="submit" class="btn btn-success mr-2">Assign</button>
    				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    			</div>
    			</form>
    			<!--//form-->
    		</div>
    	</div>
    </div>
  
  @endforeach
</div>

<div id="today_completed" class="tabcontentnew" style="padding:0px !important;">
<div class="col-lg-12" style="height: 100%;">    
  @foreach($completed_orders as $completed_orders) 
    <div class="col-lg-12 col-md-12 col-sm-12" style="padding: 16px; border-bottom: 5px dotted; margin-bottom: 13px;">
    <div class ="col-lg-12 col-md-12 col-sm-12" style="border:1px solid grey; background-color:#f7eeee; float: left;">
        <p style="font-size: 14px;"><span>Complete ID : </span> <b><span style="color:black">{{$completed_orders->completed_id}} </span></b></p>
    </div>  
   
    <p>Total Price : <span style="color:black">{{$completed_orders->total_price}}</span></p>
     <p>Product Price : <span style="color:black">{{$completed_orders->products_price}}</span></p> 
     <p>Delivery Charge : <span style="color:black">{{$completed_orders->delivery_charge}}</span></p>
     <p>Delivery Date : <span style="color:black">{{$completed_orders->delivery_date}}</span></p> 
   </div>
  @endforeach
  </div>
</div>
 
 
 
<div id="nextday_unassigned" class="tabcontentnew" style="padding:0px !important;">
 @foreach($unassignednextdayorder as $nextdayorders)

 <div class="col-lg-12 col-md-12 col-sm-12" style="padding: 16px; border-bottom: 5px dotted; margin-bottom: 13px;">
    <div class ="col-lg-7 col-md-7 col-sm-7" style="border:1px solid grey; background-color:#f7eeee; float: left;">
        <p style="font-size: 14px;"><span>Cart Id : </span> <b><span style="color:black">{{$nextdayorders->order_cart_id}} </span></b></p>
    </div>  
    <div class ="col-lg-5 col-md-5 col-sm-5"  style="border:1px solid grey; background-color:#f7eeee; float: left;">
       <p style="font-size: 14px;"><span>User id : </span> <b><span style="color:black">{{$nextdayorders->user_id}}</span></b></p>
    </div>
    <p>Total Price : <span style="color:black">{{$nextdayorders->total_price}}</span></p>
     <p>Products Price : <span style="color:black">{{$nextdayorders->products_price}}</span></p> 
     <p>Delivery Charge : <span style="color:black">{{$nextdayorders->delivery_charge}}</span></p>
     <p>Delivery Date : <span style="color:black">{{$nextdayorders->delivery_date}}</span></p> 
     <button type="button" style="width:100%" class="btn btn-danger" data-toggle="modal" data-target="#nextexampleModal{{$nextdayorders->order_cart_id}}"> Assign</button>
</div>
 <div class="modal fade" id="nextexampleModal{{$nextdayorders->order_cart_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    	<div class="modal-dialog" role="document">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="exampleModalLabel">Assign Delivery Boy/ Incentive</h5>
    					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    						<span aria-hidden="true">&times;</span>
    					</button>
    			</div>
    			<!--//form-->
    			<form action="{{route('assigned_vendor_order')}}" method="post">   
    			{{csrf_field()}}
    			<div class="modal-body">
    			 <div class="form-group">
                    <label for="exampleFormControlSelect3">choose a Delivery Boy<sup>*</sup></label>
                    <select class="form-control form-control-sm" id="exampleFormControlSelect3 " name="delivery_boy_name">
                      @foreach($delivery_boy as $delivery_boys)
                      @if($delivery_boys->area_id==$nextdayorders->area_id)
		          	    <option value="{{$delivery_boys->delivery_boy_id}}"><span style="font-weight:bold">{{$delivery_boys->delivery_boy_name}}</span> 
		          	    </option>
		          	  @endif
		              @endforeach 
                      
                      
                    </select>
                    </div>
                    
                      <!--<label for="exampleInputName1">Incentive for this order</label>-->
                      <!--<input type="text" class="form-control" id="exampleInputName1" name="incentive" placeholder="Incentive for this order">-->
                      <input type="hidden" class="form-control" name="order_cart_id" value={{$nextdayorders->order_cart_id}}>
                    
                    
    			</div>
    			<div class="modal-footer">
    			    <button type="submit" class="btn btn-success mr-2">Assign</button>
    				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    			</div>
    			</form>
    			<!--//form-->
    		</div>
    	</div>
    </div>
  @endforeach 
 
</div>
<div id="nextday_assigned" class="tabcontentnew" style="padding:0px !important;">
 @foreach($assignednextdayorder as $nextdayorders)
 
  <div class="col-lg-12 col-md-12 col-sm-12" style="padding: 16px; border-bottom: 5px dotted; margin-bottom: 13px;">
    <div class ="col-lg-7 col-md-7 col-sm-7" style="border:1px solid grey; background-color:#f7eeee; float: left;">
        <p style="font-size: 14px;"><span>Cart Id :</span> <b><span style="color:black">{{$nextdayorders->order_cart_id}} </span></b></p>
    </div>  
    <div class ="col-lg-5 col-md-5 col-sm-5"  style="border:1px solid grey; background-color:#f7eeee; float: left;">
       <p style="font-size: 14px;"><span>User id : </span> <b><span style="color:black">{{$nextdayorders->user_id}}</span></b></p>
    </div>
    <p>Total Price : <span style="color:black">{{$nextdayorders->total_price}}</span></p>
     <p>Products Price : <span style="color:black">{{$nextdayorders->products_price}}</span></p> 
     <p>Delivery Charge : <span style="color:black">{{$nextdayorders->delivery_charge}}</span></p>
     <p>Delivery Date : <span style="color:black">{{$nextdayorders->delivery_date}}</span></p> 
     <button type="button" style="width:100%" class="btn btn-danger" data-toggle="modal" data-target="#nextnewexampleModal{{$nextdayorders->order_cart_id}}">Assigned/edit  ({{$nextdayorders->delivery_boy_name}})</button>
</div>
 
 
  <div class="modal fade" id="nextnewexampleModal{{$nextdayorders->order_cart_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    	<div class="modal-dialog" role="document">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="exampleModalLabel">Assign Delivery Boy/ Incentive</h5>
    					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    						<span aria-hidden="true">&times;</span>
    					</button>
    			</div>
    			<!--//form-->
    			<form action="{{route('assigned_vendor_order')}}" method="post">   
    			{{csrf_field()}}
    			<div class="modal-body">
    			 <div class="form-group">
                    <label for="exampleFormControlSelect3">choose a Delivery Boy<sup>*</sup></label>
                    <select class="form-control form-control-sm" id="exampleFormControlSelect3 " name="delivery_boy_name">
                      @foreach($delivery_boy as $delivery_boys)
                      @if($delivery_boys->area_id==$nextdayorders->area_id)
		          	    <option value="{{$delivery_boys->delivery_boy_id}}"><span style="font-weight:bold">{{$delivery_boys->delivery_boy_name}}</span> 
		          	    </option>
		          	  @endif
		              @endforeach
                      
                      
                    </select>
                    </div>
                      <input type="hidden" class="form-control" name="order_cart_id" value={{$nextdayorders->order_cart_id}}>
                    
                    
    			</div>
    			<div class="modal-footer">
    			    <button type="submit" class="btn btn-success mr-2">Assign</button>
    				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    			</div>
    			</form>
    			<!--//form-->
    			
    			
    		</div>
    	</div>
    </div>
  
  @endforeach
</div>




<div id="cashrequestunassigned" class="tabcontentnew" style="padding:0px !important;">
 @foreach($cash_requestunassigned as $cash_requestunassigneds)
  <div class="col-lg-12 col-md-12 col-sm-12" style="padding: 16px; border-bottom: 5px dotted; margin-bottom: 13px;">
    <div class ="col-lg-7 col-md-7 col-sm-7" style="border:1px solid grey; background-color:#f7eeee; float: left;">
        <p style="font-size: 14px;"><span>Request id : </span> <b><span style="color:black">{{$cash_requestunassigneds->request_id}} </span></b></p>
    </div>  
    <div class ="col-lg-5 col-md-5 col-sm-5"  style="border:1px solid grey; background-color:#f7eeee; float: left;">
       <p style="font-size: 14px;"><span>User id : </span> <b><span style="color:black">{{$cash_requestunassigneds->user_id}}</span></b></p>
    </div>
    <p>Amount : <span style="color:black">{{$cash_requestunassigneds->amount}}</span></p>
     <p>Collection Date : <span style="color:black">{{$cash_requestunassigneds->date_of_collection}}</span></p> 
     <button type="button" style="width:100%" class="btn btn-danger" data-toggle="modal" data-target="#cashModal{{$cash_requestunassigneds->request_id}}">Assign</button>
</div>
   <div class="modal fade" id="cashModal{{$cash_requestunassigneds->request_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    	<div class="modal-dialog" role="document">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="exampleModalLabel">Assign Delivery Boy</h5>
    					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    						<span aria-hidden="true">&times;</span>
    					</button>
    			</div>
    			<!--//form-->
    			<form action="{{route('assignedcashrequest')}}" method="post">   
    			{{csrf_field()}}
    			<div class="modal-body">
    			 <div class="form-group">
                    <label for="exampleFormControlSelect3">choose a Delivery Boy<sup>*</sup></label>
                    <select class="form-control form-control-sm" id="exampleFormControlSelect3 " name="delivery_boy_name">
                      @foreach($delivery_boy as $delivery_boys)
                      @if($delivery_boys->area_id==$cash_requestunassigneds->area_id)
		          	    <option value="{{$delivery_boys->delivery_boy_id}}"><span style="font-weight:bold">{{$delivery_boys->delivery_boy_name}}</span> 
		          	    </option>
		          	  @endif
		             @endforeach
                      
                      
                    </select>
                    </div>
                    
                      
                      <input type="hidden" class="form-control" name="request_id" value={{$cash_requestunassigneds->request_id}}>
                    
                    
    			</div>
    			<div class="modal-footer">
    			    <button type="submit" class="btn btn-success mr-2">Assign</button>
    				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    			</div>
    			</form>
    			<!--//form-->
    		</div>
    	</div>
    </div>
  
 @endforeach
</div>

<div id="cashrequestassigned" class="tabcontentnew" style="padding:0px !important;">
 @foreach($cash_requestassigned as $cash_requestassigneds)    
<div class="col-lg-12 col-md-12 col-sm-12" style="padding: 16px; border-bottom: 5px dotted; margin-bottom: 13px;">
    <div class ="col-lg-7 col-md-7 col-sm-7" style="border:1px solid grey; background-color:#f7eeee; float: left;">
        <p style="font-size: 14px;"><span>Request id : </span> <b><span style="color:black">{{$cash_requestassigneds->request_id}} </span></b></p>
    </div>  
    <div class ="col-lg-5 col-md-5 col-sm-5"  style="border:1px solid grey; background-color:#f7eeee; float: left;">
       <p style="font-size: 14px;"><span>User id : </span> <b><span style="color:black">{{$cash_requestassigneds->user_id}}</span></b></p>
    </div>
    <p>Amount : <span style="color:black">{{$cash_requestassigneds->amount}}</span></p>
     <p>Collection Date : <span style="color:black">{{$cash_requestassigneds->date_of_collection}}</span></p> 
      <button type="button" style="width:100%" class="btn btn-danger" data-toggle="modal" data-target="#cashrequestModal{{$cash_requestassigneds->request_id}}">Assigned/edit  ({{$cash_requestassigneds->delivery_boy_name}})</button>
</div>
   <div class="modal fade" id="cashrequestModal{{$cash_requestassigneds->request_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    	<div class="modal-dialog" role="document">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="exampleModalLabel">Assign Delivery Boy</h5>
    					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    						<span aria-hidden="true">&times;</span>
    					</button>
    			</div>
    			<!--//form-->
    			<form action="{{route('assignedcashrequest')}}" method="post">   
    			{{csrf_field()}}
    			<div class="modal-body">
    			 <div class="form-group">
                    <label for="exampleFormControlSelect3">choose a Delivery Boy<sup>*</sup></label>
                    <select class="form-control form-control-sm" id="exampleFormControlSelect3 " name="delivery_boy_name">
                      @foreach($delivery_boy as $delivery_boys)
                      @if($delivery_boys->area_id==$cash_requestassigneds->area_id)
		          	    <option value="{{$delivery_boys->delivery_boy_id}}"><span style="font-weight:bold">{{$delivery_boys->delivery_boy_name}}</span> 
		          	    </option>
		          	  @endif
		             @endforeach
                      
                      
                    </select>
                    </div>
                    
                      
                     <input type="hidden" class="form-control" name="request_id" value={{$cash_requestassigneds->request_id}}>
                    
                    
    			</div>
    			<div class="modal-footer">
    			    <button type="submit" class="btn btn-success mr-2">Assign</button>
    				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    			</div>
    			</form>
    			<!--//form-->
    		</div>
    	</div>
    </div>
  
  @endforeach
</div>

</div>

</div>
    <div class="col-lg-6 col-sm-12" style="padding-left:0px !important; padding-right:0px !important;float:left; overflow-y: scroll !important;">
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
        <div id="map" style="width:100%;height:87%;"></div>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQ-YSVmQS8h0Pv3hs_YwLZ65ifZqZ23X0"> 
        </script>
        <script type="text/javascript">
            //  var locations = [
            //   ['Bondi Beach', 0, -33.890542, 151.274856, 4],
            //   ['Coogee Beach', 0, -33.923036, 151.259052, 5],
            //   ['Cronulla Beach', 0, -34.028249, 151.157507, 3],
            //   ['Manly Beach', 0, -33.80010128657071, 151.28747820854187, 2],
            //   ['Maroubra Beach', 0, -33.950198, 151.259302, 1]
            //  ];
            
             var locations = {!! $map_list !!};
        
            var map = new google.maps.Map(document.getElementById('map'), {
              zoom: 6,
              center: new google.maps.LatLng({{$latitude}}, {{$longitude}}),
              mapTypeId: google.maps.MapTypeId.ROADMAP
            });
        
            var infowindow = new google.maps.InfoWindow();
        
            var marker, i;
        
            for (i = 0; i < locations.length; i++) {  
              marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][2], locations[i][3]),
                map: map
              });
        
              google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                var tamplate='<b>NAME :</b> '+locations[i][0]+'<br><b>MOBILE :</b> '+locations[i][1];
                  infowindow.setContent(tamplate);
                  infowindow.open(map, marker);
                }
              })(marker, i));
            }
          </script>
    </div>
    <div class="col-lg-3 col-sm-12"  style="padding-left:0px !important; padding-right:0px !important;float:left; ;height: 87% !important; overflow-y: scroll !important;">
    <div style="background-color: #ff9a03; padding: 16px;">
        <b style="color:white">Delivery Boy</b>
        
    </div>    
   <div class="tab">
  <button class="tablinks newbtn" id="firstright" onclick="openBoi(event, 'activeboy')">Active</button>
  <button class="tablinks newbtn" onclick="openBoi(event, 'offlineboy')">Offline</button>
  <button class="tablinks newbtn" onclick="openBoi(event, 'total')">Total</button>
  </div>
  <div id="activeboy" class="tabcontent" style="padding:0px !important;">
  @foreach($onlinedelivery_boy as $delivery_boy)
  <div class="col-lg-12" style="height: 93px;">
  <div class="col-lg-12" style="height: 93px; border-bottom: 1px solid black;">      
  <b>Delivery boy id-<span style="color:green">{{$delivery_boy->delivery_boy_id}}</span></b><br>
  <div class="col-lg-8" style="float:left">
  <img src="{{url($delivery_boy->delivery_boy_image)}}" style="width: 26px;" alt="delivery boy image">  
  <b><span style="color:green">{{$delivery_boy->delivery_boy_name}}</span></b><br>
  <b>Phone :<span style="color:green">{{$delivery_boy->delivery_boy_phone}}</span></b>
  </div>
   <div class="col-lg-4" style="height: 30px; float:right !important">   
  <b><span style="color:green">{{$delivery_boy->delivery_boy_status}}</span></b><br>
   <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$delivery_boy->delivery_boy_id}}" style="font-size: 10px;">Send Notification</button>
  
  </div>
  
  </div>
  </div>
  
     <div class="modal fade" id="exampleModal{{$delivery_boy->delivery_boy_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    	<div class="modal-dialog" role="document">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="exampleModalLabel">Notification message for delivery boy</h5>
    					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    						<span aria-hidden="true">&times;</span>
    					</button>
    			</div>
    			<div class="col-lg-12">
    			<!--//form-->
    			<form action="{{route('notificationtodeliveryboy')}}" method="post">   
    			{{csrf_field()}}
                    <div class="form-group">
                      <label for="exampleInputName1">Notification<sup>*</sup></label>
                      <textarea class="form-control" id="exampleInputName1" name="message"></textarea>
                    </div>
                    <input type="hidden" value="{{$delivery_boy->delivery_boy_id}}" name="delivery_boy_id">
    			<div class="modal-footer">
    			    <button type="submit" class="btn btn-success mr-2">Send Notification</button>
    			    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    			</div>
    			</form>
    			<!--//form-->
    			</div>
    			
    		</div>
    	</div>
    </div>
  @endforeach
  </div>

   <div id="offlineboy" class="tabcontent" style="padding:0px !important;">
 @foreach($offlinedelivery_boy as $delivery_boy)
  <div class="col-lg-12" style="height: 93px;">
  <div class="col-lg-12" style="height: 93px; border-bottom: 1px solid black;">      
  <b>Delivery boy id-<span style="color:green">{{$delivery_boy->delivery_boy_id}}</span></b><br>
  <div class="col-lg-8" style="float:left">
  <img src="{{url($delivery_boy->delivery_boy_image)}}" style="width: 26px;" alt="delivery boy image">  
  <b><span style="color:green">{{$delivery_boy->delivery_boy_name}}</span></b><br>
  <b>Phone :<span style="color:green">{{$delivery_boy->delivery_boy_phone}}</span></b>
  </div>
   <div class="col-lg-4" style="height: 30px; float:right !important">   
  <b><span style="color:green">{{$delivery_boy->delivery_boy_status}}</span></b><br>
  </div>
  
  </div>
  </div>
  @endforeach
    </div> 
    
     <div id="total" class="tabcontent" style="padding:0px !important;">
  @foreach($totaldelivery_boy as $delivery_boy)
  <div class="col-lg-12" style="height: 93px;">
  <div class="col-lg-12" style="height: 93px; border-bottom: 1px solid black;">      
  <b>Delivery boy id-<span style="color:green">{{$delivery_boy->delivery_boy_id}}</span></b><br>
  <div class="col-lg-8" style="float:left">
  <img src="{{url($delivery_boy->delivery_boy_image)}}" style="width: 26px;" alt="delivery boy image">  
  <b><span style="color:green">{{$delivery_boy->delivery_boy_name}}</span></b><br>
  <b>Phone :<span style="color:green">{{$delivery_boy->delivery_boy_phone}}</span></b>
  </div>
   <div class="col-lg-4" style="height: 30px; float:right !important">   
  <b><span style="color:green">{{$delivery_boy->delivery_boy_status}}</span></b><br>
  </div>
  
  </div>
  </div>
  @endforeach
    </div> 
     
      </script>      
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    
        <script>
    function myMap() {
    var mapProp= {
      center:new google.maps.LatLng(51.508742,-0.120850),
      zoom:5,
    };
    var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
    }
    </script>
    
    
    
    
    
  <!-- Bootstrap core JavaScript-->
  <script src="{{url('public/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{url('public/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{url('public/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{url('public/js/sb-admin-2.min.js')}}"></script>

  <!-- Page level plugins -->
  <script src="{{url('public/vendor/chart.js/Chart.min.js')}}"></script>

  <!-- Page level custom scripts -->
  <script src="{{url('public/js/demo/chart-area-demo.js')}}"></script>
  <script src="{{url('public/js/demo/chart-pie-demo.js')}}"></script>
  
  <script src="{{url('public/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{url('public/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

  <!-- Page level custom scripts -->
  <script src="{{url('public/js/demo/datatables-demo.js')}}"></script>
  
 <script>
 document.getElementById("todayorder").style.display = "block";
 var element = document.getElementById("firstleft");
   element.classList.add("active");
 document.getElementById("today_unassigned").style.display = "block";
 var element2 = document.getElementById("secondleft");
   element2.classList.add("active");
   
  document.getElementById("activeboy").style.display = "block";
 var element3 = document.getElementById("firstright");
   element3.classList.add("active"); 
 
function openCity(evt, cityName) {
  var i, tabcontent, tabcontentnew, tablinks;
  tabcontentnew = document.getElementsByClassName("tabcontentnew");
  for (i = 0; i < tabcontentnew.length; i++) {
    tabcontentnew[i].style.display = "none";
  }
  
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

function openCitynew(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontentnew");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>


 <script>
 document.getElementById("todayorder").style.display = "block";
 var element = document.getElementById("firstleft");
   element.classList.add("active");
 document.getElementById("today_unassigned").style.display = "block";
 var element2 = document.getElementById("secondleft");
   element2.classList.add("active");
   
  document.getElementById("activeboy").style.display = "block";
 var element3 = document.getElementById("firstright");
   element3.classList.add("active"); 
 
function openBoi(evt, cityName) {
  var i, tabcontent, tabcontentnew, tablinks;
  tabcontentnew = document.getElementsByClassName("tabcontentnew");
  for (i = 0; i < tabcontentnew.length; i++) {
    tabcontentnew[i].style.display = "none";
  }
  
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

</script>
    </body>
    
</html>
