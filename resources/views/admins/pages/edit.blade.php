@extends('admins.layouts.app')

@section('content')
    @include('flash-message')

    <section class="content-header">
        <h1>
            {{ $page->title }}
            <small>{{ config('admin.edit') }}</small>
        </h1>
        <!-- breadcrumb start -->
        <ol class="breadcrumb" style="margin-right: 30px;">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> {{ config('admin.home')}}</a></li>
            <li>
                {{ $page->title }}
            </li>
            <li>
                {{ $page->id }}
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
                                <form action="{{ route('pages.destroy',['id'=>$page->id]) }}" method="post" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                    @csrf
                                    <input type="hidden" class="_method" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> {{ config('admin.delete') }}</button>
                                </form>
                            </div>

                            <div class="btn-group pull-right" style="margin-right: 5px">
                                <a href="{{ route('pages.index') }}" class="btn btn-sm btn-default" title="{{ config('admin.list') }}"><i class="fa fa-list"></i><span class="hidden-xs">&nbsp;{{ config('admin.list') }}</span></a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    @if ($errors->any())
                        <div style="color:red; font-style: italic" class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <span>{{ $error }}</span><br>
                            @endforeach
                        </div>
                    @endif
                    <form action="{{ route('pages.update',['id'=>$page->id]) }}" method="post" class="form-horizontal" id="valiForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" class="_method" name="_method" value="PUT">
                        <div class="box-body">
                            <div class="fields-group">
                                <div class="form-group  ">
                                    <label for="title" class="col-sm-2  control-label">{{ config('admin.title') }}</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input type="text" name="title" value="{{ $page->title }}" class="form-control title" placeholder="{{ config('admin.username') }}" required />
                                        </div>
                                        <label for="title" generated="true" class="error"></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="slug" class="col-sm-2  control-label">{{ config('admin.slug') }}</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input type="text" name="slug" value="{{ $page->slug }}" class="form-control" placeholder="{{ config('admin.slug') }}" required />
                                        </div>
                                        <label for="email" generated="true" class="error"></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="content" class="col-sm-2  control-label">Nội dung</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control " id="content" name="content" placeholder="Nhập nội dung">{!! $page->content !!} </textarea>
                                        <label for="content" generated="true" class="error"></label>
                                    </div>
                                </div>
                                <div class="form-group  ">
                                    <label for="seo_title" class="col-sm-2  control-label">Seo_title</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input type="text"  name="seo_title" value="{{ $page->seo_title }}" class="form-control name" placeholder="seo title">
                                        </div>
                                        <span class="help-block">
                                            <i class="fa fa-info-circle"></i>&nbsp;sử dụng a-z and 0-9.
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group  ">
                                    <label for="seo_description" class="col-sm-2  control-label">seo_description</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input type="text"  name="seo_description" value="{{ $page->seo_description }}" class="form-control" placeholder="seo description">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group  ">
                                    <label for="seo_keywords" class="col-sm-2  control-label">seo_keywords</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input type="text"  name="seo_keywords" value="{{ $page->seo_keywords }}" class="form-control" placeholder="seo keywords">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-8">
                                <div class="btn-group pull-right">
                                    <button type="submit" class="btn btn-primary">{{ config('admin.submit') }}</button>
                                </div>
                                <div class="btn-group pull-left">
                                    <button type="reset" class="btn btn-warning">{{ config('admin.reset') }}</button>
                                </div>
                            </div>
                        </div>

                        <!-- /.box-footer -->
                    </form>
                </div>
            </div>
        </div>

    </section>
@stop
@push('script')
    
    <script type="text/javascript">
        $(document).ready(function(){
            CKEDITOR.replace( 'content' );
            $("#valiForm").validate({
                
            });
        });
    </script>
@endpush
