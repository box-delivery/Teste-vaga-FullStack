<script src="{{ asset("Auth-Panel/assets/node_modules/jquery/jquery-3.2.1.min.js") }}"></script>
<script src="{{ asset("Auth-Panel/assets/node_modules/popper/popper.min.js") }}"></script>
<script src="{{ asset("Auth-Panel/assets/node_modules/bootstrap/dist/js/bootstrap.min.js") }}"></script>
<script src="{{ asset('jquery.mask.js') }}"></script>
<script type="text/javascript">
    $(function() {
        $(".preloader").fadeOut();
    });
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    });
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
</script>

@includeIf("Global.masks")
@includeIf("Global.via_cep")
@includeIf("Global.sweetalert")

<script>
    var type_user = $("#type_user");
    var div_email = $(".div-email");
    var div_registration = $(".div-registration");
    var input_email = div_email.find("input");
    var input_registration = div_registration.find("input");

    div_email.hide();
    div_registration.hide();

    @error("email")
        div_email.show();
    @enderror

    @error("registration")
        div_registration.show();
    @enderror

    type_user.change(function (event) {
        event.preventDefault();
        if($(this).val()==1)
        {
            div_registration.fadeIn();
            div_email.hide();

            input_email.attr("disabled", true);
            input_registration.attr("disabled", false);
        }
        else
        {
            div_registration.hide();
            div_email.fadeIn();

            input_email.attr("disabled", false);
            input_registration.attr("disabled", true);
        }
    });
</script>
