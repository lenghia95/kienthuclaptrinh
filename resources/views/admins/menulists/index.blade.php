@extends('admins.menulists.widgets.app')
@section('menulist')
<form action="{{ route('menulists.store') }}" class="_form_bk mt-10 ml-10 mb-10" method="POST" id="valiMenulist">
    @csrf
    {{-- <input type="hidden" name="menugroup" value="" /> --}}
    <h3 class="modal-title ml-15" id="modalLabel">{{ config('admin.new') }}</h3>
    <div class="modal-body">
        <div class="fields-group row">
            <div class="form-group">
                <div class="col-sm-12 mb-10">
                    <label for="menugroup" class="control-label">Menu Group*</label>
                    @error('menugroup')
                        <label class="error">{{ $message }}</label>
                    @enderror
                    <select class="form-control parent_id select2-hidden-accessible" style="width: 100%;" name="menugroup" data-value="" tabindex="-1" aria-hidden="true" required>
                        <?php $menuGroups = new App\Models\Menugroup; ?>
                        @foreach($menuGroups->getMenugroups() as $menugroup)
                        <option value="{{ $menugroup->id }}">{{ $menugroup->name }}</option>
                        @endforeach()
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="name" class="control-label">{{ config('admin.name') }}*</label>
                    <label for="_name" generated="true" class="error"></label>
                    @error('name')
                        <label for="_name" generated="true" class="error">{{ $message }}</label>
                    @enderror
                    <input type="text" name="name" id="_name" value="{{ old('name') }}" class="form-control" placeholder="{{ config('admin.name') }}" required>
                    <br>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="url" class="control-label">{{ config('admin.url') }}*</label>
                    <label for="url" generated="true" class="error"></label>
                    @error('url')
                        <label class="error">{{ $message }}</label>
                    @enderror
                    <input type="text"  name="url" value="{{ old('url') }}" class="form-control uri" placeholder="{{ config('admin.url') }}" required />
                    <br>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12 mb-10">
                    <label for="parent" class="control-label">{{config('admin.parent_id')}}*</label>
                    <input type="hidden" name="parent">
                    @error('parent')
                        <label class="error">{{ $message }}</label>
                    @enderror
                    <select class="form-control parent_id select2-hidden-accessible" style="width: 100%;" name="parent" data-value="" tabindex="-1" aria-hidden="true" required>
                        <option value="0">Không</option>
                        {!! $parents !!}
                    </select>
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
                    <label for="sort" generated="true" class="error"></label>
                    <input type="number"  name="sort" value="{{ old('sort') }}" class="form-control" placeholder="{{ config('admin.sort') }}" >
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">{{ config('admin.submit') }}</button>
    </div>
</form>

@endsection

