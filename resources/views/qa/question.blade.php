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

                        <h3>Q. {{ $question->title }}</h3>

                        <div id="reviews" class="clearfix">

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
                                                            <img alt="Image" src="{{ $answer->user->avatar }}" height="40"
                                                                width="40"></span>
                                                    </div>
                                                </div>

                                                <div class="comment-content clearfix">
                                                    <div class="comment-author">{{ $answer->user->name }},
                                                        {{ $answer->user->qualification }} <span><a href="#"
                                                                title="Permalink to this comment">{{ Carbon\Carbon::parse($answer->created_at)->format('M d, Y - h:i A') }}</a></span>
                                                    </div>
                                                    <p>&nbsp;</p>
                                                    {{ $answer->answer }}
                                                </div>

                                                <div class="btns">
                                                    @if (Auth::user())
                                                        @if (Auth::user()->hasLiked($answer))
                                                            @if ($answer->likers()->count() > 1)
                                                                <span id="like-{{ $answer->id }}">you and
                                                                    {{ $answer->likers()->count() - 1 }} more <i
                                                                        class="icon-thumbs-up"></i> this</span>
                                                            @else
                                                                <span id="like-{{ $answer->id }}">you <i
                                                                        class="icon-thumbs-up"></i> this </span>
                                                            @endif
                                                            <button type="button" class="btn btn-sm btn-primary likebtn"
                                                                data-ansid="{{ $answer->id }}"><i
                                                                    class="icon-thumbs-up"></i>
                                                                Like</button>
                                                        @else
                                                            @if ($answer->likers()->count() > 0)
                                                                <span
                                                                    id="like-{{ $answer->id }}">{{ $answer->likers()->count() }}
                                                                    <i class="icon-thumbs-up"></i></span>
                                                            @else
                                                                <span id="like-{{ $answer->id }}">Be the first one to <i
                                                                        class="icon-thumbs-up"></i> this</span>
                                                            @endif
                                                            <button type="button"
                                                                class="btn btn-sm btn-outline-dark likebtn"
                                                                data-ansid="{{ $answer->id }}"><i
                                                                    class="icon-thumbs-up"></i>
                                                                Like</button>
                                                        @endif
                                                    @else
                                                        <span id="like-{{ $answer->id }}">{{ $answer->likers()->count() }}
                                                            <i class="icon-thumbs-up"></i></span>
                                                        <a type="button" class="btn btn-sm btn-outline-dark"
                                                            href="{{ URL::to('login') }}"><i class="icon-thumbs-up"></i>
                                                            Like</a>
                                                    @endif
                                                    <button class="btn btn-sm btn-outline-dark dropdown-toggle"
                                                        type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="icon-share"></i> Share</button>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ Request::url() }}">Facebook</a>
                                                        <a class="dropdown-item" target="_blank" href="https://twitter.com/intent/tweet?text={{ $question->title }}&amp;url={{ Request::url() }}">Twitter</a>
                                                        <a class="dropdown-item" target="_blank" href="https://wa.me/?text={{ Request::url() }}">Whatsapp</a>
                                                        <a class="dropdown-item" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ Request::url() }}&amp;title={{ $question->title }}">Linkedin</a>
                                                    </div>
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
                        <div class="sidebar-widgets-wrap">

                            <div class="widget widget_links text-left qwidget">

                                <h4>Related Questions</h4>
                                <div class="divider mt-2 mb-4"></div>
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

        $('.likebtn').click(function() {
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
                        $btnLike.removeClass("btn-outline-dark").addClass("btn-primary");
                    } else {
                        $btnLike.addClass("btn-outline-dark").removeClass("btn-primary");
                    }
                    $('#like-' + $answerid).html(response.likecpy);
                }
            });
        });

    </script>
@endsection
