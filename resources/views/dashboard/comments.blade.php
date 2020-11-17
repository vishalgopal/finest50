@extends('layout.dashboard')

@section('title', 'Dashboard')

@section('content')
	<!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid pt-10" id="kt_content">						
						
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Dashboard-->
                
                <!--begin::Row-->
                <div class="row">
                    @foreach ($comments as $comment)
                    <div class="col-xl-4" id="card-{{ $comment->id }}">
                        <!--begin::Widget-->
                        <div class="card card-custom card-stretch gutter-b">
                            
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Item-->
                                <div>
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-45 symbol-light mr-5">
                                            <span class="symbol-label">
                                                @if ($comment->avatar != '')
                                                    @if (strpos($comment->avatar, "http") === false)
                                                    <img src="{{ env('APP_URL') . "img/square/".$comment->avatar }}" class="h-75 align-self-center" alt="{{ $comment->name }}" />
                                                    @else
                                                    <img src="{{ $comment->avatar }}" class="h-75 align-self-center" alt="{{ $comment->name }}" />
                                                    @endif
                                                @else
                                                    <img src="{{  \Avatar::create($comment->name)->toBase64() }}" class="h-75 align-self-center" alt="{{ $comment->name }}" />
                                                @endif
                                            {{-- <img src="{{ $comment->avatar }}" class="h-75 align-self-center" alt="{{ $comment->name }}" /> --}}
                                            </span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Text-->
                                        <div class="d-flex flex-column flex-grow-1">
                                            <a  class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">{{ $comment->name }}</a>
                                            <span class="text-muted font-weight-bold"></span>
                                            <small><a href="{{ URL::to('blog/'.$comment->slug) }}">{{ $comment->title }}</a></small>

                                        </div>
                                        <div class="d-flex flex-column flex-grow-0">
                                        <a data-subject = "{{ $comment->id }}" data-type = "comment" class="btn btn-icon btn-light btn-xs mb-1 px-2 py-1 flag-btn">
                                                <i class="fa fa-flag @if($comment->flagged) text-danger @else text-medium @endif"></i>
                                            </a>
                                        @if($comment->user_id == AUTH::id())
                                        <a data-blid = "{{ $comment->id }}" class="delete-btn btn btn-icon btn-light btn-xs mb-1 px-2 py-1">
                                            <i class="flaticon2-trash text-danger "></i>
                                        </a>
                                        @endif
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Desc-->
                                    <p class="text-dark-50 m-0 pt-5 font-weight-normal">{{ $comment->comment }}</p>
                                    <!--end::Desc-->
                                    <!--begin::Separator-->
                                        <div class="separator separator-solid mt-5 mb-4"></div>
                                        <!--end::Separator-->
                                        <!--begin::Editor-->
                                        <form class="position-relative border-bottom">
                                            <textarea  id="comment-{{ $comment->id }}" class="form-control border-0 p-0 pr-10" rows="3" placeholder="Reply..."></textarea>
                                            <div class="position-absolute top-0 right-0 mt-n1 mr-n2">
                                                <a data-blog="{{ $comment->blog_id }}" data-parent="{{ $comment->id }}" class="btn btn-icon btn-sm btn-hover-icon-primary reply-btn">
                                                    <i class="fa fa-paper-plane text-primary"></i>
                                                </a>
                                            </div>
                                        </form>
                                        <!--edit::Editor-->
                                </div>
                                <!--end::Item-->
                                
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end: Card-->
                    </div>
                    @endforeach

                </div>
                <!--end::Row-->
                @if($comments->total() >18 )
                <div class="row">
                    <div class="col-12">
                        <div class="card card-custom gutter-b">
                            <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <div class="d-flex flex-wrap py-2 mr-3">
                                    {{ $comments->links() }}
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>	
                @endif

                
                <!--end::Dashboard-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->
@endsection

@section('js')

<script>
     $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
     $('.reply-btn').click(function(){
        var parent_id = $(this).data("parent");
        var comment = $('#comment-'+parent_id).val();
        var blog_id = $(this).data('blog');
        console.log(comment);
                if (comment != "" ) {
                    
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
                            } else {
                                swal("Oops!", "Something went wrong, Please try again", "warning");
                            }
                        },
                        error: function(response) {
                            swal("Oops!", "Something went wrong, Please try again", "warning");
                        }
                    });
                }
            return false;
        });

        $('.flag-btn').click(function(){
            console.log("sds");
        var subject_id = $(this).data("subject");
        var type = $(this).data("type");
        var $current = $(this);
        console.log(type);
                if (type != "" ) {
                    
                    $.ajax({
                        type: 'post',
                        url: APP_URL + '/user/flag',
                        data: {
                            type: type,
                            subject_id: subject_id,
                        },
                        success: function(response) {
                            if (response.status) {
                                swal("Thankyou!",
                                response.msg,
                                    "success");
                                if (response.msg=="Removed Flag"){
                                    $current.html('<i class="fa fa-flag text-medium"></i>'); 
                                }
                                else{
                                    $current.html('<i class="fa fa-flag text-danger"></i>'); 
                                }
                            } else {
                                swal("Oops!", "Something went wrong, Please try again", "warning");
                            }
                        },
                        error: function(response) {
                            swal("Oops!", "Something went wrong, Please try again", "warning");
                        }
                    });
                }
            return false;
        });
        // Delete Start
        $('.delete-btn').click(function (e) {
                    e.preventDefault();
                    swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this comment!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                        type: 'DELETE',
                        url: APP_URL + '/comment/delete/' + $(this).data('blid'),
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            $('#card-' + $(this).data('blid')).fadeOut( "slow", function() {
                                $('#card-' + $(this).data('blid')).remove();
                            });
                        swal(data.msg, { icon: "success", });
                        },
                        error: function (reject) {
                            var errors = $.parseJSON(reject.responseText);
                            $.each(errors.errors, function (key, val) {
                                console.log(key + " - - " + val);
                                $("#" + key + "_error").text(val);
                            });
                        }
                    });
                    }
                    });
                    
                });
                // Delete End
</script>
@endsection