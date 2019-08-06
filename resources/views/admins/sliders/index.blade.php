@extends('admins.layouts.app')

@section('content')

    @include('flash-message')
    <style>
        th,td{
            text-align: center;
        }
    </style>
<section class="content-header">
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
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="pull-right">
                        <a href="" class="btn btn-success" data-toggle="modal" data-target="#flipFlop"> <i class="fa fa-save"></i> {{ config('admin.new') }}</a>
                    </div>
                    <!-- The modal -->
                    <div class="modal fade" id="flipFlop" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" >
                        <div class="modal-dialog" role="document" >
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="modal-title" id="modalLabel">Add Sliders</h4>
                                </div>
                                <form action="{{ route('sliders.store') }}" method="POST" id="valiForm">
                                    @csrf
                                    <div class="box-body">
                                        <div class="fields-group">
                                            <div class="col-sm-12">
                                                <label for="key" class="control-label">{{ config('admin.key') }}*</label>
                                                <label for="key" generated="true" class="error"></label>
                                                <div class="input-group mb-10">
                                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                                    <input type="text" name="key" value="{{ old('key') }}" maxlength="255" class="form-control key" placeholder="{{ config('admin.key') }}" required>
                                                </div>
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
                </div>

                <!-- /.box-header -->

                <div class="box-body">
                    <table id="example" class="table table-hover table-striped table-bordered">
                        <thead>
                        <tr class="_table_title">
                            <th> </th>
                            <th>ID
                                <a class="fa fa-fw fa-sort" href=""></a>
                            </th>
                            <th>{{ config('admin.key') }}</th>
                            <th>{{ config('admin.status') }}</th>
                            <th>{{ config('admin.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sliders as $slider)
                            <tr>
                                <td>
                                    <input type="checkbox" class="minimal">

                                </td>
                                <td>{{ $slider->id }}</td>
                                <td>{{ $slider->key }}</td>
                                <td>
                                    <input type="checkbox" {{ ($slider->status === 1) ? 'checked' : '' }} data-toggle="toggle" data-size="xs" data-onstyle="primary" data-offstyle="warning" class="grid-switch-status" data-key="{{ $slider->id }}" value="{{ ($slider->status === 1) ? 1 : 0 }}">
                                </td>
                                <td align="center">
                                    <a href="{{ route('sliders.edit',[ 'id' => $slider->id ]) }}"><i class="fa fa-edit"></i></a>
                                    <a href="javascript:void(0);" data-id="{{ $slider->id }}" class="grid-row-delete"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
@push('script')
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
                            url: "{{ url('/admin/ajax/slider_del')  }}/"+ id,
                            data: {
                                _method: 'PUT',
                                _token: "{{ csrf_token() }}",
                            },
                            success: function(data) {
                                location.reload();
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

            // ajax status
            $(document).on('change', '.grid-switch-status', function(){
                var id = $(this).data('key');
                $.ajax({
                    url: "{{ url('/admin/ajax/slider_status')  }}/" + id,
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
    @include('admins.sliders.validate')
@endpush
