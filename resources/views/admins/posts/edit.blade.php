@extends('admins.layouts.app')

@section('content')
    @include('flash-message')

    <section class="content-header">
        <h1>
            {{ str_limit($post->title,60) }}
            <small>{{ config('admin.edit') }}</small>
        </h1>
        <!-- breadcrumb start -->
        <ol class="breadcrumb" style="margin-right: 30px;">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> {{ config('admin.home')}}</a></li>
            <li>
                {{ $post->id }}
            </li>
            <li>
                {{ config('admin.edit') }}
            </li>
           
        </ol>

        <!-- breadcrumb end -->

    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ config('admin.edit') }}</h3>
                        <div class="box-tools">
                            <div class="btn-group pull-right" style="margin-right: 5px">
                                <form action="{{ route('listposts.destroy',[ $post->id ]) }}" method="post" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                    @csrf
                                    <input type="hidden" class="_method" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> {{ config('admin.delete') }}</button>
                                </form>
                            </div>

                            <div class="btn-group pull-right" style="margin-right: 5px">
                                <a href="{{ route('listposts.index') }}" class="btn btn-sm btn-default" title="{{ config('admin.list') }}"><i class="fa fa-list"></i><span class="hidden-xs">&nbsp;{{ config('admin.list') }}</span></a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="modal-body">
                        <div class="row box-body">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-bars"></i> Basic Field</a></li>
                                    <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-clock-o"></i> Seo meta</a></li>
                                </ul>
                                <form action="{{ route('listposts.update',[$post->id]) }}" method="POST" enctype="multipart/form-data" id="valiForm">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="post_slug" value="{{ $post->id }}" >
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label for="title" class="control-label">{{ config('admin.title') }}*</label>
                                                    <label for="title" generated="true" class="error"></label>
                                                    <input type="text" name="title" value="{{ $post->title }}" maxlength="255" class="form-control title" placeholder="{{ config('admin.title') }}" required>
                                                </div>
                                                    
                                                <div class="form-group">
                                                    <label for="slug" class="control-label">{{ config('admin.slug') }}*</label>
                                                    <label for="slug" generated="true" class="error"></label>
                                                    <input type="text" name="slug" data-id="{{ $post->id }}" value="{{ $post->slug }}" maxlength="255" class="form-control slug" placeholder="{{ config('admin.slug') }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Categories*</label>
                                                    <select class="form-control category" style="width: 100%;" name="category[]" multiple="multiple" data-placeholder="Categories" required >
                                                    {!! $categories !!}
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="status" class="control-label">{{ config('admin.status') }}:</label>
                                                    <input type="checkbox" {{ ($post->status === 1) ? 'checked' : '' }} name="status" data-toggle="toggle" data-size="xs" data-onstyle="primary" data-offstyle="warning" class="edit-status" value="{{ ($post->status === 1) ? 1 : 0 }}">
                                                    {{-- <input type="hidden" c value="{{ ($post->status === 1) ? 1 : 0 }}"> --}}
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="thumbnail" class="control-label">{{ config('admin.image') }}</label>
                                                    @error('thumbnail')
                                                        <label class="error">{{ $message }}</label>
                                                    @enderror
                                                    <input type="file" class="avatar" name="thumbnail" data-initial-preview="{{ asset($post->thumbnail) }}" data-initial-caption="{{ $post->thumbnail }}"/>
                                                </div>

                                                <div class="form-group">
                                                    <label for="description" class="control-label">{{ config('admin.description') }}</label>
                                                    <textarea class="form-control" name="description" col="3" placeholder="Input {{ config('admin.description') }}">{{ $post->description }}</textarea>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="content" class="control-label">{{ config('admin.content') }}</label>
                                                    <textarea class="form-control" id="_content" name="content" placeholder="Input {{ config('admin.content') }}">{{ $post->content }}</textarea>
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="tab_2">
                                            <div class="col-sm-12">
                                                <label for="seo_title" class="control-label">seo_title</label>
                                                <div class="input-group mb-10">
                                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                                    <input type="text" name="seo_title" value="{{ $post->seo_title }}" class="form-control seo_title" placeholder="tiêu đề seo">
                                                </div>
                                                <span class="help-block">
                                                    <i class="fa fa-info-circle"></i>&nbsp;sử dụng a-z and 0-9.
                                                </span>
                                            </div>
                                            <div class="col-sm-12">
                                                <label for="seo_description" class="control-label">Seo description</label>
                                                <div class="input-group mb-10">
                                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                                    <input type="text" name="seo_description" value="{{ $post->seo_description }}" class="form-control seo_description" placeholder="seo {{ config('admin.description') }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <label for="seo_keywords" class="control-label">Seo keywords</label>
                                                <div class="input-group mb-10">
                                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                                    <input type="text" name="seo_keywords" value="{{ $post->seo_keywords }}" class="form-control seo_keywords" placeholder="seo keywords">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- /.box-body -->
                                        <div class="box-footer">
                                            <div class="col-md-12">
                                                <div class="btn-group pull-right">
                                                    <button type="submit" class="btn btn-primary">{{ config('admin.submit') }}</button>
                                                </div>
                                                <div class="btn-group pull-left">
                                                    <button type="reset" class="btn btn-warning">{{ config('admin.reset') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-footer -->
                                    </div>
                                </form>
                                <!-- /.tab-content -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    
@stop
@push('script')
    @include('admins.posts.validate')
    
@endpush
