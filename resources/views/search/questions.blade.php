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

								@if(count($questions)>0)
                                <div class="page-title">
                                    <h2>Popular Q&A</h2>
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
                            <div class="divider"><i class="icon-circle"></i></div>
                            @else
                                No Resuts Found!!
							@endif
                        </div>
                        {{ $questions->withQueryString()->links() }}


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
