<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
	<ul class="nav navbar-nav">
		{{--<li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>--}}
        {{--<?php $menus = new App\Models\Admin_menu ?>--}}
        {{--{!! $menus->menuSidebar() !!}--}}
		{{--@foreach ($menuItems as $menu)--}}
			{{--@if($menu->type == "module")--}}
				{{--<?php--}}
				{{--$temp_module_obj = Module::get($menu->name);--}}
				{{--?>--}}
				{{--@la_access($temp_module_obj->id)--}}
					{{--@if(isset($module->id) && $module->name == $menu->name)--}}
						{{--<?php echo LAHelper::print_menu_topnav($menu ,true); ?>--}}
					{{--@else--}}
						{{--<?php echo LAHelper::print_menu_topnav($menu); ?>--}}
					{{--@endif--}}
				{{--@endla_access--}}
			{{--@else--}}
				{{--<?php echo LAHelper::print_menu_topnav($menu); ?>--}}
			{{--@endif--}}
		{{--@endforeach--}}
	</ul>
	@if(App\Models\Config::getByKey('sidebar_search'))
	<form class="navbar-form navbar-left" role="search">
		<div class="form-group">
			<input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
		</div>
	</form>
	@endif
</div><!-- /.navbar-collapse -->
