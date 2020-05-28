<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="{{asset('')}}">
    <!-- Font awsome -->
    <link rel="stylesheet" href="source/source/Fontawsome/css/fontawesome.css">
    <link rel="stylesheet" href="source/source/Fontawsome/css/brands.css">
    <link rel="stylesheet" href="source/source/Fontawsome/css/solid.css">
    <!-- // End font awsome -->
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="source/source/Bootstrap/css/bootstrap.min.css" type="text/css">
    <!-- // Bootstrap -->
    <!-- Css -->
    <link rel="stylesheet" href="source/assets/css/style.css" type="text/css">
    <!-- // Css -->
    <!-- Jquery & Bootstrap -->

    <script src="source/source/JQuery/jquery.js"></script>
    <script src="source/source/Bootstrap/js/bootstrap.min.js"></script>

    <!-- // Jquery -->
    <!-- Font google sans -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">


    <!-- // Font google  -->
    <!-- W3 CSS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <title>Spicy Food - Teach you delicious cooking</title>


</head>

<body>

<!-- Banner -->
@include('header')

<!-- Content -->
@yield('content')
<!-- // Content -->
@include('index-search')
@include('footer')

<script src="source/assets/js/smooth.js"></script>

<script src="source/assets/js/function.js"></script>

<script>
    AOS.init();
</script>
<script src="source/assets/js/addField.js"></script>
<a  id="toTop" style="display: inline;" href="#"><span id="toTopHover" style="opacity: 0;"></span></a>
</body>
</html>
