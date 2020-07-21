@extends('admins.layouts.app')

@section('content')

@include('flash-message')

<section class="content-header">
    <h1>
        {{ $title }}
        <small>{{ config('admin.list')}}</small>
        @if ($errors->any())
            <span style="color:red; font-style: italic">
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

                </div>


                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example" class="table table-hover table-striped table-bordered">
                        <thead>
                        <tr class="_table_title">
                            <th> </th>
                            <th>ID<a class="fa fa-fw fa-sort" href=""></a></th>
                            <th>{{ config('admin.name') }}</th>
                            <th>{{ config('admin.slug') }}</th>
                            <th>{{ config('admin.content') }}</th>
                            <th>{{ config('admin.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pages as $page)
                            <tr>
                                <td>
                                    <input type="checkbox" class="minimal">
                                </td>
                                <td>{{ $page->id }}</td>
                                <td>{{ $page->title }}</td>
                                <td>{{ $page->slug }}</td>
                                <td>{!! $page->content !!}</td>
                                <td align="center">
                                    <a href="{{ route('pages.show',[$page->id]) }}"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('pages.edit',['id' => $page->id]) }}"><i class="fa fa-edit"></i></a>
                                    <a href="#" data-id="{{ $page->id }}" class="grid-row-delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
                            <form action="{{ route('pages.store') }}" method="POST" enctype="multipart/form-data" id="valiForm">
                                @csrf
                                <div class="box-body">
                                    <div class="fields-group">
                                        <div class="col-sm-12">
                                            <label for="title" class="control-label">{{ config('admin.title') }}*</label>
                                            <label for="title" generated="true" class="error"></label>
                                            <div class="input-group mb-10">
                                                <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" name="title" value="{{ old('title') }}" maxlength="255" class="form-control title" placeholder="{{ config('admin.title') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="slug" class="control-label">{{ config('admin.slug') }}*</label>
                                            <label for="slug" generated="true" class="error"></label>
                                            <div class="input-group mb-10">
                                                <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                                <input type="text" name="slug" value="{{ old('slug') }}" maxlength="255" class="form-control slug" placeholder="{{ config('admin.slug') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 mb-10">
                                            <label for="content" class="control-label">Nội dung*</label>
                                            {{-- <label for="content" generated="true" class="error"></label> --}}
                                            <textarea class="form-control" id="_content" name="content" placeholder="Input Content">{{ old('content') }}</textarea>
                                        </div>

                                        <hr>
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
    <script type="text/javascript">

        $(document).ready(function(){
            $("#valiForm").validate({
                
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
                            url: "{{ url('/admin/ajax/page_del')  }}/"+ id,
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

        })
    </script>
@endpush
