<div class="fakeimg p-1 mt-2">
    <div class="news-ticker" id="outer">
        <ul id ="tick">
            @foreach (App\Models\Post::getPosts() as $key => $post)
                @if ($key < 10)
              
                    <li>
                        <img width="30" height="30" src="{{ asset($post->thumbnail) }}" alt="">
                        <span class="badge badge-warning" style="color:#fff;">{{ $post->name }}</span>
                        <a href="{{ url('post/'.$post->slug) }}" >
                            {{ $post->title }}
                        </a>
                    </li>
              
                @endif
            @endforeach
        </ul>
        <h5 class="title-ticker"><i class="fa fa-hand-o-right"></i> Mới nhất</h5>
    </div>
</div>