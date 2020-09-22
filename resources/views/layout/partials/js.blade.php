<!-- Go To Top
 ============================================= -->
<div id="gotoTop" class="icon-angle-up"></div>

<!-- JavaScripts
 ============================================= -->
<script src="{{ asset('js/jquery.js') }}"></script>

<script src="{{ asset('js/plugins.min.js') }}"></script>

<!-- Footer Scripts
 ============================================= -->
<script src="{{ asset('js/functions.js') }}"></script>

<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
<script src="{{ asset('js/parsley.min.js') }}"></script>


<script>
    var APP_URL = {!! json_encode(url('/')) !!}
    $(function() {
        $('#widget-newsletter-form').parsley();
    });

    function add_newsletter() {
        if ($('#widget-newsletter-form').parsley().validate()) {
            var email = $("#widget-subscribe-form-email").val();
            var source = "HomePage Footer Link";
            $(".form-process").css({
                "display": "block"
            });
            if (email != "") {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'post',
                    url: APP_URL+'home/newsletter',
                    data: {
                        email: email,
                        source: source
                    },
                    success: function(response) {
                        if (response.status) {
                            swal("Thankyou!",
                                "You are subscribed!",
                                "success");
                        } else {
                            swal("Oops!", "Something went wrong, Please try again", "warning");
                        }
                    }
                });
                swal("Thankyou!", "You are subscribed!", "success");

            }
        }

        /* else
       {
        swal("Please Fill All The Details");
       }*/

        return false;
    }

</script>
