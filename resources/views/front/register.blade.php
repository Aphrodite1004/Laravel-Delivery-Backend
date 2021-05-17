 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

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
                        <h2 class="form-title">Sign up</h2>
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
                        <form method="POST" class="register-form" action="{{route('registerform')}}" id="register-form" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="user_name" id="name" placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="user_email" id="email" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="phone"><i class="zmdi zmdi-phone"></i></label>
                                <input type="phone" name="user_phone" id="phone" placeholder="Your Phone"/>
                            </div>
                            <div class="form-group">
                                <label for="your_password"><i class="zmdi zmdi-key material-icons-name"></i></label>
                                <input type="password" name="user_password" id="user_password" placeholder="user password"/>
                            </div>
                            <div class="form-group">
                                <label for="repeat_password"><i class="zmdi zmdi-key material-icons-name"></i></label>
                                <input type="password" name="repeat_password" id="repeat_password" placeholder="repeat password"/>
                            </div>
                            <div class="form-group">
                                <label for="image"><i class="zmdi zmdi-lock"></i></label>
                                <input type="file" name="user_image" id="image"/>
                            </div>
                            <!--<div class="form-group">-->
                            <!--    <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>-->
                            <!--    <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password"/>-->
                            <!--</div>-->
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="{{url('public/login/images/signup-image.jpg')}}" alt="sing up image"></figure>
                        <a href="{{route('login-user')}}" class="signup-image-link">I am already member</a>
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