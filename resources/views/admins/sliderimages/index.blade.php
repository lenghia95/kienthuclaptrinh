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
        <li>{{ $title }}</li>
    </ol>
    <!-- breadcrumb end -->
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
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
                                    <h4 class="modal-title" id="modalLabel">Add Sliders Image</h4>
                                </div>
                                <form action="{{ route('sliderimages.store') }}" method="POST" id="valiForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="box-body">
                                        <div class="fields-group">
                                            <div class="col-sm-12">
                                                <label for="title" class="control-label">{{ config('admin.title') }}*</label>
                                                <label for="title" generated="true" class="error"></label>
                                                @error('title')
                                                    <label class="error">{{ $message }}</label>
                                                @enderror
                                                <div class="input-group mb-10">
                                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                                    <input type="text" name="title" value="{{ old('title') }}" maxlength="255" class="form-control key" placeholder="{{ config('admin.title') }}" required>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">

                                                <div class="form-group">
                                                    <label for="image" class="control-label">{{ config('admin.image') }}*</label>
                                                    @error('image')
                                                        <label class="error">{{ $message }}</label>
                                                    @enderror
                                                    <input type="file" class="avatar" name="image"/>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <!-- /.form-group -->
                                                <div class="form-group">
                                                    <label for="key" class="control-label">{{config('admin.key')}}*</label>
                                                    @error('key')
                                                        <label class="error">{{ $message }}</label>
                                                    @enderror
                                                    <select class="form-control parent_id select2-hidden-accessible" style="width: 100%;" name="key" data-value="" tabindex="-1" aria-hidden="true" required>
                                                        @foreach ($sliders as $slider)
                                                            <option value="{{ $slider->id }}">{{ $slider->key }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-sm-12">
                                                <label for="content" class="control-label">{{ config('admin.content') }}*</label>
                                                <div class="input-group mb-10">
                                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                                    <textarea name="content" class="form-control" rows="3" placeholder="{{ config('admin.content') }}"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <label for="html" class="control-label">Html content</label>
                                                <div class="input-group mb-10">
                                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                                    <textarea name="html" class="form-control" rows="3" placeholder="html content"></textarea>
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
                    <!-- The modal -->

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
                            <th>{{ config('admin.title') }}</th>
                            <th>{{ config('admin.image') }}</th>
                            <th>{{ config('admin.key') }}</th>
                            <th>{{ config('admin.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sliderimages as $slider)
                            <tr>
                                <td>
                                    <input type="checkbox" class="minimal">
                                </td>
                                <td>{{ $slider->id }}</td>
                                <td>{{ $slider->title }}</td>
                                <td align="center">
                                    <img width="300" class="img-thumbnail" src="{{ asset($slider->image) }}" alt="">
                                </td>
                                <td>
                                    <?php $slide = new App\Models\Slider; ?>
                                    <a>{{ $slide->getItem($slider->key)->key }}</a>
                                </td>
                                <td align="center">
                                    <a href="{{ route('sliderimages.edit',[ 'id' => $slider->id ]) }}"><i class="fa fa-edit"></i></a>
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
                            url: "{{ url('/admin/ajax/sliderimages_del')  }}/"+ id,
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

            $('#valiForm').validate();
            
        });
    </script>
    
@endpush
