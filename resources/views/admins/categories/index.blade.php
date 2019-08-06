@extends('admins.categories.widgets.app')
@section('category')
<form action="{{ route('categories.store') }}" class="_form_bk mt-10 ml-10 mb-10" method="POST" id="valiMenulist">
    @csrf
    <h3 class="modal-title ml-15" id="modalLabel">{{ config('admin.new') }}</h3>
    <div class="modal-body">
        <div class="fields-group row">
            
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="name" class="control-label">{{ config('admin.name') }}*</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="{{ config('admin.name') }}" required>
                    @error('name')
                        <label for="name" generated="true" class="error">{{ $message }}</label>
                    @enderror
                    <br>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="slug" class="control-label">{{ config('admin.slug') }}*</label>
                    <input type="text"  name="slug" value="{{ old('slug') }}" class="form-control uri" placeholder="{{ config('admin.slug') }}" required />
                    @error('slug')
                        <label class="error">{{ $message }}</label>
                    @enderror
                    <br>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12 mb-10">
                    <label for="parent" class="control-label">{{config('admin.parent_id')}}*</label>
                    <select class="form-control parent_id select2-hidden-accessible" style="width: 100%;" name="parent" data-value="" tabindex="-1" aria-hidden="true" required>
                        <option value="0">No Parent</option>
                        {!! $parents !!}
                    </select>
                    @error('parent')
                        <label class="error">{{ $message }}</label>
                    @enderror
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
                    <label for="sort" class="control-label">{{ config('admin.sort') }}</label>
                    <input type="number"  name="sort" value="{{ old('sort') }}" class="form-control" placeholder="{{ config('admin.sort') }}" />
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">{{ config('admin.submit') }}</button>
    </div>
</form>

@endsection

