<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/magic-master/dist/magic.css" rel="stylesheet">


    @include('front_side_frame.link')
    <title>Document</title>
    <style>
        div {
            position: absolute;
            display: block;
            width: 10vw;
            height: 10vh;
            background-color: aqua;
        }
    </style>
</head>

<body>
    <div class="hi">123</div>
    <script>
        // function myFunction() {
        //     const selector = document.querySelector('.hi')
        //     // selector.classList.add('magictime', 'slideRight')
        //     selector.classList.toggle('slideRight')
        //     selector.classList.toggle('magictime')
        // }
        // setInterval(myFunction, 1000);



        $('.hi').hover(function() {
            $(this).addClass('magictime slideRight');
        });
    </script>
</body>

</html>
