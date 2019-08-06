<footer class="page-footer font-small unique-color-dark bg-dark">
    <!-- Footer Links -->
    <div class="container text-center text-md-left mt-5 pt-3">
        <div class="row small-row">
            <!-- Grid row -->
            <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-md-3 col-lg-3 col-xl-3 mb-4 infomation">

                    <!-- Content -->
                    <h6 class="text-uppercase font-weight-bold text-light">Về chúng tôi</h6>
                    <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block " style="width: 60px;">
                    <p class="text-light">{{ $Setting['company_about'] }}</p>

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 col-lg-3 col-xl-3 mb-4 infomation list-category">

                    <!-- Links -->
                    <h6 class="text-uppercase font-weight-bold text-light">Tin mới</h6>
                    <hr class="deep-purple accent-2 mb-2 mt-0 d-inline-block" style="width: 50px;">
                    @foreach(App\Models\Post::getPosts() as $key => $value)
                        @if($key < 3)
                        <p><a class="text-light" href="{{ url('post/'.$value->slug) }}">{{ $value->title }}</a></p>
                        @endif
                    @endforeach()

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 col-lg-3 col-xl-3 mb-4 infomation list-category">

                    <!-- Links -->
                    <h6 class="text-uppercase font-weight-bold text-light">Danh mục</h6>
                    <hr class="deep-purple accent-2 mb-2 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    @foreach(App\Models\Category::getCategories() as $key => $category)
                        @if($key < 5)
                        <p><a class="text-light" href="{{ url('category/'.$category->slug) }}"> <i class="fa fa-angle-double-right"></i> {{ $category->name }}</a></p>
                        @endif
                    @endforeach

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 col-lg-3 col-xl-3 mb-4 infomation">

                    <!-- Links -->
                    <h6 class="text-uppercase font-weight-bold text-light">Liên hệ</h6>
                    <hr class="deep-purple accent-2 mb-2 mt-0 d-inline-block " style="width: 60px;">
                    <p class="text-light">
                        <i class="fa fa-home mr-3"></i>{{ $Setting['company_address'] }}
                    </p>
                    <p class="text-light">
                        <i class="fa fa-envelope mr-3"></i>{{ $Setting['company_email'] }}
                    </p>
                    <p class="text-light">
                        <i class="fa fa-phone mr-3"></i>{{ $Setting['company_phone'] }}
                    </p>
                    <p class="text-light">
                        <i class="fa fa-print mr-3"></i>{{ $Setting['company_hotline'] }}
                    </p>
                    <p class="text-light">
                        <a href="{{ $Setting['facebook'] }}" class="facebook"><i class="fa fa-facebook-official"></i></a>
                        <a href="{{ $Setting['youtube'] }}" class="youtube"><i class="fa fa-youtube"></i></a>
                        <a href="{{ $Setting['googleplus'] }}" class="google-plus"><i class="fa fa-google-plus"></i></a>
                    </p>

                </div>
                <!-- Grid column -->

            </div>
            <!-- Grid row -->

        </div>
        <!-- Footer Links -->
    </div>
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">
        <span class="text-light">{{ $Setting['copyright'] }}</span>
        {{--<a href=""> MDBootstrap.com</a>--}}
    </div>
    <!-- Copyright -->

</footer>
