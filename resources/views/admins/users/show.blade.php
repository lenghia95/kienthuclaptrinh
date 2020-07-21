@extends('admins.layouts.app')
<style>
    .form-group {
        display: -webkit-box;
    }
</style>
@section('content')
    @include('flash-message')

    <section class="content-header">
        <h1>
            {{ $user->username }}
            <small>{{ config('admin.show') }}</small>
        </h1>
        <!-- breadcrumb start -->
        <ol class="breadcrumb" style="margin-right: 30px;">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> {{ config('admin.home')}}</a></li>
            <li>
                {{ $user->username }}
            </li>
            <li>
                {{ $user->id }}
            </li>
            <li>
                {{ config('admin.show') }}
            </li>
        </ol>

        <!-- breadcrumb end -->
        
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ config('admin.show') }}</h3>
                        <div class="box-tools">
                            @can('create')
                                <div class="btn-group pull-right" style="margin-right: 5px">
                                    <form action="{{ route('users.destroy',['id'=>$user->id]) }}" method="post" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                        @csrf
                                        <input type="hidden" class="_method" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> {{ config('admin.delete') }}</button>
                                    </form>
                                </div>
                                <div class="btn-group pull-right" style="margin-right: 5px">
                                    <a href="#" data-toggle="modal" data-target="#change_password" class="btn btn-sm btn-primary" title="{{ config('admin.change_password') }}">
                                        <i class="fa fa-edit"></i>
                                        <span class="hidden-xs">&nbsp;Change Pass</span>
                                    </a>
                                </div>
                            @endcan
                            <div class="btn-group pull-right" style="margin-right: 5px">
                                <a href="{{ route('users.index') }}" class="btn btn-sm btn-default" title="{{ config('admin.list') }}"><i class="fa fa-list"></i><span class="hidden-xs">&nbsp;{{ config('admin.list') }}</span></a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    
                        <div class="box-body">
                            <div class="fields-group">
                                <div class="form-group">
                                    <label for="email" class="col-sm-2  control-label text-right">{{ config('admin.email') }}:</label>
                                    <div class="col-sm-8">
                                        <div class="form-control"> {{ $user->email }}</div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-2  control-label text-right">{{ config('admin.fullname') }}:</label>
                                    <div class="col-sm-8">
                                        <div class="form-control"> {{ ( isset($user->fullname) ) ? $user->fullname : 'Chưa cập nhập' }}</div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="address" class="col-sm-2  control-label text-right">Address;</label>
                                    <div class="col-sm-8">
                                            <div class="form-control "> {{ ( isset($user->address) ) ? $user->address : 'Chưa cập nhập' }}</div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="phone" class="col-sm-2  control-label text-right">{{ config('admin.phone') }}:</label>
                                    <div class="col-sm-8">
                                       <div class="form-control"> {{ ( isset($user->phone) ) ? $user->phone : 'Chưa cập nhập' }}</div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="avatar" class="col-sm-2  control-label text-right">{{ config('admin.image') }}:</label>
                                    <div class="col-sm-8">
                                        <img width="300" src="{{ asset($user->avatar) }}" class="img-thumbnail" alt="">
                                        {{-- <input type="file" class="avatar" name="avatar" data-initial-preview="{{ asset($user->avatar) }}" data-initial-caption="{{ $user->avatar }}" /> --}}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="phone" class="col-sm-2 control-label text-right">{{ config('admin.status') }}:</label>
                                    <div class="col-sm-8">
                                        <span class="label label-{{ ($user->status == 1) ? 'success' : 'warning' }}"> {{ ($user->status == 1) ? 'Đã duyệt' : 'Chưa duyệt' }}</span>
                                    </div>
                                </div>
                                {{--<div class="form-group">
                                    <label for="roles" class="col-sm-2  control-label">{{ config('admin.roles') }}</label>
                                    <div class="col-sm-8">
                                        <select class="form-control roles" style="width: 100%;" name="roles[]" multiple="multiple" data-placeholder="{{ config('admin.roles') }}" data-value="">
                                            {!! $listRoles !!}
                                        </select>
                                    </div>
                                    <label for="roles" generated="true" class="error"></label>
                                </div>--}}
                            </div>
                        </div>
                        <!-- /.box-body -->
                   
                </div>
            </div>
        </div>
       
    </section>
@stop

