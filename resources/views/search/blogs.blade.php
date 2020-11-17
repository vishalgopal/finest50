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
						
								@if(count($blogs)>0)
                                <div class="page-title">
                                    <h2>Blogs</h2>
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
                                @else
                                No Resuts Found!!
								@endif
								{{ $blogs->withQueryString()->links() }}
                        </div>


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
