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
                            <span class="title">Giới thiệu</span>
                        </span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="fakeimg mt-2 p-2">
            {!! $about->content !!}
        </div>
        <!-- main-content -->
    </div>

    <div class="col-sm-4 col-sm-12 col-lg-4 sticky sidebar">
        @include('homes.layouts.sidebar')
        @include('homes.layouts.fanpage')
    </div>


@stop

