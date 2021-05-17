<!DOCTYPE html>
<html>
   <head>
      <title>signup</title>
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
   </head>
   <body>
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-6" style="padding: 80px 140px 27px 140px;">
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
            <form method="POST" action="{{route('grocerywebsignup')}}">
            {{csrf_field()}}
               <p style="font-size: 35px;font-weight: 500;">Hello There</p>
               <p class="login_continue1">Sign up to continue</p>
               <p class="login_para122">Name</p>
               <input type="" name="name" class="login_input40" placeholder="Enter Name">
               <br><br>
               <p class="login_para122">Mobile Number</p>
               <input type="" name="mobile" class="login_input40" placeholder="Enter Mobile Number">
               <br><br>
               <p class="login_para122">Email Address</p>
               <input type="" name="email" class="login_input40" placeholder="Enter Email Address">
               <br><br>
               <p class="login_para122">Password</p>
               <input type="" name="password" class="login_input40" placeholder="Enter Password">
               <button class="login_btn756">SIGN UP</button>
               </form>

               <!-- <button class="login_face756"><i class="fab fa-facebook-f"></i> Facebook</button><button class="login_goog756" style="float: right;"><i class="fab fa-google-plus-g"></i> Google Plus</button> -->
               <br><br>
               <center>
                  <p class="forgot_login">ALready an account? <a  href="{{ route('grocerylogin') }}">Sign in</a></p>
               </center>
            </div>
            <div class="col-sm-6 login_banner76">
            </div>
         </div>
      </div>
   </body>
</html>