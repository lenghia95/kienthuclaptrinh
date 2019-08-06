<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        @if ( Auth::check())
            <div class="user-panel">
                <div class="pull-left image">
                    @if( !empty(Auth::user()->avatar) )
                        <img src="{{ asset(Auth::user()->avatar) }}" class="img-circle" alt="{{ Auth::user()->fullname }}" />
                    @else
                        <img src="{{ asset('uploads/users/user.png') }}" class="img-circle" alt="{{ Auth::user()->fullname }}" />
                    @endif
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->fullname }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
        @endif

        <!-- search form -->
        @if(App\Models\Config::getByKey('sidebar_search'))
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search..."/>
                    <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
                </div>
            </form>
        @endif
        
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menu</li>
            <?php $menus = new App\Models\Menu ?>
            {!! $menus->menuSidebar() !!}
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
