<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    @include('front_side_frame.link')
    <link rel="stylesheet" href="/css/ld/ld_login.css">

    <title>後台login</title>
</head>

<body>
    <section class="location">
        <div class="outside">
            <form method="POST">
                @csrf
                <div>
                    <p class="header01">後臺管理系統</p>
                </div>
                <div class="" id="mark"><img src="/image/ld/login/opindex00.png" class="rounded img-fluid img01"></div>
                <div class="form-group mt-4">
                    <label for="account" class="header-font">管理員帳號</label>
                    <input type="text" class="form-control" id="account" name="account" value={{$data['account']}}>
                </div>
                <div class="form-group mt-3">
                    <label for="exampleInputPassword1" class="header-font">管理員密碼</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder={{$data['error']}}>
                </div>
                <button type="submit" class="btn button01">登入</button>
            </form>
        </div>

    </section>
</body>

</html>