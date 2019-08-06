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
                <div class="box-body">
                    <table id="example" class="table table-hover table-striped table-bordered">
                        <thead>
                        <tr class="_table_title">
                            <th> </th>
                            <th>ID
                                <a class="fa fa-fw fa-sort" href=""></a>
                            </th>
                            <th>{{ config('admin.title') }}</th>
                            <th>{{ config('admin.email') }}</th>
                            <th>{{ config('admin.content') }}</th>
                            <th>Reply</th>
                            <th>{{ config('admin.status') }}</th>
                            <th>{{ config('admin.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($comments as $comment)
                            <tr>
                                <td>
                                    <input type="checkbox" class="minimal" >
                                </td>
                                <td>{{ $comment->id }}</td>
                                <td>{{ $comment->title }}</td>
                                <td>{{ $comment->email }}</td>
                                <td>{!! $comment->content !!}</td>
                                <td>
                                    @php
                                        $parent = new App\Models\Comment;
                                    @endphp
                                    {{ ($comment->parent != null) ? $parent->getItemReply($comment->parent)->email : 'Level 1 comment'}}
                                    @if($comment->parent != null)
                                    <br><span class="label label-primary">
                                        {{ $parent->getItemReply($comment->parent)->id }}
                                    </span>
                                    @endif
                                </td>
                                <td align="center">
                                    <a data-key="{{ $comment->id }}" data-status="{{ $comment->status }}" class="status-contact label label-{{ ($comment->status == 1) ? 'success' : 'warning' }}"> {{ ($comment->status == 1) ? 'On' : 'Off' }} </a>
                                </td>
                                <td align="center">
                                    <a href="{{ route('comments.show',[ 'id' => $comment->id ]) }}"><i class="fa fa-eye"></i></a>
                                    <a href="javascript:void(0);" data-id="{{ $comment->id }}" class="grid-row-delete"><i class="fa fa-trash"></i></a>
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
                            url: "{{ url('/admin/ajax/comments_del')  }}/"+ id,
                            data: {
                                _method: 'DELETE',
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


            // // ajax status
            $(document).on('click', '.status-contact', function(){
                var id = $(this).data('key');
                var status = $(this).attr('data-status');
                if(status == 1){
                    $(this).removeClass('label-success').addClass('label-warning');
                    $(this).text('Off');
                    $(this).attr('data-status',0)
                }
                else if(status == 0){
                    $(this).text('On');
                    $(this).removeClass('label-warning').addClass('label-success');
                    $(this).attr('data-status',1)
                }
                
                $.ajax({
                    url: "{{ url('/admin/ajax/comments_status')  }}/" + id,
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
