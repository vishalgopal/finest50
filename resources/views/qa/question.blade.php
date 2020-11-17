@extends('layout.main')

@section('title', 'About Us')

@section('meta')

@endsection
@section('content')
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

                        <h3 class="main-que shadow-sm border"><span class="que-sign">Q.</span> {{ $question->title }}</h3>
                        <div class="badge badge-pill badge-secondary font-weight-bold">{{count($question->answers)}} answers</div>
                        <hr class="py-2">
                        <div id="reviews" class="clearfix mt-2">
                            
                            <ol class="commentlist clearfix border-0">
                                @if (count($question->answers) <= 0)
                                <li class="comment even thread-even depth-1 border-bottom" id="li-comment-1">
                                    <div id="comment-1" class="comment-wrap clearfix">

                                        <div class="comment-meta">
                                            <div class="comment-author vcard">

                                            </div>
                                        </div>

                                        <div class="comment-content clearfix">
                                            <div class="comment-author"></span>
                                            </div>
                                            <p>&nbsp;</p>
                                            This Question is not answered yet
                                        </div>
                                    </div>
                                </li>
                            @else
                                @foreach ($question->answers as $answer)
                                <li class="comment even thread-even depth-1 border-bottom" id="li-comment-1">
                                    <div id="comment-1" class="comment-wrap clearfix">

                                        <div class="comment-meta">
                                            <div class="comment-author vcard">
                                                <span class="comment-avatar clearfix">
                                                    <img alt="Image"
                                                        src="{{ $answer->user->avatar }}"
                                                        height="40" width="40"></span>
                                            </div>
                                        </div>

                                        <div class="comment-content clearfix">
                                                        <div class="comment-author">{{ $answer->user->name }},
                                                            {{ $answer->user->qualification }} <span><a href="#"
                                                                    title="Permalink to this comment">{{ Carbon\Carbon::parse($answer->created_at)->format('M d, Y - h:i A') }}</a></span>
                                                        </div>
                                                        <p>&nbsp;</p>
                                                        {!! $answer->answer !!}
                                        </div>

                                        <div class="btns d-flex">
                                        @if (Auth::user())
                                            @if (Auth::user()->hasLiked($answer))
                                            <!-- Like btn -->
                                            <a class="btn btn-lg btn-shared btn-like liked" data-ansid="{{ $answer->id }}"><span
                                                class="icon-like pull-left"></span><span
                                                class="like-text" id="like-{{ $answer->id }}" style="display: none">Like</span><span class="unlike-text" id="unlike-{{ $answer->id }}" style="display: inline">Unlike</span></a>
                                            <!-- / -->
                                                {{-- @if ($answer->likers()->count() > 1)
                                                    <span id="like-{{ $answer->id }}">you and
                                                        {{ $answer->likers()->count() - 1 }} more <i
                                                            class="icon-thumbs-up"></i> this</span>
                                                @else
                                                    <span id="like-{{ $answer->id }}">you <i
                                                            class="icon-thumbs-up"></i> this </span>
                                                @endif --}}
                                                {{-- <button type="button" class="btn btn-sm btn-primary likebtn"
                                                    data-ansid="{{ $answer->id }}"><i
                                                        class="icon-thumbs-up"></i>
                                                    Like</button> --}}
                                            @else
                                            <a class="btn btn-lg btn-shared btn-like unliked" data-ansid="{{ $answer->id }}"><span
                                                class="icon-like pull-left"></span><span
                                                class="like-text" id="like-{{ $answer->id }}" style="display: inline">Like</span><span class="unlike-text" id="unlike-{{ $answer->id }}" style="display: none">Unlike</span></a>
                                            @endif
                                        @else
                                            <span id="like-{{ $answer->id }}">{{ $answer->likers()->count() }}
                                                <i class="icon-thumbs-up"></i></span>
                                            <a type="button" class="btn btn-sm btn-outline-dark"
                                                href="{{ URL::to('login') }}"><i class="icon-thumbs-up"></i>
                                                Like</a>
                                        @endif
                                            

                                            <!-- share btn -->
                                            <div class="share">
                                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ Request::url() }}">
                                                    <div class="icon first"><i class="icon-facebook"></i></div>
                                                </a>
                                                <a href="https://twitter.com/intent/tweet?text={{ $question->title }}&amp;url={{ Request::url() }}">
                                                    <div class="icon"><i class="icon-twitter"></i></div>
                                                </a>
                                                <a href="https://wa.me/?text={{ Request::url() }}">
                                                    <div class="icon"><i class="icon-whatsapp"></i></div>
                                                </a>
                                                <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ Request::url() }}&amp;title={{ $question->title }}">
                                                    <div class="icon last"><i class="icon-linkedin"></i></div>
                                                </a>
                                                <div class="label">Share</div>
                                            </div>
                                            <!-- / -->
                                        </div>  
                                        <div class="clear"></div>

                                    </div>
                                </li>
                                @endforeach
                                @endif
                            </ol>
                        </div>



                    </div><!-- .postcontent end -->

                    <!-- Sidebar
          ============================================= -->
                    <div class="sidebar col-lg-4 d-block ">
                        <div class="sidebar-widgets-wrap related-que shadow-sm">

                            <div class="widget widget_links text-left qwidget">

                                <h4>Related Questions</h4>
                                @foreach ($relatedQuestions as $relatedQuestion)
                                    <p><a
                                            href="{{ URL::to('question/' . $relatedQuestion->slug) }}">{{ $relatedQuestion->title }}</a>
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

    <script type="text/javascript">
        $(function() {
            //$('#contactform').parsley();
        });

        $('.btn-like').click(function() {
            $answerid = $(this).data('ansid');
            $btnLike = $(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: APP_URL + '/answer/like',
                data: {
                    answerid: $answerid
                },
                success: function(response) {
                    if (response.status) {
                        $btnLike.addClass("liked");
                        $('#unlike-' + $answerid).show();
                        $('#like-' + $answerid).hide();
                    } else {
                        $btnLike.removeClass("liked");
                        $('#unlike-' + $answerid).hide();
                        $('#like-' + $answerid).show();
                    }
                }
            });
        });

    </script>
@endsection
