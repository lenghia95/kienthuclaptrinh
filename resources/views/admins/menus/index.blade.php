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
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <div class="btn-group">
                            <a class="btn btn-primary btn-sm tree-5ca088fec367f-tree-tools" data-action="expand" title="Expand">
                                <i class="fa fa-plus-square-o"></i>&nbsp;Expand
                            </a>
                            <a class="btn btn-primary btn-sm tree-5ca088fec367f-tree-tools" data-action="collapse" title="Collapse">
                                <i class="fa fa-minus-square-o"></i>&nbsp;Collapse
                            </a>
                        </div>
                        <div class="btn-group">
                            <a class="btn btn-info btn-sm tree-5ca088fec367f-save" title="Save"><i class="fa fa-save"></i><span class="hidden-xs">&nbsp;{{ config('admin.save') }}</span></a>
                        </div>
                        <div class="btn-group">
                            <a class="btn btn-warning btn-sm tree-5ca088fec367f-refresh" title="Refresh"><i class="fa fa-refresh"></i><span class="hidden-xs">&nbsp;{{ config('admin.refresh') }}</span></a>
                        </div>
                        <div class="btn-group">

                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <div class="dd" id="tree-5ca088fec367f">
                            <ol class="dd-list">
                                <?php $listMenus = new App\Models\Menu; ?>
                                {!! $listMenus->listMenus() !!}
                            </ol>
                        </div>
                    </div>
                    <!-- /.box-body -->

                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ config('admin.new') }}</h3>
                        <div class="box-tools pull-right">
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="display: block;">
                        <form method="POST" action="{{ route('menus.store') }}" class="form-horizontal" id="valiMenu">
                            @csrf
                            <div class="box-body fields-group">
                                <div class="form-group">
                                    <label for="parent_id" class="col-sm-3  control-label">{{config('admin.parent_id')}}</label>
                                    <div class="col-sm-8">
                                        <input type="hidden" name="parent_id">
                                        <select class="form-control parent_id select2-hidden-accessible" style="width: 100%;" name="parent_id" data-value="" tabindex="-1" aria-hidden="true">
                                            <?php $menus = new App\Models\Menu; ?>
                                            <option value="0">Không</option>
                                            {!! $menus->listOptions() !!}
                                        </select>
                                    </div>
                                </div>
            
                                <div class="form-group  ">
                                    <label for="title" class="col-sm-3  control-label">{{config('admin.title')}}</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control title" placeholder="{{config('admin.title')}}" required>
                                        @error('title')
                                            <label class="error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    
                                </div>
                                
                                <div class="form-group">
                                    <label for="icon" class="col-sm-3 control-label">{{config('admin.icon')}}</label>
                                    <div class="col-sm-8">
                                        <div class="input-group iconpicker-container">
                                            <span class="input-group-addon"><i class="fa fa-bars"></i></span>

                                            <input style="width: 140px" type="text" id="icon" name="icon" value="fa-bars" class="form-control icon iconpicker-element iconpicker-input" placeholder="Input Icon">
                                        </div>
                                        <span class="help-block">
                                            <i class="fa fa-info-circle"></i>&nbsp;For more icons please see
                                            <a href="http://fontawesome.io/icons/" target="_blank">http://fontawesome.io/icons/</a>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group  ">
                                    <label for="url" class="col-sm-3 control-label">URL</label>
                                    <div class="col-sm-8">
                                        <input type="text"  name="url" value="" class="form-control" placeholder="Url" required>
                                        @error('url')
                                            <label class="error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group  ">
                                    <label for="order" class="col-sm-3  control-label">{{config('admin.order')}}</label>
                                    <div class="col-sm-8">
                                        <input type="number" id="order" name="order" value="" class="form-control title" placeholder="{{config('admin.order')}}">
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    <div class="btn-group pull-left">
                                        <button type="reset" class="btn btn-warning pull-right">{{ config('admin.reset') }}</button>
                                    </div>
                                    <div class="btn-group pull-right">
                                        <button type="submit" class="btn btn-info pull-right">{{ config('admin.submit') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>

        <div class="modal fade" id="editModal" role="dialog">
            <div class="modal-dialog">
        
                <!-- Modal content-->
                <div class="modal-content edit-content">
                    
                </div>
        
            </div>
        </div>
    </section>
@stop
@push('script')
    <script data-exec-on-popstate="">
        $(function () {
            $('#tree-5ca088fec367f').nestable([]);
            $('.tree-5ca088fec367f-save').click(function () {
                var serialize = $('#tree-5ca088fec367f').nestable('serialize');
                $.ajax({
                    type: "post",
                    url: "{{ url('/admin/menu') }}",
                    serialize: serialize,
                    dataType: "json",
                    success: function(data) {
                        $.pjax.reload('#pjax-container');
                        toastr.success('Save succeeded !');
                    },
                    error: function(error) {
                        console.log('error');
                    }
                });
                // $.post("{{ url('/admin/menu') }}", {
                //     _token: "{{ csrf_token() }}",
                //     _order: JSON.stringify(serialize)
                // },
                // function(data){
                //     $.pjax.reload('#pjax-container');
                //     toastr.success('Save succeeded !');
                // });
            });

            $('.tree-5ca088fec367f-refresh').click(function () {
                $.pjax.reload('#pjax-container');
                toastr.success('Refresh succeeded !');
            });

            $('.tree-5ca088fec367f-tree-tools').on('click', function(e){
                var target = $(e.target),
                    action = target.data('action');
                if (action === 'expand') {
                    $('.dd').nestable('expandAll');
                }
                if (action === 'collapse') {
                    $('.dd').nestable('collapseAll');
                }
            });
        });

        $(document).ready(function() {

            $(document).on('click', '.tree_branch_delete',function() {
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
                            url: "{{ url('/admin/ajax/menu_del')  }}/"+ id,
                            data: {
                                _method: 'DELETE',
                                _token: "{{ csrf_token() }}",
                            },
                            success: function(data) {
                                if(data == 'true'){
                                    swal("Bạn đã xóa thành công!", {
                                        buttons: false,
                                        timer: 1000,
                                        icon: "success"
                                    });
                                    location.reload();
                                } else{
                                    swal("Menu bạn chọn không tồn tại!", {
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

            $(document).on('click', '.edit-menu',function() {
                var id = $(this).data('id');
                $.ajax({
                    method: 'post',
                    url: "{{ url('/admin/ajax/menu_edit') }}/" + id,
                    data: {
                        _method:'PUT',
                        _token:"{{ csrf_token() }}",
                    },
                    success: function (data) {
                        $("#editModal").modal();
                        $('.edit-content').html(data);
                    }
                });
            });
            
            $("#valiMenu").validate();
        });
    </script>
@endpush
