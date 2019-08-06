@extends('homes.layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="main-content">
            <div class="errors-404 p-3">
                    <div class="row">
                    <div class="col-md-12">
                        <div class="content text-center"> 
                            <img src="{{ asset('homes/images/error-img.png') }}" title="error">

                            <p class="text-center mt-5">
                                <span>
                                    <label class="text-danger">Ohh.....</label>
                                </span>Không tìm thấy trang bạn cần tìm!!!.
                            </p>
                            
                            <a href="{{ url('') }}" class="text-info"><u>Trở về trang chủ</u></a>
                            
                            <div class="copy-right">
                                <p class=" text-center">
                                    {{ $Setting['copyright'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

