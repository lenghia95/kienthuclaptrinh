<script type="text/javascript">
    $(document).ready(function(){
        $("#valiForm").validate({
            rules: {
                username: {
                    required: true,
                    minlength: 2,
                    maxlength: 20
                },

                email:    {
                    required: true,
                    email: true,
                    remote: {
                        url: "{{ url('/admin/ajax/user_unique_email') }}",
                        type: "get",
                        data: {
                            email: function () {
                                return $("input[name='email']").val();
                            },
                            id: function () {
                                return $("input[name='email']").attr('data-id');
                            }
                        },
                        dataFilter: function (data) {
                            var json = JSON.parse(data);
                            if (json.msg == "true") {
                                return "\"" + "This value exists in database" + "\"";
                            } else {
                                return 'true';
                            }
                        }
                    },
                },
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 32
                },
                repassword: {
                    equalTo: "#password",
                },
                phone: {
                    minlength: 10,
                    maxlength: 11
                }
            },
            /*messages: {
                username: {
                    required:  "Vui lòng nhập tên",
                    minlength: "Tên không được ít hơn 2 ký tự",
                    maxlength: "Tên không được nhiều hơn 20 ký tự"
                },
                email: {
                    required:  "Vui lòng nhập email",
                    email:     "Bạn phải nhập đúng định dạng email",
                    // remote:    "Email đã tồn tại"
                },
                password: {
                    required:  "Vui lòng nhập mật khẩu",
                    minlength: "Mật khẩu không được ít hơn 6 ký tự",
                    maxlength: "Mật khẩu không được nhiều hơn 32 ký tự"
                },
                repassword: {
                    equalTo: "Mật khẩu chưa khớp",
                },
                roles: {
                    required: "Vui lòng chọn vai trò",
                }
            }*/
        });
    });
</script>
