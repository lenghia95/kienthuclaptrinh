@extends('admins.layouts.app')

@section('content')

@include('flash-message')

<section class="content-header">
    <h1>
        {{ $title }}
        <small>{{ config('admin.list')}}</small>
        
    </h1>
    <!-- breadcrumb start -->
    <ol class="breadcrumb" style="margin-right: 30px;">
        <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> {{ config('admin.home')}}</a></li>
        <li>Auth</li>
        <li>{{ $title }}</li>
    </ol>
    <!-- breadcrumb end -->
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="pull-right">
                        <div class="btn-group pull-right" style="margin-right: 10px">
                            <a class="btn btn-sm btn-twitter" title="Export"><i class="fa fa-download"></i><span class="hidden-xs"> {{ config('admin.export')}}</span></a>
                            <button type="button" class="btn btn-sm btn-twitter dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="" target="_blank">All</a></li>
                                <li><a href="" target="_blank">Current page</a></li>
                                <li><a href="" target="_blank" class="export-selected">Selected rows</a></li>
                            </ul>
                        </div>

                        <div class="btn-group pull-right" style="margin-right: 10px">
                            <a href="" class="btn btn-sm btn-success" title="New" data-toggle="modal" data-target="#flipFlop">
                                <i class="fa fa-save"></i><span class="hidden-xs">&nbsp;&nbsp;{{ config('admin.new')}}</span>
                            </a>
                        </div>

                    </div>
                    <span>
                    <a class="btn btn-sm btn-primary grid-refresh" title="Refresh"><i class="fa fa-refresh"></i> <span class="hidden-xs">{{ config('admin.refresh')}}</span></a>
                        <div class="btn-group" style="margin-right: 10px" data-toggle="buttons">
                            <label class="btn btn-sm btn-dropbox filter-btn " title="Filter">
                                <input type="checkbox"><i class="fa fa-filter"></i><span class="hidden-xs">&nbsp;&nbsp;{{ config('admin.filter')}}</span>
                            </label>
                        </div>
                    </span>
                </div>
                <div class="box-header with-border hide" id="filter-box">
                    <form action="" class="form-horizontal" pjax-container="" method="get">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <div class="fields-group">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"> ID</label>
                                            <div class="col-sm-8">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-pencil"></i>
                                                    </div>
                                                    <input type="text" class="form-control id" placeholder="ID" name="id" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        <div class="btn-group pull-left">
                                            <button class="btn btn-info submit btn-sm"><i class="fa fa-search"></i>&nbsp;&nbsp;{{ config('admin.search')}}</button>
                                        </div>
                                        <div class="btn-group pull-left " style="margin-left: 10px;">
                                            <a href="" class="btn btn-default btn-sm"><i class="fa fa-undo"></i>&nbsp;&nbsp;{{ config('admin.reset')}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example" class="table table-hover table-striped table-bordered">
                        <thead>
                        <tr class="_table_title">
                            <th> </th>
                            <th>ID
                                <a class="fa fa-fw fa-sort" href=""></a>
                            </th>
                            <th>{{ config('admin.email') }}</th>
                            <th>{{ config('admin.name') }}</th>
                            {{-- <th>{{ config('admin.role') }}</th> --}}
                            <th>{{ config('admin.image') }}</th>
                            <th>{{ config('admin.status') }}</th>
                            <th>{{ config('admin.created_at') }}</th>
                            <th>{{ config('admin.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    <input type="checkbox" class="minimal" >
                                </td>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->fullname }}</td>
                                {{-- <td>

                                    @if($roles = App\Models\Role::whereIn('id', json_decode($user->role_id))->get())
                                        @foreach($roles as $role)
                                            <span class="label label-success mr-5">
                                                {{ $role->name }}
                                            </span>
                                        @endforeach
                                    @else @endif
                                </td> --}}
                                @if($user->avatar)
                                    <td align="center">
                                        <img src="{{ asset( $user->avatar )  }}" alt="" class="img-thumbnail" width="50" height="50"/>
                                    </td>
                                @else
                                    <td align="center"><strong>Chưa cập nhật</strong></td>
                                @endif
                                <td>
                                    <span data-key="{{ $user->id }}" data-status="{{ $user->status }}" class="_status status-user label label-{{ ($user->status == 1) ? 'success' : 'warning' }}"> {{ ($user->status == 1) ? 'Đã duyệt' : 'Chưa duyệt' }} </span>
                                </td>
                                <td>{{ date('d/m/Y', strtotime($user->created_at) ) }}</td>
                                <td>
                                    {{--<a href=""><i class="fa fa-eye"></i></a>--}}
                                    <a href="{{ route('users.edit',['id' => $user->id]) }}"><i class="fa fa-edit"></i></a>
                                    <a href="javascript:void(0)" data-id="{{ $user->id }}" class="grid-row-delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Add modal -->
                <div class="modal fade" id="flipFlop" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title" id="modalLabel">Add User</h4>
                            </div>
                            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" id="valiForm">
                                @csrf
                                <div class="modal-body">
                                    <div class="fields-group row">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label for="username" class="control-label">{{ config('admin.name') }}*</label>
                                                <label for="username" generated="true" class="error"></label>
                                                <div class="input-group mb-10">
                                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                                    <input type="text" name="username" value="" class="form-control username" placeholder="{{ config('admin.username') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label for="name" class="control-label">{{ config('admin.email') }}*</label>
                                                <label for="email" generated="true" class="error"></label>
                                                <div class="input-group mb-10">
                                                    <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                                                    <input type="text"  name="email" value="" class="form-control name" placeholder="{{ config('admin.email') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label for="name" class="control-label">{{ config('admin.password') }}*</label>
                                                <label for="password" generated="true" class="error"></label>
                                                <div class="input-group mb-10">
                                                    <span class="input-group-addon"><i class="fa fa-eye-slash fa-fw"></i></span>
                                                    <input type="password" id="password" name="password" value="" class="form-control name" placeholder="{{ config('admin.password') }}">
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

                                        {{--<div class="form-group">
                                            <div class="col-sm-12">
                                                <label for="name" class="control-label">{{ config('admin.role') }}*</label>
                                                <label for="roles" generated="true" class="error"></label>
                                                <select class="form-control roles" style="width: 100%;" name="roles[]" multiple="multiple" data-placeholder="{{ config('admin.role') }}" data-value="">
                                                    @foreach(App\Models\Role::get() as $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>--}}
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label for="name" class="control-label">{{ config('admin.fullname') }}</label>
                                                <div class="input-group mb-10">
                                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                                    <input type="text" name="fullname" value="" class="form-control name" placeholder="{{ config('admin.fullname') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12 mb-10">
                                                <label for="status" class="control-label">{{ config('admin.status') }}:</label>
                                                <input type="checkbox" name="status" checked data-toggle="toggle" data-size="xs" data-onstyle="primary" data-offstyle="warning" class="edit-status" value="1">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label for="avatar" class="control-label">{{ config('admin.image') }}</label>
                                                <input type="file" class="avatar" name="avatar" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">{{ config('admin.submit') }}</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
@push('script')
    @include('admins.users.validate')
    <script>
        $(document).ready(function() {
            // ajax delete
            $('.grid-row-delete').unbind('click').click(function() {
                var id = $(this).data('id');
                swal({
                    title: "Bạn có chắc chắn muốn xóa ?",
                    icon:'error',
                    dangerMode: true,
                    buttons: ["Đóng", "Xác nhận"],

                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            method: 'POST',
                            url: "{{ url('/admin/ajax/user_del')  }}/"+ id,
                            data: {
                                _method: 'DELETE',
                                _token: "{{ csrf_token() }}",
                            },
                            success: function(data) {
                                if(data == 'true'){
                                    swal("Bạn đã xó thành công!", {
                                        buttons: false,
                                        timer: 1000,
                                        icon: "success"
                                    });
                                    location.reload();
                                }else{
                                    swal("User không tồn tại!", {
                                        buttons: false,
                                        timer: 1000,
                                        icon: "error"
                                    });
                                }

                            }
                        });


                    }
                });

            });

            // // ajax status
            $(document).on('click', '.status-user', function(){
                var id = $(this).data('key');
                var status = $(this).attr('data-status');
                if(status == 1){
                    $(this).removeClass('label-success').addClass('label-warning');
                    $(this).text('Chưa duyệt');
                    $(this).attr('data-status', 0)
                }
                else if(status == 0){
                    $(this).text('Đã duyệt');
                    $(this).removeClass('label-warning').addClass('label-success');
                    $(this).attr('data-status', 1)
                }
                
                $.ajax({
                    url: "{{ url('/admin/ajax/user_status')  }}/" + id,
                    type: "POST",
                    data: {
                        "status": status,
                        _token: "{{ csrf_token() }}",
                        _method: 'PUT'
                    },
                    success: function (data) {
                        toastr.success(data);
                    }
                });
            });
        });
    </script>
@endpush
