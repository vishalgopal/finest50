@extends('layout.main')

@section('title', 'Search')

@section('meta')

@endsection
@section('content')
    <!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">

					<div class="btn btn-secondary btn-sm" id="show-filter"><i class="icon-line-menu"></i> Filters</div>

					<div class="row gutter-40 col-mb-80">
						<!-- Post Content
						============================================= -->
						<div class="postcontent col-lg-9">

							<!-- Posts
					============================================= -->
					<div id="posts" class="post-grid row grid-container gutter-40 clearfix" data-layout="fitRows">
                        @foreach ($blogs as $blog)
						<div class="entry col-md-4 col-sm-6 col-12">
							<div class="grid-inner">
								<div class="entry-image">
									<a href="{{ URL::to('blog/'.$blog->slug) }}"><img src="{{ asset('img/large/' . $blog->image) }}" alt=""></a>
								</div>
								<div class="entry-title">
									<h2><a href="{{ URL::to('blog/'.$blog->slug) }}">{{ $blog->title }}</a></h2>
								</div>
								<div class="entry-meta">
									<ul>
										<li><i class="icon-calendar3"></i> {{ Carbon\Carbon::parse($blog->created_at)->format('M d, Y') }}</li>
										<li><a href="{{ URL::to('blog/'.$blog->slug) }}#comments"><i class="icon-comments"></i> {{ $blog->comment_count }}</a></li>
									</ul>
								</div>
								<div class="entry-content">
									<p>{{ strip_tags(substr($blog->description,150)) }}</p>
									<a href="{{ URL::to('blog/'.$blog->slug) }}" class="more-link">Read More</a>
								</div>
							</div>
                        </div>
                        @endforeach
					</div>	
							

						</div><!-- .postcontent end -->


						<!-- Sidebar
						============================================= -->
						<div class="sidebar col-lg-3">
							<div class="sidebar-widgets-wrap">

								<div class="widget widget_links clearfix">

									<h4>Blog Categories</h4>
									<ul>
                                        @foreach ($categories as $category)
                                            <li><a href="{{ URL::to('blogs/'.$category->slug) }}">{{ $category->title }}</a></li>
                                        @endforeach
									</ul>

								</div>

							</div>
						</div><!-- .sidebar end -->

						
					</div>
                    {{-- Pagination --}}
                    {{ $blogs->withQueryString()->links() }}
				</div>
			</div>
		</section><!-- #content end -->

@endsection


@section('js')
    <script src="{{ asset('js/readmore.min.js') }}"></script>
    <script>
		$( document ).ready(function() {

		$('#show-filter').click(function(){
			$('.sidebar').toggleClass('show-sidebar');
			$('.sidebar').toggle();
			$('.cat-filter').readmore({
  			speed: 75,
  			lessLink: '<a href="#">Read less</a>'
		});

		});
		});

		$('.cat-filter').readmore({
  			speed: 75,
  			lessLink: '<a href="#">Read less</a>'
		});

	</script>

    <script>
        $(document).ready(function() {

            $('#show-filter').click(function() {
                // $('.sidebar').toggleClass('show-sidebar');
                $('.sidebar').toggle();
                $('.cat-filter').readmore({
                    speed: 75,
                    lessLink: '<a href="#">Read less</a>'
                });

            });
        });

        $('.cat-filter').readmore({
            speed: 75,
            lessLink: '<a href="#">Read less</a>'
        });

        $('#btn-apply-filter').click(function() {
            $('#btn-apply-filter i').toggleClass('icon-angle-up1');
            // $('i').addClass('icon-angle-up1');
        })
        $('.filter').click(function(){
            var categories = [];
                $.each($("input[name='categories']:checked"), function(){
                    categories.push($(this).val());
            });
            var url = new URL(document.location);
            var params = url.searchParams;
            var sortby = params.get("sortby");
            if(sortby)
            {
               document.location = APP_URL + '/members/' + categories.join(",") + "?sortby=" + sortby ;
            }
            else
            {
               document.location = APP_URL + '/members/' + categories.join(",");
            }
        })
    </script>
    <script type="text/javascript">
        $(function() {
            $('#contactform').parsley();
        });

        function save_contact() {
            if ($('#contactform').parsley().validate()) {
                var firstname = $("#contactform-firstname").val();
                var lastname = $("#contactform-lastname").val();
                var email = $("#contactform-email").val();
                var phone = $("#contactform-phone").val();
                var category_id = $("#contactform-category_id").val();
                var subject = $("#contactform-subject").val();
                var message = $("#contactform-message").val();
                var phone_code = $("#contactform-phone_code").val();

                if (firstname != "" && email != "") {
                    $(".form-process").css({
                        "display": "block"
                    });
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'post',
                        url: 'contact/submit',
                        data: {
                            firstname: firstname,
                            lastname: lastname,
                            email: email,
                            phone: phone,
                            category_id: category_id,
                            subject: subject,
                            message: message,
                            phone_code: phone_code,
                        },
                        success: function(response) {
                            if (response.status) {
                                swal("Thankyou!",
                                    "We have recieved your request, someone from our team will contact you shortly!",
                                    "success");
                                $(".form-process").css({
                                    "display": "none"
                                });
                            } else {
                                swal("Oops!", "Something went wrong, Please try again", "warning");
                            }
                        }
                    });
                    swal("Thankyou!", "We have recieved your request, someone from our team will contact you shortly!",
                        "success");
                    $(".form-process").css({
                        "display": "none"
                    });
                }
            }

            /* else
           {
            swal("Please Fill All The Details");
           }*/

            return false;
        }

    </script>

@endsection
