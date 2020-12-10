@extends('layout.main')

@section('title', 'Home Page')

@section('content')

    @include('layout.partials.home-slider')
    <!-- Content
      ============================================= -->
    <section id="content">
        <div class="content-wrap mob-pt-0" style="overflow: visible;">
          

            <!-- Members Section
        ============================================= -->
        <div class="section bg-transparent mt-0 mb-0">
                <div class="container">

                    <div class="heading-block border-bottom-0 mb-5 center">
                        <h3>Most Popular Members</h3>
                        <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla natus mollitia ipsum.
                            Voluptatibus, perspiciatis placeat.</span>
                    </div>

                    <div class="clear"></div>

                    <div class="row">
                        <div class="col-12">
                            <!-- carousel begin -->
                            <div class="owl-carousel owl-carousel-full image-carousel carousel-widget" data-margin="40"
                                data-center="false" data-loop="true" data-autoplay="5000" data-nav="true" data-pagi="true"
                                data-items-xs="1" data-items-sm="2" data-items-md="3" data-items-lg="3" data-items-xl="4">
                                @foreach ($members as $member)
                                    <div class="oc-item">
                                        <div
                                            class="feature-box hover-effect shadow-sm fbox-center fbox-bg fbox-light fbox-lg fbox-effect">
                                            <a href="{{ URL::to('member/'.$member->slug) }}">
                                            <div class="fbox-icon">
                                                    <i><img src="{{ $member->avatar }}"
                                                            class="border-0 bg-transparent shadow-sm" height="128" width="128" style="z-index: 2;"
                                                            alt="{{ $member->name }}"></i>
                                            </div>
                                            </a>
                                            <div class="fbox-content">
                                                <h3 class="mb-4 nott ls0"><a href="{{ URL::to('member/'.$member->slug) }}"
                                                        class="text-dark">{{ $member->name }}</a><br>
                                                        <small class="subtitle nott color"><a href="{{ URL::to('members/' . $member->category->slug) }}">{{ $member->category->title }}</a></small>
                                                </h3>
                                                <p class="text-dark"><strong>{{ $member->follower }}</strong> Followers</p>
                                            <p class="text-dark mt-0"><a href="{{ URL::to('member/' . $member->slug . '/blogs') }}"><strong>{{ $member->stories }}</strong> Stories</a>
                                                </p>
                                                @if (Auth::user())
                                                    <a class="follow-btn" data-uid="{{ $member->id }}">
                                                    @if (Auth::user()->isFollowing($member))
                                                        <div class="btn btn-follow ">Unfollow</div>
                                                    @else 
                                                        <div class="btn btn-follow ">Follow</div>
                                                    @endif
                                                    </a>
                                                @else
                                                    <a href="{{ URL::to('/login') }}"><div class="btn btn-follow ">Follow</div></a>   
                                                @endif

                                                
                                            </div>
                                        </div>
                                    </div>
                                @endforeach






                            </div>
                            <!-- carousel end -->
                        </div>



                    </div>
                </div>
            </div>

            <div class="container text-center">
                <img src="{{ asset('images/Eagleish-banner-1.jpg') }}" alt="Ad" class="img-width m-auto d-none d-sm-block">
                <img src="{{ asset('images/Eagleish-banner-400.jpg') }}" alt="Ad" class="img-width m-auto d-block d-sm-none">
            </div>            
            
<!-- Categories -->
            
            <div class="section pop-stories-bg">
            <div class="container">

                <div class="heading-block border-bottom-0 my-4 mob-my center">
                    <h3>Popular Categories</h3>
                    <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla natus mollitia ipsum.
                        Voluptatibus, perspiciatis placeat.</span>
                </div>

                <div class="row course-categories clearfix mb-4">
                    @foreach ($categories as $category)
                        <div class="col-lg-2 col-sm-3 col-6 mt-4">
                            <div class="card hover-effect">
                                <img class="card-img" src="img/small/{{ $category->image }}" alt="Card image">
                                <a href="{{ URL::to('/members/' . $category->slug) }}" class="card-img-overlay rounded p-0"
                                    style="background-color: rgba({{ rand(1, 251) }},{{ rand(1, 251) }},{{ rand(1, 251) }},0.8);">
                                    <span><i class="icon-music1"></i>{{ $category->title }}</span>
                                </a>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="clear"></div>
                <div class="row justify-content-center">
                    <a href="#" class="button button-rounded button-xlarge ls0 ls0 nott font-weight-bold m-0">View All</a>
                </div>

            </div>
            </div>

            <!-- Popular Stories
        ============================================= -->
            <div class="section topmargin-lg parallax mb-0">


                <div class="container">

                    <div class="heading-block border-bottom-0 mb-5 center">
                        <h3>Popular Stories</h3>
                        <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla natus mollitia ipsum.
                            Voluptatibus, perspiciatis placeat.</span>
                    </div>

                    <div class="clear"></div>

                    <div class="row mt-2">

                        <!-- Categories 
           ============================================= -->
                        @foreach ($blogs as $blog)
                            <div class="col-md-4 mb-5">
                                <div class="card course-card hover-effect border-0 h-100">
                                    <a href="{{ URL::to('/blog/' . $blog->slug) }}"><img class="card-img-top"
                                            src="img/large/{{ $blog->image }}" alt="Card image cap"></a>
                                    <div class="card-body">
                                        <h4 class="card-title font-weight-bold mb-2"><a
                                                href="{{ URL::to('/blog/' . $blog->slug) }}">{{ $blog->title }}</a></h4>
                                        <p class="mb-2 card-title-sub text-uppercase font-weight-normal ls1"><a
                                                href="{{ URL::to('/member/' . $blog->user->slug) }}"
                                                class="text-black-50">{{ $blog->user->name }}</a></p>
                                        <p class="card-text text-black-50 mb-1">{!! Str::limit(strip_tags($blog->description), 150, ' ...') !!}</p>
                                    </div>
                                    <div
                                        class="card-footer py-3 d-flex justify-content-between align-items-center bg-white text-muted">
                                        <div class="badge alert-warning"><a
                                                href="{{ URL::to('/blogs/' . $blog->category->slug) }}"
                                                class="text-black-50">{{ $blog->category->title }}</a></div>
                                        <a href="{{ URL::to('/blog/' . $blog->slug) }}"
                                            class="text-dark position-relative"><i class="icon-line2-user"></i> <span
                                                class="author-number">{{ $blog->likes }}</span></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                        <!-- Course End -->

                    </div>
                    <div class="row justify-content-center">
                        <a href="{{ URL::to('/blog/') }}"
                            class="button button-rounded button-xlarge ls0 ls0 nott font-weight-bold m-0">View All</a>
                    </div>
                </div>

            </div>

            <div class="container text-center">
            <img src="{{ asset('images/Eagleish-banner-1.jpg') }}" alt="Ad" class="img-width m-auto d-none d-sm-block">
                <img src="{{ asset('images/Eagleish-banner-400.jpg') }}" alt="Ad" class="img-width m-auto d-block d-sm-none">
            </div>  

            <!-- Featues Section
        ============================================= -->
            <div class="section mb-0 min-vh-100 d-flex align-items-center" style="padding: 80px 0; background-color:#f9f9f9">


                <div class="container">
                    <div class="row">

                        <div class="col-lg-8">
                            <div class="row light clearfix">

                                <div id="tab" class="widget px-3 clearfix">

                                    <div class="tabs mb-0 clearfix ui-tabs ui-corner-all ui-widget ui-widget-content"
                                        id="sidebar-tabs">

                                        <ul class="tab-nav clearfix ui-tabs-nav ui-corner-all ui-helper-reset ui-helper-clearfix ui-widget-header"
                                            role="tablist">
                                            <li role="tab" tabindex="0"
                                                class="ui-tabs-tab ui-corner-top ui-state-default ui-tab ui-tabs-active ui-state-active"
                                                aria-controls="tabs-1" aria-labelledby="ui-id-1" aria-selected="true"
                                                aria-expanded="true"><a href="#tabs-1" role="presentation" tabindex="-1"
                                                    class="ui-tabs-anchor" id="ui-id-1">Popular Q&A</a></li>
                                            <li role="tab" tabindex="-1"
                                                class="ui-tabs-tab ui-corner-top ui-state-default ui-tab"
                                                aria-controls="tabs-2" aria-labelledby="ui-id-2" aria-selected="false"
                                                aria-expanded="false"><a href="#tabs-2" role="presentation" tabindex="-1"
                                                    class="ui-tabs-anchor" id="ui-id-2">Recent Q&A</a></li>
                                        </ul>

                                        <div class="tab-container">

                                            <div class="tab-content clearfix ui-tabs-panel ui-corner-bottom ui-widget-content"
                                                id="tabs-1" aria-labelledby="ui-id-1" role="tabpanel" aria-hidden="false">
                                                <div class="posts-sm row col-mb-30" id="popular-post-list-sidebar">
                                                    @foreach ($popularQAs as $popularQA)
                                                        <div class="entry col-12">
                                                            <div class="grid-inner row no-gutters">
                                                                <div class="col-auto">
                                                                    <div class="entry-image">
                                                                        <a
                                                                            href="{{ URL::to('/member/' . $popularQA->user->slug) }}"><img
                                                                                class="rounded-circle"
                                                                                src="{{ $popularQA->user->avatar }}"
                                                                                alt="{{ $popularQA->user->avatar }}"></a>
                                                                    </div>
                                                                </div>
                                                                <div class="col pl-3">
                                                                    <div class="entry-title">
                                                                        <h4><a
                                                                                href="{{ URL::to('question/' . $popularQA->slug) }}">{{ $popularQA->title }}</a>
                                                                        </h4>
                                                                    </div>
                                                                    <div class="entry-meta">
                                                                        <ul>
                                                                            <li><i class="icon-comments-alt"></i>
                                                                                {{ $popularQA->answers_count }} Comments /
                                                                                Answers</li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach


                                                </div>
                                            </div>
                                            <div class="tab-content clearfix ui-tabs-panel ui-corner-bottom ui-widget-content"
                                                id="tabs-2" aria-labelledby="ui-id-2" role="tabpanel" aria-hidden="true"
                                                style="display: none;">
                                                <div class="posts-sm row col-mb-30" id="recent-post-list-sidebar">

                                                    @foreach ($recentQAs as $recentQA)
                                                        <div class="entry col-12">
                                                            <div class="grid-inner row no-gutters">
                                                                <div class="col-auto">
                                                                    <div class="entry-image">
                                                                        <a
                                                                            href="{{ URL::to('/member/' . $recentQA->user->slug) }}"><img
                                                                                class="rounded-circle"
                                                                                src="{{ $recentQA->user->avatar }}"
                                                                                alt="{{ $recentQA->user->name }}"></a>
                                                                    </div>
                                                                </div>
                                                                <div class="col pl-3">
                                                                    <div class="entry-title">
                                                                        <h4><a
                                                                                href="{{ URL::to('question/' . $recentQA->slug) }}">{{ $recentQA->title }}</a>
                                                                        </h4>
                                                                    </div>
                                                                    <div class="entry-meta">
                                                                        <ul>
                                                                            <li><i class="icon-comments-alt"></i>
                                                                                {{ Carbon\Carbon::parse($recentQA->created_at)->format('d M Y') }}
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>

                        <!-- Ask your question
           ============================================= -->
                        <div class="col-lg-4">

                            <div class="card shadow ask-form" data-animate="shake" style="opacity: 1 !important">
                                <div class="card-body">

                                    <div class="badge registration-badge shadow-sm alert-primary" style="top:0;">Q & A</div>
                                    <h4 class="card-title ls-1 mt-4 font-weight-bold h5">Ask your question now!</h4>
                                    <h6 class="card-subtitle mb-4 font-weight-normal text-uppercase ls2 text-black-50">
                                        questions will be answered by our experts</h6>

                                    <div class="form-widget">
                                        <div class="form-result"></div>

                                        <form class="row mb-0" id="askqna-form" name="askqna-form"
                                            onsubmit="return send_enquiry();" method="post">
                                            @csrf
                                            <div class="form-process" >
                                                <div class="css3-spinner">
                                                    <div class="css3-spinner-scaler"></div>
                                                </div>
                                            </div>

                                            <div class="col-12 form-group">
                                                <input type="text" id="askqna-form-name" name="askqna-form-name" value=""
                                                    class="form-control required" required placeholder="Your Full Name" />
                                            </div>
                                            <div class="col-12 form-group input-group">

                                                <select id="askqna-form-country-code" name="askqna-form-country-code"
                                                    value="" class="form-control required" required style="max-width: 100px;">
                                                    <option>+91 </option>
                                                    <option>+43</option>
                                                    <option>+135</option>
                                                </select>

                                                <input type="tel" id="askqna-form-phone" name="askqna-form-phone"
                                                    data-parsley-pattern="^[6-9]\d{9}$" value=""
                                                    class="form-control required" required placeholder="Your Phone Number" />

                                            </div>
                                            <div class="col-12 form-group">
                                                <select id="askqna-form-category_id" required name="askqna-form-category_id" value=""
                                                    class="form-control required">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12 form-group">
                                                <input type="text" id="askqna-form-question" required name="askqna-form-question"
                                                    value="" class="required question form-control"
                                                    placeholder="Your Question" />
                                            </div>



                                            <div class="col-12 form-group">
                                                <button
                                                    class="button button-rounded btn-block button-large bg-color text-white nott ls0 mx-0"
                                                    type="submit" id="askqna-form-submit" name="askqna-form-submit"
                                                    value="submit">Ask</button>
                                                <br>
                                                <small
                                                    style="display: block; font-size: 12px; margin-top: 15px; color: #AAA;"><em>Experts
                                                        will try to get back to you with questions as soon as
                                                        possible.</em></small>
                                            </div>

                                            <div class="col-12 form-group d-none">
                                                <input type="text" id="askqna-form-botcheck" name="askqna-form-botcheck"
                                                    value="" class="sm-form-control" />
                                            </div>

                                            <input type="hidden" name="prefix" value="askqna-form-">

                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>


            </div>

            <!-- Promo Section
        ============================================= -->
            <div class="section m-0 become-member-bg">
                <div class="container">
                    <div class="row">

                        <div class="col-md-7"></div>

                        <div class="col-md-5">
                            <div class="heading-block border-bottom-0 mb-4">
                                <h3>Become a Member!</h3>
                                <span>Help with you knowledge</span>
                            </div>
                            <p class="mb-2">Lorem ipsum dolor sierr met areas and cross-unit deliverables.</p>
                            <p>Consectetur adipisicing elit. Voluptate incidunt dolorum perferendis accusamus nesciunt et
                                est consequuntur placeat, dolor quia.</p>
                            <a href="#" class="button button-rounded button-xlarge ls0 ls0 nott font-weight-bold m-0">Join
                                Finest50</a>
                        </div>

                    </div>
                </div>
            </div>

            <!-- App Buttons
        ============================================= -->
            <div class="section my-0 get-app-section" style="background-color: #f9f9f9;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 offset-md-1 offset-0 bottommargin-lg d-flex flex-column align-self-center">
                            <h2 class="card-title font-weight-bold ls0">Get the FINEST50 App</h2>
                            <span>Lorem ipsum dolor sierr met areas</span>
                            <div class="mt-3 row">
                                <div class="col-6 col-lg-9 col-xl-6">
                                    <a href="#"
                                        class="button btn-block button-small button-rounded button-desc font-weight-normal ls1 clearfix"><i
                                            class="icon-apple"></i>
                                        <div><span>Download App</span>App Store</div>
                                    </a>
                                </div>
                                <div class="col-6 col-lg-9 col-xl-6">
                                    <a href="#"
                                        class="button btn-block button-small button-rounded button-desc font-weight-normal ls1 clearfix"><i
                                            class="icon-googleplay"></i>
                                        <div><span>Download App</span>Google Play</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 d-none d-md-flex align-items-center">
                            <img src="{{ asset('images/app.png') }}" alt="Image" class="mb-0">
                        </div>
                    </div>
                </div>
            </div>

            <div class="promo promo-light promo-full p-5 footer-stick">
                <div class="container clearfix">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg">
                            <h3 class="ls-1">Call us today at <span>+91 9898989898</span> or Email us at
                                <span>support@finest50.com</span></h3>
                            <span class="text-black-50">Any Questions, feel free to call us now</span>
                        </div>
                        <div class="col-12 col-lg-auto mt-4 mt-lg-0">
                            <a href="{{ URL::to('contact') }}" class="button button-xlarge button-rounded nott ls0 font-weight-bold m-0">Get in
                                Touch</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- #content end -->
@endsection

@section('js')

    <script type="text/javascript">
        $(function() {
			$('#askqna-form').parsley();
        });

        function send_enquiry() {
            if ($('#askqna-form').parsley().validate()) {
                var fullname = $("#askqna-form-name").val();
                var phone = $("#askqna-form-phone").val();
                var category_id = $("#askqna-form-category_id").val();
				var question = $("#askqna-form-question").val();
				
                if (fullname != "" && phone != "" && question != "") {
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
                        url: APP_URL+'home/submit',
                        data: {
                            category_id: category_id,
                            phone: phone,
                            fullname: fullname,
                            question: question
                        },
                        success: function(response) {
                            if (response.status) {
                                swal("Thankyou!",
                                    "We have recieved you Question, Experts will answer them shortly!",
									"success");
									$(".form-process").css({
										"display": "none"
									});
                            } else {
                                swal("Oops!", "Something went wrong, Please try again", "warning");
                            }
                        }
                    });
					swal("Thankyou!", "We have recieved you Question, Experts will answer them shortly!", "success");
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
        $('.follow-btn').click(function () {
        $member_id = $(this).data('uid');
        currentbtn = $(this);
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
                    $(currentbtn).html('<div class="btn btn-follow ">Unfollow</div>');
                } else {
                    $(currentbtn).html('<div class="btn btn-follow ">Follow</div>');
                }
                // $('#like-' + $answerid).html(response.likecpy);
            }
        });
    });
    </script>
@endsection
