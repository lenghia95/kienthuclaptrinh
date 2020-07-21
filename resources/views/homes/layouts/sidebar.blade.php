<div class="fakeimg p-3 mt-2">
    {{-- <form action="">
        <div class="input-group mb-3">
            <input type="text" name="keywork" class="form-control" placeholder="Search">
            <div class="input-group-append">
                <button class="btn btn-secondary search" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form> --}}
    <div class="newspaper-x-blog-sidebar">
        <div class="widget widget_categories">
            {{-- <div class="widget-head">
                <h3 class="widget-title text-light p-2">Danh mục</h3>
            </div> --}}
            <div class="box-title">
                <h2 class="title">
                    <a href="javascript:void(0)">Danh mục</a>
                </h2>
            </div>
            <div class="categories mt-3">
                <ul>
                    @foreach(App\Models\Category::getCategories() as $key => $category)
                        <li>
                            <a href="{{ url('category/'.$category->slug) }}"> 
                                <i class="fa fa-angle-double-right"></i> 
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

</div>

<div class="fakeimg p-3 mt-2">

    <div class="newspaper-x-blog-sidebar">
        <div class="widget widget_categories">
            {{-- <div class="widget-head">
                <h3 class="widget-title text-light p-2">Bài viết mới</h3>
            </div> --}}
            <div class="box-title">
                <h2 class="title">
                    <a href="javascript:void(0)">Bài viết mới</a>
                </h2>
            </div>
            <div class="post-news mt-3">
                @foreach(App\Models\Post::getPosts() as $key => $post)
                    @if($key < 5)
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

<div class="fakeimg p-3 mt-2">
    
    <div class="newspaper-x-blog-sidebar">
        <div class="widget widget_categories">
            {{-- <div class="widget-head">
                <h3 class="widget-title text-light p-2">Bài viết xem nhiều</h3>
            </div> --}}
            <div class="box-title">
                <h2 class="title">
                    <a href="javascript:void(0)">Bài viết xem nhiều</a>
                </h2>
            </div>
            <div class="post-news mt-3">
                @foreach(App\Models\Post::getPostManyViews() as $key => $post)
                    @if($key < 5)
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