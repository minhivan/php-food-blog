<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="{{asset('')}}">
    <link rel="stylesheet" href="source/source/Bootstrap/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="source/assets/css/login.css" type="text/css">
    <script src="source/source/JQuery/jquery.js"></script>
    <script src="source/source/Bootstrap/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes&display=swap" rel="stylesheet">
    <title>Login - SpicyFood</title>
</head>
<body>
<div class="error-show" id="error_element">
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Error!</strong>
            @foreach($errors->all() as $err)
                <p>{{$err}}</p>
            @endforeach
        </div>
        <button id="hide_div">Retry</button>
    @endif
    @if(session('thongbao'))
        <div class="alert alert-success">
            <strong>{{session('thongbao')}}</strong>
        </div>

    @endif
</div>

<div class="login-container">

    <img src="source/content/background/Login/undraw_profile_pic_ic5t.svg" alt="" class="mobile_background" style="display: none">
    <img src="source/content/background/Login/undraw_cooking_lyxy.svg" alt="" class="
    background ">
    <div class="login">
        <form action="" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="login__title">
                <h3>Welcome to Spicy Food</h3>
            </div>
            <div class="login__fill-in">
                <input type="text" name="user_email" id="useremail" placeholder="Email" >
                <input type="text" name="user_name" id="userlogin" placeholder="User Name">
                <input type="text" name="user_fname" id="userfullname" placeholder="First Name">
                <input type="text" name="user_lname" id="userfullname" placeholder="Name Name">
                <input type="password" name="user_pwd" id="pwd" placeholder="Password">
                <button type="submit">Sign up</button>

            </div>
            <div class="login__second-type">
                <div class="divider">
                    <div class="divider__left"></div>
                    <span>OR</span>
                    <div class="divider__right"></div>
                </div>
            </div>
        </form>
          <img src="./classes/background/Login/facebook.svg" alt="">
        <div class="login__fb">
            <i class="icon face-icon"></i>
            <a href="#">Sign-in with Facebook</a>
        </div>
        <div class="login__fb">
            <span>Already have account ? </span><a href="login">Login</a>
        </div>
    </div>
</div>

</body>
<script>
    $(document).ready(function(){
        $("button#hide_div").click(function(){
            $("#error_element").hide(1000);
        });
    });
</script>
</html>
