@extends('homes.layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="fakeimg p-2 mt-2">
            <h3>{{ $page->title }}</h3>
            {!! $page->content !!}
        </div>
        @if(app('request')->input('s'))
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
                                <span class="title">Tìm kiếm</span>
                            </span>
                        </li>
                        <li>
                            <span>
                                <i class="fa fa-angle-double-right"></i>
                                <span class="title">Kết quả tìm kiếm cho từ khóa: 
                                    <b style="color:red">"{{ app('request')->input('s') }}"</b>
                                    - Tìm thấy :<span> {{ $posts->total() }} </span>
                                </span>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        @else 
            <div class="fakeimg mt-2">
                <div class="widget-head">
                    <h3 class="widget-title text-light p-2">Bài viết mới</h3>
                </div>
            </div>
        @endif
        <div class="fakeimg p-2 mt-2">
            <!--  -->
            <div class="row">
                @foreach($posts as $post)
                <div class="col-sm-4 post-home">
                    <a href="{{ url('post/'.$post->slug) }}">
                        <img src="{{ asset($post->thumbnail) }}" class="img-thumbnail img-responsive margin" style="width:100%" alt="Image">
                    </a>
                    <h5 class="mt-1"><a href="{{ url('post/'.$post->slug) }}">{{ $post->title }}</a></h5>
                    <div class="mom-post-meta bp-meta">
                        <span class="author vcard">Đăng bởi: {{ $post->uName }}</span>
                        <span>Ngày: 
                            <time class="updated">{{ date('d/m/Y',strtotime($post->created_at)) }}</time>
                             - <i class="fa fa-eye"> {{ $post->views }} </i>
                             - <i class="fa fa-comments"> {{ $post->comments->count() }} </i>
                        </span>
                    </div>
                    <p>{!! str_limit($post->description,100) !!}</p>

                </div>
                @endforeach
                
                
            </div>
            <div class="col-md-12">
                {{ $posts->appends(Request::except('page'))->links() }}
            </div>
        </div>
    </div>
@stop

{{-- @section('sidebar')
    @include('homes.layouts.sidebar')
    @include('homes.layouts.fanpage')
@stop
 --}}