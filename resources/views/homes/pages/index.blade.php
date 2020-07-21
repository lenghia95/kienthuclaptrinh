@extends('homes.layouts.app')

@section('content')
    <div class="col-sm-8 col-sm-12 col-lg-8">
        <div class="fakeimg p-2 mt-2">
            <h3>{{ $page->title }}</h3>
            {!! $page->content !!}
        </div>
        @foreach (App\Models\Category::getCategories() as $cat)
        @php 
            $obj = new App\Models\Post;
            $post = $obj->getPostByCat($cat->slug); 
        @endphp 
            @if ($post)
            
                <div class="fakeimg p-1 mt-2">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="box-title">
                                <h2 class="title">
                                    <a href="{{ url('category/'.$cat->slug) }}">{{ $cat->name }}</a>
                                </h2>
                            </div>
                        </div>
                    
                        <div class="col-md-6">
                            <div class="newspaper">
                                <a href="{{ url('post/'.$post->slug) }}">
                                    <img src="{{ asset($post->thumbnail) }}" alt="{{ $post->title }}">
                                </a>
                                <div class="first-tag">
                                    <a class="badge badge-warning" href="{{ url('category/'.$cat->slug) }}">{{ $cat->name }}</a>
                                </div>
                                <div class="bf-content-br"></div>
                                <div class="bf-content">
                                    <h5 class="recent-title">
                                        <a href="{{ url('post/'.$post->slug) }}">{{ $post->title }}</a>
                                    </h5>
                                    <div class="mom-post-meta mom-w-meta">
                                        <span class="entry-date"><i class="fa fa-clock-o"></i> {{ date('d/m/Y',strtotime($post->created_at)) }}</span>  -  
                                        <span class="entry-date"><i class="fa fa-eye"></i> {{ $post->views }} - </span>
                                        <span class="entry-date"><i class="fa fa-comments"></i> {{ $post->comments->count() }} </span>
                                    </div>
                                </div>
                            </div>
                            <div class="content-post">
                                    {!! str_limit($post->description, 150) !!}
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="post-news newspaper-home">
                                @foreach (App\Models\Post::getPostsByCat($cat->slug) as $key => $post)
                                    @if($key < 5 && $key != 0)
                                        
                                        <div class="mpw-post">
                                            <div class="post-img main-sidebar-element">
                                                <a href="{{ url('post/'.$post->slug) }}">
                                                    <img src="{{ asset($post->thumbnail) }}" alt="{{ $post->title }}" >
                                                </a>
                                            </div>
                                            <div class="details has-feature-image">
                                                <h6>
                                                    <a href="{{ url('post/'.$post->slug) }}" title="{{ $post->title }}">{{ $post->title }}</a>
                                                </h6>
                                                
                                            </div>
                                            <div class="mom-post-meta mom-w-meta">
                                                <span class="entry-date"><i class="fa fa-clock-o"></i> {{ date('d/m/Y',strtotime($post->created_at)) }}</span>  -
                                                <span class="entry-date"><i class="fa fa-eye"></i> {{ $post->views }} - </span>
                                                <span class="entry-date"><i class="fa fa-comments"></i> {{ $post->comments->count() }} </span>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>  
                    
                    </div>
                </div>

            @endif
        @endforeach
        <div class="fakeimg p-1 mt-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="box-title">
                        <h2 class="title">
                            <a href="/search/label/Break?&amp;max-results=10">Bài viết mới</a>
                        </h2>
                    </div>
                </div>

                <div class="slider-blog">
                    @foreach ($posts as $post)
                        
                        <div class="col-md-4 blogspot">
                            <div class="newspaper new-slider">
                                <a href="{{ url('post/'.$post->slug) }}">
                                    <img src="{{ asset($post->thumbnail) }}"  alt="{{ $post->title }}">
                                </a>
                                <div class="first-tag">
                                    <a class="badge badge-warning" href="{{ url('category/'.$post->cSlug) }}">{{ $post->name }}</a>
                                </div>
                                <div class="bf-content-br"></div>
                                <div class="bf-content">
                                    <h5 class="recent-title">
                                        <a href="{{ url('post/'.$post->slug) }}">{{ $post->title }}</a>
                                    </h5>
                                    <div class="mom-post-meta mom-w-meta">
                                        <span class="entry-date"><i class="fa fa-clock-o"></i> {{ date('d/m/Y',strtotime($post->title) ) }}</span>  -  
                                        <span class="entry-date"><i class="fa fa-eye"></i> {{ $post->views }} - </span>
                                        <span class="entry-date"><i class="fa fa-comments"></i> {{ $post->comments->count() }} </span>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    
    </div>


        <!-- sidebar -->

    <div class="col-sm-4 col-sm-12 col-lg-4 sticky sidebar">

        @include('homes.layouts.sidebar')
        @include('homes.layouts.fanpage')

    </div>

   
@stop

