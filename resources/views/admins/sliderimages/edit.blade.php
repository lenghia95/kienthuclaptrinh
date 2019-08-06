@extends('admins.layouts.app')

@section('content')
    @include('flash-message')

    <section class="content-header">
        <h1>
            {{ $sliderimage->title }}
            <small>{{ config('admin.edit') }}</small>
        </h1>
        <!-- breadcrumb start -->
        <ol class="breadcrumb" style="margin-right: 30px;">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> {{ config('admin.home')}}</a></li>
            <li>
                {{ $sliderimage->title }}
            </li>
            <li>
                {{ $sliderimage->id }}
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
                                <form action="{{ route('sliderimages.destroy',['id'=>$sliderimage->id]) }}" method="post" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                    @csrf
                                    <input type="hidden" class="_method" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> {{ config('admin.delete') }}</button>
                                </form>
                            </div>

                            <div class="btn-group pull-right" style="margin-right: 5px">
                                <a href="{{ route('sliderimages.index') }}" class="btn btn-sm btn-default" title="{{ config('admin.list') }}"><i class="fa fa-list"></i><span class="hidden-xs">&nbsp;{{ config('admin.list') }}</span></a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                   
                    <form action="{{ route('sliderimages.update',['id'=>$sliderimage->id]) }}" method="post" class="form-horizontal" id="valiForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" class="_method" name="_method" value="PUT">
                        <div class="box-body">
                            <div class="fields-group">
                                
                                <label for="title" class="control-label">{{ config('admin.title') }}*</label>
                                <label for="title" generated="true" class="error"></label>
                                @error('title')
                                    <label class="error">{{ $message }}</label>
                                @enderror
                                <div class="input-group mb-10">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <input type="text" name="title" value="{{ $sliderimage->title }}" maxlength="255" class="form-control key" placeholder="{{ config('admin.title') }}" required>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="image" class="control-label">{{ config('admin.image') }}*</label>
                                        @error('image')
                                            <label class="error">{{ $message }}</label>
                                        @enderror
                                        <input type="file" class="avatar" name="image" data-initial-preview="{{ asset($sliderimage->image) }}" data-initial-caption="{{ $sliderimage->image }}"/>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="key" class="control-label">{{config('admin.key')}}*</label>
                                        @error('key')
                                            <label class="error">{{ $message }}</label>
                                        @enderror
                                        <select class="form-control parent_id select2-hidden-accessible" style="width: 100%;" name="key" data-value="" tabindex="-1" aria-hidden="true" required>
                                            @foreach ($sliders as $slider)
                                                <option value="{{ $slider->id }}" {{ ($slider->id == $sliderimage->key) ? 'selected' : ''}}>{{ $slider->key }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                
                                <label for="content" class="control-label">{{ config('admin.content') }}</label>
                                <div class="input-group mb-10">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <textarea name="content" class="form-control" rows="3" placeholder="{{ config('admin.content') }}">{{ $sliderimage->content }}</textarea>
                                </div>
                                
                                
                                <label for="html" class="control-label">Html content</label>
                                <div class="input-group mb-10">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                    <textarea name="html" class="form-control" rows="3" placeholder="html content">{{ $sliderimage->html }}</textarea>
                                </div>
                                
                                
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="col-md-12">
                                <div class="btn-group pull-right">
                                    <button type="submit" class="btn btn-primary">{{ config('admin.submit') }}</button>
                                </div>
                                <div class="btn-group pull-right" style="margin-right:10px">
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
    <script>
        $(document).ready(function () {
            $('#valiForm').validate();
        });
    </script>
@stop

