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
                    @foreach ($reviews as $review)
                    <div class="col-xl-4">
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
                                                @if ($review->avatar != '')
                                                    @if (strpos($review->avatar, "http") === false)
                                                    <img src="{{ env('APP_URL') . "img/square/".$review->avatar }}" class="h-75 align-self-center" alt="{{ $review->name }}" />
                                                    @else
                                                    <img src="{{ $review->avatar }}" class="h-75 align-self-center" alt="{{ $review->name }}" />
                                                    @endif
                                                @else
                                                    <img src="{{  \Avatar::create($review->name)->toBase64() }}" class="h-75 align-self-center" alt="{{ $review->name }}" />
                                                @endif
                                            {{-- <img src="{{ $review->avatar }}" class="h-75 align-self-center" alt="{{ $review->name }}" /> --}}
                                            </span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Text-->
                                        <div class="d-flex flex-column flex-grow-1">
                                            <a  class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">{{ $review->name }}</a>
                                            <span class="text-muted font-weight-bold"></span>
                                        </div>
                                        <div class="d-flex flex-column flex-grow-0">
                                        <a data-subject = "{{ $review->id }}" data-type = "review" class="btn btn-icon btn-light btn-xs mb-1 px-2 py-1 flag-btn">
                                                <i class="fa fa-flag @if($review->flagged) text-danger @else text-medium @endif"></i>
                                            </a>
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Desc-->
                                    <p class="text-dark-50 m-0 pt-5 font-weight-normal">{{ $review->review }}</p>
                                    <!--end::Desc-->
                                    <!--begin::Separator-->
                                        <div class="separator separator-solid mt-5 mb-4"></div>
                                        <!--end::Separator-->
                                        <!--begin::Editor-->
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
                @if($reviews->total() >18 )
                <div class="row">
                    <div class="col-12">
                        <div class="card card-custom gutter-b">
                            <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <div class="d-flex flex-wrap py-2 mr-3">
                                    {{ $reviews->links() }}
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
     $('.reply-btn').click(function(){
        var parent_id = $(this).data("parent");
        var review = $('#review-'+parent_id).val();
        var blog_id = $(this).data('blog');
        console.log(review);
                if (review != "" ) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'post',
                        url: APP_URL + '/review/submit',
                        data: {
                            review: review,
                            parent_id: parent_id,
							blog_id: blog_id
                        },
                        success: function(response) {
                            if (response.status) {
                                swal("Thankyou!",
                                    "review Submitted Successfully!",
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