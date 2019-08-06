<script type="text/javascript">
    $(document).ready(function(){
        $("#valiForm").validate({
            rules: {
                title: {
                    required: true,
                    maxlength: 255,
                },
                slug: {
                    required: true,
                    maxlength: 255
                },
                noidung: {
                    required: true,
                },
            },
            messages: {
                title: {
                    required:  "Vui lòng nhập tiêu đề",
                    maxlength: "Tên không được nhiều hơn 255 ký tự"
                },
                slug: {
                    required:  "Vui lòng nhập slug",
                    maxlength: "Tên không được nhiều hơn 255 ký tự"
                },
                noidung: {
                    required:  "Vui lòng nhập mật khẩu",
                },
            }
        });
    });
</script>
