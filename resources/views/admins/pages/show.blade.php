@extends('admins.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ $title }}
            <small>{{ config('admin.show') }}</small>
        </h1>

        <!-- breadcrumb start -->
        <ol class="breadcrumb" style="margin-right: 30px;">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> {{ config('admin.home') }}</a></li>
            <li>
                {{ $title }}
            </li>
            <li>
                {{ $page->id }}
            </li>
        </ol>

        <!-- breadcrumb end -->

    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Pages.{{ config('admin.detail') }}</h3>
    
                                <div class="box-tools">
                                    <div class="btn-group pull-right" style="margin-right: 5px">
                                        <form action="{{ route('pages.destroy',['id'=>$page->id]) }}" method="post" onsubmit="return confirm('{{ config('admin.delete_confirm') }}')">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> {{ config('admin.delete') }}</button>
                                        </form>
                                    </div>
                                    <div class="btn-group pull-right" style="margin-right: 5px">
                                        <a href="{{ route('pages.edit',[$page->id]) }}" class="btn btn-sm btn-primary" title="Edit">
                                            <i class="fa fa-edit"></i><span class="hidden-xs"> {{ config('admin.edit') }}</span>
                                        </a>
                                    </div>
                                    <div class="btn-group pull-right" style="margin-right: 5px">
                                        <a href="{{ route('pages.index') }}" class="btn btn-sm btn-default" title="List">
                                            <i class="fa fa-list"></i><span class="hidden-xs"> {{ config('admin.list') }}</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <div class="form-horizontal">
    
                                <div class="box-body">
    
                                    <div class="fields-group">
    
                                        <div class="form-group ">
                                            <label class="col-sm-2 control-label">ID</label>
                                            <div class="col-sm-8">
                                                <div class="box box-solid box-default no-margin box-show">
                                                    <!-- /.box-header -->
                                                    <div class="box-body">
                                                        {{ $page->id }}&nbsp;
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="col-sm-2 control-label">{{ config('admin.title') }}</label>
                                            <div class="col-sm-8">
                                                <div class="box box-solid box-default no-margin box-show">
                                                    <!-- /.box-header -->
                                                    <div class="box-body">
                                                        {{ $page->title }}&nbsp;
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="col-sm-2 control-label">{{ config('admin.slug') }}</label>
                                            <div class="col-sm-8">
                                                <div class="box box-solid box-default no-margin box-show">
                                                    <!-- /.box-header -->
                                                    <div class="box-body">
                                                        {{ $page->slug }}&nbsp;
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group ">
                                            <label class="col-sm-2 control-label">{{ config('admin.content') }}</label>
                                            <div class="col-sm-8">
                                                <div class="box box-solid box-default no-margin box-show">
                                                    <!-- /.box-header -->
                                                    <div class="box-body">
                                                            {!! $page->content !!}&nbsp;
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group ">
                                            <label class="col-sm-2 control-label">Seo title</label>
                                            <div class="col-sm-8">
                                                <div class="box box-solid box-default no-margin box-show">
                                                    <!-- /.box-header -->
                                                    <div class="box-body">
                                                        {{ $page->seo_title ?? 'null'}}&nbsp;
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="col-sm-2 control-label">Seo description</label>
                                            <div class="col-sm-8">
                                                <div class="box box-solid box-default no-margin box-show">
                                                    <!-- /.box-header -->
                                                    <div class="box-body">
                                                        {{ $page->seo_description ?? 'null' }}&nbsp;
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="col-sm-2 control-label">Seo keywords</label>
                                            <div class="col-sm-8">
                                                <div class="box box-solid box-default no-margin box-show">
                                                    <!-- /.box-header -->
                                                    <div class="box-body">
                                                        {{ $page->seo_keywords ?? 'null'}}&nbsp;
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                    </div>
    
                    <div class="col-md-12">
                    </div>
                </div>
            </div>
        </div>
    
    </section>
@stop
