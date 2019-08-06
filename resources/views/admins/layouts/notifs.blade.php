<div style="margin:10px;" class="btn-group">
    <button type="button" class="dropdown-toggle usa" data-toggle="dropdown">
		<img src="/backends/documents/website/language/flag_uk.png" style="height: 25px;">
		<span class="caret"></span>
	</button>
    <ul class="dropdown-menu">
        <li>
			<a href="http://shopcart.local/locale/en">
				<img src="/backends/documents/website/language/flag_uk.png" style="height: 25px;">
			</a>
        </li>
        <li>
			<a href="http://shopcart.local/locale/vi">
				<img src="/backends/documents/website/language/flag_vn.png" style="height: 25px;">
			</a>
        </li>
    </ul>
</div>
<style>
    .search-form {
        width: 250px;
        margin: 10px 0 0 20px;
        border-radius: 3px;
        float: left;
    }

    .search-form input[type="text"] {
        color: #666;
        border: 0;
    }

    .search-form .btn {
        color: #999;
        background-color: #fff;
        border: 0;
    }
</style>
        <form action="http://shopcart.local/admin/shop_order" method="get" class="search-form" pjax-container>
            <div class="input-group input-group-sm ">
                <input type="text" name="keyword" class="form-control" placeholder="Search order id, email, phone or name">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- Navbar Right Menu -->
		<div class="navbar-custom-menu">

			<ul class="nav navbar-nav">
				<!-- Messages: style can be found in dropdown.less-->
				<li class="dropdown messages-menu">
					<!-- Menu toggle button -->
					<a href="{{ url('/') }}" target="_blank" style="color: #61b4f7">
						<i class="fa fa-eye"></i> Website
					</a>
				</li>
				@if(App\Models\Config::getByKey('show_messages'))
				<li class="dropdown messages-menu">
					<!-- Menu toggle button -->
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-envelope-o"></i>
						<span class="label label-success">4</span>
					</a>
					<ul class="dropdown-menu">
						<li class="header">You have 4 messages</li>
						<li>
							<!-- inner menu: contains the messages -->
							<ul class="menu">
								<li><!-- start message -->
									<a href="#">
										<div class="pull-left">
											<!-- User Image -->
											<img src="@if(Auth::check()) {{ asset('/'.Auth::user()->avatar) }} @else {{ asset('home/images/user.png-v=582.png') }} @endif" class="img-circle" alt="User Image"/>
										</div>
										<!-- Message title and timestamp -->
										<h4>
											Support Team
											<small><i class="fa fa-clock-o"></i> 5 mins</small>
										</h4>
										<!-- The message -->
										<p>Why not buy a new awesome theme?</p>
									</a>
								</li><!-- end message -->
							</ul><!-- /.menu -->
						</li>
						<li class="footer"><a href="#">See All Messages</a></li>
					</ul>
				</li><!-- /.messages-menu -->
				@endif
				@if(App\Models\Config::getByKey('show_notifications'))
				<!-- Notifications Menu -->
				<li class="dropdown notifications-menu">
					<!-- Menu toggle button -->
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-bell-o"></i>
						<span class="label label-warning">10</span>
					</a>
					<ul class="dropdown-menu">
						<li class="header">You have 10 notifications</li>
						<li>
							<!-- Inner Menu: contains the notifications -->
							<ul class="menu">
								<li><!-- start notification -->
									<a href="#">
										<i class="fa fa-users text-aqua"></i> 5 new members joined today
									</a>
								</li><!-- end notification -->
							</ul>
						</li>
						<li class="footer"><a href="#">View all</a></li>
					</ul>
				</li>
				@endif
				@if(App\Models\Config::getByKey('show_tasks'))
				<!-- Tasks Menu -->
				<li class="dropdown tasks-menu">
					<!-- Menu Toggle Button -->
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-flag-o"></i>
						<span class="label label-danger">9</span>
					</a>
					<ul class="dropdown-menu">
						<li class="header">You have 9 tasks</li>
						<li>
							<!-- Inner menu: contains the tasks -->
							<ul class="menu">
								<li><!-- Task item -->
									<a href="#">
										<!-- Task title and progress text -->
										<h3>
											Design some buttons
											<small class="pull-right">20%</small>
										</h3>
										<!-- The progress bar -->
										<div class="progress xs">
											<!-- Change the css width attribute to simulate progress -->
											<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
												<span class="sr-only">20% Complete</span>
											</div>
										</div>
									</a>
								</li><!-- end task item -->
							</ul>
						</li>
						<li class="footer">
							<a href="#">View all tasks</a>
						</li>
					</ul>
				</li>
				@endif
				@if (!Auth::check())
					<li><a href="">{{ config('admin.login') }}</a></li>
					<li><a href="{{ url('/register') }}">Register</a></li>
				@else
					<!-- User Account Menu -->
					<li class="dropdown user user-menu">
						<!-- Menu Toggle Button -->
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<!-- The user image in the navbar-->
							<img src="{{ asset('/'. Auth::user()->avatar) }}" class="user-image" alt="User Image"/>
							<!-- hidden-xs hides the username on small devices so only the image appears. -->
							<span class="hidden-xs">{{ Auth::user()->fullname }}</span>
						</a>
						<ul class="dropdown-menu">
							<!-- The user image in the menu -->
							<li class="user-header">
								<img src="{{ asset('/'. Auth::user()->avatar) }}" class="img-circle" alt="User Image" />
								<p>
									{{ Auth::user()->fullname }}
									<?php
									$datec = Auth::user()->created_at;
									?>
									<small>Member since <?php echo date("M. Y", strtotime($datec)); ?></small>
								</p>
							</li>
							<!-- Menu Body -->
							<li class="user-body">
								{{--<div class="col-xs-6 text-center mb10">--}}
									{{--<a href="{{ url(config('laraadmin.adminRoute') . '/lacodeeditor') }}"><i class="fa fa-code"></i> <span>Editor</span></a>--}}
								{{--</div>--}}
								{{--<div class="col-xs-6 text-center mb10">--}}
									{{--<a href="{{ url(config('laraadmin.adminRoute') . '/modules') }}"><i class="fa fa-cubes"></i> <span>Modules</span></a>--}}
								{{--</div>--}}
								<div class="col-xs-6 text-center mb10">
									<a href="{{ url(config('modules.backend.prefix_url') . '/menu') }}"><i class="fa fa-bars"></i> <span>{{config('admin.menu')}}</span></a>
								</div>
								<div class="col-xs-6 text-center mb10">
									<a href="{{ url(config('modules.backend.prefix_url') . '/config') }}"><i class="fa fa-cogs"></i> <span>{{config('admin.setting')}}</span></a>
								</div>
								{{--<div class="col-xs-6 text-center">--}}
									{{--<a href="{{ url(config('laraadmin.adminRoute') . '/backups') }}"><i class="fa fa-hdd-o"></i> <span>Backups</span></a>--}}
								{{--</div>--}}
							</li>
							<!-- Menu Footer-->
							<li class="user-footer">
								<div class="pull-left">
									<a href="{{ url('admin/config')  }}" class="btn btn-default btn-flat">{{ config('admin.setting') }}</a>
								</div>
								<div class="pull-right">
									<a href="{{ route('admin.logout') }}" class="btn btn-default btn-flat">{{ config('admin.logout') }}</a>
								</div>
							</li>
						</ul>
					</li>
				@endif
				@if(App\Models\Config::getByKey('show_rightsidebar'))
				<!-- Control Sidebar Toggle Button -->
				<li>
					<a href="#" data-toggle="control-sidebar"><i class="fa fa-comments-o"></i> <span class="label label-warning">10</span></a>
				</li>
				@endif
			</ul>
		</div>
