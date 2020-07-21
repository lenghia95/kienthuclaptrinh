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
                            @yield('roles')
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
                                        <th>Display Name</th>
                                        <th>{{ config('admin.description') }}</th>
                                        <th>{{ config('admin.created_at') }}</th>
                                        <th>{{ config('admin.action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($roles as $role)
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="minimal" >
                                            </td>
                                            <td>{{ $role->id }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>{{ $role->display_name }}</td>
                                            <td>{{ $role->description }}</td>
                                            <td>{{ date('d/m/Y', strtotime($role->created_at) ) }}</td>
                                            <td>
                                                <a href="{{ route('roles.edit',['id' => $role->id]) }}" data-toggle="modal"><i class="fa fa-edit"></i></a>
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
        </div>

    </section>
@stop
@push('script')
    <script type="text/javascript">
        $(document).ready(function(){

            //ajax delete
            $('.grid-row-delete').unbind('click').click(function() {
                var id = $(this).data('id');
                swal({
                    title: "You definitely want to delete?",
                    icon:'error',
                    dangerMode: true,
                    buttons: ["Cancel", "Yes"],

                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            method: 'POST',
                            url: "{{ url('/admin/ajax/role_del')  }}/"+ id,
                            data: {
                                _method: 'DELETE',
                                _token: "{{ csrf_token() }}",
                            },

                            success: function(data) {
                                if(data == 'true'){
                                    swal("Delete success!", {

                                        buttons: false,
                                        timer: 1000,
                                        icon: "success"
                                    });
                                    window.location.href="/admin/roles"
                                }else{
                                    swal("Sorry, You are not authorized!", {
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

            // $('#_name').on('blur', function(){
            //     var name = $(this).val();
            //     $('#_slug').val(convertSlug(name));
            // });
        });
        $(function () {

            $("#valiForm").validate({
                rules:{
                    name:    {
                        remote: {
                            url: "{{ url('/admin/ajax/role_unique_name') }}",
                            type: "get",
                            data: {
                                name: function () {
                                    return $("input[name='name']").val();
                                },
                                id: function () {
                                    return $("input[name='name']").attr('data-id');
                                }
                            },
                            dataFilter: function (data) {
                                var json = JSON.parse(data);
                                if (json.msg == "true") {
                                    return "\"" + "This value exists in database" + "\"";
                                } else {
                                    return 'true';
                                }
                            }
                        },
                    },
                }
            });
        });
    </script>
@endpush
