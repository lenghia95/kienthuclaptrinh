<style>
.dropbtn {
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.account-content {
  text-align: left;
  display: none;
  position: absolute;
  right: -46px;
  background-color: #f1f1f1;
  min-width: 160px;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 10000;
}

.account-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a.t-account:hover {background-color: #ddd;}

.show {display: block;}
    </style>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark p-0">
    <div class="container p-0">

        <div class="col-md-6 col-lg-6 col-sm-6 col-6 pl-0 ">
            <ul class="navbar-nav mr-auto menu-top">
                <?php $menuList = new App\Models\Menulist; ?>
                @foreach($menuList->getMenusList('menu_top') as $menu)
                    <li class="nav-item p-0">
                        <a class="nav-link" href="{{ asset($menu->url) }}">{{ $menu->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="col-md-6 col-lg-6 col-sm-6 col-6 text-right pr-0">
            <a href="{{ $Setting['facebook'] }}" class="facebook"><i class="fa fa-facebook-official"></i></a>
            <a href="{{ $Setting['youtube'] }}" class="youtube"><i class="fa fa-youtube"></i></a>
            <a href="{{ $Setting['googleplus'] }}" class="google-plus"><i class="fa fa-google-plus"></i></a>
           
            @if(Auth::check())
            <div class="dropdown">
                <a href="#" onclick="myFunction()" class="dropbtn"><i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->username }}</a>
                <div id="myAccount" class="account-content">
                    <a class="t-account" href="#"><i class="fa fa-info-circle" aria-hidden="true"></i> Tài khoản</a>
                    {{-- <a class="t-account" href="#about">About</a> --}}
                    <a class="t-account" href="{{ url('logout?back='.Request::fullUrl()) }}"> <i class="fa fa-sign-out" aria-hidden="true"></i> Đăng xuất</a>
                </div>
            </div>
             @else
                <a href="{{ url('login') }}"  class="login-frontend"> Đăng nhập</a>
            @endif
        </div>

    </div>
</nav>

<div class="container-fluid header-logo">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-3 logo">
                <a href="{{ url('/')  }}" class="custom-logo-link" rel="home" itemprop="url">
                    <img src="{{ asset($Setting['logo']) }}" class="custom-logo" alt="" itemprop="logo">
                </a>
            </div>
            <div class="col-md-9 col-sm-9 col-9 header-banner text-right">
                <a href="#">
                    <img src="{{ asset('homes/images/uploads/banner.png') }}" class="attachment-newspaper-x-wide-banner size-newspaper-x-wide-banner" alt="">
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal login and resgiter -->
{{-- <div class="modal fade" id="loginModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="loginOrRegisterModalLabel">Đăng nhập hoặc đăng ký để khám phá thêm!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <h2>Đăng nhập</h2>
                            <form method="POST" action="{{ url('login?back='.Request::fullUrl()) }}" id="loginForm" accept-charset="UTF-8">
                                @csrf
                                <!-- Email -->
                                <div class="form-group">
                                    <input class="form-control form-contro" value="{{ old('email') }}" required="" placeholder="E-Mail Address" name="email" type="email">
                                    <small class="text-danger"></small>
                                </div>
                                <!-- Password -->
                                <div class="form-group">
                                    <input class="form-control" required="required" placeholder="Mật khẩu" name="password" type="password" value="">
                                    <small class="text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-info">
                                        Đăng nhập
                                    </button>
                                    <a class="btn btn-sm btn-link" href="https://chungnguyen.xyz/password/reset">
                            Quên mật khẩu rồi
                            </a>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 col-lg-6">
                            <form method="POST" action="{{ url('register') }}" id="registerForm" accept-charset="UTF-8">
                                @csrf
                               
                                <h2>hoặc Đăng ký</h2>
                                <!-- Name -->
                                <div class="form-group">
                                    <input class="form-control" value="{{ old('username') }}" required="required" placeholder="Tên" name="username" type="text">
                                    @error('username')
                                        <label id="username-error" class="error" for="username">{{ $message }}</label>
                                    @enderror
                                    <small class="text-danger"></small>
                                </div>
                                <!-- Email -->
                                <div class="form-group">
                                    <input class="form-control" id="register_email" required value="{{ old('email') }}" placeholder="E-Mail Address" name="email" type="email" />
                                    @error('email')
                                        <label id="email-error" class="error" for="email">{{ $message }}</label>
                                    @enderror
                                    <small class="text-danger"></small>
                                </div>
                                <!-- Password -->
                                <div class="form-group">
                                    <input class="form-control" required="required" id="password" placeholder="Mật khẩu" name="password" type="password" value="">
                                    @error('password')
                                        <label id="password-error" class="error" for="password">{{ $message }}</label>
                                    @enderror
                                    <small class="text-danger"></small>
                                </div>
                                <!-- Confirm Password -->
                                <div class="form-group">
                                    <input id="password-confirm" type="password" class="form-control" name="repassword" placeholder="Xác nhận mật khẩu" >
                                    @error('repassword')
                                        <label id="repassword-error" class="error" for="repassword">{{ $message }}</label>
                                    @enderror
                                </div>
                                <!-- submit -->
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-info">
                                        Đăng ký
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col text-center">
                            <a href="javascript:void(0)" class="fb btn social-facebook"><i class="fa fa-facebook fa-fw"></i> Login with Facebook</a>
                            <a href="javascript:void(0)" class="twitter btn social-twitter"><i class="fa fa-twitter fa-fw"></i> Login with Twitter</a>
                            <a href="javascript:void(0)" class="google btn social-google"><i class="fa fa-google fa-fw"></i> Login with Google+</a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Thôi khỏi</button>
                </div>
            </div>
        
        </div>
    </div>
</div> --}}
