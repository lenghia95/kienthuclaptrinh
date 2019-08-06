@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <!-- succeeded -->
        @if(Session::has('update_succeeded'))
            <script type="text/javascript">
                $(function() {
                    toastr.success("{{config('admin.update_succeeded')}}");
                });
            </script>
        @endif
        @if(Session::has('update_failed'))
            <script type="text/javascript">
                $(function() {
                    toastr.success("{{config('admin.update_failed')}}");
                });
            </script>
    @endif
    <!-- succeeded -->
        <h1>
            {{ $title }}
            <small>{{ config('admin.list')}}</small>
        </h1>
        <!-- breadcrumb start -->
        <ol class="breadcrumb" style="margin-right: 30px;">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> {{ config('admin.home')}}</a></li>
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

                    <!-- /.box-header -->
                    <div class="row">
                        <div class="col-md-4">
                            @yield('roles')
                        </div>

                        <div class="col-md-8">
                            <table id="example" class="table table-hover table-striped table-bordered">
                                <thead>
                                <tr class="_table_title">
                                    <th> </th>
                                    <th>ID
                                        <a class="fa fa-fw fa-sort" href=""></a>
                                    </th>
                                    <th>{{ config('admin.name') }}</th>
                                    <th>{{ config('admin.slug') }}</th>
                                    <th>{{ config('admin.description') }}</th>
                                    <th>{{ config('admin.created_at') }}</th>
                                    <th>{{ config('admin.action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>
                                            <div class="icheckbox_minimal-blue" aria-checked="false" aria-disabled="false" style="position: relative;">
                                                <input type="checkbox" class="grid-row-checkbox" data-id="1" style="position: absolute; opacity: 0;">
                                            </div>
                                        </td>
                                        <td>{{ $role->id }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->slug }}</td>
                                        <td>{{ $role->description }}</td>
                                        <td>{{ date('d/m/Y', strtotime($role->created_at) ) }}</td>
                                        <td>
                                            <a href=""><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('role.edit',['id' => $role->id]) }}" data-toggle="modal"><i class="fa fa-edit"></i></a>
                                            <a href="#" data-id="{{ $role->id }}" class="grid-row-delete">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@push('script')
    <script type="text/javascript">
        $(document).ready(function(){
            {{--$("#valiForm").validate({--}}
                {{--rules: {--}}
                    {{--name: {--}}
                        {{--required: true,--}}
                        {{--minlength: 2,--}}
                        {{--maxlength: 40,--}}
                        {{--remote: {--}}
                            {{--url: "{{ url('/admin/ajax/unique_name') }}",--}}
                            {{--type: "get",--}}
                            {{--data: {--}}
                                {{--name: function () {--}}
                                    {{--var seg4 = "{{ Request::segment(4) }}";--}}
                                    {{--if(seg4 != 'edit'){--}}
                                        {{--return $("input[name='name']").val();--}}
                                    {{--}else{--}}
                                        {{--return '';--}}
                                    {{--}--}}
                                {{--}--}}
                            {{--},--}}
                            {{--dataFilter: function (data) {--}}
                                {{--var json = JSON.parse(data);--}}
                                {{--if (json.msg == "true") {--}}
                                    {{--return "\"" + "Tên đã tồn tại!" + "\"";--}}
                                {{--} else {--}}
                                    {{--return 'true';--}}
                                {{--}--}}
                            {{--}--}}
                        {{--},--}}
                    {{--},--}}
                    {{--slug: {--}}
                        {{--required: true,--}}
                    {{--},--}}
                {{--},--}}
                {{--messages: {--}}
                    {{--name: {--}}
                        {{--required:  "Vui lòng nhập tên",--}}
                        {{--minlength: "Tên không được ít hơn 2 ký tự",--}}
                        {{--maxlength: "Tên không được nhiều hơn 20 ký tự"--}}
                    {{--},--}}
                    {{--slug: {--}}
                        {{--required:  "Vui lòng nhập slug",--}}
                    {{--},--}}
                {{--}--}}
            {{--});--}}

            //ajax delete
            $('.grid-row-delete').unbind('click').click(function() {
                var id = $(this).data('id');
                swal({
                    title: "Bạn có chắc chắn muốn xóa ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Xác nhận",
                    showLoaderOnConfirm: true,
                    cancelButtonText: "Đóng",
                    preConfirm: function() {
                        return new Promise(function(resolve) {
                            $.ajax({
                                method: 'POST',
                                url: "{{ url('/admin/ajax/role_del')  }}/"+ id,
                                data: {
                                    _method: 'DELETE',
                                    _token: "{{ csrf_token() }}",
                                },
                                success: function(data) {
                                    $.pjax.reload('#pjax-container');
                                    resolve(data);
                                    toastr.success('{{config('admin.delete_succeeded')}}');
                                }
                            });
                        });
                    }
                }).then(function(result) {
                    var data = result.value;
                    if (typeof data === 'object') {
                        if (data.status) {
                            swal(data.message, '', 'Thành công');
                        } else {
                            swal(data.message, '', 'Lỗi');
                        }
                    }
                });
            });

            $('#_name').on('blur', function(){
                var name = $(this).val();
                $('#_slug').val(convertSlug(name));
            });
        });
        $(function () {

            $("#valiForm").validate({

            });
        });
    </script>
@endpush
