

<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('vendors/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Morris.js charts -->
<script src="{{ asset('vendors/bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('vendors/bower_components/morris.js/morris.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('vendors/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
 <script src="{{ asset('vendors/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
 <script src="{{ asset('vendors/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('vendors/bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('vendors/bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('vendors/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('vendors/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('vendors/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('vendors/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('vendors/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('vendors/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('vendors/dist/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('vendors/dist/js/demo.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('vendors/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendors/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{ asset('vendors/plugins/iCheck/icheck.min.js')}}"></script>
<!-- fileinput -->
<script src="{{ asset('vendors/plugins/bootstrap-fileinput/js/fileinput.min.js')}}"></script>
<!-- Select2 -->
<script src="{{ asset('vendors/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<!-- Switch bootstrap -->
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.5.0/js/bootstrap4-toggle.min.js"></script>
<!-- Toastr bootstrap -->
<script src="{{ asset('vendors/plugins/toastr/build/toastr.min.js')}}"></script>
<!-- Custom Sweet alert bootstrap -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- pjax alert bootstrap -->
<script src="https://raw.github.com/defunkt/jquery-pjax/master/jquery.pjax.js"></script>
<!-- CK Editor -->
<script src="{{ asset('vendors/bower_components/ckeditor/ckeditor.js') }}"></script>
<!-- NestTable -->
<script src="{{ asset('vendors/plugins/nestable/nestable.js') }}"></script>
<!-- Icon picker -->
<script src="{{ asset('vendors/plugins/fontawesome-iconpicker/dist/js/fontawesome-iconpicker.min.js') }}"></script>

@stack('script')
<script type="text/javascript">
    $(function () {
        CKEDITOR.replace('content',{
            fullPage: true,
            allowedContent: true,
            autoGrow_onStartup: true,
            enterMode: CKEDITOR.ENTER_BR
        });
        $('.minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-red'
        });
        $("input.avatar").fileinput({"overwriteInitial":true,"initialPreviewAsData":true,"browseLabel":"Browse","showRemove":false,"showUpload":false,"deleteExtraData":{"avatar":"_file_del_","_file_del_":"","_token":"2EXIWpYuxecTOZhhEKr1oU0PEYYb6TMPfzhWyNiG","_method":"PUT"},"deleteUrl":"http:\/\/shopcart.local\/admin\/auth\/","allowedFileTypes":["image"]});
        $('.icon').iconpicker();
        $('.icp-auto').iconpicker();

        $(".parent_id").select2({"allowClear":true,"placeholder":{"id":"","text":"Parent"}});
        $(".category").select2();
        $('#example').DataTable();

    });

    $(document).ready(function() {
        $(document).on('change', '.edit-status', function(){
            var vale = $(this).val();
            var value= (vale == 1) ? 0 : 1;
            $(this).val(value);
            $('input[name=status]').val(value);
        });

        $(document).on("change", ".custom-file-input", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

    });
</script>
</body>
</html>
