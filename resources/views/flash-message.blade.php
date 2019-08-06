@if(session('save_succeeded'))
    <script type="text/javascript">
        $(function() {
            toastr.success("{{ session('save_succeeded') }}");
        });
    </script>
@endif

@if(session('update_succeeded'))
    <script type="text/javascript">
        $(function() {
            toastr.success("{{ session('update_succeeded') }}");
        });
    </script>
@endif

@if(session('delete_succeeded'))
    <script type="text/javascript">
        $(function() {
            toastr.success("{{ session('delete_succeeded') }}");
        });
    </script>
@endif

@if(session('refresh_succeeded'))
    <script type="text/javascript">
        $(function() {
            toastr.success("{{ session('refresh_succeeded') }}");
        });
    </script>
@endif

@if(session('login_successful'))
    <script type="text/javascript">
        $(function() {
            toastr.success("{{ session('login_successful') }}");
        });
    </script>
@endif

@if(session('failed'))
    <script type="text/javascript">
        $(function() {
            toastr.error("{{ session('failed') }}");
        });
    </script>
@endif
