<form method="POST" action="{{ route('menus.update',[ 'id' => $menu->id ]) }}" class="form-horizontal" id="valiEdit">
    @method('PUT')
    @csrf
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{ config('admin.edit') }}</h4>
    </div>
    <div class="modal-body">

        <div class="form-group">
            <label for="parent_id" class="col-sm-3  control-label">{{ config('admin.parent_id') }}</label>
            <div class="col-sm-8">
                <input type="hidden" name="parent_id">
                <select class="form-control parent_id select2-hidden-accessible" style="width: 100%;" name="parent_id" data-value="" tabindex="-1" aria-hidden="true">
                    <option value="0">Không</option>
                    {!! $listOptionsSelected !!}
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label for="title" class="col-sm-3  control-label">{{ config('admin.title') }}</label>
            <div class="col-sm-8">
                <input value="{{ $menu->title }}" class="form-control" name="title" placeholder="{{ config('admin.title') }}" required="required" type="text">
            </div>
        </div>
        <div class="form-group">
            <label for="icon" class="col-sm-3 control-label">Icon</label>
            <div class="col-sm-8">
                <div class="input-group iconpicker-container">
                    <span class="input-group-addon"><i class="fa fa-bars"></i></span>
                    <input style="width: 140px" type="text" id="icon" name="icon" value="{{ $menu->icon }}" class="form-control icon iconpicker-element iconpicker-input" placeholder="Input Icon">
                </div>
                <span class="help-block">
                    <i class="fa fa-info-circle"></i>&nbsp;For more icons please see
                    <a href="http://fontawesome.io/icons/" target="_blank">http://fontawesome.io/icons/</a>
                </span>
            </div>
        </div>
        <div class="form-group  ">
            <label for="url" class="col-sm-3 control-label">URL</label>
            <div class="col-sm-8">
                <input type="text"  name="url" value="{{ $menu->url }}" class="form-control" placeholder="Url" required>
            </div>
        </div>
        <div class="form-group  ">
            <label for="order" class="col-sm-3  control-label">{{ config('admin.order')}}</label>
            <div class="col-sm-8">
                <input type="number" id="order" name="order" value="{{ $menu->order }}" class="form-control title" placeholder="{{ config('admin.order')}}">
            </div>
        </div>
        
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ config('admin.close') }}</button>
        <input type="{{ config('admin.submit') }}" class="btn btn-success" />
    </div>
</form>
<script type="text/javascript">

    $(function () {
      $('.icon').iconpicker({placement:'bottomLeft'});
      $(".parent_id").select2({"allowClear":true,"placeholder":{"id":"","text":"Parent"}});
    });
    
    $(document).ready(function () {
        $("#valiEdit").validate();
    });
</script>