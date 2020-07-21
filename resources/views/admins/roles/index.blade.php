@extends('admins.roles.widgets.app')
@section('roles')
<form action="{{ route('roles.store') }}" class="_form_bk mt-10 ml-10 mb-10" method="POST" enctype="multipart/form-data" id="valiForm">
    @csrf
    <h3 class="modal-title ml-15" id="modalLabel">Add {{ config('admin.role') }}</h3>
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
                    @error('name')
                        <label for="name" generated="true" class="error">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="display_name" class="control-label">Display Name*</label>
                    <label for="display_name" generated="true" class="error"></label>
                    <div class="input-group mb-10">
                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                        <input type="text"  name="display_name" value="" class="form-control" placeholder="Display Name" required>
                    </div>
                    @error('display_name')
                        <label for="name" generated="true" class="error">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="description" class="control-label">{{ config('admin.description') }}*</label>
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
    </div>
</form>
@endsection
