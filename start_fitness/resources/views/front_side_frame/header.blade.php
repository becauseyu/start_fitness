<nav class="fixed-top navbar navbar-expand-lg navbar-light " style="background-color: #E5D9CE;">
    <a class="navbar-brand d-lg-none" href="/index"><img width="60" height="60" style="display:block; margin:auto;"
            src="/image/LOGO.png"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbarToggler7"
        aria-controls="myNavbarToggler7" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>


    <div class="collapse navbar-collapse mx-auto row " id="myNavbarToggler7">
        <div class=" col-1"></div>
        <ul class="navbar-nav mx-auto nav-justif justify-content-around " style="align-items: end;">
            <li class="nav-iteml px-1">
                <a class="nav-link " href="/sport/introduce">運動Tip</a>
            </li>
            <li class="nav-iteml px-1">
                <a class="nav-link" href="/goods/index">健身小物</a>
            </li>
            <li class="nav-iteml px-1">
                <a class="nav-link" href="/sport/gymmap">預約地圖</a>
            </li>
            <a class="d-none d-lg-block px-4" href="/index"><img width="60" height="60" style="display:block; margin:auto;"
                    src="/image/LOGO.png"></a>
            <li class="nav-itemr px-1">
                <a class="nav-link" href="/food/introduce">飲食Tip</a>
            </li>
            <li class="nav-itemr px-1">
                <a class="nav-link" href="/goods/index">飲食小食</a>
            </li>
            <li class="nav-itemr px-1">
                <a class="nav-link" href="/food/minigame">Mini game</a>
            </li>
        </ul>
        @if (isset($member))
            <div class=" col-2 d-flex justify-content-end">
                <button class="btn " >
                    <a href="/member/login"><i class="fa fa-user" aria-hidden="true"></i></a>
                </button>
            <button class="btn btn-cart" data-toggle="dropdown" onclick="openbuycar()">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                <span id="cartQuantity" class="badge badge-pill badge-danger" >0</span>
            </button>
            <button class="btn " >
                <a href="/member/logout"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
            </button>
        </div>
        @else 
        <div class=" col-2 d-flex justify-content-end">
            <button class="btn " >
                <a href="/member/login"><i class="fa fa-user-o" aria-hidden="true"></i>登入</a>
            </button>
            <button class="btn btn-cart" data-toggle="dropdown" onclick="openbuycar()">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                <span id="cartQuantity" class="badge badge-pill badge-danger" >0</span>
            </button>
            
        </div>

        @endif
        
    </div>
</nav>
<div class="" style="width: 100%; height :75px;"></div>

