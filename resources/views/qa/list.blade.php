@extends('layout.main')

@section('title', 'Questions')

@section('meta')

@endsection
@section('content')
    <!-- Content
                          ============================================= -->
    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">

                <div class="row gutter-40 col-mb-80">

                    <!-- Post Content
                              ============================================= -->
                    <div class="postcontent col-lg-8">
                        <div class="qpage-title border-bottom">
                            <h3>Latest Questions</h3>
                            <!-- tabs begin -->
                            <ul id="myTab2" class="nav nav-pills boot-tabs">
                                <li class="nav-item"><a class="nav-link border active" href="#latest-ques"
                                        data-toggle="tab">Latest
                                        Questions</a></li>
                                <li class="nav-item"><a class="nav-link border" href="#most-answered" data-toggle="tab">Most
                                        Answered</a></li>
                            </ul>
                        </div>
                        <div id="myTabContent2" class="tab-content">
                            <div class="tab-pane fade show active" id="latest-ques">
                                @foreach ($latestQuestions as $latestQuestion)
                                    <div class="qlist">
                                        <h4>Q: {{ $latestQuestion->title }}</h4>
                                        <div class="comment-content clearfix float-right">
                                            <div class="comment-author">
                                                <span>{{ Carbon\Carbon::parse($latestQuestion->created_at)->format('M d, Y - h:i A') }}</span>
                                            </div>
                                        </div>
                                        <div class="btns">
                                            <span class="badge badge-light border">{{ count($latestQuestion->answers) }}
                                                answer(s)</span>
                                            <span class="badge badge-light border"><a
                                                    href="{{ URL::to('question/' . $latestQuestion->slug) }}">View</a></span>
                                        </div>
                                    </div>
                                @endforeach
                                {{ $latestQuestions->fragment('latest-ques')->links() }}
                            </div>
                            <div class="tab-pane fade" id="most-answered">
                                @foreach ($mostAnswerQues as $mostAnswerQue)
                                    <div class="qlist">
                                        <h4>Q: {{ $mostAnswerQue->title }}</h4>
                                        <div class="comment-content clearfix float-right">
                                            <div class="comment-author">
                                                <span>{{ Carbon\Carbon::parse($mostAnswerQue->created_at)->format('M d, Y - h:i A') }}</span>
                                            </div>
                                        </div>
                                        <div class="btns">
                                            <span class="badge badge-light border">{{ count($mostAnswerQue->answers) }}
                                                answer(s)</span>
                                            <span class="badge badge-light border"><a
                                                    href="{{ URL::to('question/' . $mostAnswerQue->slug) }}">View</a></span>
                                        </div>
                                    </div>
                                @endforeach
                                {{ $mostAnswerQues->fragment('most-answered')->links() }}
                            </div>
                        </div>
                        <!-- tab end -->

                        {{-- Pagination --}}


                    </div><!-- .postcontent end -->

                    <!-- Sidebar
                              ============================================= -->
                    <div class="sidebar col-lg-4 d-block ">
                        <div class="sidebar-widgets-wrap related-que shadow-sm">

                            <div class="widget widget_links text-left qwidget">

                                <h4>Random Questions</h4>
                                @foreach ($randomQuestions as $randomQuestion)
                                    <p><a href="{{ URL::to('question/'.$randomQuestion->slug )}}">{{ $randomQuestion->title }}</a></p>  
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
    <script>
        $(function() {
            var hash = window.location.hash;
            hash && $('ul.nav a[href="' + hash + '"]').tab('show');

            $('.nav-tabs a').click(function(e) {
                $(this).tab('show');
                var scrollmem = $('body').scrollTop();
                window.location.hash = this.hash;
                $('html,body').scrollTop(scrollmem);
            });
        });
    </script>

@endsection
