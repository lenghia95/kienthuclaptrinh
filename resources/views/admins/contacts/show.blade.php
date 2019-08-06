@extends('admins.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ $title }}
            <small>{{ config('admin.show') }}</small>
        </h1>

        <!-- breadcrumb start -->
        <ol class="breadcrumb" style="margin-right: 30px;">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> {{ config('admin.home') }}</a></li>
            <li>
                {{ $title }}
            </li>
            <li>
                {{ $contact->id }}
            </li>
        </ol>

        <!-- breadcrumb end -->

    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Contact.{{ config('admin.detail') }}</h3>
    
                                <div class="box-tools">
                                    <div class="btn-group pull-right" style="margin-right: 5px">
                                        <form action="{{ route('contacts.destroy',['id'=>$contact->id]) }}" method="post" onsubmit="return confirm('{{ config('admin.delete_confirm') }}')">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> {{ config('admin.delete') }}</button>
                                        </form>
                                    </div>
                                    
                                    <div class="btn-group pull-right" style="margin-right: 5px">
                                        <a href="{{ route('contacts.index') }}" class="btn btn-sm btn-default" title="List">
                                            <i class="fa fa-list"></i><span class="hidden-xs"> {{ config('admin.list') }}</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <div class="form-horizontal">
    
                                <div class="box-body">
    
                                    <div class="fields-group">
    
                                        <div class="form-group ">
                                            <label class="col-sm-2 control-label">ID</label>
                                            <div class="col-sm-8">
                                                <div class="box box-solid box-default no-margin box-show">
                                                    <!-- /.box-header -->
                                                    <div class="box-body">
                                                        {{ $contact->id }}&nbsp;
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="col-sm-2 control-label">{{ config('admin.name') }}</label>
                                            <div class="col-sm-8">
                                                <div class="box box-solid box-default no-margin box-show">
                                                    <!-- /.box-header -->
                                                    <div class="box-body">
                                                        {{ $contact->name }}&nbsp;
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="col-sm-2 control-label">{{ config('admin.email') }}</label>
                                            <div class="col-sm-8">
                                                <div class="box box-solid box-default no-margin box-show">
                                                    <!-- /.box-header -->
                                                    <div class="box-body">
                                                        {{ $contact->email }}&nbsp;
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group ">
                                            <label class="col-sm-2 control-label">{{ config('admin.phone') }}</label>
                                            <div class="col-sm-8">
                                                <div class="box box-solid box-default no-margin box-show">
                                                    <!-- /.box-header -->
                                                    <div class="box-body">
                                                            {{ $contact->phone }}&nbsp;
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group ">
                                            <label class="col-sm-2 control-label">{{ config('admin.created_at') }}</label>
                                            <div class="col-sm-8">
                                                <div class="box box-solid box-default no-margin box-show">
                                                    <!-- /.box-header -->
                                                    <div class="box-body">
                                                        {{ $contact->created_at }}&nbsp;
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="col-sm-2 control-label">{{ config('admin.updated_at') }}</label>
                                            <div class="col-sm-8">
                                                <div class="box box-solid box-default no-margin box-show">
                                                    <!-- /.box-header -->
                                                    <div class="box-body">
                                                        {{ $contact->updated_at }}&nbsp;
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="col-sm-2 control-label">{{ config('admin.status') }}</label>
                                            <div class="col-sm-8">
                                                <div class="box box-solid box-default no-margin box-show">
                                                    <!-- /.box-header -->
                                                    <div class="box-body" >
                                                        <a data-key="{{ $contact->id }}" data-status="{{ $contact->status }}" class=" status-contact  label label-{{ ($contact->status == 1) ? 'success' : 'warning' }}"> {{ ($contact->status == 1) ? 'Done' : 'Slacking' }} </a>
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                    </div>
    
                    <div class="col-md-12">
                    </div>
                </div>
            </div>
        </div>
    
    </section>
@stop
@push('script')
    <script>
        $(document).ready(function() {
            // ajax status
            $(document).on('click', '.status-contact', function(){
                var id = $(this).data('key');
                var status = $(this).attr('data-status');
                if(status == 1){
                    $(this).removeClass('label-success').addClass('label-warning');
                    $(this).text('Slacking');
                    $(this).attr('data-status',0)
                }
                else if(status == 0){
                    $(this).text('Done');
                    $(this).removeClass('label-warning').addClass('label-success');
                    $(this).attr('data-status',1)
                }

                $.ajax({
                    url: "{{ url('/admin/ajax/contact_status')  }}/" + id,
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
