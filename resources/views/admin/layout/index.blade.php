<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="{{asset('')}}">
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="source/source/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin_asset/css/style.css">
    <script src="source/source/JQuery/jquery.js"></script>
    <script src="source/source/Bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <title>Admin - Spicy Food</title>
</head>
<body>
<div class="food-admin">
    <!-- Header menu -->
    @include('admin.layout.header-menu')
    <div class="food-wrapper">
        <!-- left menu food-->
        @include('admin.layout.menu')
        <!-- Content  -->
        @yield('content')
    </div>
</div>
<script>
    let x = document.getElementsByTagName("body")[0];
    let xheight = x.offsetHeight;
    let y = document.getElementsByClassName("food-admin")[0];
    let yheight = y.offsetHeight;
    if(yheight<xheight){
        y.style.height = ""+xheight+"px";
    }
</script>

<script src="admin_asset/js/function.js"></script>
<script src="source/assets/js/uploadImage.js"></script>
<script src="source/assets/js/addField.js"></script>

</body>
</html>
