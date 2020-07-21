@extends('admins.roles.widgets.app')
@section('roles')
    <form action="{{ route('roles.update',['id'=>$role->id]) }}" class="_form_bk mt-10 ml-10" method="POST" id="valiForm">
        <input type="hidden" class="_method" name="_method" value="PUT">
        <input type="hidden" name="role_name" value="{{ $role->id }}">
        @csrf
        <h3 class="modal-title ml-15" id="modalLabel">{{ config('admin.edit') }} {{ config('admin.role') }}</h3>
        <div class="modal-body">
            <div class="fields-group row">
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="name" class="control-label">{{ config('admin.name') }}*</label>
                        <label for="_name" generated="true" class="error"></label>
                        <div class="input-group mb-10">
                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                            <input type="text" name="name" data-id="{{ $role->id }}" id="_name"value="{{ $role->name }}" class="form-control name" placeholder="{{ config('admin.name') }}" required>
                        </div>
                        @error('name')
                            <label for="name" generated="true" class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="slug" class="control-label">Display Name*</label>
                        <label for="_slug" generated="true" class="error"></label>
                        <div class="input-group mb-10">
                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                            <input type="text"  name="display_name" value="{{ $role->display_name }}" class="form-control" placeholder="Display Name" required>
                        </div>
                        @error('display_name')
                            <label for="name" generated="true" class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="description" class="control-label">{{ config('admin.description') }}*</label>
                        <label for="description" generated="true" class="error"></label>
                        <div class="input-group mb-10">
                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                            <input type="text" name="description" value="{{ $role->description }}" class="form-control description" placeholder="{{ config('admin.description') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">{{ config('admin.update') }}</button>
            <a href="{{ route('roles.index') }}" class="btn btn-danger">{{ config('admin.close') }}</a>
        </div>
    </form>
@endsection
