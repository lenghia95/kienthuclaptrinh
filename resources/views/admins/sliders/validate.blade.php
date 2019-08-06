<script type="text/javascript">
    $(document).ready(function () {
        $('#valiForm').validate({
            rules: {
                key: {
                    remote: {
                        url: "{{ url('/admin/ajax/unique_slider_key') }}",
                        type: "get",
                        data: {
                            key: function () {
                                return $("input[name='key']").val();
                            },
                            id: function () {
                                return $("input[name='key']").attr('data-id');
                            }
                        },
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