 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Check OTP</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{url('public/login/fonts/material-icon/css/material-design-iconic-font.min.css')}}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{url('public/login/css/style.css')}}">
</head>
<body>

    <div class="main">
     
     
      <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Check OTP</h2>
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
                        <form method="POST" class="register-form" action="{{route('checkotp')}}" enctype="multipart/form-data" id="checkotp-form">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="otp" id="otp" placeholder="otp"/>
                                <input type="hidden" name='user_phone' value='{{ $user_phone }}'/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" class="form-submit" value="verify OTP"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="{{url('public/login/images/signup-image.jpg')}}" alt="sing up image"></figure>
                        <!--<a href="#" class="signup-image-link">I am already member</a>-->
                    </div>
                </div>
            </div>
        </section>
  <!-- JS -->
    <script src="{{url('public/login/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{url('public/login/js/main.js')}}"></script>
</body>
</html>
        <!-- Sing in  Form -->