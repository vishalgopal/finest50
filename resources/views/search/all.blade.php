@extends('layout.main')

@section('title')
    Search - {{ $query }}
@endsection

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
                        <!-- desktop-category -->
                        <div class="form-group mb-0 category-select d-none d-lg-block">
                            <select id="single" class="form-control select2-single">
                                <option value="all">All</option>
                                <option value="member">Member</option>
                                <option value="blog">Blog</option>
                                <option value="question">Question</option>
                            </select>
                        </div>
                        <!-- / -->

                        <input class="form-control rounded border-0 main-search cd-search-trigger" type="search"
                            placeholder="Search ends here.." aria-label="Search">

                        <!-- mobile-category -->
                        <div class="form-group mb-0 category-select d-block d-lg-none">
                            <select id="single" class="form-control select2-single">
                                <option value="all">All</option>
                                <option value="member">Member</option>
                                <option value="blog">Blog</option>
                                <option value="question">Question</option>
                            </select>
                        </div>
                        <!-- / -->

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

                <!-- suggestion  -->

                <div class="cd-search-suggestions mCustomScrollbar">
                    <ul>
                        <li><a href="#">Teacher</a><br>
                            <p><a href="#">in Members</a></p>
                            <p><a href="#">in Blog</a></p>
                        </li>
                        <li><a href="#">Teacher</a></li>
                        <li><a href="#">Teacher</a></li>
                        <li><a href="#">Teacher</a></li>
                    </ul>
                </div> <!-- .cd-search-suggestions -->


            </div>
        </div>
    </section> --}}
    <!-- #page-title end -->

    <!-- Content ============================================= -->
    <section id="content">
        <div class="content-wrap">

            <div class="container clearfix">

                <div class="row gutter-40 col-mb-80">

                    <!-- Post Content   ============================================= -->
                    <div class="postcontent col-12">
						@if(count($users)>0)
                        <div class="page-title">
                            <h2>Members</h2>
                            <a href="{{ URL::to('search/member/'.$query)}}">
                                <div class="btn btn-follow mt-0">View All</div>
                            </a>
                        </div>
						@endif
                        <!-- search ============================================= -->
                        <div id="" class="shop row" data-layout="fitRows">

                            <div class="container">
								@if(count($users)>0)
                                <div class="row">
                                    <div class="col-12">
                                        <!-- carousel begin -->
                                        <div class="owl-carousel owl-carousel-full image-carousel carousel-widget search-all-members"
                                            data-center="false" data-loop="false" data-autoplay="5000" data-nav="true"
                                            data-pagi="true" data-items-xs="2" data-items-sm="2" data-items-md="3"
                                            data-items-lg="3" data-items-xl="5">
                                            @foreach ($users as $user)
                                                <div class="oc-item">
                                                    <div
                                                        class="feature-box hover-effect shadow-sm fbox-center fbox-bg fbox-light fbox-lg fbox-effect">
                                                        <div class="fbox-icon"><a href="{{ URL::to('search/member/' . $user->slug) }}">
                                                            <i><img src="{{ $user->avatar }}"
                                                                    class="border-0 bg-transparent shadow-sm"
                                                                    style="z-index: 2;" alt="{{ $user->name }}"></i>
                                                                    </a>
                                                        </div>
                                                        <div class="fbox-content">
                                                            <h3 class="mb-4 nott ls0"><a href="{{ URL::to('search/member/' . $user->slug) }}"
                                                                    class="text-dark">{{ $user->name }}</a></h3>
                                                            <p><small
                                                                    class="subtitle nott color">{{ $user->designation }}</small>
                                                            </p>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <!-- carousel end -->
                                    </div>
                                </div>
                                <!-- members end -->

                                <div class="divider"><i class="icon-circle"></i></div>

								@endif
								@if(count($categories)>0)
                                <div class="page-title">
                                    <h2>Categories</h2>
                                    <a href="{{ URL::to('members/'.$query)}}">
                                        <div class="btn btn-follow mt-0">View All</div>
                                    </a>
                                </div>
								@endif
								<!-- Posts ============================================= -->
								@if(count($categories)>0)
                                <div id="posts" class="blog-search  course-categories  post-grid row grid-container gutter-40 clearfix"
                                    data-layout="fitRows">

                                        @foreach ($categories as $category)
                                            <div class="col-lg-2 col-sm-3 col-6 mt-4">
                                                <div class="card hover-effect">
                                                    <img class="card-img" src="{{ asset('img/small/' . $category->image ) }}" alt="{{ $category->title }}">
                                                    <a href="{{ URL::to('/members/' . $category->slug) }}" class="card-img-overlay rounded p-0"
                                                        style="background-color: rgba({{ rand(1, 251) }},{{ rand(1, 251) }},{{ rand(1, 251) }},0.8);">
                                                        <span><i class="icon-music1"></i>{{ $category->title }}</span>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
								</div>
								
                                <!-- Blogs end -->

                                <div class="divider"><i class="icon-circle"></i></div>
                                @endif
                                @if(count($blogs)>0)
                                <div class="page-title">
                                    <h2>Blogs</h2>
                                    <a href="{{ URL::to('search/blog/'.$query)}}">
                                        <div class="btn btn-follow mt-0">View All</div>
                                    </a>
                                </div>
								@endif
								<!-- Posts ============================================= -->
								@if(count($blogs)>0)
                                <div id="posts" class="blog-search post-grid row grid-container gutter-40 clearfix"
									data-layout="fitRows">
									
									@foreach ($blogs as $blog)

                                    <div class="entry col-md-3 col-sm-6 col-6">
                                        <div class="grid-inner">
                                            <div class="entry-image">
                                                <a href="{{ URL::to('blog/'. $blog->slug)}}" ><img
                                                        src="{{ asset('img/large/' . $blog->image) }}" alt="{{ $blog->title }}"></a>
                                            </div>
                                            <div class="entry-title">
                                                <h2><a href="{{ URL::to('blog/'. $blog->slug)}}">{{ $blog->title }}</a></h2>
                                            </div>
                                            <div class="entry-meta">
                                                <ul>
                                                    <li><i class="icon-calendar3"></i> {{ Carbon\Carbon::parse($blog->created_at)->format('M d, Y') }}</li>
                                                    <li><a href="{{ URL::to('blog/'. $blog->slug)}}#comments"><i class="icon-comments"></i>
                                                            {{ $blog->comment_count }}</a></li>
                                                </ul>
                                            </div>
                                            <div class="entry-content">
                                                <p>{{ strip_tags(substr($blog->description,0,180)) }}</p>
                                                <a href="{{ URL::to('blog/'. $blog->slug)}}" class="more-link">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                    
									@endforeach
								</div>
								
                                <!-- Blogs end -->

                                <div class="divider"><i class="icon-circle"></i></div>
								@endif
								@if(count($questions)>0)
                                <div class="page-title">
                                    <h2>Popular Q&A</h2>
                                    <a href="{{ URL::to('search/question/'.$query)}}">
                                        <div class="btn btn-follow mt-0">View All</div>
                                    </a>
                                </div>
								
								
                                <div class="posts-sm row col-mb-30" id="popular-post-list-sidebar">
									@foreach ($questions as $question)
										
									<div class="entry col-12">
                                        <div class="grid-inner row no-gutters">
                                            <div class="col-auto">
                                                <div class="entry-image">
                                                </div>
                                            </div>
                                            <div class="col pl-3">
                                                <div class="entry-title">
                                                    <h4><a href="{{ URL::to('question/' . $question->slug) }}">{{ $question->title }}</a></h4>
                                                </div>
                                                <div class="entry-meta">
                                                    <ul>
                                                        <li><i class="icon-comments-alt"></i> {{ $question->answers_count }} Answers</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
									</div>
									@endforeach
                                <!-- q and a end -->
							</div>
							@endif
                        </div>
                        @if (count($users)==0 && count($categories)==0 && count($blogs)==0 && count($questions)==0) 
                        No Results Found!!
                        @endif

                    </div><!-- #search end -->


                </div><!-- .postcontent end -->


            </div>

        </div>
        </div>
    </section><!-- #content end -->

@endsection
@section('js')
    <script src="js/jquery.matchHeight-min.js"></script>
    <script>
        $(function() {
            $('.feature-box').matchHeight();
            $('.search-all-members .fbox-content h3').matchHeight();
        });

    </script>
@endsection
