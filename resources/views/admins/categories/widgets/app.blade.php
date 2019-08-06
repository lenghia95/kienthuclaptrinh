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
                            @yield('category')
                        </div>

                        <div class="col-md-8">
                            <div class="box-body">
                                <table id="example" class="table table-hover table-striped table-bordered mt-10">
                                    <thead>
                                    <tr class="_table_title">
                                        <th> </th>
                                        <th>ID
                                            <a class="fa fa-fw fa-sort" href=""></a>
                                        </th>
                                        <th>{{ config('admin.name') }}</th>
                                        <th>{{ config('admin.slug') }}</th>
                                        <th>{{ config('admin.status') }}</th>
                                        <th>{{ config('admin.sort') }}</th>
                                        <th>{{ config('admin.action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        {!! $categories !!}
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
            $("#valiMenulist").validate({
                rules: {
                    slug: {
                        remote: {
                            url: "{{ url('/admin/ajax/category_unique_slug') }}",
                            type: "get",
                            data: {
                                slug: function () {
                                    return $("input[name='slug']").val();
                                },
                                id: function () {
                                    return $("input[name='slug']").attr('data-id');
                                },
                            },
                            async:false,
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
                            url: "{{ url('/admin/ajax/categories_del')  }}/"+ id,
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
                                    window.location.href="/admin/categories"
                                }else{
                                    swal("Bạn không thể xóa!", {
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

            // ajax status
            $('.grid-switch-status').on('change',function(){
                var id = $(this).data('key');
                $.ajax({
                    url: "{{ url('/admin/ajax/status_categories')  }}/" + id,
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
