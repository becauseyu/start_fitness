<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
    <title>login</title>


    <style>
.outside{
    position: absolute;
    border: 1px solid black;
    height: 500px;
    width: 500px;
    left:  calc((100vw - 500px) / 2);
    top : calc((100vh - 500px) / 2);
    padding: 20px;
}

#mark{
    height: 100px;
}
    </style>
</head>

<body>

    <div class="outside">
        <form method="POST" action="">
            {{ csrf_field() }}
            {{-- @csrf --}}
            <div class="mark" id="mark"> I am mark </div>
            <div class="form-group">
                <label for="account">管理員帳號</label>
                <input type="text" class="form-control" id="account" name="account" value={{$data['account']}}>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">管理員密碼</label>
                <input type="password" class="form-control" id="password" name="password" placeholder={{$data['error']}}>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="memorize_account">
                <label class="form-check-label" for="memorize_account">記住帳號</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>