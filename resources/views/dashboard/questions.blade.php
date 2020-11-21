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
                    @foreach ($questions as $question)
                    <div class="col-xl-12" id="question-{{ $question->id }}">
                        <!--begin::Widget-->
                        <div class="card card-custom card-stretch gutter-b">

                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Item-->
                                <div>
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center">
                                        @if($user->type=="member")
                                        <div class="symbol symbol-45 symbol-light mr-5">
                                            <span class="symbol-label">
                                                @if ($question->user->avatar != '')
                                                    @if (strpos($question->user->avatar, "http") === false)
                                                    <img src="{{ env('APP_URL') . "img/square/".$question->user->avatar }}" class="h-75 align-self-center" alt="{{ $question->user->name }}" />
                                                    @else
                                                    <img src="{{ $question->user->avatar }}" class="h-75 align-self-center" alt="{{ $question->user->name }}" />
                                                    @endif
                                                @else
                                                    <img src="{{  \Avatar::create($question->user->name)->toBase64() }}" class="h-75 align-self-center" alt="{{ $question->user->name }}" />
                                                @endif
                                            </span>
                                        </div>
                                        @endif
                                        <!--begin::Text-->
                                        @if($user->type=="member")
                                        <div class="d-flex flex-column flex-grow-1">
                                            <a class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">{{ $question->user->name }}</a>
                                            <span class="text-muted font-weight-bold">{{ $question->created_at->diffForHumans() }}</span>
                                        </div>
                                        @endif

                                        <div class="d-flex flex-column flex-grow-0">
                                            @if ($user->type=="member")
                                            <div class="btn btn-secondary float-right reply-btn"
                                                data-toggle="modal" data-target="#reply-modal" data-qsl="{{ $question->id }}">Reply 
                                                <i class="fa fa-reply fa-1x"></i>
                                            </div>
                                            @endif
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Desc-->
                                    <h6 class="text-dark-75 m-0 pt-5">{{ $question->title }}</h6>
                                    @if($user->type=="user")
                                    <div class="d-flex flex-column flex-grow-1">
                                        <a href="{{ URL::to('question/'.$question->slug)}}" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">View <i class="fa fa-eye fa-1x"></i></a>
                                        <span class="text-muted font-weight-bold">{{ $question->created_at->diffForHumans() }}</span>
                                        <span class="text-muted font-weight-bold">@if ($question->answers_count==0) Not Yet Answered @else {{ $question->answers_count }} Answer(s) @endif </span>
                                    </div>
                                    @endif
                                    <!--end::Desc-->

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

                @if($questions->total() >18 )
                <div class="row">
                    <div class="col-12">
                        <div class="card card-custom gutter-b">
                            <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <div class="d-flex flex-wrap py-2 mr-3">
                                    {{ $questions->links() }}
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>	
                @endif

					<!-- reply modal begin -->
					<div class="modal fade" id="reply-modal" tabindex="-1" role="dialog"
						aria-labelledby="staticBackdrop" aria-hidden="true">
						<div class="modal-dialog  modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="ModalLabel">Submit an Answer</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<i aria-hidden="true" class="ki ki-close"></i>
									</button>
								</div>
								<div class="modal-body">
									<div class="form-group mb-1">
										<h5>Reply -</h5>
										<textarea class="form-control" id="answer-content" name="answer-content" rows="7"></textarea>
									</div>
									<button type="button" class="btn btn-primary mt-3 submit-btn">Submit</button>
								</div>
							</div>
						</div>
					</div>
					<!-- reply modal end -->
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
    qid = '';
     $('.reply-btn').click(function(){
        qid = $(this).data('qsl');
        });
     $('.submit-btn').click(function(){
        var question_id = qid;
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
                        url: APP_URL + '/answer/submit',
                        data: {
                            answer: answer,
                            question_id: question_id                        },
                        success: function(response) {
                            if (response.status) {
                                swal("Thankyou!",
                                    "answer Submitted Successfully!",
                                    "success");
                                $('#question-' + question_id).fadeOut( "slow", function() {
                                    $('#question-' + question_id).remove();
                                });
                                $('.modal').modal('hide');
                    
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
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
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
</script>
@endsection