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

					<div class="row gutter-40 col-mb-80">
						<!-- Post Content
						============================================= -->
						<div class="postcontent col-lg-9">

							<div class="single-post mb-0">

								<!-- Single Post
								============================================= -->
								<div class="entry clearfix">

									<!-- Entry Title
									============================================= -->
									<div class="entry-title">
										<h2>{{ $blog->title }}</h2>
									</div><!-- .entry-title end -->

									<!-- Entry Meta
									============================================= -->
									<div class="entry-meta">
										<ul>
											<li><i class="icon-calendar3"></i>  {{ Carbon\Carbon::parse($blog->created_at)->format('M d, Y') }}</li>
											<li><a href="{{ URL::to('member/'.$blog->user->slug) }}"><i class="icon-user"></i> {{ $blog->user->name }}</a></li>
											{{-- <li><i class="icon-folder-open"></i> <a href="#">General</a>, <a href="#">Media</a></li> --}}
											<li><a href="#"><i class="icon-comments"></i> {{ $blog->comment_count }} Comments</a></li>
											{{-- <li><a href="#"><i class="icon-camera-retro"></i></a></li> --}}
										</ul>
									</div><!-- .entry-meta end -->

									<!-- Entry Image
									============================================= -->
									<div class="entry-image">
										<a href="#"><img src="{{ asset('img/original/' . $blog->image) }}" alt="{{ $blog->title }}"></a>
									</div><!-- .entry-image end -->

									<!-- Entry Content
									============================================= -->
									<div class="entry-content mt-0">

										{!! $blog->description !!}
										<!-- Post Single - Content End -->

										<!-- Tag Cloud
										============================================= -->
										{{-- <div class="tagcloud clearfix bottommargin">
											<a href="#">general</a>
											<a href="#">information</a>
											<a href="#">media</a>
											<a href="#">press</a>
											<a href="#">gallery</a>
											<a href="#">illustration</a>
										</div><!-- .tagcloud end --> --}}

										<div class="clear"></div>

										<!-- Post Single - Share
										============================================= -->
										<div class="si-share border-0 d-flex justify-content-between align-items-center">
											<span>Share this Post:</span>
											<div>
											<a href="https://www.facebook.com/sharer.php?u={{ URL::full() }}" class="social-icon si-borderless si-facebook">
													<i class="icon-facebook"></i>
													<i class="icon-facebook"></i>
												</a>
												<a href="https://twitter.com/share?url={{ URL::full() }}&text={{ $blog->title }}" class="social-icon si-borderless si-twitter">
													<i class="icon-twitter"></i>
													<i class="icon-twitter"></i>
												</a>
												<a href="https://pinterest.com/pin/create/bookmarklet/?media={{ asset('img/original/'. $blog->image)}}&url{{ URL::full() }}&description={{ $blog->title }}
												" class="social-icon si-borderless si-pinterest">
													<i class="icon-pinterest"></i>
													<i class="icon-pinterest"></i>
												</a>
												<a href="https://plus.google.com/share?url={{ URL::full() }}" class="social-icon si-borderless si-gplus">
													<i class="icon-gplus"></i>
													<i class="icon-gplus"></i>
												</a>
												<a href="https://www.linkedin.com/shareArticle?url={{ URL::full() }}&title={{ $blog->title }}" class="social-icon si-borderless si-linkedin">
													<i class="icon-linkedin"></i>
													<i class="icon-linkedin"></i>
												</a>
											</div>
										</div><!-- Post Single - Share End -->
										<!-- Post Single - Like
										============================================= -->
										<div class="si-share border-0 d-flex justify-content-between align-items-center">
											{{-- <i class="like-icon"></i>
											<span class="like-txt">liked!</span> --}}
											@if (Auth::user())
                                                        @if (Auth::user()->hasLiked($blog))
                                                            @if ($blog->likers()->count() > 1)
                                                                <span id="like-{{ $blog->id }}">you and
                                                                    {{ $blog->likers()->count() - 1 }} more <i
                                                                        class="icon-thumbs-up"></i> this</span>
                                                            @else
                                                                <span id="like-{{ $blog->id }}">you <i
                                                                        class="icon-thumbs-up"></i> this </span>
                                                            @endif
                                                            <button type="button" class="btn btn-sm btn-primary likebtn"
                                                                data-blogid="{{ $blog->id }}"><i
                                                                    class="icon-thumbs-up"></i>
                                                                Like</button>
                                                        @else
                                                            @if ($blog->likers()->count() > 0)
                                                                <span
                                                                    id="like-{{ $blog->id }}">{{ $blog->likers()->count() }}
                                                                    <i class="icon-thumbs-up"></i></span>
                                                            @else
                                                                <span id="like-{{ $blog->id }}">Be the first one to <i
                                                                        class="icon-thumbs-up"></i> this</span>
                                                            @endif
                                                            <button type="button"
                                                                class="btn btn-sm btn-outline-dark likebtn"
                                                                data-blogid="{{ $blog->id }}"><i
                                                                    class="icon-thumbs-up"></i>
                                                                Like</button>
                                                        @endif
                                                    @else
                                                        <span id="like-{{ $blog->id }}">{{ $blog->likers()->count() }}
                                                            <i class="icon-thumbs-up"></i></span>
                                                        <a type="button" class="btn btn-sm btn-outline-dark"
                                                            href="{{ URL::to('login') }}"><i class="icon-thumbs-up"></i>
                                                            Like</a>
                                                    @endif
											<div>
											
											</div>
										</div><!-- Post Single - Like End -->

									</div>
								</div><!-- .entry end -->

								<!-- Post Navigation
								============================================= -->
								<div class="row justify-content-between col-mb-30 post-navigation">
									<div class="col-12 col-md-auto text-center">
										@if($prev)
										<a href="{{ URL::to('blog/'. $prev->slug)}}">&lArr; {{ $prev->title }}</a>
										@endif
									</div>

									<div class="col-12 col-md-auto text-center">
										@if($next)
										<a href="{{ URL::to('blog/'. $next->slug)}}">{{ $next->title }} &rArr;</a>
										@endif
									</div>
								</div><!-- .post-navigation end -->

								<div class="line"></div>

								<!-- Post Author Info
								============================================= -->
								<div class="card">
									<div class="card-header"><strong>Posted by <a href="{{ URL::to('member/'.$blog->user->slug)}}">{{ $blog->user->name }}</a></strong></div>
									<div class="card-body">
										<div class="author-image">
											<img src="{{ $blog->user->avatar }}" alt="Image" class="rounded-circle">
										</div>
										{{ $blog->user->short_description }}
									</div>
								</div><!-- Post Single - Author End -->

								<div class="line"></div>

								<h4>Related Posts:</h4>

								<div class="related-posts row posts-md col-mb-30">
									@foreach ($relatedblogs as $related)
									<div class="entry col-12 col-md-6">
										<div class="grid-inner row align-items-center gutter-20">
											<div class="col-4">
												<div class="entry-image">
													<a href="{{ URL::to('blog/'. $related->slug)}}"><img src="{{ asset('img/medium/'.$related->image) }}" alt="{{ $related->title }}"></a>
												</div>
											</div>
											<div class="col-8">
												<div class="entry-title title-xs">
													<h3><a href="{{ URL::to('blog/'. $related->slug)}}">{{ $related->title }}</a></h3>
												</div>
												<div class="entry-meta">
													<ul>
														<li><i class="icon-calendar3"></i>  {{ Carbon\Carbon::parse($blog->created_at)->format('M d, Y') }}</li>
														<li><a href="#"><i class="icon-comments"></i> {{ $related->comment_count }}</a></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
									@endforeach
									

									

								</div>

								<!-- Comments
								============================================= -->
								<div id="comments" class="clearfix">

									<h3 id="comments-title"><span>{{ $blog->comment_count }}</span> Comments</h3>

									<!-- Comments List
									============================================= -->
									<ol class="commentlist clearfix">
										@foreach ($comments as $comment)
										<li class="comment even thread-even depth-1" id="li-comment-1">
											<div id="comment-1" class="comment-wrap clearfix">
												<div class="comment-meta">
													<div class="comment-author vcard">
														<span class="comment-avatar clearfix">
														<img alt='Image' src='{{ $comment->userinfo->avatar }}' class='avatar avatar-60 photo avatar-default' height='60' width='60' /></span>
													</div>
												</div>
												<div class="comment-content clearfix">
													<div class="comment-author">{{ $comment->userinfo->name}}<span>{{ Carbon\Carbon::parse($comment->created_at)->format('M d, Y - h:i A') }}</span></div>
													<p>{!!  strip_tags($comment->comment, '<b><i><strong><p>') !!}</p>
														@if(Auth::user())
															<a class='comment-reply-link' href='javascript:openmodal({{$comment->id}})'><i class="icon-reply"></i></a>
														@else
															<a class='comment-reply-link' href='{{ URL::to('login') }}'><i class="icon-reply"></i></a>
														@endif
												</div>
												<div class="clear"></div>
											</div>
											@if (count($comment->children)>0)
											<ul class='children'>
												@foreach ($comment->children as $child)
												<li class="comment byuser comment-author-_smcl_admin odd alt depth-2" id="li-comment-3">
													<div id="comment-3" class="comment-wrap clearfix">
														<div class="comment-meta">
															<div class="comment-author vcard">
																<span class="comment-avatar clearfix">
																	<img alt='Image' src='{{ $child->userinfo->avatar }}' class='avatar avatar-60 photo avatar-default' height='40' width='40' /></span>
																</div>
														</div>
														<div class="comment-content clearfix">
															<div class="comment-author">{{ $child->userinfo->name}}<span>{{ Carbon\Carbon::parse($child->created_at)->format('M d, Y - h:i A') }}</span></div>
															<p>{!!  strip_tags($child->comment, '<b><i><strong><p>') !!}</p>
														</div>
														<div class="clear"></div>
													</div>
												</li>
												@endforeach
											</ul>
											@endif 
										</li>
										@endforeach
										
									</ol><!-- .commentlist end -->
                    {{-- Pagination --}}
                    {{ $comments->withQueryString()->links() }}
									<div class="clear"></div>
									@if(Auth::user())
									<a href="javascript:openmodal()" 
										class="button button-3d m-0 float-right">Comment</a>
									@else
										<a href="{{ URL::to('login') }}"
											class="button button-3d m-0 float-right">Comment</a>
									@endif

									<!-- Modal Comments
                       ============================================= -->
					   <div class="modal fade" id="CommentFormModal" tabindex="-1" role="dialog"
					   aria-labelledby="CommentFormModalLabel" aria-hidden="true">
					   <div class="modal-dialog">
						   <div class="modal-content">
							   <div class="modal-header">
								   <h4 class="modal-title" id="CommentFormModalLabel">Submit a Comment</h4>
								   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							   </div>
							   <div class="modal-body">
								   <form class="row mb-0" id="Commentform" name="Commentform"
									   onsubmit="return save_comment();" method="post">										  
									   <div class="w-100"></div>
									   <div class="col-12 mb-3">
										   <label for="Commentform-Comment">Comment <small>*</small></label>
										   <textarea class="required form-control" id="Commentform-Comment" required
											   name="Commentform-Comment" rows="6" cols="30"></textarea>
											   <input type="hidden" id="Commentform-val" name="Commentform-val" value="">
									   <input type="hidden" id="Commentform-blogid" name="Commentform-blogid" value="{{ $blog->id }}">
									   </div>
   
									   <div class="col-12">
										   <button class="button button-3d m-0" type="submit" id="Commentform-submit"
											   name="Commentform-submit" value="submit">Submit Comment</button>
									   </div>
   
								   </form>
							   </div>
							   <div class="modal-footer">
								   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							   </div>
						   </div><!-- /.modal-content -->
					   </div><!-- /.modal-dialog -->
				   </div><!-- /.modal -->
				   <!-- Modal Comments End -->
									<!-- Comment Form
									============================================= -->
									{{-- <div id="respond">

										<h3>Leave a <span>Comment</span></h3>

										<form class="row" action="#" method="post" id="commentform">
											<div class="col-md-4 form-group">
												<label for="author">Name</label>
												<input type="text" name="author" id="author" value="" size="22" tabindex="1" class="sm-form-control" />
											</div>

											<div class="col-md-4 form-group">
												<label for="email">Email</label>
												<input type="text" name="email" id="email" value="" size="22" tabindex="2" class="sm-form-control" />
											</div>

											<div class="col-md-4 form-group">
												<label for="url">Website</label>
												<input type="text" name="url" id="url" value="" size="22" tabindex="3" class="sm-form-control" />
											</div>

											<div class="w-100"></div>

											<div class="col-12 form-group">
												<label for="comment">Comment</label>
												<textarea name="comment" cols="58" rows="7" tabindex="4" class="sm-form-control"></textarea>
											</div>

											<div class="col-12 form-group">
												<button name="submit" type="submit" id="submit-button" tabindex="5" value="Submit" class="button button-3d m-0">Submit Comment</button>
											</div>
										</form>

									</div> --}}
									<!-- #respond end -->

								</div><!-- #comments end -->

							</div>

						</div><!-- .postcontent end -->

						<!-- Sidebar
						============================================= -->
						<div class="sidebar col-lg-3">
							<div class="sidebar-widgets-wrap">

								<div class="widget clearfix no-padding">

									<div class="tabs mb-0 clearfix" id="sidebar-tabs">

										<ul class="tab-nav clearfix">
											<li><a href="#popular-tab">Popular</a></li>
											<li><a href="#recent-tab">Recent</a></li>
										</ul>

										<div class="tab-container">

											<div class="tab-content clearfix" id="popular-tab">
												<div class="posts-sm row col-mb-30" id="popular-post-list-sidebar">
													@foreach ($popularblogs as $popular)
													<div class="entry col-12">
														<div class="grid-inner row no-gutters">
															<div class="col-auto">
																<div class="entry-image">
																	<a href="{{ $popular->slug }}"><img class="" src="{{ asset('img/small/'.$popular->image) }}" alt="{{ $popular->title }}"></a>
																</div>
															</div>
															<div class="col pl-3">
																<div class="entry-title">
																	<h4><a href="{{ $popular->slug }}">{{ $popular->title }}</a></h4>
																</div>
																<div class="entry-meta">
																	<ul>
																		<li><i class="icon-comments-alt"></i> {{ $popular->comment_count }} Comments</li>
																	</ul>
																</div>
															</div>
														</div>
													</div>
													@endforeach
													
												</div>
											</div>
											<div class="tab-content clearfix" id="recent-tab">
												<div class="posts-sm row col-mb-30" id="recent-post-list-sidebar">
													@foreach ($recentblogs as $recent)
													<div class="entry col-12">
														<div class="grid-inner row no-gutters">
															<div class="col-auto">
																<div class="entry-image">
																	<a href="{{ $recent->slug }}"><img class="" src="{{ asset('img/small/'.$recent->image) }}" alt="{{ $recent->title }}"></a>
																</div>
															</div>
															<div class="col pl-3">
																<div class="entry-title">
																	<h4><a href="{{ $recent->slug }}">{{ $recent->title }}</a></h4>
																</div>
																<div class="entry-meta">
																	<ul>
																		<li><i class="icon-comments-alt"></i> {{ $recent->comment_count }} Comments</li>
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

								{{-- <div class="widget clearfix">

									<h4>Tag Cloud</h4>
									<div class="tagcloud">
										<a href="#">general</a>
										<a href="#">videos</a>
										<a href="#">music</a>
										<a href="#">media</a>
										<a href="#">photography</a>
										<a href="#">parallax</a>
										<a href="#">ecommerce</a>
										<a href="#">terms</a>
										<a href="#">coupons</a>
										<a href="#">modern</a>
									</div>

								</div> --}}

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
function openmodal(val){
	$('#Commentform-val').val(val);
	$("#CommentFormModal").modal()
}
	</script>

    <script type="text/javascript">
        $(function() {
            $('#Commentform').parsley();
        });

        function save_comment() {
			console.log('in form');
            if ($('#Commentform').parsley().validate()) {
                var comment = $("#Commentform-Comment").val();
                var parent_id = $('#Commentform-val').val();
                var blog_id = $('#Commentform-blogid').val();

                if (comment != "" ) {
					console.log('in comment');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'post',
                        url: APP_URL + '/comment/submit',
                        data: {
                            comment: comment,
                            parent_id: parent_id,
							blog_id: blog_id
                        },
                        success: function(response) {
                            if (response.status) {
                                swal("Thankyou!",
                                    "Comment Submitted Successfully!",
                                    "success");
									$('#CommentFormModal').modal('hide');
                            } else {
                                swal("Oops!", "Something went wrong, Please try again", "warning");
                            }
                        }
                    });
                    swal("Thankyou!", "Comment Submitted Successfully!",
                        "success");
						$('#CommentFormModal').modal('hide');

                }
            }

            return false;
        }
		$(function() {
			$( "i.like-icon" ).click(function() {
			$( "i.like-icon,span.like-txt" ).toggleClass( "press", 1000 );
			});
		});


		// Like Button

		$('.likebtn').click(function() {
            $blogid = $(this).data('blogid');
            $btnLike = $(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: APP_URL + '/blog/like',
                data: {
                    blogid: $blogid
                },
                success: function(response) {
                    if (response.status) {
                        $btnLike.removeClass("btn-outline-dark").addClass("btn-primary");
                    } else {
                        $btnLike.addClass("btn-outline-dark").removeClass("btn-primary");
                    }
                    $('#like-' + $blogid).html(response.likecpy);
                }
            });
        });
    </script>

@endsection
