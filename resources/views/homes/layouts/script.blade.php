
<a href="javascript:void(0)" id="goTop"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>

<script src="{{ asset('homes/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('js/share.js') }}"></script>
<script src="{{ asset('homes/js/popper.min.js') }}"></script>
<script src="{{ asset('homes/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('homes/js/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('homes/navbar/js/bootnavbar.js') }}"></script>
<script src="{{ asset('homes/js/slick.min.js') }}"></script>
<script src="{{ asset('homes/js/jquery-custom.js') }}"></script>
@stack('script')

@include('homes.ajax.validator')

<script type="text/javascript">

    $(document).ready(function() {
        $(window).resize(function(){
            if ($(window).width() >= 980){

                $(".navbar .dropdown-toggle").hover(function () {
                    $(this).parent().toggleClass("show");
                    $(this).parent().find(".dropdown-menu").toggleClass("show");
                });

                $( ".navbar .dropdown-menu" ).mouseleave(function() {
                    $(this).removeClass("show");
                });
            }
        });
        
    });
    $(function () {
        $('#main_navbar').bootnavbar();
    })
    

    function myFunction() {
        document.getElementById("myAccount").classList.toggle("show");
    }
    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("account-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
            }
        }
        }
    }
</script>


<!-- Facebook -->
<script type="text/javascript">
    // Disable form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Get the forms we want to add validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    window.fbAsyncInit = function() {
        FB.init({
            xfbml: true,
            version: 'v3.2'
        });
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    
</script>

<!-- Your customer chat code -->
<div class="fb-customerchat"
  attribution=setup_tool
  page_id="437132143495931">
</div>
<!-- Facebook -->

