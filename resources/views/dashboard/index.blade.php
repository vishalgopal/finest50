@extends('layout.dashboard')

@section('title', 'Dashboard')

@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid pt-10" id="kt_content">
						
    <!--begin::Modal-->
    <div class="modal fade" id="subheader7Modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Select Location</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="kt_subheader_leaflet" style="height:450px; width: 100%;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cancel</button>
                    <button id="submit" type="button" class="btn btn-primary font-weight-bold" data-dismiss="modal">Apply</button>
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Dashboard-->
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <!--begin::Details-->
                    <div class="d-flex mb-9">
                        <!--begin: Pic-->
                        <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                            <div class="symbol symbol-50 symbol-lg-120">
                            <img src="{{ $user->avatar}}" alt="image" />
                            </div>
                            <div class="symbol symbol-50 symbol-lg-120 symbol-primary d-none">
                                <span class="font-size-h3 symbol-label font-weight-boldest">{{ $user->name}}</span>
                            </div>
                        </div>
                        <!--end::Pic-->
                        <!--begin::Info-->
                        <div class="flex-grow-1">
                            <!--begin::Title-->
                            <div class="d-flex justify-content-between flex-wrap mt-1">
                                <div class="d-flex mr-3">
                                    <a href="#" class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3">{{ $user->name}}</a>
                                    <a href="#">
                                        <i class="flaticon2-correct text-success font-size-h5"></i>
                                    </a>
                                </div>
                                <!-- <div class="my-lg-0 my-3">
                                    <a href="#" class="btn btn-sm btn-light-success font-weight-bolder text-uppercase mr-3">ask</a>
                                    <a href="#" class="btn btn-sm btn-info font-weight-bolder text-uppercase">hire</a>
                                </div> -->
                            </div>
                            <!--end::Title-->
                            <!--begin::Content-->
                            <div class="d-flex flex-wrap justify-content-between mt-1">
                                <div class="d-flex flex-column flex-grow-1 pr-8 pl-0 col-sm-6">
                                    <div class="d-flex flex-wrap mb-4">
                                        @if ($user->email!="")
                                        <a class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                        <i class="flaticon2-new-email mr-2 font-size-lg"></i>{{ $user->email}}</a>
                                        @endif  
                                        @if ($user->designation!="")
                                        <a class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                        <i class="flaticon2-calendar-3 mr-2 font-size-lg"></i>{{ $user->designation}}</a>
                                        @endif
                                        @if ($user->city!="")
                                        <a class="text-dark-50 text-hover-primary font-weight-bold">
                                        <i class="flaticon2-placeholder mr-2 font-size-lg"></i>{{ $user->city}}</a>
                                        @endif
                                    </div>
                                    <span class="font-weight-bold text-dark-50">{{ $user->short_description}}</span>
                                </div>
                                <div class="d-flex align-items-center w-25 flex-fill float-right mt-lg-12 mt-8 col-sm-5 offset-sm-1">
                                    <span class="font-weight-bold text-dark-75 mr-2">Average Rating</span>
                                    {!! $user->rating !!}
                                    {{-- <i class="fas fa-star text-warning ml-1"></i>
                                    <i class="fas fa-star text-warning ml-1"></i>
                                    <i class="fas fa-star text-warning ml-1"></i>
                                    <i class="fas fa-star text-warning ml-1"></i>
                                    <i class="fas fa-star-half-alt text-warning ml-1"></i> --}}
                                    
                                </div>
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Details-->
                    <div class="separator separator-solid"></div>
                    <!--begin::Items-->
                    <div class="d-flex align-items-center flex-wrap mt-8">
                        <!--begin::Item-->
                        <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                            <span class="mr-4">
                                <i class="flaticon-questions-circular-button display-4 text-muted font-weight-bold"></i>
                            </span>
                            <div class="d-flex flex-column text-dark-75">
                                <span class="font-weight-bolder font-size-sm">Answers</span>
                                <span class="font-weight-bolder font-size-h5">
                                <span class="text-dark-50 font-weight-bold"></span>{{ $user->answers}}</span>
                            </div>
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                            <span class="mr-4">
                                <i class="flaticon-chat-2 display-4 text-muted font-weight-bold"></i>
                            </span>
                            <div class="d-flex flex-column text-dark-75">
                                <span class="font-weight-bolder font-size-sm">Stories</span>
                                <span class="font-weight-bolder font-size-h5">
                                <span class="text-dark-50 font-weight-bold"></span>{{ $user->stories}}</span>
                            </div>
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                            <span class="mr-4">
                                <i class="flaticon-file-2 display-4 text-muted font-weight-bold"></i>
                            </span>
                            <div class="d-flex flex-column text-dark-75">
                                <span class="font-weight-bolder font-size-sm">Reviews</span>
                                <span class="font-weight-bolder font-size-h5">
                                <span class="text-dark-50 font-weight-bold"></span>{{ $user->reviews}}</span>
                            </div>
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                            <span class="mr-4">
                                <i class="flaticon-network display-4 text-muted font-weight-bold"></i>
                            </span>
                            <div class="d-flex flex-column flex-lg-fill">
                                <span class="font-weight-bolder font-size-sm">Followers</span>
                                <span class="font-weight-bolder font-size-h5">
                                    <span class="text-dark-50 font-weight-bold"></span>{{ $user->follower}}</span>
                            </div>
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                            <span class="mr-4">
                                <i class="flaticon-chat-1 display-4 text-muted font-weight-bold"></i>
                            </span>
                            <div class="d-flex flex-column flex-lg-fill">
                                <span class="font-weight-bolder font-size-sm">Comments</span>
                                <span class="font-weight-bolder font-size-h5">
                                    <span class="text-dark-50 font-weight-bold"></span>{{ $totalcomments}}</span>
                            </div>
                        </div>
                        <!--end::Item-->
                        
                    </div>
                    <!--begin::Items-->
                </div>
            </div>
            <!--end::Card-->
            <!--begin::Row-->
            <div class="row">
                <div class="col-xl-4">

                    <!--begin::List Widget 8-->
                    <div class="card card-custom card-stretch gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0">
                            <h3 class="card-title font-weight-bolder text-dark">Comments</h3>
                            
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-0">
                            <!--begin::Item-->
                            @foreach ($comments as $comment)
                            <div class="mb-10">
                                <!--begin::Section-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-45 symbol-light mr-5">
                                        <span class="symbol-label">
                                            @if ($comment->avatar != '')
                                                    @if (strpos($comment->avatar, "http") === false)
                                                    <img src="{{ env('APP_URL') . "/public/img/square/".$comment->avatar }}" class="h-75 align-self-center" alt="{{ $comment->name }}" />
                                                    @else
                                                    <img src="{{ $comment->avatar }}" class="h-75 align-self-center" alt="{{ $comment->name }}" />
                                                    @endif
                                                @else
                                                    <img src="{{  \Avatar::create($comment->name)->toBase64() }}" class="h-75 align-self-center" alt="{{ $comment->name }}" />
                                                @endif
                                        </span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Text-->
                                    <div class="d-flex flex-column flex-grow-1">
                                        <a href="#" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">{{ $comment->name }}</a>
                                        <span class="text-muted font-weight-bold">{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</span>
                                    </div>
                                    <div class="d-flex flex-column flex-grow-0">
                                        <a data-subject = "{{ $comment->id }}" data-type = "comment" class="btn btn-icon btn-light btn-xs mb-1 px-2 py-1 flag-btn">
                                            <i class="fa fa-flag @if($comment->flagged) text-danger @else text-medium @endif"></i>
                                        </a>
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
                            @endforeach
                            <div class="text-right"><a href="" class="btn btn-primary">View All</a></div>   
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end: Card-->
                    <!--end::List Widget 8-->
                </div>

                <div class="col-xl-4">
                    <!--begin::Mixed Widget 5-->
                    <div class="card card-custom bg-radial-gradient-primary gutter-b card-stretch">
                        <!--begin::Header-->
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title font-weight-bolder text-white">Progress Report</h3>
                            
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body d-flex flex-column p-0">
                            <!--begin::Chart-->
                            <div id="kt_mixed_widget_5_chart" style="height: 200px"></div>
                            <!--end::Chart-->
                            <!--begin::Stats-->
                            <div class="card-spacer bg-white card-rounded flex-grow-1">												
                                <!--begin::Row-->
                                <div class="row m-0">
                                    <div class="col px-8 py-6 mr-8">
                                        <div class="font-size-sm text-muted font-weight-bold">Average Questions</div>
                                        <div class="font-size-h4 font-weight-bolder">350</div>
                                    </div>
                                    <div class="col px-8 py-6">
                                        <div class="font-size-sm text-muted font-weight-bold">Average Answers</div>
                                        <div class="font-size-h4 font-weight-bolder">480</div>
                                    </div>
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <div class="row m-0">
                                    <div class="col px-8 py-6 mr-8">
                                        <div class="font-size-sm text-muted font-weight-bold">Average Comments</div>
                                        <div class="font-size-h4 font-weight-bolder">650</div>
                                    </div>
                                    <div class="col px-8 py-6">
                                        <div class="font-size-sm text-muted font-weight-bold">Average Reviews</div>
                                        <div class="font-size-h4 font-weight-bolder">600</div>
                                    </div>
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <div class="row m-0">
                                    <div class="col px-8 py-6 mr-8">
                                        <div class="font-size-sm text-muted font-weight-bold">Average Ratings</div>
                                        <div class="font-size-h4 font-weight-bolder">4.5</div>
                                    </div>
                                    <div class="col px-8 py-6">
                                        
                                    </div>
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Mixed Widget 5-->
                </div>
                <div class="col-xl-4">

                    <!--begin::List Widget 8-->
                    <div class="card card-custom card-stretch gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0">
                            <h3 class="card-title font-weight-bolder text-dark">Reviews</h3>
                            
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-0">
                            <!--begin::Item-->
                            @foreach ($reviews as $review)
                            <div class="mb-10">
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
                                        </span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Text-->
                                    <div class="d-flex flex-column flex-grow-1">
                                        <a href="#" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">{{ $review->name }}</a>
                                        <span class="text-muted font-weight-bold">{{ \Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</span>
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
                                    {{-- <form class="position-relative">
                                        <textarea id="kt_forms_widget_5_input" class="form-control border-0 p-0 pr-10 resize-none" rows="1" placeholder="Reply..."></textarea>
                                        <div class="position-absolute top-0 right-0 mt-n1 mr-n2">
                                            <span class="btn btn-icon btn-sm btn-hover-icon-primary">
                                                <i class="fa fa-paper-plane text-primary"></i>
                                            </span>
                                        </div>
                                    </form> --}}
                                    <!--edit::Editor-->
                            </div>
                            <!--end::Item-->
                            @endforeach
                            <!--end::Item-->
                            <div class="text-right"><a href="" class="btn btn-primary">View All</a></div>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end: Card-->
                    <!--end::List Widget 8-->
                </div>

            </div>
            <!--end::Row-->
            <div class="row">									
                
                <div class="col-xl-8">
                    <!--begin::Tiles Widget 15-->
                    <div class="card card-custom gutter-b card-stretch">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <div class="card-title">
                                <div class="card-label">
                                    <div class="font-weight-bolder">Followers</div>
                                    <div class="font-size-sm text-muted mt-2">Total {{ $user->follower }}</div>
                                </div>
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body d-flex flex-row">
                            <!--begin::Items-->
                            <div class="row w-100">
                                <!--begin::Item-->
                            @foreach ($followers as $follower)
                            <div class="col-sm-4 col-6 d-flex align-items-center justify-content-between mb-5" style="max-height: 50px;">
                                <div class="d-flex align-items-center mr-2">
                                    <div class="symbol symbol-50 symbol-light mr-3 flex-shrink-0">
                                        <div class="symbol-label">
                                            <img src="{{ $follower->avatar }}" alt="" class="h-75" />
                                        </div>
                                    </div>
                                    <div>
                                        <a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">{{ $follower->name }}</a>
                                        <div class="font-size-sm text-muted font-weight-bold mt-1">{{ $follower->name }}</div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                                <!--end::Item-->
                            </div>
                            <!--end::Items-->


                        </div>
                        <!--end::Body-->
                        
                    </div>
                    <!--end::Tiles Widget 15-->
                </div>


                <div class="col-xl-4">
                    <div class="card card card-custom card-stretch gutter-b">
                        <!--begin::Header-->
                        <div class="card-header align-items-center border-0 mt-4">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="font-weight-bolder text-dark">My Activity</span>
                                <span class="text-muted mt-3 font-weight-bold font-size-sm">Recent Activities</span>
                            </h3>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-4">
                            <!--begin::Timeline-->
                            <div class="timeline timeline-6 mt-3">
                                <!--begin::Item-->

                                @foreach ($activites as $activity)
                                <div class="timeline-item align-items-start">
                                    <!--begin::Label-->
                                    <div class="timeline-label font-weight-light text-dark-50"><small>{{ $activity->created_at->diffForHumans() }}</small></div>
                                    <!--end::Label-->
                                    <!--begin::Badge-->
                                    <div class="timeline-badge bg-primary">
                                        <i class="fa fa-genderless text-warning icon-xl"></i>
                                    </div>
                                    <!--end::Badge-->
                                    <!--begin::Text-->
                                    <div class="font-weight-mormal font-size-lg timeline-content text-dark-75 pl-3">{{ $activity->description }}</div>
                                    <!--end::Text-->
                                </div>
                                @endforeach
                                <!--end::Item-->
                            </div>
                            <!--end::Timeline-->
                            <div class="text-right"><a href="" class="btn btn-primary">View All</a></div>
                        </div>
                        <!--end: Card Body-->
                    </div>
                </div>
                <!-- / x4 -->
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row mb-6">
                <div class="col-lg-6">
                    <!--begin::Card-->
                    <div class="card card-custom card-stretch">
                        <div class="card-header border-0 ">
                            <div class="card-title">
                                <h3 class="card-label">Upload Pictures</h3>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="uppy" id="kt_uppy_1">
                                <div class="uppy-dashboard"></div>
                                <div class="uppy-progress"></div>
                            </div>
                        </div>
                    </div>
                    <!--end::Card-->
                </div>
                <div class="col-lg-6">
                    <!--begin::Card-->
                    <div class="card card-custom card-stretch">
                        <div class="card-header border-0">
                            <div class="card-title">
                                <h3 class="card-label">Upload Videos</h3>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="uppy" id="kt_uppy_2">
                                <div class="uppy-dashboard"></div>
                                <div class="uppy-progress"></div>
                            </div>
                        </div>
                    </div>
                    <!--end::Card-->
                </div>
            </div>
            <!--end::Row-->


            <div class="row">
                @if(count($blogs)>1)
                    @foreach ($blogs as $blog)
                        @if($loop->index<=1)
                        <div class="col-xl-4">
                            <!--begin::Mixed Widget 10-->
                            <div class="card card-custom card-stretch gutter-b">
                                <div class="card-header border-0 pt-5">
                                    <div class="card-title">
                                        <div class="card-label">
                                            <div class="font-weight-bolder">Blog</div>
                                            <div class="font-size-sm text-muted mt-2">{{ $blog->created_at->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                </div>
        
                                <!--begin::Body-->
                                <div class="card-body d-flex flex-column">
                                    <div class="flex-grow-1 pb-5">
                                        <div class="bgi-no-repeat bgi-size-cover rounded min-h-265px mb-4" style="background-image: url({{ asset('img/large/' .$blog->image) }})"></div>
                                        <!--begin::Link-->
                                        <a href="{{ URL::to('blog/'.$blog->slug) }}" class="text-dark font-weight-bolder text-hover-primary font-size-h4">{{ $blog->title }}</a>
                                        <!--end::Link-->
                                        <!--begin::Desc-->
                                        <p class="text-dark-50 font-weight-normal font-size-lg mt-6">{{ strip_tags(substr($blog->description,0,150)) }}</p>
                                        <!--end::Desc-->
                                        <!--begin::Action-->
                                                    <div class="d-flex align-items-center">
                                                        <a href="{{ URL::to('blog/'.$blog->slug) }}#comments" class="btn btn-hover-text-primary btn-hover-icon-primary btn-sm btn-text-dark-50 bg-light-primary rounded font-weight-bolder font-size-sm p-2 mr-2">
                                                        <span class="svg-icon svg-icon-md svg-icon-primary pr-2">
                                                            <!--begin::Svg Icon | path:/assets/media/svg/icons/Communication/Group-chat.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                                    <path d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z" fill="#000000"></path>
                                                                    <path d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z" fill="#000000" opacity="0.3"></path>
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>{{ $blog->comment_count }}</a>
                                                        <a href="#" class="btn btn-hover-text-danger btn-hover-icon-danger btn-sm btn-text-dark-50 bg-hover-light-danger rounded font-weight-bolder font-size-sm p-2">
                                                        <span class="svg-icon svg-icon-md svg-icon-dark-25 pr-1">
                                                            <!--begin::Svg Icon | path:/assets/media/svg/icons/General/Heart.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                                    <path d="M16.5,4.5 C14.8905,4.5 13.00825,6.32463215 12,7.5 C10.99175,6.32463215 9.1095,4.5 7.5,4.5 C4.651,4.5 3,6.72217984 3,9.55040872 C3,12.6834696 6,16 12,19.5 C18,16 21,12.75 21,9.75 C21,6.92177112 19.349,4.5 16.5,4.5 Z" fill="#000000" fill-rule="nonzero"></path>
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>{{ $blog->likers()->count() }}</a>
                                                    </div>
                                                    <!--end::Action-->
                                    </div>
                                    <!--begin::Team-->
                                    
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Mixed Widget 10-->
                        </div>
                            @if (count($blogs)>2 && $loop->index == 1)
                            <div class="col-xl-4">
                                <!--begin::Mixed Widget 12-->
                                <div class="card card-custom card-stretch gutter-b">
                                    <div class="card-header border-0 pt-5">
                                        <div class="card-title">
                                            <div class="card-label">
                                                <div class="font-weight-bolder">Blog</div>
                                                <div class="font-size-sm text-muted mt-2">Blog List</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--begin::Body-->
                                    <div class="card-body">
                                                <!--begin::Container-->
                                                <div>
                                                    <!--begin::Body-->
                                                    <div>
                            @endif
                        @elseif($loop->index >= 2)

                        <!--begin::Item-->
                        <div class="d-flex py-5">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-40  mr-5 mt-1">
                                <span class="symbol-label">
                                    <img src="{{ asset('img/small/' .$blog->image) }}" class="h-75 align-self-end" alt="">
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Info-->
                            <div class="d-flex flex-column flex-row-fluid">
                                <!--begin::Info-->
                                <div class="d-flex align-items-center flex-wrap">
                                    <a href="{{ URL::to('blog/'.$blog->slug) }}" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder pr-6">{{ $blog->title }}</a>
                                    <span class="text-muted font-weight-normal flex-grow-1 font-size-sm">{{ $blog->created_at->diffForHumans() }}</span>
                                    
                                </div>
                                        <span class="text-dark-75 font-size-sm font-weight-normal pt-1">{{ strip_tags(substr($blog->description,0,150)) }}</span>
                                <!--end::Info-->
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Separator-->
                <div class="separator separator-solid mb-4"></div>
                <!--end::Separator-->
                        @elseif($loop->last)
                    <div class="text-right"><a href="{{ URL::to('dashboard/blogs') }}" class="btn btn-primary">View All</a></div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Container-->
                
            </div>
    <!--end::Body-->
</div>
<!--end::Mixed Widget 12-->
</div>
                        @endif
                    @endforeach
                @endif
                
                                       
                                   
            </div>
            <!--end::Row-->
            
            <!--end::Dashboard-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->
@endsection

@section('js')
<script src="{{ asset('assets/plugins/custom/uppy/uppy.bundle.js?v=7.1.2') }}"></script>
<script src="{{ asset('assets/js/pages/crud/file-upload/uppy.js?v=7.1.2') }}"></script>
<script>
     $('.reply-btn').click(function(){
        var parent_id = $(this).data("parent");
        var comment = $('#comment-'+parent_id).val();
        var blog_id = $(this).data('blog');
        console.log(comment);
                if (comment != "" ) {
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
        var subject_id = $(this).data("subject");
        var type = $(this).data("type");
        var $current = $(this);
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