@extends('admin.roles.widgets.app')
@section('roles')
<form action="{{ route('role.store') }}" class="_form_bk mt-10 ml-10" method="POST" enctype="multipart/form-data" id="valiForm">
    @csrf
    <h3 class="modal-title ml-15" id="modalLabel">Thêm {{ config('admin.role') }}</h3>
    <div class="modal-body">
        <div class="fields-group row">
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="name" class="control-label">{{ config('admin.name') }}*</label>
                    <label for="_name" generated="true" class="error"></label>
                    <div class="input-group mb-10">
                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                        <input type="text" name="name" id="_name"value="" class="form-control name" placeholder="{{ config('admin.name') }}" required>
                    </div>
                    @foreach ($errors->get('name') as $mes)
                        <span style="color:#c23527;font-style:italic">{{ $mes }}</span><br>
                    @endforeach
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="slug" class="control-label">{{ config('admin.slug') }}*</label>
                    <label for="_slug" generated="true" class="error"></label>
                    <div class="input-group mb-10">
                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                        <input type="text"  name="slug" id="_slug" value="" class="form-control name" placeholder="{{ config('admin.slug') }}" required>
                    </div>
                    @foreach ($errors->get('slug') as $mes)
                        <span style="color:#c23527;font-style:italic">{{ $mes }}</span><br>
                    @endforeach
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="description" class="control-label">{{ config('admin.description') }}*</label>
                    <label for="description" generated="true" class="error"></label>
                    <div class="input-group mb-10">
                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                        <input type="text" name="description" value="" class="form-control description" placeholder="{{ config('admin.description') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">{{ config('admin.submit') }}</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ config('admin.close') }}</button>
    </div>
</form>
@endsection
