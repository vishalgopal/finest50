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
<script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>


<script>
    var APP_URL = {!!json_encode(url('/')) !!}
    $(document).ready(function() {

        $('.cd-search-trigger, .cd-search-suggestions').click(function(e) {
            if ($(e.target).attr('id') != 'close-btn') {
                $('.cd-search-suggestions').show();
                event.stopPropagation();
            }
        });
        $('body').click(function() {
            $('.cd-search-suggestions').hide();
        });

    });
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
                    url: APP_URL + 'home/newsletter',
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
    // function search(event){
    //     alert('search')
    //     // event.preventDefault();
    //     $type = $('#type').val();   
    //     $query = $('#query').val();
    //     $location = $('#location').val();
    //     if ($query.length > 2 ){
    //         alert($query);
    //         window.location.href = APP_URL + "/search/" + $type + "/" + $query + "/" +"?location=" + $location;
    //     }
    //     else{

    //     }
    // }

    // your function
var search = function(event) {
        event.preventDefault();
        $type = $('#type').val();   
        $query = $('#query').val();
        $location = $('#location').val();
        if ($query.length > 2 ){
            window.location.href = APP_URL + "/search/" + $type + "/" + $query + "/" +"?location=" + $location;
        }
        else{

        }
    // event.preventDefault();
};

// your form
var form = document.getElementById("searchbar");

// attach event listener
form.addEventListener("submit", search, true);

</script>
