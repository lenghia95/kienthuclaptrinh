@extends('admins.menugroups.widgets.app')
@section('menugroup')
<form action="{{ route('menugroups.store') }}" class="_form_bk mt-10 ml-10 mb-10" method="POST" id="valiForm">
    @csrf
    <h3 class="modal-title ml-15" id="modalLabel">{{ config('admin.new') }}</h3>
    <div class="modal-body">
        <div class="fields-group row">
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="name" class="control-label">{{ config('admin.name') }}*</label>
                    <label for="_name" generated="true" class="error"></label>
                    @error('name')
                        <label for="_name" generated="true" class="error"> {{ $message }}</label>
                    @enderror
                    <input type="text" name="name" id="_name" value="{{ old('name') }}" class="form-control name" placeholder="{{ config('admin.name') }}" required><br>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="key" class="control-label">{{ config('admin.key') }}*</label>
                    <label for="key" generated="true" class="error"></label>
                    @error('key')
                        <label for="key" generated="true" class="error"> {{ $message }}</label>
                    @enderror
                    <input type="text" name="key" value="{{ old('key') }}" class="form-control key" placeholder="{{ config('admin.key') }}" required><br>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12 mb-10">
                    <label for="status" class="control-label">{{ config('admin.status') }}:</label>
                    <input type="checkbox" name="status" checked data-toggle="toggle" data-size="xs" data-onstyle="primary" data-offstyle="warning" class="edit-status" value="1">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="description" class="control-label">{{ config('admin.description') }}</label>
                    <textarea class="form-control" placeholder="{{ config('admin.description') }}" cols="30" rows="3" name="description"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" name="submit" class="btn btn-primary">{{ config('admin.submit') }}</button>
    </div>
</form>
@endsection
