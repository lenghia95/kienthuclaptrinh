<!DOCTYPE html>
<html>

@include('admins.layouts.link')
<style type="text/css">
    .modal {
        overflow-x: hidden;
        overflow-y: auto;
    }
</style>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    @include('admins.layouts.header')
    <!-- Left side column. contains the logo and sidebar -->

    @include('admins.layouts.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" >
        
        @yield('content')

    </div>
    <!-- /.content-wrapper -->
    @include('admins.layouts.footer')

    <!-- Control Sidebar -->

        {{--@include('admins.layouts.control')--}}

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
@include('admins.layouts.script')
