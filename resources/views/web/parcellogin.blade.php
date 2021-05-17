<!DOCTYPE html>
<html>
   <head>
      <title>login</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/4ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="{{ url('frontassets/owlcarousel/owl.carousel.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ url('frontassets/owlcarousel/owl.theme.default.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ url('frontassets/css/style.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ url('frontassets/css/style2.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ url('frontassets/css/style3.css') }}">
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Dosis:300,400,500,,600,700,700i|Lato:300,300i,400,400i,700,700i" rel="stylesheet">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
      <link href="{{ url('frontassets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
      <link href="{{ url('frontassets/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
      <link href="{{ url('frontassets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
      <link href="{{ url('frontassets/vendor/venobox/venobox.css') }}" rel="stylesheet">
      <link href="{{ url('frontassets/vendor/line-awesome/css/line-awesome.min.css') }}" rel="stylesheet">
      <link href="{{ url('frontassets/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

      <link href="https://fonts.googleapis.com/css?family=Philosopher&display=swap" rel="stylesheet">
                  <style>
          .login_banner79 {
                background: linear-gradient(rgba(22, 9, 11, .3), rgba(172, 2, 2, .1)), url(public/frontassets/image/parcel.jpg);
                background-position: 40% 60%;
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center center;
                min-height: auto;
            }
      </style>
   </head>
   <body>
      <div class="container-fluid">
        <?php
        $vendorgrocerycat = DB::table('vendor_category')->where('ui_type','=',4)->first();
        ?>
         <div class="row">
            <div class="col-sm-6 login_banner79">
            </div>
            
            <div class="col-sm-6 sec_loginpad">
            @if (count($errors) > 0)
                    @if($errors->any())
                   <div class="alert alert-primary" role="alert">
                  <strong>SUCCESS : </strong>{{$errors->first()}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
                  </div>
                  @endif
                 @endif
            <form method="POST" action="{{route('parcellogin')}}">
            {{csrf_field()}}
               <p style="font-size: 35px;font-weight: 500;">Welcome Back</p>
               <p class="login_continue1">Sign in to continue</p>
               <p class="login_para122">Mobile Number</p>
               <input type="" name="mobile" class="login_input40" placeholder="Enter Mobile Number">
               <br><br>
               <p class="login_para122">Password</p>
               <input type="password" name="password" class="login_input40" placeholder="Enter Password">
               <button class="login_btn756">SIGN IN</button>
               </form>
               <!-- <button class="login_face756"><i class="fab fa-facebook-f"></i> Facebook</button><button class="login_goog756" style="float: right;"><i class="fab fa-google-plus-g"></i> Google Plus</button> -->
               <br><br>
               <br>
               <br>
               <center>
               <p class="forgot_login"><a  href="{{ route('parcelforgotpassword') }}">Forgot your password?</a></p>
                    <p style="font-size: 14px;">Don't have an account? <a  href="{{ route('parcelwebsignup') }}">Sign up</a></p>
               </center>
            </div>

         </div>
      </div>
   </body>
</html>