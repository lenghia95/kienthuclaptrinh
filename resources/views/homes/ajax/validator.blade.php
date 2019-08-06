<script>
    $(document).ready(function () {
        $('#loginForm').validate({
            rules:{
                email: {
                    required:true,
                    email:true,
                },
                password:{
                    required:true,
                }
            },
            messages:{
                email: {
                    required: 'Vui lòng nhập địa chỉ email',
                    email: "Email chưa chính xác",
                },
                password:{
                    required:'Vui lòng nhập mật khẩu đăng nhập',
                }
            }
        });

        $('#registerForm').validate({
            rules:{
                username: {
                    required:true,
                    minlength:2,
                    maxlength:20
                },
                email: {
                    required:true,
                    email:true,
                    remote: {
                        url: "{{ url('/ajax/unique-email') }}",
                        type: "get",
                        data: {
                            email: function () {
                                return $("#register_email").val();
                            },
                        },
                        dataFilter: function (data) {
                            var json = JSON.parse(data);
                            if (json.msg == "true") {
                                return "\"" + "Email đã tồn tại!!" + "\"";
                            } else {
                                return 'true';
                            }
                        }
                    },
                },
                password:{
                    required:true,
                    minlength:6,
                    maxlength:32
                },
                repassword:{
                    equalTo: "#password"
                }
            },
            messages:{
                username: {
                    required:'Vui lòng nhập tên',
                    minlength: 'Tên phải ít nhất 2 ký tự',
                    maxlength: "Tên phải nhiều nhất 20 ký tự"
                },
                email: {
                    required: 'Vui lòng nhập địa chỉ email',
                    email: "Email chưa chính xác",
                },
                password:{
                    required:'Vui lòng nhập mật khẩu đăng nhập',
                    minlength: "Mật khẩu phải ít nhất 6 ký tự",
                    maxlength:'Mật khẩu phải nhiều nhất 32 ký tự'
                },
                repassword:{
                    equalTo: "Xác nhận mật khẩu chưa chính xác"
                }
            }
        });
        
    });
</script>