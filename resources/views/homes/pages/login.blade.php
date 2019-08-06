@extends('homes.layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <div class="col-sm-8 col-sm-12 col-lg-8">
        <div class="fakeimg p-2 mt-2">
            <div class="news-ticker" >
                <ul>
                    <li>
                        <span>
                            <a href="{{ url('/')  }}" >
                                <span>Trang chủ</span>
                            </a>
                        </span>
                    </li>
                    <li>
                        <span>
                            <i class="fa fa-angle-double-right"></i>
                            <span class="title">Đăng nhập</span>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="fakeimg mt-2 p-2">
            @if(session('msg'))
                <div class="alert alert-success">{{ session('msg') }}</div>
            @endif
            @if(session('failed'))
                <div class="alert alert-danger">{{ session('failed') }}</div>
            @endif
        </div>
        <div class="fakeimg mt-2 p-2">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="loginOrRegisterModalLabel">Đăng nhập hoặc đăng ký để khám phá thêm!</h5>
                   
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <h2>Đăng nhập</h2>
                            <form method="POST" action="{{ url('login') }}" id="loginForm" accept-charset="UTF-8">
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
            </div>
        </div>
        <!-- main-content -->
    </div>
    
    <div class="col-sm-4 col-sm-12 col-lg-4 sticky sidebar">
        @include('homes.layouts.sidebar')
        @include('homes.layouts.fanpage')
    </div>


@stop

