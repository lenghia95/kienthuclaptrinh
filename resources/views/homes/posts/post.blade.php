@extends('homes.layouts.app')

@section('content')
<meta property="og:url"           content="{{ Request::fullUrl() }}" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="{{ $post->title }}" />
<meta property="og:description"   content="{{ $post->description }}" />
<meta property="og:image"         content="{{ asset($post->thumbnail) }}" />
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
                            <a href="{{ url('category/'.$post->cSlug) }}" >
                                 <span>{{ $post->cName }}</span>
                            </a>
                        </span>
                    </li>
                    
                    <li>
                        <span>
                            <i class="fa fa-angle-double-right"></i>
                            <span class="title">{{ $post->title }}</span>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb -->


        <!-- main-content -->
        <div class="main-content">
                <div class="fakeimg p-3 mt-2">
                     <div class="row">
                        <div class="col-md-12">
                            <h3 class="entry-title">
                                <a>{{ $post->title }}</a>
                            </h3>
                            <div class="newspaper-x-post-meta">
                                <div>
                                    
                                    <div class="mom-post-meta bp-meta single-post-meta">
                                        <span class="author vcard mr-2"><i class="fa fa-user"></i> {{ $post->uName }} </span>
                                        <span class="mr-2">
                                            <i class="fa fa-clock-o"></i>
                                            <time datetime="2019-03-07T03:51:04+00:00" itemprop="datePublished" class="updated">{{ date('d/m/Y',strtotime($post->created_at)) }}</time>
                                        </span>
                                        <span class="mr-2"><i class="fa fa-eye"></i> {{ $post->views }}</span>
                                        <span class="mr-2"><i class="fa fa-comments"></i> {{ $post->comments->count() }}</span>
                                        <span> <i class="fa fa-tags"></i> </span><a href="{{ url('category/'.$post->cSlug) }}" class="badge badge-info">{{ $post->cName }}</a>
                                    </div>
                                </div>
                                

                                <!-- post detail -->
                                    <section class="post-content"> 
                                        {!! $post->content !!}
                                    </section>
                                <!-- post detail -->
                            </div>
                        </div>
                    </div>
                </div>
                    

                <!-- tags -->
                    <div class="fakeimg p-2 mt-2">
                        <div class="row">
                                <div class="col-md-6">
                                <h6 class="m-0"><i class="fa fa-tags"></i>Tags:
                                    <span> 
                                        @foreach (App\Models\PostCategory::getCatsByPostId($post->id) as $cat)
                                            <a href="{{ url('category/'.$cat->slug) }}"><span class="badge badge-info"> {{ $cat->name }} </span></a>
                                        @endforeach
                                    </span>
                                </h6>
                            </div>
                            <div class="col-md-6">
                                <div class="text-right">
                                        <div class="fb-share-button" 
                                        data-href="{{ Request::url() }}" 
                                        data-layout="button_count">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                <!-- tags -->

                <!-- bình luận -->
                    <div class="fakeimg p-2 mt-2">
                        <h4> Bình luận:</h4>
                        

                        <div class="comment-show mb-5">
                            <!-- Comment parent -->
                            @foreach($comments as $comment)
                            <div class="media mb-2 comment-parent comment-{{ $comment->id }}">
                                <img class="d-flex mr-2 border rounded comment-avatar" src="{{ ( !empty($comment->avatar) ) ? asset($comment->avatar) : asset('uploads/users/user.png') }}" alt="{{ $comment->fullname }}" title="{{ $comment->fullname }}">
                                <div class="media-body comment-body">
                                    <div class="card bg-light p-2 card-edit-{{ $comment->id }}">
                                        <div class="comment-content-{{ $comment->id }}">
                                            <h5 class="mt-0">{{ $comment->fullname }}</h5>
                                            <div class="comment-body-content">
                                                {!! $comment->content !!}
                                            </div>
                                        </div>
                                        <div class="form-edit-{{ $comment->id }}">
                                            
                                        </div>
                                    </div>
                                    <div>
                                        <ul class="list-inline mb-1 comment-action">
                                            <li class="list-inline-item">
                                                <a class="reply" data-scrollto="#reply{{ $comment->id }}" data-toggle="collapse" data-pell="{{ $comment->id }}" href="#reply{{ $comment->id }}" role="button" aria-expanded="false" aria-controls="reply{{ $comment->id }}"><i class="fa fa-reply" aria-hidden="true"></i> Trả lời</a>
                                            </li>
                                            @if(Auth::check() && Auth::user()->fullname == $comment->fullname)
                                            <li class="list-inline-item">
                                                <a href="javascript:void(0)" data-id="{{ $comment->id }}" class="reply delete-comment"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript:void(0)" data-id="{{ $comment->id }}" class="reply edit-comment"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Sửa</a>
                                            </li>
                                            @endif
                                            <li class="list-inline-item">
                                                @php
                                                    $current = Carbon\Carbon::create(date('Y-m-d H:i:s',strtotime($comment->created_at)));
                                                @endphp
                                                @if( $current->diffInMinutes() < 60)
                                                    {{ ($current->diffInMinutes() == 0) ? 1 : $current->diffInMinutes()}} phút
                                                @endif
                                                @if( $current->diffInHours() > 0 && $current->diffInHours() < 24)
                                                    {{ $current->diffInHours() }} giờ
                                                @endif
                                                @if( $current->diffInDays() > 0 && $current->diffInDays() < 30)
                                                    {{ $current->diffInDays() }} ngày
                                                @endif
                                                @if( $current->diffInMonths() > 0 && $current->diffInMonths() < 12)
                                                    {{ $current->diffInMonths() }} tháng
                                                @endif
                                                @if( $current->diffInYears() > 0)
                                                    {{ $current->diffInYears() }} năm
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- Comment children -->
                                    <div class="comment-children{{ $comment->id }} comment-child">
                                        @foreach (App\Models\Comment::getCommentsByParent($comment->id) as $reply)
                                        <div class="media mb-2 comment-{{ $comment->id }}" id="comment{{ $comment->id }}">
                                            <img class="d-flex mr-2 border rounded comment-avatar" src="{{ ( !empty($reply->avatar) ) ? asset($reply->avatar) : asset('uploads/users/user.png') }}" alt="{{ $reply->fullname }}" title="{{ $reply->fullname }}">
                                            <div class="media-body">
                                                <div class="card bg-light p-2 card-edit-{{ $reply->id }}">
                                                   <div class="comment-content-{{ $reply->id }}">
                                                        <h5 class="mt-0">{{ $reply->fullname }}</h5>
                                                        <div class="comment-body-content">
                                                            {!! $reply->content !!}
                                                        </div>
                                                   </div>
                                                   <div class="form-edit-{{ $reply->id }}"> </div>
                                                </div>
                                                <ul class="list-inline mb-1 comment-action">
                                                    <li class="list-inline-item">
                                                        <a class="reply" data-scrollto="#reply{{ $comment->id }}" data-toggle="collapse" data-pell="{{ $comment->id }}" href="#reply{{ $comment->id }}" role="button" aria-expanded="false" aria-controls="reply{{ $comment->id }}"><i class="fa fa-reply" aria-hidden="true"></i> Trả lời</a>
                                                    </li>
                                                    @if(Auth::check() && Auth::user()->id == $reply->uId)
                                                    <li class="list-inline-item">
                                                        <a href="javascript:void(0)" data-id="{{ $reply->id }}" class="reply delete-comment"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="javascript:void(0)" data-id="{{ $reply->id }}" class="reply edit-comment"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Sửa</a>
                                                    </li>
                                                    @endif
                                                    @php
                                                        $current = Carbon\Carbon::create(date('Y-m-d H:i:s',strtotime($reply->created_at)));
                                                    @endphp
                                                    <li class="list-inline-item">
                                                        @if( $current->diffInMinutes() < 60)
                                                            {{ ($current->diffInMinutes() == 0) ? 1 : $current->diffInMinutes()}} phút
                                                        @endif
                                                        @if( $current->diffInHours() > 0 && $current->diffInHours() < 24)
                                                            {{ $current->diffInHours() }} giờ
                                                        @endif
                                                        @if( $current->diffInDays() > 0 && $current->diffInDays() < 30)
                                                            {{ $current->diffInDays() }} ngày
                                                        @endif
                                                        @if( $current->diffInMonths() > 0 && $current->diffInMonths() < 12)
                                                            {{ $current->diffInMonths() }} tháng
                                                        @endif
                                                        @if( $current->diffInYears() > 0)
                                                            {{ $current->diffInYears() }} năm
                                                        @endif
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="collapse mb-1" id="reply{{ $comment->id }}">
                                        <form method="POST" action="javascript:void(0)" accept-charset="UTF-8" class="postAjax" id="comment-reply">
                                            @csrf
                                            <input type="hidden" name="post" value="{{ $post->id }}">
                                            <input type="hidden" name="comment" value="{{ $comment->id }}">
                                            <div class="form-group textarea-comment">
                                                <textarea class="form-control comment" name="content" rows="1" placeholder="Nhập nội dung bình luận..."></textarea>
                                            </div>
                                            <input type="reset" class="d-none">
                                            {{-- <button type="submit" name="submit" class="btn btn-info btn-sm comment"><i class="fa fa-send"></i> Gửi bình luận</button> --}}
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="card mb-3 comment-form">
                            <div class="card-body p-2">
                                <form method="POST" action="javascript:void(0)" accept-charset="UTF-8" class="postAjax" id="comment0">
                                    @csrf
                                    <input type="hidden" name="post" value="{{ $post->id }}">
                                    <div class="form-group textarea-comment">
                                        <textarea class="form-control comment" name="content" rows="1" placeholder="Nhập nội dung bình luận..."></textarea>
                                    </div>
                                    <input type="reset" class="d-none">
                                    {{-- <button type="submit" name="submit" class="btn btn-info btn-sm comment"><i class="fa fa-send"></i> Gửi bình luận</button> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                <!-- tags -->
            </div>
        <!-- main-content -->
        
    </div>

        <!-- sidebar -->

    <div class="col-sm-4 col-sm-12 col-lg-4 sticky sidebar">

        @include('homes.layouts.sidebar')
        @include('homes.layouts.fanpage')

    </div>

@stop

@push('script')
    <script type="text/javascript">
    
        $(document).ready(function () {
            
            $(document).on( 'keydown', 'textarea', function (e){
                $(this).css('height', 'auto' );
                $(this).height( this.scrollHeight );
            });

            $(document).on( 'focus', 'textarea[name=content]', function (e){
                $(this).css('background-color', 'rgb(238, 238, 238)' );
            });

            @if(!Auth::check())
                var login = false;
            @else 
                var login = true;
            @endif

            $('textarea.comment').on('click', function(){
                if(login == false){
                    window.location.href="/login";
                }
            });

            $(document).on( "keypress", "#comment0", function(e) {
                if(e.which == 13) {
                    if(login == false){
                        window.location.href="/login";
                    }else if(login == true){
                        var option = $( this ).serializeArray();

                        if(option[2] == ''){
                            return false;
                        }else{
                            $.ajax({
                                type: "POST",
                                url: "{{ url("ajax/comment") }}",
                                data: {
                                    post_id: option[1].value,
                                    content: option[2].value,
                                }, 
                                success: function(data)
                                {
                                    // alert(data);return false;
                                    $('.comment-show').append(data);
                                    $('input[type=reset]').click();
                                }
                            });
                            return false;
                        }
                    }
                }
            });

            $(document).on( "keypress", "#comment-reply", function(e) {
                if(e.which == 13) {
                    if(login == false){
                        window.location.href="/login";
                    }else if(login == true){
                        var option = $( this ).serializeArray();
                        if(option[2] == ''){
                            return false;
                        }else{
                            $.ajax({
                                type: "POST",
                                url: "{{ url("ajax/comment-reply") }}",
                                data: {
                                    post_id: option[1].value,
                                    content: option[3].value,
                                    comment_id: option[2].value,
                                }, 
                                success: function(data)
                                {
                                    $('.comment-children'+ option[2].value).append(data);
                                    $('input[type=reset]').click();
                                }
                            });
                            return false;
                        }
                    }
                }
            });
            
            $(document).on('click', '.delete-comment', function(){
                var comment_id = $(this).data('id');
                var check = confirm('Bạn chắc chắn muốn xóa bình luận này!');
                if(check == true){
                    $.ajax({
                        type: "post",
                        url: "{{ url("ajax/comment-del") }}",
                        data: { comment_id: comment_id, _token: "{{ csrf_token() }}"},
                        success: function (data) {
                            if(data != ''){
                                $('.comment-'+comment_id).remove();
                            }
                        }
                    });
                    
                }else{return false}
            });


            $(document).on('click', '.edit-comment', function(){
                var comment_id = $(this).data('id')
                    content = $('.card-edit-'+ comment_id + ' .comment-body-content').text();
                   
                var html = '<form method="POST" action="javascript:void(0)" accept-charset="UTF-8" class="postAjax" id="edit-comment"><input type="hidden" name="comment_id" value="'+comment_id+'" /><div class="form-group textarea-comment"><textarea class="form-control comment" name="content" rows="1" placeholder="Nhập nội dung bình luận...">'+ content.trim() +'</textarea><span class="reply">Nhấn phím Esc để hủy</span></div><input type="reset" class="d-none"></form>';
                
                $('.comment-content-' + comment_id).css('display','none');
                $('.form-edit-'+comment_id).html(html);
                $( document ).on( 'keydown', function ( e ) {
                    if ( e.keyCode === 27 ) {
                        $('#edit-comment').hide();
                        $('.comment-content-' + comment_id).css('display','block');
                    }
                });
            });

            $(document).on( "keypress", "#edit-comment", function(e) {
                if(e.which == 13) {
                    var option = $( this ).serializeArray();
                   
                    if(option[1] == ''){
                        return false;
                    }else{
                        $.ajax({
                            type: "POST",
                            url: "{{ url("ajax/comment-edit") }}",
                            data: {
                                content: option[1].value,
                                comment_id: option[0].value,
                            }, 
                            success: function(data)
                            {
                                $('.card-edit-'+ option[0].value + ' .comment-body-content').text(data);
                                $('.comment-content-' + option[0].value).css('display','block');
                                $('#edit-comment').hide();
                            }
                        });
                        return false;
                    }
                }
            });

        });
    </script>
@endpush