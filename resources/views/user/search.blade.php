@extends('layout.main')

@section('title', 'Search')

@section('meta')

@endsection
@section('content')
    <!-- Page Title
      ============================================= -->
    {{-- <section class="search-title">
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
    </section> --}}
    <!-- #page-title end -->

    <!-- Content
      ============================================= -->
    <section id="content"  class="member-style">
        <div class="content-wrap">

            <div class="container clearfix">

                <div class="row gutter-40 col-mb-80">

                    <!-- Post Content
          ============================================= -->
                    <div class="postcontent col-12 col-lg-8">

                        <!-- Filter Begin -->
                        <div class="search-filter">

                            <a href="Javascript:void(0);" class="badge badge-pill badge-light" id="btn-apply-filter"
                                onclick="$('.all-filters').toggle()">Change Category<i
                                    class="icon-angle-down1 ml-2"></i></a>

                            <ul class="all-filters" style="display: none;">
                                @foreach ($categories as $category)
                                    <li class="custom-control custom-checkbox">
                                        <input type="checkbox" name="categories" value="{{ $category->slug }}" class="custom-control-input categories" @if(in_array($category->slug,$selectedCategories)) checked @endif id="category{{$category->id}}">
                                        <label class="custom-control-label" for="category{{$category->id}}">{{ $category->title }}</label>
                                    </li>
                                @endforeach
                                <div class="btn btn-follow float-right filter">Apply</div>
                            </ul>
                            
                        </div>
                        <!-- Filter End -->

                        <div class="page-title">
                            <h2>Members</h2>
                            <div class="from-group">
                                <button class="btn btn-sm btn-outline-dark dropdown-toggle"
                                    type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-share"></i> Sort By @if(Request::has('sortby')){{ "- " . ucwords(Request::get('sortby')) }} @endif </button>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ Request::url() }}">None</a>
                                    <a class="dropdown-item" href="{{ Request::url().'?sortby=rating' }}">Highest Rated</a>
                                    <a class="dropdown-item" href="{{ Request::url().'?sortby=reviews' }}">Most Reviewed</a>
                                    <a class="dropdown-item" href="{{ Request::url().'?sortby=follower' }}">Followers</a>
                                    <a class="dropdown-item" href="{{ Request::url().'?sortby=stories' }}">Blogs</a>
                                    <a class="dropdown-item" href="{{ Request::url().'?sortby=answers' }}">Answers</a>
                                </div>

                            </div>
                        </div>
                        
                        <!-- List
           ============================================= -->
                        <div id="shop" class="shop row" data-layout="fitRows">
                            @php $rec = 0; @endphp
                            @foreach ($users as $user)
                                <div class="product">
                                    <div class="grid-inner row ">
                                        <div class="product-image col-3 col-lg-3 col-xl-2">
                                            <a href="{{ URL::to('member/' . $user->slug) }}"><img src="{{ $user->avatar }}"
                                                    alt="{{ $user->name }}"></a>
                                            <!-- <div class="sale-flash badge badge-secondary p-2">Out of Stock</div> -->
                                        </div>
                                        <div class="product-desc col-9 col-lg-8 col-xl-9 px-lg-5 pt-lg-0">
                                            <div class="product-title">
                                                <h3><a href="{{ URL::to('member/' . $user->slug) }}">{{ $user->name }}</a>
                                                </h3>
                                            </div>
                                            <div class="product-price">{{ $user->qualification }}</div>
                                            <div class="product-rating">
                                                {!! $user->rating !!}
                                            </div>

                                            <p class="mt-2 mb-2 d-none d-lg-block">{{ $user->short_description }}</p>
                                            <div class="number-section">
                                                <div>
                                                    <div class="d-flex mb-2">
                                                    <p class="text-dark my-0" id="followers-{{ $user->id }}"><strong>{{ $user->follower }}</strong>
                                                            Followers</p>
                                                        <p class="mx-3 mb-0">|</p>
                                                        <p class="text-dark my-0">
                                                            <a href="{{ URL::to('member/' . $user->slug . '/blogs') }}"><strong>{{ $user->stories }}</strong>
                                                            Blogs</a></p>
                                                        <p class="mx-3 mb-0">|</p>
                                                        <p class="text-dark my-0"><strong>{{ $user->answers }}</strong>
                                                            Answers</p>
                                                    </div>
                                                </div>
                                                <div>
                                                    @if (Auth::user())
                                                    <a class="follow-btn" data-uid="{{ $user->id }}">
                                                    @if (Auth::user()->isFollowing($user))
                                                        <div class="btn btn-follow mt-0 btn-outline-dark">Unfollow</div>
                                                    @else 
                                                        <div class="btn btn-follow mt-0 btn-outline-dark">Follow</div>
                                                    @endif
                                                    </a>
                                                @else
                                                    <a href="{{ URL::to('/login') }}"><div class="btn btn-follow ">Follow</div></a>   
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Promoted --}}
                                @if($loop->index %4 ==0)
                                
                                <div class="product shadow">
                                    <div class="grid-inner row ">
                                        <div class="product-image col-3 col-lg-3 col-xl-2">
                                            <a href="{{ URL::to('member/' . $promotions[$rec]->user->slug) }}"><img src="{{ $promotions[$rec]->user->avatar }}"
                                                alt="{{ $promotions[$rec]->user->name }}"></a>
                                        </div>
                                        <div class="product-desc col-9 col-lg-8 col-xl-9 px-lg-5 pt-lg-0">
                                            <div class="sale-flash badge badge-secondary rounded-lg p-2">Promoted <i
                                                class="icon-star3 text-warning"></i></div>
                                            <div class="product-title">
                                                <h3><a href="{{ URL::to('member/' . $promotions[$rec]->user->slug) }}">{{ $promotions[$rec]->user->name }}</a>
                                                </h3>
                                            </div>
                                            <div class="product-price">{{ $promotions[$rec]->user->qualification }}</div>
                                            <div class="product-rating">
                                                {!! $promotions[$rec]->user->rating !!}
                                            </div>

                                            <p class="mt-2 mb-2 d-none d-lg-block">{{ $promotions[$rec]->user->short_description }}</p>
                                            <div class="number-section">
                                                <div>
                                                    <div class="d-flex mb-2">
                                                    <p class="text-dark my-0" id="followers-{{ $promotions[$rec]->user->id }}"><strong>{{ $promotions[$rec]->user->follower }}</strong>
                                                            Followers</p>
                                                        <p class="mx-3 mb-0">|</p>
                                                        <p class="text-dark my-0">
                                                            <a href="{{ URL::to('member/' . $promotions[$rec]->user->slug . '/blogs') }}"><strong>{{ $promotions[$rec]->user->stories }}</strong>
                                                            Blogs</a></p>
                                                        <p class="mx-3 mb-0">|</p>
                                                        <p class="text-dark my-0"><strong>{{ $promotions[$rec]->user->answers }}</strong>
                                                            Answers</p>
                                                    </div>
                                                </div>
                                                <div>
                                                    @if (Auth::user())
                                                    <a class="follow-btn" data-uid="{{ $promotions[$rec]->user->id }}">
                                                    @if (Auth::user()->isFollowing($promotions[$rec]->user))
                                                        <div class="btn btn-follow mt-0 btn-outline-dark">Unfollow</div>
                                                    @else 
                                                        <div class="btn btn-follow mt-0 btn-outline-dark">Follow</div>
                                                    @endif
                                                    </a>
                                                @else
                                                    <a href="{{ URL::to('/login') }}"><div class="btn btn-follow ">Follow</div></a>   
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php 
                                if ($rec <  count($promotions)-1) 
                                $rec++;
                                else $rec=0;
                                 @endphp
                                @endif
                                {{-- Promoted End --}}
                            @endforeach
                            {{-- Pagination --}}
                            {{ $users->withQueryString()->links() }}
                        </div><!-- #shop end -->


                    </div><!-- .postcontent end -->

                <!-- Sidebar
                        ============================================= -->
                        <div class="sidebar col-lg-4 d-block ">
                            <div class="sidebar-widgets-wrap related-que shadow-sm">

                                <div class="widget widget_links text-left qwidget">

                                    <h4>Related Categories</h4>
                                    @foreach ($sidebarCategories as $sidebarCategory)
                                        <p><a
                                                href="{{ URL::to('members/' . $sidebarCategory->slug) }}">{{ $sidebarCategory->title }}</a>
                                        </p>
                                    @endforeach
                                </div>


                            </div>
                            <div class="spacer"><br><br></div>
                            <div class="sidebar-widgets-wrap related-que shadow-sm">

                                <div class="widget widget_links text-left qwidget">

                                    <h4>Related Blogs</h4>
                                    @foreach ($sidebarBlogs as $sidebarblog)
                                        <p><a
                                                href="{{ URL::to('blog/' . $sidebarblog->slug) }}">{{ $sidebarblog->title }}</a>
                                        </p>
                                    @endforeach
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
                $('#followers-'+$member_id).html('<strong>' + response.count + '</strong> Follower(s) ')
                // $('#like-' + $answerid).html(response.likecpy);
            }
        });
    });
    </script>

@endsection
