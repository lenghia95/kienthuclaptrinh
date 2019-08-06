@extends('admins.layouts.app')

@section('content')
    @include('flash-message')

    <section class="content-header">
        <h1>
            {{ $slide->key }}
            <small>{{ config('admin.edit') }}</small>
        </h1>
        <!-- breadcrumb start -->
        <ol class="breadcrumb" style="margin-right: 30px;">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> {{ config('admin.home')}}</a></li>
            <li>
                {{ $slide->id }}
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
                                <form action="{{ route('sliders.destroy',['id'=>$slide->id]) }}" method="post" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                    @csrf
                                    <input type="hidden" class="_method" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> {{ config('admin.delete') }}</button>
                                </form>
                            </div>

                            <div class="btn-group pull-right" style="margin-right: 5px">
                                <a href="{{ route('sliders.index') }}" class="btn btn-sm btn-default" title="{{ config('admin.list') }}"><i class="fa fa-list"></i><span class="hidden-xs">&nbsp;{{ config('admin.list') }}</span></a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    
                    <form action="{{ route('sliders.update',[ 'id' => $slide->id ]) }}" method="post" class="form-horizontal" id="valiForm">
                        @csrf
                        <input type="hidden" class="_method" name="_method" value="PUT">
                        <input type="hidden" name="slider_id" value="{{ $slide->id }}"/>
                        <div class="box-body">
                            <div class="fields-group">
                                <div class="form-group">
                                    <label for="key" class="col-sm-2  control-label">{{ config('admin.key') }}</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input type="text" name="key" data-id="{{ $slide->id }}" value="{{ $slide->key }}" class="form-control title" placeholder="{{ config('admin.slide') }}" required />
                                        </div>
                                        @error('key')
                                            <label class="error">{{ $message }}</label>
                                        @enderror
                                        <label for="key" generated="true" class="error"></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="col-sm-2 text-right">Status</label>
                                    <div class="col-sm-8">
                                        <input type="checkbox" {{ ($slide->status === 1) ? 'checked' : '' }} data-toggle="toggle" data-size="xs" data-onstyle="primary" data-offstyle="warning" class="edit-status" value="{{ ($slide->status === 1) ? 1 : 0 }}">
                                        <input type="hidden" name="status" value="{{ ($slide->status === 1) ? 1 : 0 }}">
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
    @include('admins.sliders.validate')
    <script>

    </script>
@endpush
