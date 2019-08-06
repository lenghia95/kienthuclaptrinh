@extends('admins.layouts.app')

@section('content')

@include('flash-message')

<section class="content-header">
    <h1>
        {{ $title }}
        <small>{{ config('admin.list')}}</small>
        @if ($errors->any())
            <span style="color:red">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </span>
        @endif
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

                        <div class="btn-group pull-right" style="margin-right: 10px">
                            <a href="" class="btn btn-sm btn-success" title="New" data-toggle="modal" data-target="#flipFlop">
                                <i class="fa fa-save"></i><span class="hidden-xs">&nbsp;&nbsp;{{ config('admin.new')}}</span>
                            </a>
                        </div>

                    </div>
                   
                    <span>
                        <input type="checkbox" class="grid-select-all " />&nbsp;
                        <div class="btn-group">
                            <a class="btn btn-sm btn-default">&nbsp;<span class="hidden-xs">Action</span></a>
                            <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#" class="grid-batch-0">Delete</a></li>
                            </ul>
                        </div>
                    </span>
                </div>
                
                <!-- /.box-header -->
                <div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <div class="box-body">
                                <div class="col-sm-6">
                                    <div class="dataTables_length" id="example_length">
                                        <label>Show
                                            <select name="item" class="form-control input-sm" onchange="if(this.value) window.location.href='?item='+this.value">
                                                @foreach (config('admin.items') as $item)
                                                    <option value="{{ $item }}" {{ (app('request')->get('item') == $item ) ? 'selected' : ''}}>{{ $item }}</option>
                                                @endforeach
                                            </select>
                                            entries
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div id="example_filter" class="dataTables_filter">
                                        <label>Search:
                                            <input type="search" name="search" class="form-control input-sm search-post" placeholder="Nhập từ khóa tìm kiếm..." aria-controls="example">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="box-body">
                                    <table id="" class="table table-hover table-striped table-bordered">
                                        <thead>
                                        <tr class="_table_title">
                                            <th> </th>
                                            <th>ID<a class="fa fa-fw fa-sort" href=""></a></th>
                                            <th>{{ config('admin.title') }}</th>
                                            <th>{{ config('admin.image') }}</th>
                                            <th>{{ config('admin.category') }}</th>
                                            <th>Author</th>
                                            <th>{{ config('admin.status') }}</th>
                                            <th>{{ config('admin.created_at') }}</th>
                                            <th>{{ config('admin.action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody class="post-output">
                                        @foreach($posts as $post)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="minimal" /><br>
                                                    <a href="#" class="fa fa-comments"></a>
                                                </td>
                                                <td>{{ $post->id }}</td>
                                                <td>{{ $post->title }}</td>
                                                <td>
                                                    <img width="100" src="{{ asset($post->thumbnail) }}" class="img-thumbnail" title="{{ $post->title }}" />
                                                </td>
                                                <td>
                                                    @php $Cat = new App\Models\PostCategory @endphp
                                                    @foreach ($Cat->getCatsByPostId($post->id) as $cat)
                                                        <a class="label label-info"> {{ $cat->name }} </a><br>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <a class="label label-warning">{{ $post->uName }}</a>
                                                </td>
                                                <td align="center">
                                                    <input type="checkbox" {{ ($post->status === 1) ? 'checked' : '' }} data-toggle="toggle" data-size="xs" data-onstyle="primary" data-offstyle="warning" class="grid-switch-status" data-key="{{ $post->id }}" value="{{ ($post->status === 1) ? 1 : 0 }}">
                                                </td>
                                                <td>{{ date('d/m/Y', strtotime($post->created_at)) }}</td>
                                                <td align="center">
                                                    <a href="{{ route('listposts.edit',['id' => $post->id]) }}"><i class="fa fa-edit"></i></a>
                                                    <a href="javascript:void(0)" data-id="{{ $post->id }}" class="grid-row-delete">
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
                        <div class="row">
                            <div class="box-body">
                                <div class="col-sm-5">
                                    <div class="dataTables_info">
                                        Showing
                                        {{ ($posts->currentPage() * $posts->perPage()) - ($posts->perPage() - 1) }}
                                        to
                                        {{ ( $posts->currentPage() == $posts->lastPage() ) ? $posts->total() : $posts->currentPage() * $posts->perPage()  }}
                                        of
                                        {{ $posts->total() }}
                                        entries
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="dataTables_paginate">
                                        {{ $posts->appends(Request::except('page'))->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <!-- The modal -->
                <div class="modal fade" id="flipFlop" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" >
                    <div class="modal-dialog modal-lg" role="document" >
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title" id="modalLabel">Add Pages</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row box-body">
                                    <!-- Custom Tabs -->
                                    <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-bars"></i> Basic Field</a></li>
                                            <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-clock-o"></i> Seo meta</a></li>
                                        </ul>
                                        <form action="{{ route('listposts.store') }}" method="POST" enctype="multipart/form-data" id="valiForm">
                                            @csrf
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab_1">
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label for="title" class="control-label">{{ config('admin.title') }}*</label>
                                                            <label for="title" generated="true" class="error"></label>
                                                            <input type="text" name="title" value="{{ old('title') }}" maxlength="255" class="form-control title" placeholder="{{ config('admin.title') }}" required>
                                                        </div>
                                                            
                                                        <div class="form-group">
                                                            <label for="slug" class="control-label">{{ config('admin.slug') }}*</label>
                                                            <label for="slug" generated="true" class="error"></label>
                                                            <input type="text" name="slug"  value="{{ old('slug') }}" maxlength="255" class="form-control slug" placeholder="{{ config('admin.slug') }}" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Categories*</label>
                                                            <select class="form-control category"  name="category[]" multiple="multiple" data-placeholder="Categories" style="width: 100%;" >
                                                                {!! $categories !!}
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="status" class="control-label">{{ config('admin.status') }}:</label>
                                                            <input type="checkbox" name="status" checked data-toggle="toggle" data-size="xs" data-onstyle="primary" data-offstyle="warning" class="edit-status" value="1">
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label for="thumbnail" class="control-label">{{ config('admin.image') }}</label>
                                                            @error('thumbnail')
                                                                <label class="error">{{ $message }}</label>
                                                            @enderror
                                                            <input type="file" class="avatar" name="thumbnail"/>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="description" class="control-label">{{ config('admin.description') }}</label>
                                                            <textarea class="form-control" name="description" col="3" placeholder="Input {{ config('admin.description') }}">{{ old('description') }}</textarea>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label for="content" class="control-label">{{ config('admin.content') }}</label>
                                                            <textarea class="form-control" id="content" name="content" placeholder="Input {{ config('admin.description') }}">{{ old('content') }}</textarea>
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                </div>
                                                <!-- /.tab-pane -->
                                                <div class="tab-pane" id="tab_2">
                                                    <div class="col-sm-12">
                                                        <label for="seo_title" class="control-label">seo_title</label>
                                                        <div class="input-group mb-10">
                                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                                            <input type="text" name="seo_title" value="" class="form-control seo_title" placeholder="tiêu đề seo">
                                                        </div>
                                                        <span class="help-block">
                                                            <i class="fa fa-info-circle"></i>&nbsp;sử dụng a-z and 0-9.
                                                        </span>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <label for="seo_description" class="control-label">{{ config('admin.description') }}</label>
                                                        <div class="input-group mb-10">
                                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                                            <input type="text" name="seo_description" value="" class="form-control seo_description" placeholder="seo {{ config('admin.description') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <label for="seo_keywords" class="control-label">seo_keywords</label>
                                                        <div class="input-group mb-10">
                                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                                            <input type="text" name="seo_keywords" value="" class="form-control seo_keywords" placeholder="seo keywords">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                 <!-- /.box-body -->
                                                 <div class="box-footer">
                                                    <div class="col-md-12">
                                                        <div class="btn-group pull-right">
                                                            <button type="submit" class="btn btn-primary">{{ config('admin.submit') }}</button>
                                                        </div>
                                                        <div class="btn-group pull-left">
                                                            <button type="reset" class="btn btn-warning">{{ config('admin.reset') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.box-footer -->
                                            </div>
                                        </form>
                                        <!-- /.tab-content -->
                                    </div>
                                </div>
                            </div>
                            <!-- nav-tabs-custom -->
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
@push('script')
    @include('admins.posts.validate')
    <script type="text/javascript">

        $(document).ready(function(){
            CKEDITOR.replace('content');
            $('.grid-select-all').iCheck({checkboxClass:'icheckbox_minimal-red'});
            $('.grid-select-all').on('ifChanged', function(event) {
                if (this.checked) {
                    $('.minimal').iCheck('check');
                } else {
                    $('.minimal').iCheck('uncheck');
                }
            });

            $(document).on('keyup', '.search-post', function(){
               var keywork  = $(this).val();
               $.ajax({
                   type: "get",
                   url: "{{ url('/admin/ajax/search-posts') }}",
                   data: { keywork:keywork},
                   success: function (data) {
                    //    console.log(data); return false;
                       $('.post-output').html(data);
                   }
               });
            });

            
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
                            url: "{{ url('/admin/ajax/posts_del')  }}/"+ id,
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


            $(document).on('change', '.grid-switch-status', function(){
                var id = $(this).data('key');
                $.ajax({
                    url: "{{ url('/admin/ajax/status_posts')  }}/" + id,
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

        })
    </script>
@endpush
