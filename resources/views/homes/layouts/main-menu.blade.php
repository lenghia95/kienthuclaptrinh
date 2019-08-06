<nav class="navbar navbar-expand-sm bg-primary navbar-dark sticky-top" id="main_navbar">
    <div class="container pl-0">
        <a class="navbar-brand" href="{{ url('/') }}"><i class="fa fa-home"></i></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse shows" id="navbarSupportedContent" >
            <ul class="navbar-nav mr-auto navbar-menu">
                @foreach( App\Models\Category::getCategories() as $category)
                    <li class="nav-item main-menu">
                        <a class="nav-link nav-main" href="{{ url('category/'.$category->slug) }}">{{ $category->name }}</a>
                    </li>
                @endforeach

                {{-- <li class="nav-item dropdown main-menu">
                    <a class="nav-link dropdown-toggle nav-main" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Lập trình
                    </a>
                    <div class="dropdown-menu menu-dropdown container" aria-labelledby="navbarDropdown">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-lg-3 col-xl-3">
                                <a href="" class="pl-2">
                                    <span class="text-uppercase text-body">Lập trình php</span>
                                </a>
                                <hr class="m-1">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#"> <i class="fa fa-angle-double-right"></i> Kiến thức WordPress</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><i class="fa fa-angle-double-right"></i> Kiến thức PHP</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><i class="fa fa-angle-double-right"></i> Kiến thức Laravel</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.col-md-4  -->
                            <div class="col-md-3 col-sm-6 col-lg-3 col-xl-3">
                                <a href="" class="nav-main pl-2">
                                    <span class="text-uppercase text-body">Lập trình php</span>
                                </a>
                                <hr class="m-1">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#"> <i class="fa fa-angle-double-right"></i> Kiến thức WordPress</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><i class="fa fa-angle-double-right"></i> Kiến thức PHP</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><i class="fa fa-angle-double-right"></i> Kiến thức Laravel</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-md-3 col-sm-6 col-lg-3 col-xl-3">
                                <a href="" class="nav-main pl-2">
                                    <span class="text-uppercase text-body">Lập trình php</span>
                                </a>
                                <hr class="m-1">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#"> <i class="fa fa-angle-double-right"></i> Kiến thức WordPress</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><i class="fa fa-angle-double-right"></i> Kiến thức PHP</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><i class="fa fa-angle-double-right"></i> Kiến thức Laravel</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.col-md-4  -->
                            <div class="col-md-3 col-sm-6 col-lg-3 col-xl-3">
                                <a href="" class="nav-main pl-2">
                                    <span class="text-uppercase text-body">Lập trình php</span>
                                </a>
                                <hr class="m-1">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#"> <i class="fa fa-angle-double-right"></i> Kiến thức WordPress</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><i class="fa fa-angle-double-right"></i> Kiến thức PHP</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><i class="fa fa-angle-double-right"></i> Kiến thức Laravel</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.col-md-4  -->
                        </div>
                    </div>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu flex-column" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="#"><i class="fa fa-angle-double-right"></i> Action</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#"><i class="fa fa-angle-double-right"></i> Another action</a>
                        </li>
                        <li><a class="dropdown-item" href="#"><i class="fa fa-angle-double-right"></i> Something else here</a></li>
                </li>
                <li class="nav-item dropdown">
                    <a class="dropdown-item dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-angle-double-right"></i> Dropdown
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                </li>

                <li class="nav-item dropdown">
                    <a class="dropdown-item dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                </li>
                </ul>
                </li>
                </ul>
                </li>
                </ul>
                </li> --}}

            </ul>
           
        </div>
    </div>
</nav>

{{-- <nav class="navbar navbar-expand-lg navbar-light bg-light" id="main_navbar">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
            
        </div>
    </nav> --}}

<div class="container">
    <div class="row small-row">
        <div class="col-md-12 p-0 mt-4">
            <form action="{{ url('/') }}" method="get">
                <div class="input-group mb-3">
                    <input type="search"  name="s" placeholder="Gõ từ khóa và Enter...!">
                    <input type="submit" class="d-none" />
                </div>
            </form>
        </div>
    </div>
</div>
