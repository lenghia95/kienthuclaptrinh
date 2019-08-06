@extends('admins.layouts.app')
{{-- @push('link')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
@endpush --}}
@section('content')
    <section class="content-header">
        <h1>
            404 Error Page
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">404 error</li>
        </ol>
    </section>

    <section class="content">
        <div class="error-page">
            <h2 class="headline text-yellow"> 404</h2>
    
            <div class="error-content">
                <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
    
                <p>
                    We could not find the page you were looking for. Meanwhile, you may <a href="{{ url('/admin') }}">return to dashboard</a> or try using the search form.
                </p>
    
                <form action="javascript:void(0)">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search">
    
                        <div class="input-group-btn">
                            <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.input-group -->
                </form>
            </div>
            <!-- /.error-content -->
        </div>
        <!-- /.error-page -->
    </section>
@stop

