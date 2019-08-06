<script type="text/javascript">
    $(document).ready(function () {
        $("#valiForm").validate({
            rules: {
                slug: {
                    remote: {
                        url: "{{ url('/admin/ajax/posts_unique_slug') }}",
                        type: "get",
                        data: {
                            url: function () {
                                return $("input[name='slug']").val();
                            },
                            id: function () {
                                return $("input[name='slug']").attr('data-id');
                            },
                        },
                        async:false,
                        dataFilter: function (data) {
                            var json = JSON.parse(data);
                            if (json.msg == "true") {
                                return "\"" + "This value exists in database." + "\"";
                            } else {
                                return 'true';
                            }
                        }
                    },
                },
            },
        });
    });
</script>    
