@extends('homes.layouts.app')

@section('content')

     <div class="col-sm-8 col-sm-12 col-lg-8">

         <!-- Breadcrumb -->
        <div class="fakeimg p-2 mt-2">
            <div class="news-ticker" >
                <ul>
                    <li>
                        <span>
                            <a href="{{ url('') }}" >
                                 <span>Trang chủ</span>
                            </a>
                        </span>
                    </li>
                    <li>
                        <span>
                            <i class="fa fa-angle-double-right"></i>
                            <span class="title">{{ $category->name }}</span>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb -->


        <!-- main-content -->
        <div class="main-content">
            @if($posts->total() == 0)
                <div class="fakeimg p-2 mt-2 text-center">
                    Hiện tại chưa có bài đăng nào cho mục này!!
                </div>
            @else
                @foreach($posts as $post)
                    <div class="fakeimg p-3 mt-2">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="newspaper-x-image">
                                    <a href="{{ url('post/'.$post->slug) }}">
                                        <img src="{{ asset($post->thumbnail) }}" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <h5 class="entry-title">
                                    <a href="{{ url('post/'.$post->slug) }}">{{ $post->title }}</a>
                                </h5>
                                <div class="newspaper-x-post-meta">
                                    <div>

                                        <div class="mom-post-meta bp-meta">
                                            <span class="author vcard">Đăng bởi: {{ $post->uName }}</span>
                                            <span>Ngày:
                                                <time class="updated">{{ date('d/m/Y',strtotime($post->created_at)) }}</time>
                                                 - <i class="fa fa-eye"> {{ $post->views }} </i>
                                                 - <i class="fa fa-comments"> {{ $post->comments->count() }} </i>
                                                    </span>
                                        </div>
                                        @foreach (App\Models\PostCategory::getCatsByPostId($post->id) as $cat)
                                            <a href="{{ url('category/'.$cat->slug) }}"><span class="badge badge-info"> {{ $cat->name }} </span></a>
                                        @endforeach

                                    </div>
                                    <p>{!! str_limit($post->content,150) !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            <ul class="pagination mt-2">
                {{ $posts->appends(Request::except('page'))->links() }}
            </ul>
        </div>
        <!-- main-content -->

    </div>

        <!-- sidebar -->

    <div class="col-sm-4 col-sm-12 col-lg-4 sticky sidebar">

        @include('homes.layouts.sidebar')
        @include('homes.layouts.fanpage')

    </div>

   
@stop

