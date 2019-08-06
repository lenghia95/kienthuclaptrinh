@extends('admins.menulists.widgets.app')
@section('menulist')
    <form action="{{ route('menulists.update',['id'=>$menuList->id]) }}" class="_form_bk mt-10 ml-10 mb-10" method="POST" id="valiMenulist">
        <input type="hidden" class="_method" name="_method" value="PUT">
        <input type="hidden" name="menugroup" value="" />
        <input type="hidden" class="_menulist" name="_menulist" value="{{ $menuList->id }}">
        @csrf
        <h3 class="modal-title ml-15" id="modalLabel">{{ config('admin.edit') }}</h3>
        <div class="modal-body">
            <div class="fields-group row">
                <div class="col-sm-12 mb-10">
                    <label for="menugroup" class="control-label">Menu Group*</label>
                    @error('menugroup')
                        <label class="error">{{ $message }}</label>
                    @enderror
                    <select class="form-control parent_id select2-hidden-accessible" style="width: 100%;" name="menugroup" data-value="" tabindex="-1" aria-hidden="true" required>
                        <?php $menuGroups = new App\Models\Menugroup; ?>
                        @foreach($menuGroups->getMenugroups() as $menugroup)
                        <option value="{{ $menugroup->id }}" {{ ($menuList->menugroup == $menugroup->id) ? 'selected' : '' }}>{{ $menugroup->name }}</option>
                        @endforeach()
                    </select>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="name" class="control-label">{{ config('admin.name') }}*</label>
                        <label generated="true" class="error"></label>
                        @error('name')
                            <label class="error">{{ $message }}</label>
                        @enderror
                        <div class="input-group mb-10">
                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                            <input type="text" name="name" value="{{ $menuList->name }}" class="form-control name" placeholder="{{ config('admin.name') }}" required>
                        </div>
                       
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="url" class="control-label">{{ config('admin.url') }}*</label>
                        <label for="url" generated="true" class="error"></label>
                        @error('url')
                            <label class="error">{{ $message }}</label>
                        @enderror
                        <div class="input-group mb-10">
                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                            <input type="text"  name="url" data-id="{{ $menuList->id }}" value="{{ $menuList->url }}" class="form-control" placeholder="{{ config('admin.url') }}" required>
                        </div>
                        
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 mb-10">
                        <label for="parent" class="control-label">{{config('admin.parent_id')}}*</label>
                        @error('parent')
                            <label class="error">{{ $message }}</label>
                        @enderror
                        <input type="hidden" name="parent">
                        <select class="form-control parent_id select2-hidden-accessible" style="width: 100%;" name="parent" data-value="" tabindex="-1" aria-hidden="true">
                            <option value="0">Không</option>
                            {!! $parents !!}
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 mb-10">
                        <label for="status" class="control-label">{{ config('admin.status') }}:</label>
                        <input type="checkbox" {{ ($menuList->status === 1) ? 'checked' : '' }} data-toggle="toggle" data-size="xs" data-onstyle="primary" data-offstyle="warning" class="edit-status" value="{{ ($menuList->status === 1) ? 1 : 0 }}">
                        <input type="hidden" name="status" value="{{ ($menuList->status === 1) ? 1 : 0 }}">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="sort" class="control-label">{{ config('admin.sort') }}</label>
                        <label for="sort" generated="true" class="error"></label>
                        <div class="input-group mb-10">
                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                            <input type="number"  name="sort" value="{{ $menuList->sort }}" class="form-control sort" placeholder="{{ config('admin.sort') }}" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">{{ config('admin.update') }}</button>
            <a href="{{ route('menulists.index') }}" class="btn btn-danger">{{ config('admin.close') }}</a>
        </div>
    </form>
@endsection
