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
                    @foreach ($answers as $answer)
                    <div class="col-xl-4" id="card-{{ $answer->id }}">
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
                                                @if ($answer->user->avatar != '')
                                                    @if (strpos($answer->user->avatar, "http") === false)
                                                    <img src="{{ env('APP_URL') . "img/square/".$answer->user->avatar }}" class="h-75 align-self-center" alt="{{ $answer->user->name }}" />
                                                    @else
                                                    <img src="{{ $answer->user->avatar }}" class="h-75 align-self-center" alt="{{ $answer->user->name }}" />
                                                    @endif
                                                @else
                                                    <img src="{{  \Avatar::create($answer->user->name)->toBase64() }}" class="h-75 align-self-center" alt="{{ $answer->user->name }}" />
                                                @endif
                                            {{-- <img src="{{ $answer->avatar }}" class="h-75 align-self-center" alt="{{ $answer->name }}" /> --}}
                                            </span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Text-->
                                        <div class="d-flex flex-column flex-grow-1">
                                            <a  class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">{{ $answer->user->name }}</a>
                                            <span class="text-muted font-weight-bold"></span>
                                            <small><a href="{{ URL::to('question/'.$answer->question->slug) }}">{{ $answer->question->title }}</a></small>

                                        </div>
                                        <div class="d-flex flex-column flex-grow-0">
                                            @if($answer->user_id == AUTH::id())
                                            <a data-blid = "{{ $answer->id }}" class="delete-btn btn btn-icon btn-light btn-xs mb-1 px-2 py-1">
                                                <i class="flaticon2-trash text-danger "></i>
                                            </a>
                                            <a data-blid = "{{ $answer->id }}" data-toggle="modal" data-target="#reply-modal" data-qsl="{{ $answer->id }}" class="reply-btn btn btn-icon btn-light btn-xs mb-1 px-2 py-1">
                                                <i class="flaticon-edit text-primary "></i>
                                            </a>
                                            @endif
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Desc-->
                                    <p class="text-dark-50 m-0 pt-5 font-weight-normal" id="answer-{{ $answer->id }}">{{ $answer->answer }}</p>
                                    <!--end::Desc-->
                                    <!--begin::Separator-->
                                        <div class="separator separator-solid mt-5 mb-4"></div>
                                        <!--end::Separator-->
                                        <!--begin::Editor-->
                                        {{-- <form class="position-relative border-bottom">
                                            <textarea  id="answer-{{ $answer->id }}" class="form-control border-0 p-0 pr-10" rows="3" placeholder="Reply..."></textarea>
                                            <div class="position-absolute top-0 right-0 mt-n1 mr-n2">
                                                <a data-blog="{{ $answer->blog_id }}" data-parent="{{ $answer->id }}" class="btn btn-icon btn-sm btn-hover-icon-primary reply-btn">
                                                    <i class="fa fa-paper-plane text-primary"></i>
                                                </a>
                                            </div>
                                        </form> --}}
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
                @if($answers->total() >18 )
                <div class="row">
                    <div class="col-12">
                        <div class="card card-custom gutter-b">
                            <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <div class="d-flex flex-wrap py-2 mr-3">
                                    {{ $answers->links() }}
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
    <!-- reply modal begin -->
    <div class="modal fade" id="reply-modal" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Submit an Answer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-1">
                    <h5>Answer -</h5>
                    <textarea class="form-control" id="answer-content" name="answer-content" rows="7"></textarea>
                </div>
                <button type="button" class="btn btn-primary mt-3 submit-btn">Submit</button>
            </div>
        </div>
    </div>
</div>
<!-- reply modal end -->
@endsection

@section('js')

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //  $('.reply-btn').click(function(){
    //     var parent_id = $(this).data("parent");
    //     var answer = $('#answer-'+parent_id).val();
    //     var blog_id = $(this).data('blog');
    //     console.log(answer);
    //             if (answer != "" ) {
                    
    //                 $.ajax({
    //                     type: 'post',
    //                     url: APP_URL + '/answer/submit',
    //                     data: {
    //                         answer: answer,
    //                         parent_id: parent_id,
	// 						blog_id: blog_id
    //                     },
    //                     success: function(response) {
    //                         if (response.status) {
    //                             swal("Thankyou!",
    //                                 "answer Submitted Successfully!",
    //                                 "success");
    //                         } else {
    //                             swal("Oops!", "Something went wrong, Please try again", "warning");
    //                         }
    //                     },
    //                     error: function(response) {
    //                         swal("Oops!", "Something went wrong, Please try again", "warning");
    //                     }
    //                 });
    //             }
    //         return false;
    //     });

        //
        qid="";
        $('.reply-btn').click(function(){
        qid = $(this).data('qsl');
        $('#answer-content').val($('#answer-'+qid).html());
        });
     $('.submit-btn').click(function(){
        var answer_id = qid;
        var answer = $('#answer-content').val();
        console.log(answer);
                if (answer != "" ) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'post',
                        url: APP_URL + '/answer/answeredit',
                        data: {
                            answer: answer,
                            answer_id: answer_id                        },
                        success: function(response) {
                            if (response.status) {
                                swal("Thankyou!",
                                    "Answer Modified Successfully!",
                                    "success");
                                $('.modal').modal('hide');
                                $('#answer-'+qid).html(answer);
                    
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
                    text: "Once deleted, you will not be able to recover this answer!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                        type: 'DELETE',
                        url: APP_URL + '/answer/delete/' + $(this).data('blid'),
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