<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/ld/goods.css">
    <link rel="stylesheet" href="/css/ld/member.css">
    <link rel="stylesheet" href="/css/ld/ld_login.css">

    <link rel="stylesheet" href="/bootstrap-4.6.1-dist/css/bootstrap.min.css">
    <title>管理員登出</title>
</head>

<body>
    <div class="location">
        <div class="outside-out">
            <div class="cen" id="mark">
                <p class="header-out">登出成功!</p>
                <p class="header-out01">於3秒後,跳轉回登入畫面</p>

                <img class="mt-4"  src="/image/ld/login/opindex00.png" width="500" class="rounded">
            </div>
        </div>
        <script>
            setTimeout(() => {
                window.location = "/ld/login";
            }, 3000);
        </script>
        </div>
</body>

</html>
