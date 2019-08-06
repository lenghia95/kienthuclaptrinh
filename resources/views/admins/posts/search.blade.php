@foreach($posts as $post)
<tr>
    <td>
        <div class="icheckbox_minimal-blue">
            <input type="checkbox" class="grid-row-checkbox" data-id="1" style="position: absolute; opacity: 0;">
        </div>
    </td>
    <td>{{ $post->id }}</td>
    <td>{{ $post->title }}</td>
    <td>
        <img width="100" src="{{ asset($post->thumbnail) }}" class="img-thumbnail" title="{{ $post->title }}" />
    </td>
    <td>
        @php $Cat = new App\Models\PostCategory @endphp
        @foreach ($Cat->getCatsByPostId($post->id) as $cat)
            <span class="btn btn-info btn-xs"> {{ $cat->name }} </span><br>
        @endforeach
    </td>
    <td>
        <a class="btn btn-warning btn-xs">{{ $post->uName }}</a>
    </td>
    <td>
        <input type="checkbox" data-key="{{ $post->id}}" class="grid-switch-status" {{ ($post->status == 1) ? 'checked' : ''}} data-toggle="toggle" data-size="mini">
    </td>
    <td>{{ date('d/m/Y', strtotime($post->created_at)) }}</td>
    <td align="center">
        <a href="{{ route('listposts.show',[$post->id]) }}"><i class="fa fa-eye"></i></a>
        <a href="{{ route('listposts.edit',['id' => $post->id]) }}"><i class="fa fa-edit"></i></a>
        <a href="javascript:void(0)" data-id="{{ $post->id }}" class="grid-row-delete">
            <i class="fa fa-trash"></i>
        </a>
    </td>
</tr>
@endforeach
<script>
    $(function() {

        $('.grid-row-checkbox').iCheck({
            checkboxClass: 'icheckbox_minimal-blue'
        }).on('ifChanged', function() {
            if (this.checked) {
                $(this).closest('tr').css('background-color', '#ffffd5');
            } else {
                $(this).closest('tr').css('background-color', '');
            }
        });

    });
    
    $(document).ready(function () {
        // ajax status
        $('.grid-switch-status').bootstrapSwitch({
            size:'mini',
            onText: 'ON',
            offText: 'OFF',
            onColor: 'primary',
            offColor: 'default',
            onSwitchChange: function(event, state){
                $(this).val(state ? 'on' : 'off');
                var id = $(this).data('key');
                $.ajax({
                    url: "{{ url('/admin/ajax/status_posts')  }}/" + id,
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        _method: 'PUT'
                    },
                    success: function (data) {
                        toastr.success(data);
                    }
                });
            }
        });
    });
     
</script>