@extends('admins.menugroups.widgets.app')
@section('menugroup')
    <form action="{{ route('menugroups.update',['id'=>$menuGroup->id]) }}" class="_form_bk mt-10 ml-10 mb-10" method="POST" id="valiForm">
        @method('PUT')
        @csrf
        <h3 class="modal-title ml-15" id="modalLabel">{{ config('admin.edit') }}</h3>
        <input type="hidden" value="{{ $menuGroup->id }}" name="id" />
        <div class="modal-body">
            <div class="fields-group row">
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="name" class="control-label">{{ config('admin.name') }}*</label>
                        <label generated="true" class="error"></label>
                        @error('name')
                            <label generated="true" class="error">{{ $message }}</label>
                        @enderror
                        <input type="text" name="name" value="{{ $menuGroup->name }}" class="form-control name" placeholder="{{ config('admin.name') }}" required>
                        <br>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="key" class="control-label">Menu key*</label>
                        <label for="key" generated="true" class="error"></label>
                        @error('key')
                            <label generated="true" class="error">{{ $message }}</label>
                        @enderror
                        <input type="text"  name="key" data-id="{{ $menuGroup->id }}"  value="{{ $menuGroup->key }}" class="form-control" placeholder="Menu key" required>
                        <br>
                        
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 mb-10">
                        <label for="status" class="control-label">{{ config('admin.status') }}:</label>
                        <input type="checkbox" {{ ($menuGroup->status === 1) ? 'checked' : '' }} data-toggle="toggle" data-size="xs" data-onstyle="primary" data-offstyle="warning" class="edit-status" value="{{ ($menuGroup->status === 1) ? 1 : 0 }}">
                        <input type="hidden" name="status" value="{{ ($menuGroup->status === 1) ? 1 : 0 }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="description" class="control-label">{{ config('admin.description') }}</label>
                         <textarea class="form-control" placeholder="{{ config('admin.description') }}" cols="30" rows="3" name="description">{{ $menuGroup->description }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">{{ config('admin.update') }}</button>
            <a href="{{ route('menugroups.index') }}" class="btn btn-danger">{{ config('admin.close') }}</a>
        </div>
    </form>
@endsection
