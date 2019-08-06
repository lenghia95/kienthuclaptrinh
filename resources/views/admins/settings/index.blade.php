@extends("admins.layouts.app")

@section("content")

<div class="box box-success">
	<!--<div class="box-header"></div>-->
	<div class="box-body">
        <form action="" method="POST" class="" enctype="multipart/form-data">
        <div class="col-md-12 bhoechie-tab-container">
            <div class="col-md-12 text-right">
                <div class="form-group" style="margin-top: 10px; margin-bottom:10px">
                    {!! csrf_field()  !!}
                    <h4 style="float:left; font-weight: bold;">Settings</h4>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save Config</button>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu">
                <div class="list-group">
                    @foreach( $settings['tabs'] as $index => $option)
                    <a href="#" class="list-group-item @if ( $index == 0 ) active @endif ">
                        <p class=""><i class="fa fa {{ $option['icon'] or '' }}" ></i> {{ $option['title']  }}</p>
                    </a>
                    @endforeach

                </div>
            </div>

            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
                @foreach( $settings['tabs'] as $key => $option)

                    @if( !isset($settings['content'][$option['id']] ))
                    <div class="bhoechie-tab-content " id="{{ $option['id'] }}">
                    </div>
                    @else
                    <!-- flight section -->
                    <div class="bhoechie-tab-content @if($key == 0) active @endif" id="{{ $option['id'] }}">
                        @foreach($settings['content'][$option['id']] as $key => $field)
                        
                            <div class="form-group">
                                <label>{{ $field['title'] ?? ''}}</label>
                                {!! $inputRender->make($field['type'], $field['id'], $field['value'] ,['default'=>$setting->getValue($field['id'], $field['value']),'class'=>'form-control', 'placeholder'=>$field['title']]) !!}

                            </div>
                        @endforeach
                    </div>
                    @endif
                @endforeach

            </div>

        </div>
        </form>
	</div>
</div>

@endsection

@push('link')
<style>
    /*  bhoechie tab */
    .list-group-item{
        padding: 0;
        background: #ecf0f5;
    }
    .list-group-item p{
        padding: 8px;
        margin: 0;
        padding-left: 30px;
    }
    .list-group-item.active, .list-group-item.active:hover, .list-group-item.active:focus{
        border-color: #ecf0f5;
        background-color: #d8dde4;
    }
    div.bhoechie-tab-container{
    z-index: 10;
    background-color: #ecf0f5;
    padding: 0 !important;
    border-radius: 4px;
    -moz-border-radius: 4px;
    border:1px solid #ddd;
    margin-top: 20px;
    -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
    box-shadow: 0 6px 12px rgba(0,0,0,.175);
    -moz-box-shadow: 0 6px 12px rgba(0,0,0,.175);
    background-clip: padding-box;
    opacity: 0.97;
    filter: alpha(opacity=97);
    }
    div.bhoechie-tab-container .odd{

    }
    div.bhoechie-tab-container .even{

    }
    div.bhoechie-tab-menu{
    padding-right: 0;
    padding-left: 0;
    padding-bottom: 0;
    }
    div.bhoechie-tab-menu div.list-group{
    margin-bottom: 0;
    }
    div.bhoechie-tab-menu div.list-group>a{
    margin-bottom: 0;
    }
    div.bhoechie-tab-menu div.list-group>a .glyphicon,
    div.bhoechie-tab-menu div.list-group>a .fa {
        padding-right: 10px;
    }
    div.bhoechie-tab-menu div.list-group>a:first-child{
    border-top-right-radius: 0;
    -moz-border-top-right-radius: 0;
    }
    div.bhoechie-tab-menu div.list-group>a:last-child{
    border-bottom-right-radius: 0;
    -moz-border-bottom-right-radius: 0;
    }
    div.bhoechie-tab-menu div.list-group>a.active,
    div.bhoechie-tab-menu div.list-group>a.active .glyphicon,
    div.bhoechie-tab-menu div.list-group>a.active .fa{
    background-color: #d8dde4;
    background-image: #d8dde4;
    color: #10cfbd;
        font-weight: bold;
    }
    div.bhoechie-tab-menu div.list-group>a.active:after{
    content: '';
    position: absolute;
    left: 100%;
    top: 50%;
    margin-top: -13px;
    border-left: 0;
    border-bottom: 13px solid transparent;
    border-top: 13px solid transparent;
    border-left: 10px solid #d8dde4;
    }

    div.bhoechie-tab-content{
    background-color: #ecf0f5;
    }

    div.bhoechie-tab div.bhoechie-tab-content:not(.active){
    display: none;
    }
    </style>
@endpush

@push('script')
<script>
$(function () {
    $("div.bhoechie-tab>div.bhoechie-tab-content").eq(0).addClass("active");
    $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
    });
	$("#setting-add-form").validate({
		
	});
});

</script>
@endpush
