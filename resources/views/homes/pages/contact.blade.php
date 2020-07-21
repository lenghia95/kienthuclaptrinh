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
                            <span class="title">Liên hệ</span>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="fakeimg p-3 mt-2">
            <p class="text-center"><b>Nếu có thắc mắc gì thì hãy liên hệ ngay cho chúng tôi!!!</b></p>
            @if(session('msg'))
                <div class="alert alert-success">{{ session('msg') }}</div>
            @endif
            <form action="{{ url('contact') }}" method="post" class="needs-validation" novalidate>
                @csrf
                <div class="form-group">
                    <div class="row">
                        <label class="col-md-3 mt-2 text-right">Họ và tên:</label>
                        <div class="col-md-9">
                            <div class="input-group mb-3">
                                    
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class=" fa fa-user"></i></span>
                                </div>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Nhập họ tên" required>
                                @error('name')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback">Vui lòng nhập vào vào trường này!!</div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-md-3 mt-2 text-right">E-Mail:</label>
                        <div class="col-md-9">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class=" fa fa-envelope"></i></span>
                                </div>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Nhập email" required>
                                @error('email')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback">Vui lòng nhập vào vào trường này!!</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-md-3 mt-2 text-right">Số điện thoại:</label>
                        <div class="col-md-9">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                </div>
                                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="Nhập số điện thoại" required>
                                @error('phone')
                                    <div class="error">{{ $message }}</div> 
                                @enderror
                                <div class="invalid-feedback">Vui lòng nhập vào vào trường này!!</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-md-3 mt-2 text-right">Nội dung:</label>
                        <div class="col-md-9">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class=" fa fa-pencil"></i></span>
                                </div>
                                <textarea class="form-control" name="content" rows="4" placeholder="Nhập nội dung" required> {{ old('content') }} </textarea>
                                @error('content')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback">Vui lòng nhập vào vào trường này!!</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-9">
                            <button type="submit" name="submit" class="btn btn-info">Gửi <span class="fa fa-send"></span></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="fakeimg mt-2">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3903.580358405804!2d108.42059081429561!3d11.934265240018652!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31716ccc751b2fbb%3A0xbc2f88c9401be4ee!2zTmfDtCBUaMOsIE5o4bqtbSwgUGjGsOG7nW5nIDQsIFRwLiDEkMOgIEzhuqF0LCBMw6JtIMSQ4buTbmcsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1551554133336" width="100%" height="450px" frameborder="0" allowfullscreen class="bando"></iframe>
        </div>
        <!-- main-content -->
    </div>

    <div class="col-sm-4 col-sm-12 col-lg-4 sticky sidebar">
        <div class="fakeimg p-3 mt-2">
            <div class="newspaper-x-blog-sidebar">
                <div class="widget widget_categories">
                    {{-- <div class="widget-head">
                        <h3 class="widget-title text-light p-2">Thông tin liên hệ </h3>
                    </div> --}}
                    <div class="box-title">
                        <h2 class="title">
                            <a href="javascript:void(0)">Thông tin liên hệ</a>
                        </h2>
                    </div>
                    <div class="next-days mt-3 pl-2">
                        <p>Nếu thông tin bạn cần không được tìm thấy trong danh sách hỗ trợ, vui lòng liên hệ với chúng tôi thông qua:</p>
                        <ul>
                            <li>
                                <div class="day-summary">
                                    <div class="d-decs" style="padding-left: 10px">
                                        <i class="fa fa-phone"></i> Số điện thoại:
                                        <a class="uppercase" href="#" title="">{{ $Setting['company_phone'] }}</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="day-summary">
                                    <div class="d-decs" style="padding-left: 10px">
                                        <i class="fa fa-envelope"></i> Email:
                                        <a class="uppercase" href="#" title="">{{ $Setting['company_email'] }}</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="day-summary">
                                    <div class="d-decs" style="padding-left: 10px">
                                        <i class="fa fa-map-marker"></i> Địa chỉ:
                                        <a class="uppercase" href="#" title="">{{ $Setting['company_address'] }}</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
    
        </div>
        @include('homes.layouts.sidebar')
        @include('homes.layouts.fanpage')

    </div>


@stop

