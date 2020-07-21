<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ ( isset($pagetitle) ) ? $pagetitle : 'Lỗi - Page 404' }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    @include('homes.layouts.link')
</head>
<body>
<!-- header -->
<header>
    @include('homes.layouts.menu-top')
</header>
<!-- header -->

<!-- main menu -->
    @include('homes.layouts.main-menu')
<!-- main menu -->

<!-- content -->
<div class="container p-0 wrapper">

    <div class="row small-row">

        @yield('content')

    </div>
    
</div>

<!-- content -->

<!-- Footer -->
    @include('homes.layouts.footer')
<!-- Footer -->
   @include('homes.layouts.script')

</body>
</html>
