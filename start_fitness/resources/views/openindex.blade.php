<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>動吃！動吃！</title>
    <link rel="stylesheet" href="/bootstrap-4.6.1-dist/css/bootstrap.min.css">
    <link href="/aos-master/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel=stylesheet type="text/css" href="/css/head.css">

    <script src="/aos-master/dist/aos.js"></script>
    <script src="/jQuery3.5.1/jquery.js"></script>
    <script src="/bootstrap-4.6.1-dist/js/bootstrap.bundle.min.js"></script>
    <script src="/bootstrap-4.6.1-dist/js/bootstrap.min.js"></script>
    <link rel="icon" href="/image/favico.ico" type="image/x-icon">

    <style>
  .index {
            width: 100%;
            min-height: 100vh;
            background: linear-gradient(to right,
                    #8EB4E3 0%,
                    #8EB4E3 50%,
                    #FBC65C 50%,
                    #FBC65C 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 100;
            position: absolute;

        }

        .logo {
            z-index: 999;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .fd {
            position: absolute;
            z-index: 101;
            background: white;
            width: 50%;
            left: 50%;
            top: 0px;
            height: 100%;
            opacity: 0.6;
        }

        .fd:hover {
            opacity: 0;
        }

        .sp {
            position: absolute;
            z-index: 101;
            background: white;
            width: 50%;
            right: 50%;
            top: 0px;
            height: 100%;
            opacity: 0.6;
        }

        .sp:hover {
            opacity: 0;
        }

    </style>
</head>

<body>
    <div class="row"></div>
    <a href="/sport">
        <div id="left_door" class="sp "></div>
    </a>
    <a href="/food">
        <div onclick="" class="fd animate__animated animate__slideRight"></div>
    </a>
    <div class="index "><img src="/image/LOGO.png" height="300vh" alt=""></div>

    <!-- <img  style="z-index:102 ;" src="../AI/LOGO.png" height="300vh" alt=""> -->


</body>

</html>
