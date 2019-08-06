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
                        <h6 class="m-0"><i class="fa fa-tags"></i>Tags:
                            <span> 
                                @foreach (App\Models\PostCategory::getCatsByPostId($post->id) as $cat)
                                    <a href="{{ url('category/'.$cat->slug) }}"><span class="badge badge-info"> {{ $cat->name }} </span></a>
                                @endforeach
                                
                            </span>
                            
                        </h6>
                    </div>
                <!-- tags -->

                <!-- bình luận -->
                    <div class="fakeimg p-2 mt-2">
                        <h4> Bình luận:</h4>
                        <div class="card mb-3 comment-form">
                            <div class="card-body p-2">
                                <form method="POST" action="https://chungnguyen.xyz/comment" accept-charset="UTF-8" class="postAjax" id="comment0">
                                    <div class="form-group">
                                    <textarea class="form-control" name="content" rows="3" placeholder="Nhập nội dung bình luận"></textarea>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-info btn-sm"><i class="fa fa-send"></i> Gửi bình luận</button>
                                </form>
                            </div>
                        </div>

                        <div class="comment-show mb-5">
                            <!-- Comment parent -->
                            <div class="media mb-2 comment-parent" id="comment145">
                                <img class="d-flex mr-2 border rounded comment-avatar" src="https://www.gravatar.com/avatar/885ef1bb9f053a7129f46856cee814a3?s=80&amp;d=identicon&amp;r=g" alt="Nguyễn Duy Nguyên avatar" title="Nguyễn Duy Nguyên avatar">
                                <div class="media-body comment-body">
                                    <div class="card bg-light p-2">
                                        <h5 class="mt-0">Nguyễn Duy Nguyên</h5>
                                        <div class="comment-body-content">
                                            <div>Em thấy hay mà đọc xong cũng khó hiểu quá bác Chung :D</div>
                                            <div>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <ul class="list-inline mb-1 comment-action">

                                            <li class="list-inline-item">
                                                <a data-scrollto="#reply145" data-toggle="collapse" data-pell="145" href="#reply145" role="button" aria-expanded="false" aria-controls="reply145">Trả lời</a>
                                            </li>
                                            <li class="list-inline-item">3 tháng trước</li>
                                        </ul>
                                    </div>
                                    <div class="collapse mb-1" id="reply145">
                                        <form method="POST" action="https://chungnguyen.xyz/comment" accept-charset="UTF-8" class="postAjax" id="comment0">
                                            <div class="form-group">
                                            <textarea class="form-control" name="content" rows="3" placeholder="Nhập nội dung bình luận"></textarea>
                                            </div>
                                            <button type="submit" name="submit" class="btn btn-info btn-sm"><i class="fa fa-send"></i> Gửi bình luận</button>
                                        </form>
                                    </div>
                                    <!-- Comment children -->
                                    <div class="media mb-2 comment-children" id="comment146">
                                        <img class="d-flex mr-2 border rounded comment-avatar" src="https://www.gravatar.com/avatar/ae9400c5091902176317fe0a0a662393?s=80&amp;d=identicon&amp;r=g" alt="Chung Nguyễn avatar" title="Chung Nguyễn avatar">
                                        <div class="media-body">
                                            <div class="card bg-light p-2">
                                                <h5 class="mt-0">Chung Nguyễn</h5>
                                                <div>Khó hiểu hè, copy về xài thử đi đã</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Comment parent -->
                            <div class="media mb-2 comment-parent" id="comment119">
                                <img class="d-flex mr-2 border rounded comment-avatar" src="https://www.gravatar.com/avatar/ab33f4956949bd02db4296004e0b4c4d?s=80&amp;d=identicon&amp;r=g" alt="Quốc Cường Nguyễn avatar" title="Quốc Cường Nguyễn avatar">
                                <div class="media-body comment-body">
                                    <div class="card bg-light p-2">
                                        <h5 class="mt-0">Quốc Cường Nguyễn</h5>
                                        <div class="comment-body-content">
                                            <p>Cho em hỏi xíu, em áp dụng thử thì ra lỗi <strong>"Class 'App\ProductDetails' not found"</strong></p>
                                            <div>Theo em hiểu thì là&nbsp; do project này em để model trong thư mục <code>app/Models</code>. Vậy làm sao custom lại để Builder hiểu tìm models ở trong thư mục "<code>app/Models</code>" ạ. Hoặc có nếu em hiểu sai thì giải quyết như thế nào trong trường hợp này ạ.</div>
                                        </div>
                                    </div>
                                    <div>
                                        <ul class="list-inline mb-1 comment-action">

                                            <li class="list-inline-item">
                                                <a data-scrollto="#reply119" data-toggle="collapse" data-pell="119" href="#reply119" role="button" aria-expanded="false" aria-controls="reply119">Comment</a>
                                            </li>
                                            <li class="list-inline-item">6 tháng trước</li>
                                        </ul>
                                    </div>
                                    <div class="collapse mb-1" id="reply119">
                                        <form method="POST" action="https://chungnguyen.xyz/comment" accept-charset="UTF-8" class="postAjax">
                                            <input name="_token" type="hidden" value="DLp2dPdDcAI7SprNpcRRWTs9AgSXo7wtiuXnrhBc">
                                            <input name="parent_id" type="hidden" value="119">
                                            <input name="entity_id" type="hidden" value="235">
                                            <input name="entity_type" type="hidden" value="Modules\Blog\Models\Post">
                                            <input name="body" type="hidden" value="">
                                            <div class="mb-2" id="reply-form-119"></div>
                                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-paper-plane"></i> Gửi bình luận</button>
                                        </form>
                                    </div>
                                    <!-- Comment children -->
                                    <div class="media mb-2 comment-children" id="comment120">
                                        <img class="d-flex mr-2 border rounded comment-avatar" src="https://www.gravatar.com/avatar/ae9400c5091902176317fe0a0a662393?s=80&amp;d=identicon&amp;r=g" alt="Chung Nguyễn avatar" title="Chung Nguyễn avatar">
                                        <div class="media-body">
                                            <div class="card bg-light p-2">
                                                <h5 class="mt-0">Chung Nguyễn</h5>
                                                <div>Có 2 cách em nhé:
                                                    <br>
                                                    <ol>
                                                        <li>import nó ở đầu file php bằng: use App\Models\ProductDetails;
                                                            <br>
                                                        </li>
                                                        <li>gọi full namespace nó ra: \App\Models\ProductDetails::whereLike('name', 'name')-&gt;get();</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Comment parent -->

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

