@extends('admins.categories.widgets.app')
@section('category')
    <form action="{{ route('categories.update',['id'=>$category->id]) }}" class="_form_bk mt-10 ml-10 mb-10" method="POST" id="valiMenulist">
        <input type="hidden" class="_method" name="_method" value="PUT">
        <input type="hidden" name="category_slug" value="{{ $category->id }}">
        @csrf
        <h3 class="modal-title ml-15" id="modalLabel">{{ config('admin.edit') }}</h3>
        <div class="modal-body">
            <div class="fields-group row">
                
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="name" class="control-label">{{ config('admin.name') }}*</label>
                        <input type="text" name="name" value="{{ $category->name }}" class="form-control name" placeholder="{{ config('admin.name') }}" required />
                        <br>
                        @error('name')
                            <label class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="slug" class="control-label">{{ config('admin.slug') }}*</label>
                        <input type="text"  name="slug" data-id="{{ $category->id }}" value="{{ $category->slug }}" class="form-control" placeholder="{{ config('admin.slug') }}" required>
                        <br>
                        @error('slug')
                            <label class="error">{{ $message }}</label>
                        @enderror
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
                            <option value="0">No Parent</option>
                            {!! $parents !!}
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                            <label for="status" class="control-label">{{ config('admin.status') }}:</label>
                            <input type="checkbox" {{ ($category->status === 1) ? 'checked' : '' }} data-toggle="toggle" data-size="xs" data-onstyle="primary" data-offstyle="warning" class="edit-status" value="{{ ($category->status === 1) ? 1 : 0 }}">
                            <input type="hidden" name="status" value="{{ ($category->status === 1) ? 1 : 0 }}">
                    </div>
                </div>
                {{-- <div class="form-group">
                    <div class="col-sm-12">
                        <label for="description" class="control-label">{{ config('admin.description') }}</label>
                        <textarea name="description" rows="3" class="form-control">{{ $category->description }}</textarea>
                        <br>
                    </div>
                </div> --}}

                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="sort" class="control-label">{{ config('admin.sort') }}</label>
                        <input type="number"  name="sort" value="{{ $category->sort }}" class="form-control" placeholder="{{ config('admin.sort') }}" />
                        <br>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="seo_title" class="control-label">Seo title</label>
                        <input type="text"  name="seo_title" value="{{ $category->seo_title }}" class="form-control" placeholder="Seo title" />
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">{{ config('admin.update') }}</button>
            <a href="{{ route('categories.index') }}" class="btn btn-danger">{{ config('admin.close') }}</a>
        </div>
    </form>
@endsection
