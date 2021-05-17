<!doctype html>
<html lang="en">

<head>
    
   <!--inc dec button -->
   <style>
    input,
textarea {
  border: 1px solid #eeeeee;
  box-sizing: border-box;
  margin: 0;
  outline: none;
  padding: 10px;
}

input[type="button"] {
  -webkit-appearance: button;
  cursor: pointer;
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
}

.input-group {
  clear: both;
  margin: 15px 0;
  position: relative;
}

.input-group input[type='button'] {
  background-color: #eeeeee;
  min-width: 38px;
  width: auto;
  transition: all 300ms ease;
}

.input-group .button-minus,
.input-group .button-plus {
  font-weight: bold;
  height: 38px;
  padding: 0;
  width: 38px;
  position: relative;
}

.input-group .quantity-field {
  position: relative;
  height: 38px;
  left: -6px;
  text-align: center;
  width: 62px;
  display: inline-block;
  font-size: 13px;
  margin: 0 0 5px;
  resize: vertical;
}

.button-plus {
  left: -13px;
}

input[type="number"] {
  -moz-appearance: textfield;
  -webkit-appearance: none;
}

  </style> 
    
    
    <!--end dec button -->
</head>

<body>
    <div class="wrapper">
        <!--sider -->
       @extends('cityadmin.layout.app')

       @section ('content')
            <!--content -->
            <div class="content">
               <div class="container-fluid">
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
                          
                                <div class="card-content">
                                    <h4 class="card-title">Order Detail</h4>
                                    
                             
                                    </div>
                                    <div class="material-datatables">
                                          <form role="form" method="post" action="" >
                                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%" data-background-color="purple">
                                            <thead>
                                                <tr>
                                                    <th colspan="3" class="text-center">Order Details</th>
                                                    
                                                    <!--th class="text-center" style="width: 100px;">Action</th-->
                                                </tr>
                                            </thead>
                                        
                                            <tbody>
                                                <tr>
                                                    <td colspan="3">
                                                        <table class="table">
                                                            <tr>
                                                                <td valign="top">
                                                                <strong> Order Id</strong>
                                                                <br />

                                                                <strong>  Order Date </strong>
                                                                <br />

                                                                </td>
                                                                <td>
                                                                    <strong> Delivery Details </strong><br />
                                                                    <strong>Contact <br/> Contact</strong>
                                                                    <br />
                                                                    <strong>Address</strong>
                                                                    <address>
                                                                        
                                                                    </address>
                                                                    <br />
                                                                     Delivery Time </p>
                                                                 </td>
                                                                
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th>Product Name</th>
                                                    <th>Qty</th>
                                                    <th>Product Price</th>
                                                </tr>
                                               
                                                <tr>
                                                    <td colspan="2"><strong class="pull-right">Total</strong></td>
                                                    <td >
                                                        <strong class=""></strong>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td colspan="2"><strong class="pull-right">Delivery Charges</strong></td>
                                                    <td >
                                                        <strong class=""></strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"><strong class="pull-right">Net Total Amount</strong></td>
                                                    <td >
                                                        <strong class=""></strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        </form>
                                    </div>
                                </div>
                                <!-- end content-->
                            </div>
                            <!--  end card  -->
                        </div>
                        <!-- end col-md-12 -->
                    </div>
                    <!-- end row -->
                </div>
            </div>
            <!--footer -->
            
        </div>
    </div>
    <!-- content -->
    
</body>

<script type="text/javascript">
    $(document).ready(function() {

        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

        demo.initVectorMap();
    });
</script>
<script>
        $(document).ready(function() {
            $(".value-minus").click(function(){
		        var product_id = $(this).attr('product_id');
		        var qty = $(".qty"+product_id).val();
		        if(qty>0)
		        {
		        var new_prod_qty = parseInt(qty)-1;
		        
		        $(".qty"+product_id).val(new_prod_qty);
		        $(".update_qty"+product_id).val(new_prod_qty);
		     // alert(new_prod_qty);
		        }
		    });
		     $(".value-plus").click(function(){
		        var product_id = $(this).attr('product_id');
		        var qty = $(".qty"+product_id).val();
		        var new_prod_qty = parseInt(qty)+1;
		        
		        $(".qty"+product_id).val(new_prod_qty);
		        $(".update_qty"+product_id).val(new_prod_qty);
		     // alert(new_prod_qty);
		        
		    });
        } );
    </script>
    
    <script>
        $(document).ready(function() {
            $('#datatables').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            } );
        } );
    </script>
</html>
@endsection

































