@extends('layout.main')

@section('title', 'Profile')

@section('meta')

@endsection
@section('content')

<!-- Page Title
          ============================================= -->
<section class="search-title">
    <div class="container clearfix">
        <div class="col-md-8 offset-md-2">
            <div class="shadow">

                <div class="input-group input-group-lg mt-1 home-searchbar">

                    <input class="form-control rounded border-0 main-search" type="search"
                        placeholder="Search ends here.." aria-label="Search">
                    <div class="form-group mb-0">
                        <select id="single" class="form-control select2-single">
                            <option value="mu">Mumbai</option>
                            <option value="dh">Delhi</option>
                            <option value="pn">Pune</option>
                            <option value="ke">Kerala</option>
                        </select>
                    </div>
                    <div class="input-group-append search-btn">
                        <button class="btn" type="submit"><i class="icon-line-search font-weight-bold"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- #page-title end -->

<!-- Content
          ============================================= -->
<section id="content">
    <div class="content-wrap">
        <div class="container clearfix">

            <div class="row gutter-40 col-mb-80">

                <!-- Post Content
              ============================================= -->
                <div class="postcontent col-lg-8">
                    <!-- Shop
               ============================================= -->
                    <div id="shop" class="shop row search-inner" data-layout="fitRows">

                        <div class="product no-bs">
                            <div class="grid-inner row ">
                                <div class="product-image col-8 col-lg-5 col-xl-5">
                                    <a href="#"><img src="{{ $user->avatar }}" alt=""></a>
                                    <input type="hidden" id="uid" value="{{ $user->id }}">
                                    <div class="d-flex flex-column align-items-center">
                                        @if(Auth::user())
                                        <a href="#" class="position-relative follow-btn">
                                            @if (Auth::user()->isFollowing($user))
                                                <div class="btn btn-follow followbtn">Unfollow <span class="badge badge-light">{{ $user->follower }}</span></div>
                                            @else 
                                                <div class="btn btn-follow followbtn">Follow <span class="badge badge-light">{{ $user->follower }}</span></div>
                                            @endif
                                            </a> 
                                        @else
                                            <a href="{{ URL::to('login') }}"
                                                class="position-relative">
                                                <div class="btn btn-follow followbtn">Follow {{ $user->follower }}</div>
                                            </a>
                                        @endif
                                        @if(Auth::user())
                                            <a href="" data-toggle="modal" data-target="#questionFormModal"
                                                class="btn btn-follow"><i class="icon-question-sign"></i> Ask a
                                                Question</a>
                                        @else
                                            <a href="{{ URL::to('login') }}"
                                                class="btn btn-follow"><i class="icon-question-sign"></i> Ask a
                                                Question</a>
                                        @endif
                                    </div>


                                </div>
                                <div class="product-desc col-12 col-lg-7 col-xl-7 px-lg-5 pt-lg-0">
                                    <div class="product-title">
                                        <h1 class="mb-2"><a href="#">{{ $user->name }}</a></h1>
                                    </div>
                                    <div class="product-price">{{ $user->qualification }}</div>
                                    <div class="product-rating">
                                        {!! $user->rating !!}
                                    </div>

                                    <p class="mt-3 mb-2 d-none d-lg-block">{{ $user->short_description }}</p>

                                    <p class="text-dark my-0"><strong>{{ $user->answers }}</strong> Questions Answered
                                    </p>
                                <p class="text-dark my-0"><a href="{{ URL::to('member/' . $user->slug  .'/blogs') }}"><strong>{{ $user->stories }}</strong> Blogs</a></p>


                                    <div class="btns">
                                        <a class="btn btn-primary" data-toggle="modal" data-target="#reviewFormModal"><i
                                                class="icon-star3"></i> Write a Review</a>
                                        <!-- <button type="button" class="btn btn-outline-dark"><i class="icon-camera"></i> Add a Photo</button> -->
                                        <button class="btn btn-outline-dark dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="icon-share"></i> Share</button>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" target="_blank"
                                                href="https://www.facebook.com/sharer/sharer.php?u={{ Request::url() }}">Facebook</a>
                                            <a class="dropdown-item" target="_blank"
                                                href="https://twitter.com/intent/tweet?text={{ $user->name }}&amp;url={{ Request::url() }}">Twitter</a>
                                            <a class="dropdown-item" target="_blank"
                                                href="https://wa.me/?text={{ Request::url() }}">Whatsapp</a>
                                            <a class="dropdown-item" target="_blank"
                                                href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ Request::url() }}&amp;title={{ $user->name }}">Linkedin</a>
                                        </div>
                                        {{-- <button type="button" class="btn btn-outline-dark"><i class="icon-bookmark"></i>
                                            Save</button> --}}
                                    </div>



                                </div>
                            </div>
                        </div>


                    </div><!-- #shop end -->

                    @if($user->images)
                        <div class="divider"></div>
                        <h3>Photo Gallery</h3>

                        <div id="oc-portfolio" class="owl-carousel portfolio-carousel carousel-widget" data-pagi="false"
                            data-items-xs="1" data-items-sm="2" data-items-md="3" data-items-lg="3">
                            @foreach(json_decode($user->images, true) as $image)
                                <div class="portfolio-item">
                                    <div class="portfolio-image">
                                        <a href="#">
                                            <img src="{{ asset('img/large/' . $image['image']) }}"
                                                alt="">
                                        </a>
                                        <div class="bg-overlay">
                                            <div class="bg-overlay-content dark" data-hover-animate="fadeIn"
                                                data-hover-speed="350">
                                                <a href="{{ asset('img/original/' . $image['image']) }}"
                                                    class="overlay-trigger-icon bg-light text-dark"
                                                    data-hover-animate="fadeInDownSmall"
                                                    data-hover-animate-out="fadeInUpSmall" data-hover-speed="350"
                                                    data-lightbox="image"><i class="icon-line-plus"></i></a>
                                            </div>
                                            <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"
                                                data-hover-speed="350"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach





                        </div>
                    @endif
                    @if($user->videos)
                        <div class="divider"></div>
                        <h3>Video Gallery</h3>


                        <div id="oc-portfolio" class="owl-carousel portfolio-carousel carousel-widget" data-pagi="false"
                            data-items-xs="1" data-items-sm="2" data-items-md="3" data-items-lg="3">

                            @foreach(json_decode($user->videos, true) as $video)
                                <div class="portfolio-item">
                                    <div class="portfolio-image">
                                        <a href="#">
                                            <img src="{{ asset('img/large/' . $video['image']) }}"
                                                alt="">
                                        </a>
                                        <div class="bg-overlay">
                                            <div class="bg-overlay-content dark" data-hover-animate="fadeIn">
                                                <a href="{{ $video['video'] }}"
                                                    class="overlay-trigger-icon bg-light text-dark"
                                                    data-hover-animate="fadeInDownSmall"
                                                    data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350"
                                                    data-lightbox="iframe"><i class="icon-line-play"></i></a>
                                            </div>
                                            <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach




                        </div>
                    @endif




                    <div class="divider"></div>
                    <h3>Recommended Reviews</h3>

                    <div id="reviews" class="clearfix">

                        <ol class="commentlist clearfix">
                            @foreach($reviews as $review)
                                <li class="comment even thread-even depth-1" id="li-comment-1">
                                    <div id="comment-1" class="comment-wrap clearfix">

                                        <div class="comment-meta">
                                            <div class="comment-author vcard">
                                                <span class="comment-avatar clearfix">
                                                    <img alt="Image"
                                                        src="https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=60"
                                                        height="60" width="60"></span>
                                            </div>
                                        </div>

                                        <div class="comment-content clearfix">
                                            <div class="comment-author">
                                                {{ $review->user->name }}<span>{{ Carbon\Carbon::parse($review->created_at)->format('M d, Y - h:i A') }}</span>
                                            </div>
                                            <p>{{ $review->review }}</p>
                                            <div class="review-comment-ratings">
                                                {!! $review->rating !!}
                                            </div>
                                        </div>

                                        <div class="clear"></div>

                                    </div>
                                </li>
                            @endforeach
                        </ol>

                        @if(Auth::user())
                            <a href="#" data-toggle="modal" data-target="#reviewFormModal"
                                class="button button-3d m-0 float-right">Add a Review</a>
                        @else
                            <a href="{{ URL::to('login') }}"
                                class="button button-3d m-0 float-right">Add a Review</a>
                        @endif

                    </div>
                            {{-- Pagination --}}
                            {{ $reviews->withQueryString()->links() }}

                </div><!-- .postcontent end -->

                <!-- Modal Reviews
                       ============================================= -->
                <div class="modal fade" id="reviewFormModal" tabindex="-1" role="dialog"
                    aria-labelledby="reviewFormModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="reviewFormModalLabel">Submit a Review</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <form class="row mb-0" id="reviewform" name="reviewform"
                                    onsubmit="return reviewformSubmit();" method="post">
                                    <div class="w-100"></div>
                                    <div class="col-12 mb-3">
                                        <label for="template-reviewform-rating">Rating</label>
                                        <div class="form-control">
                                            <span class="rating">
                                                <input type="radio" class="rating-input" id="rating-input-1-5"
                                                    name="rating-input-1" value="5" required>
                                                <label for="rating-input-1-5" class="rating-star" value="1"></label>
                                                <input type="radio" class="rating-input" id="rating-input-1-4"
                                                    name="rating-input-1" value="4">
                                                <label for="rating-input-1-4" class="rating-star" value="2"></label>
                                                <input type="radio" class="rating-input" id="rating-input-1-3"
                                                    name="rating-input-1" value="3">
                                                <label for="rating-input-1-3" class="rating-star" value="3"></label>
                                                <input type="radio" class="rating-input" id="rating-input-1-2"
                                                    name="rating-input-1" value="2">
                                                <label for="rating-input-1-2" class="rating-star" value="4"></label>
                                                <input type="radio" class="rating-input" id="rating-input-1-1"
                                                    name="rating-input-1" value="1">
                                                <label for="rating-input-1-1" class="rating-star" value="5"></label>
                                            </span>
                                        </div>
                                        @error('rating')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                    </div>

                                    <div class="w-100"></div>

                                    <div class="col-12 mb-3">
                                        <label for="reviewform-review">Review <small>*</small></label>
                                        <textarea class="required form-control" id="reviewform-review" required
                                            name="reviewform-review" rows="6" cols="30"></textarea>
                                    </div>

                                    <div class="col-12">
                                        <button class="button button-3d m-0" type="submit" id="reviewform-submit"
                                            name="reviewform-submit" value="submit">Submit Review</button>
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
				<!-- Modal Reviews End -->
				
				
                <!-- Modal Question
                       ============================================= -->

                <div class="modal fade" id="questionFormModal" tabindex="-1" role="dialog"
                    aria-labelledby="questionFormModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="questionFormModalLabel">Ask a Question</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <form class="row mb-0" id="questionform" name="questionform"
                                    onsubmit="return questionformSubmit();" method="post">
                                    <div class="w-100"></div>
                                    <div class="col-12 mb-3">
                                        <label for="questionform-question">Question <small>*</small></label>
                                        <textarea class="required form-control" id="questionform-question"
                                            name="questionform-question" rows="6" cols="30"></textarea>
                                    </div>

                                    <div class="col-12">
                                        <button class="button button-3d m-0" type="submit" id="questionform-submit"
                                            name="questionform-submit" value="submit">Submit Question</button>
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <!-- Modal Question End -->


                <!-- Modal Consultation
                       ============================================= -->

                <div class="modal fade" id="consultationFormModal" tabindex="-1" role="dialog"
                    aria-labelledby="consultationFormModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="consultationFormModalLabel">Book a Consultation</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <form class="row mb-0" id="consultationform" name="consultationform"
                                    onsubmit="return consultationformSubmit();" method="post">
                                    <div class="w-100"></div>
                                    <div class="col-12 mb-3">
                                        <label for="consultationform-datetime">Consultation Date and Time
                                            <small>*</small></label>
                                        <input type="datetime-local" class="required form-control" required
                                            id="consultationform-datetime" name="consultationform-datetime">
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="consultationform-comment">Comment</label>
                                        <textarea class="required form-control" id="consultationform-comment"
                                            name="consultationform-comment" rows="6" cols="30"></textarea>
                                    </div>

                                    <div class="col-12">
                                        <button class="button button-3d m-0" type="submit" id="consultationform-submit"
                                            name="consultationform-submit" value="submit">Request consultation</button>
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <!-- Modal Consultation End -->
                <!-- Sidebar
              ============================================= -->
                <div class="sidebar col-lg-4 d-block">
                    <div class="sidebar-widgets-wrap">

                        <div class="widget widget_links text-center">

                            <h4>Request a Consultation</h4>
                            <div class="d-flex justify-content-center align-items-center center-line">
                                <div class="left">
                                    <small>Response time</small>
                                    <h4 class="text-info">{{ minutesConverter($user->response_time) }}</h4>
                                </div>
                                <div class="">
                                    <small>Response Rate</small>
                                    <h4 class="text-info">{{ $user->response_rate }}%</h4>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <input class="form-control" type="" name="" value="I am interested">
                            </div>
                            @if(Auth::user())
                                <div class="btn btn-primary btn-block my-3 " data-toggle="modal"
                                    data-target="#consultationFormModal">Request a Consultation</div>
                            @else
                                <a href="{{ URL::to('login') }}"
                                    class="btn btn-primary btn-block my-3 ">Request a
                                    Consultation</a>
                            @endif
                            @if($user->responses > 0)
                                <small class="mb-0">{{ $user->responses }} user(s) recently requested a
                                    consultation</small>
                            @endif

                        </div>

                        <!-- <div class="widget widget_links text-center">
                 <i class="i-circled icon-call icon-2x float-none mb-3"></i>
                 <h4>Ask  for consultation</h4>
                 
                 <div class="btn btn-primary btn-block my-3">Call for details</div>

                </div> -->


                        <div class="list-group mt-5">
                            @if($user->display_email > 0)
                                <a href="#" class="list-group-item list-group-item-action d-flex">
                                    <i class="icon-globe mr-3"></i>
                                    <div>{{ $user->email }}</div>
                                </a>
                            @endif
                            @if($user->display_mobile > 0)
                                <a href="#" class="list-group-item list-group-item-action d-flex">
                                    <i class="icon-call mr-3"></i>
                                    <div>{{ $user->mobile }}</div>
                                </a>
                            @endif
                        </div>



                    </div>
                </div><!-- .sidebar end -->


            </div>

        </div>
    </div>
</section><!-- #content end -->
@endsection


@section('js')
<script src="{{ asset('js/readmore.min.js') }}"></script>
<script>
    $(document).ready(function () {

        $('#show-filter').click(function () {
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

</script>
<script type="text/javascript">
    $(function () {
        $('#reviewform').parsley();
        $('#questionform').parsley();
        $('#consultationform').parsley();
    });

    function reviewformSubmit() {
        if ($('#reviewform').parsley().validate()) {
            var rating = $("input[name='rating-input-1']:checked").val();
            var review = $("#reviewform-review").val();
            var member_id = $("#uid").val();

            if (rating != "" && review != "") {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'post',
                    url: APP_URL + '/member/review',
                    data: {
                        rating: rating,
                        review: review,
                        member_id: member_id,
                        user_id: 0

                    },
                    success: function (response) {
                        if (response.status) {
                            swal("Thankyou!",
                                "We have recieved your request, someone from our team will contact you shortly!",
                                "success");
                                $('.modal').modal('hide');
                        } else {
                            swal("Oops!", "Something went wrong, Please try again", "warning");
                        }
                    }
                });
                // swal("Thankyou!", "We have recieved your request, someone from our team will contact you shortly!",
                //     "success");
            }
        }

        /* else
           {
            swal("Please Fill All The Details");
           }*/

        return false;
    }

    function questionformSubmit() {
        if ($('#questionform').parsley().validate()) {
            var question = $("#questionform-question").val();
            var member_id = $("#uid").val();

            if (question != "") {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'post',
                    url: APP_URL + '/member/question',
                    data: {
                        title: question,
                        member_id: member_id

                    },
                    success: function (response) {
                        if (response.status) {
                            swal("Thankyou!",
                                "You have successfully submitted your Question, We'll notify as soon as Expert answers"
                            );
                            $('.modal').modal('hide');
                        } else {
                            swal("Oops!", "Something went wrong, Please try again", "warning");
                        }
                    }
                });
                swal("Thankyou!",
                    "You have successfully submitted your Question, We'll notify as soon as Expert answers",
                    "success");
            }
        }

        /* else
           {
            swal("Please Fill All The Details");
           }*/

        return false;
    }

    function consultationformSubmit() {
        if ($('#consultationform').parsley().validate()) {
            var comment = $("#consultationform-comment").val();
            var datetime = $("#consultationform-datetime").val();
            var member_id = $("#uid").val();

            if (datetime != "") {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'post',
                    url: APP_URL + '/member/consultation',
                    data: {
                        comment: comment,
                        consultation_datetime: datetime,
                        member_id: member_id,
                        user_id: 0
                    },
                    success: function (response) {
                        if (response.status) {
                            swal("Thankyou!",
                                "We have recieved your request, We'll notify once Expert Confirms",
                                "success");
                            $(".form-process").css({
                                "display": "none"
                            });
                            $('.modal').modal('hide');
                        } else {
                            swal("Oops!", "Something went wrong, Please try again", "warning");
                        }
                    }
                });
                swal("Thankyou!", "We have recieved your request, We'll notify once Expert Confirms",
                    "success");
            }
        }

        /* else
           {
            swal("Please Fill All The Details");
           }*/

        return false;
    }

    $('.follow-btn').click(function () {
        $member_id = $('#uid').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: APP_URL + '/member/follow',
            data: {
                member_id: $member_id
            },
            success: function (response) {
                if (response.status) {
                    $('.followbtn').html('Unfollow ' + response.count);
                } else {
                    $('.followbtn').html('Follow ' + response.count);
                }
                // $('#like-' + $answerid).html(response.likecpy);
            }
        });
    });

</script>

@endsection
