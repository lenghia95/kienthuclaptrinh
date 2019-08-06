@extends('admins.layouts.app')

@section('content')
    @include('flash-message')

    <section class="content-header">
        <h1>
            {{ $user->username }}
            <small>{{ config('admin.edit') }}</small>
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
                {{ config('admin.edit') }}
            </li>
        </ol>

        <!-- breadcrumb end -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ config('admin.edit') }}</h3>
                        <div class="box-tools">
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
                            <div class="btn-group pull-right" style="margin-right: 5px">
                                <a href="{{ route('users.index') }}" class="btn btn-sm btn-default" title="{{ config('admin.list') }}"><i class="fa fa-list"></i><span class="hidden-xs">&nbsp;{{ config('admin.list') }}</span></a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{ route('users.update',['id'=>$user->id]) }}" method="post" class="form-horizontal" id="valiForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" class="_method" name="_method" value="PUT">
                        <div class="box-body">
                            <div class="fields-group">

                                <div class="form-group  ">
                                    <label for="name" class="col-sm-2  control-label">{{ config('admin.fullname') }}</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input type="text"  name="fullname" value="{{ $user->fullname }}" class="form-control name" placeholder="{{ $user->fullname }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="address" class="col-sm-2  control-label">Address</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input type="text" name="address" value="{{ $user->address }}" class="form-control address" placeholder="Address">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="phone" class="col-sm-2  control-label">{{ config('admin.phone') }}</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input type="number" name="phone" value="{{ $user->phone }}" class="form-control phone" placeholder="{{ config('admin.phone') }}">
                                        </div>
                                        <label for="phone" generated="true" class="error"></label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="avatar" class="col-sm-2  control-label">{{ config('admin.image') }}</label>
                                    <div class="col-sm-8">
                                        <input type="file" class="avatar" name="avatar" data-initial-preview="{{ asset($user->avatar) }}" data-initial-caption="{{ $user->avatar }}" />
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

                        <div class="box-footer">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-8">
                                <div class="btn-group pull-right">
                                    <button type="submit" class="btn btn-primary">{{ config('admin.update') }}</button>
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
        <!-- The modal đổi mật khẩu-->
        <div class="modal fade" id="change_password" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="modalLabel">Đổi mật khẩu</h4>
                    </div>
                    <form action="{{ route('change_password',['id'=>$user->id]) }}" method="POST" enctype="multipart/form-data" id="changePass">
                        @csrf
                        <div class="modal-body">
                            <div class="fields-group row">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label for="name" class="control-label">Old {{ config('admin.password') }}*</label>
                                        <label for="password_old" generated="true" class="error"></label>
                                        <div class="input-group mb-10">
                                            <span class="input-group-addon"><i class="fa fa-eye-slash fa-fw"></i></span>
                                            <input type="password" name="password_old" value="" class="form-control name" placeholder="Old password" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label for="name" class="control-label">New {{ config('admin.password') }}*</label>
                                        <label for="password" generated="true" class="error"></label>
                                        <div class="input-group mb-10">
                                            <span class="input-group-addon"><i class="fa fa-eye-slash fa-fw"></i></span>
                                            <input type="password" id="password" name="password" value="" class="form-control name" placeholder="{{ config('admin.password') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label for="name" class="control-label">{{ config('admin.password_confirmation') }}*</label>
                                        <label for="repassword" generated="true" class="error"></label>
                                        <div class="input-group mb-10">
                                            <span class="input-group-addon"><i class="fa fa-eye-slash fa-fw"></i></span>
                                            <input type="password"  name="repassword" value="" class="form-control name" placeholder="{{ config('admin.password_confirmation') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">{{ config('admin.submit') }}</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ config('admin.close') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop
@push('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#changePass').validate({
                rules: {
                    password_old:{
                        required:true,
                    },
                    password: {
                        required: true,
                        minlength: 6,
                        maxlength: 32
                    },
                    repassword: {
                        equalTo: "#password",
                    }
                },
            });
        });
    </script>
    @include('admins.users.validate')
@endpush
