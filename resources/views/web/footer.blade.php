<!-- ======= Footer ======= -->

<section class="footers pt-5 pb-3" style="background-color: #000000;">
   <div class="container">
       <div class="row">
           <div class="col-xs-12 col-sm-6 col-md-4 footers-one">
    		    <div class="footers-logo">
    		        LOGO HERE
    		    </div>
    		    <div class="footers-info mt-3">
    		        <p>Cras sociis natoque penatibus et magnis Lorem Ipsum tells about the compmany right now the best.</p>
    		    </div>
    		    <div class="social-icons"> 
                <a href="https://www.facebook.com/"><i id="social-fb" class="fab fa-facebook fa-2x social"></i></a>
                <a href="https://twitter.com/"><i id="social-tw" class="fab fa-twitter-square fa-2x social"></i></a>
	            <a href="https://plus.google.com/"><i id="social-gp" class="fab fa-google-plus-square fa-2x social"></i></a>
	            <a href="mailto:bootsnipp@gmail.com"><i id="social-em" class="fa fa-envelope-square fa-2x social"></i></a>
	        </div>
    		</div>
    	   <div class="col-xs-12 col-sm-6 col-md-2 footers-two">
    		
    		</div>
    	   <div class="col-xs-12 col-sm-6 col-md-2 footers-three">
    		 
    		</div>
    	   <div class="col-xs-12 col-sm-6 col-md-2 footers-four">
    		    <h5>Explore </h5>
    		    <ul class="list-unstyled">
    			 <li><a href="#">Sitemap</a></li>
    			 <li><a href="#">Testimonials</a></li>
    			 <li><a href="#">Feedbacks</a></li>
    			 <li><a href="#">User Agreement</a></li>
    			</ul>
    		</div>
    	   <div class="col-xs-12 col-sm-6 col-md-2 footers-five">
    		    <h5>Company </h5>
    		    <ul class="list-unstyled">
    			 <li><a href="#">Career</a></li>
    			 <li><a href="{{ route('webterms') }}">Terms</a></li>
    			 <li><a href="{{ route('webaboutus') }}">About Us</a></li>
    			 <li><a href="#">Contact Us</a></li>
    			</ul>
    		</div>
    		
       </div>
   </div>
</section>
<section class="copyright border">
    <div class="container">
        <div class="row ">
            <div class="col-md-12 pt-3">
                <p class="text-muted">© 2021 Tecmanic Pvt. Ltd. <span style="float: right;position: relative;top: -8px;"><img src="{{ url('frontassets/image/a1.png') }}" height="40"> &nbsp; <img src="{{ url('frontassets/image/g1.png') }}" height="40"></span></p>
            </div>
        </div>
    </div>
</section>
<!-- End Footer -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   
    $("#submit-btn").click(function(e){
        debugger;

        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
         var name = $("input[name=username]").val();
         var password = $("input[name=password]").val();
         var email = $("input[name=email]").val();
         var mobile = $("input[name=mobile]").val();
         debugger;

        $.ajax({
           type:'POST',
           url:"",
           data:{name:name, password:password, email:email,mobile:mobile},
           success:function(data){
            debugger;

                // var obj = JSON.parse(data);
                // alert(obj.success);
               if(data.success)
               {
                   if(data.code == 1)
                   {
                    $('#msgdetails').html('<div id="failedmessage"><div class="alert alert-success">'+data.success+'</div> </div><input type="hidden" name="verify_mobile_number" value="'+mobile+'"><a  onclick="getverifydata()"><b>Verify Mobile<b></a><br><br>');
                        $('#signup').modal('hide');
                        $('#verifyotp').modal('show');
                   }
                  else
                  {
                      $('#msgdetails').html('<div class="alert alert-success">'+data.success+'</div>');
                  }
               }else
               {
                  $('#msgdetails').html('<div class="alert alert-danger">'+data.error+'</div>');
               }
              $(".loader").css('display','none');
           },
           beforeSend : function(){
              
                $(".loader").css('display','block');
            }
        });
  
   });

   $("#login-btn").click(function(e){
    debugger;
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
   
         var mobile = $("#mobile").val();
         var password = $("#password").val();
         debugger;
        $.ajax({
           type:'POST',
           url:"",
           data:{mobile:mobile, password:password},
           success:function(data){
            debugger;
            // var obj = JSON.parse(data);
            if(data.success)
            {
              $('#login').modal('hide');
              swal({
                title: "SUCCESS",
                text: data.success,
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
               
               }).then(function(){
                                      window.location.reload();
                                  })

            }else
            {
                $('#loginmsgdetails').html('<div class="alert alert-danger">'+data.error+'</div>');
            }
                 $(".loader").css('display','none');
            },
            beforeSend : function(){
              
                $(".loader").css('display','block');
            }
  
   });
  });
  $("#verifyotpmobile-btn").click(function(e){
        
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
   
         var mobile = $("input[name=verify_mobile_number]").val();
         var verifyotpmobnew = $("input[name=verifyotpmobnew]").val();
         debugger;
      
        $.ajax({
          type:'POST',
          url:"{{ route('webotpverify') }}",
          data:{mobile:mobile, verifyotpmobnew:verifyotpmobnew},
          success:function(data){
            //   var obj = JSON.parse(data);
            if(data.success)
            { 
               debugger;
            $('#verifyotp').modal('hide');
              swal({
                title: "SUCCESS",
                text: data.success,
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
               
              }).then(function(){
                                      window.location.reload();
                                  })

            }else
            {
                $('#failedmessage').html('<div class="alert alert-danger">'+data.error+'</div>');
            }
                 $(".loader").css('display','none');
            },
            beforeSend : function(){
              
                $(".loader").css('display','block');
            }
  
  });
  });

  $("#forgotpassword").click(function(e){
      debugger;
        e.preventDefault();
      var mobile = $('#forgotmobile').val();
       $.ajaxSetup({
                     headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
            });
            $.ajax({
               url: "{{ route('webforgotpassword') }}",
               type:"POST",
               data:{mobile: mobile},
               success: function(result){
                   if(result == 1)
                   {
                       $('#forgotphone').val(mobile);
                       $('#forgot_pass').modal('hide');
                       $('#forgot_pass_otp').modal('show');
                   }
               }
            });
      
  });
  function finalotpverify()
  {
   debugger;
      var mobile = $('#forgotphone').val();
      var otp = $('#otp').val();
       $.ajaxSetup({
                     headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
            });
            $.ajax({
               url: "{{ route('otpverifyforgotpassword') }}",
               type:"POST",
               data:{mobile: mobile,otp:otp},
               success: function(result){
                  debugger;
                  if(result == 1)
                  {
                      $('#updatephone').val(mobile);
                      $('#forgot_pass_otp').modal('hide');
                      $('#updatepassword').modal('show');
                  }else
                  {
                       $('#msgdiv').html('<div class="alert alert-danger col-md-12">Otp Not Match</div>')
                  }
               }
            });
  }
  function updatepassword()
  {
   debugger;
      var mobile  =  $('#updatephone').val();
      var newpassword = $('#newpassword').val();
      var confirmpassword =  $('#confirmpassword').val();
      if(newpassword != confirmpassword)
      {
          $('#confirmmsg').html("New password not match with Confirm password ");
          $('#confirmmsg').css('color','red');
      }
      else
      {
         debugger;

      $.ajaxSetup({
                     headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
            });
            $.ajax({
               url: "{{ route('webupdatepassword') }}",
               type:"POST",
               data:{newpassword: newpassword,confirmpassword:confirmpassword,mobile:mobile},
               success: function(result){
                  debugger;
                  if(result == 1)
                  {
                      $('#updatepassword').modal('hide');
                     swal({
                        title: "Success",
                        text: "Password Update Successfully",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                       
                       }).then(function(){
                                              window.location.reload();
                                          })
                  }
               }
            });
      }
      
  }
  function getverifydata()
  {
     
  }
  function getalert()
  {
    alert('Please Login');
  }
});
  </script>