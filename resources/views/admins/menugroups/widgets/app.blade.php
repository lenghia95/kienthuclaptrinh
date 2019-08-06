@extends('admins.layouts.app')

@section('content')
    <section class="content-header">
        <!-- succeeded -->
       @include('flash-message')
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
                    <!-- /.box-header -->
                    <div class="row">
                        <div class="col-md-4">
                            @yield('menugroup')
                        </div>

                        <div class="col-md-8">
                            <div class="box-body">
                                <table id="example" class="table table-hover table-striped table-bordered">
                                    <thead>
                                    <tr class="_table_title">
                                        <th> </th>
                                        <th>ID
                                            <a class="fa fa-fw fa-sort" href=""></a>
                                        </th>
                                        <th>{{ config('admin.name') }}</th>
                                        <th>{{ config('admin.key') }}</th>
                                        <th>{{ config('admin.status') }}</th>
                                        <th>{{ config('admin.action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($menuGroups as $menuGroup)
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="minimal">
                                            </td>
                                            <td>{{ $menuGroup->id }}</td>
                                            <td>{{ $menuGroup->name }}</td>
                                            <td>{{ $menuGroup->key }}</td>
                                            <td align="center">
                                                <input type="checkbox" {{ ($menuGroup->status === 1) ? 'checked' : '' }} data-toggle="toggle" data-size="xs" data-onstyle="primary" data-offstyle="warning" class="grid-switch-status" data-key="{{ $menuGroup->id }}" value="{{ ($menuGroup->status === 1) ? 1 : 0 }}">
                                            </td>
                                            <td align="center">
                                                <a href="{{ route('menugroups.edit',['id' => $menuGroup->id]) }}" data-toggle="modal"><i class="fa fa-edit"></i></a>
                                                <a href="#" data-id="{{ $menuGroup->id }}" class="grid-row-delete">
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
        </div>
    </section>
@stop
@push('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#valiForm").validate({
                rules: {
                    key: {
                        remote: {
                            url: "{{ url('/admin/ajax/unique_key') }}",
                            type: "get",
                            data: {
                                key: function () {
                                    return $("input[name='key']").val();
                                },
                                id: function () {
                                    return $("input[name='key']").attr('data-id');
                                },
                            },
                            dataFilter: function (data) {
                                var json = JSON.parse(data);
                                if (json.msg == "true") {
                                    return "\"" + "This value exists in database." + "\"";
                                } else {
                                    return 'true';
                                }
                            }
                        },
                    },
                },
            });
            
            //ajax delete
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
                            url: "{{ url('/admin/ajax/menugroup_del')  }}/"+ id,
                            data: {
                                _method: 'DELETE',
                                _token: "{{ csrf_token() }}",
                            },
                            success: function(data) {
                                window.location.href="/admin/menugroups"
                            }
                        });
                        swal("Bạn đã xó thành công!", {
                            buttons: false,
                            timer: 1000,
                            icon: "success"
                        });
                    }
                });
            });


            // $('#_name').on('blur', function(){
            //     var name = $(this).val();
            //     $('#_slug').val(convertSlug(name));
            // });

            // ajax status
            $('.grid-switch-status').on('change',function(){
                var id = $(this).data('key');
                $.ajax({
                    url: "{{ url('/admin/ajax/status_menugroup')  }}/" + id,
                    type: "POST",
                    data: {
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
