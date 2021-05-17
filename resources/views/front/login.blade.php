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

        <!-- Sign in form -->
  
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="{{url('public/login/images/signin-image.jpg')}}" alt="sing up image"></figure>
                        <a href="{{route('register-user')}}" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Sign in</h2>
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
                        <form method="POST" class="register-form" action="{{route('userlogin')}}" id="login-form">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="phone" name="user_phone" id="user_phone" placeholder="user phone"/>
                            </div>
                             <div class="form-group">
                                <label for="your_password"><i class="zmdi zmdi-key material-icons-name"></i></label>
                                <input type="password" name="user_password" id="user_password" placeholder="user password"/>
                            </div>
                           
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="{{url('public/login/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{url('public/login/js/main.js')}}"></script>
</body>
</html>