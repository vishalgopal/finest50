<!--begin::Aside-->
<div class="aside aside-left d-flex flex-column" id="kt_aside">
    <!--begin::Brand-->
    <div class="aside-brand d-flex flex-column align-items-center flex-column-auto py-4 py-lg-8">
        <!--begin::Logo-->
        <a href="{{ URL::to("/dashboard") }}">
            <img alt="Logo" src="{{ asset('assets/media/logos/Finest50-logo.svg') }}" class="max-h-30px" />
        </a>
        <!--end::Logo-->
    </div>
    <!--end::Brand-->
    <!--begin::Nav Wrapper-->
    <div class="aside-nav d-flex flex-column align-items-center flex-column-fluid pt-7">
        <!--begin::Nav-->
        <ul class="nav flex-column">
            <!--begin::Item-->
            @if($user->type=='member')
            <li class="nav-item mb-5" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Dashboard">
                <a href="{{ URL::to('dashboard')}}" class="nav-link btn btn-icon btn-icon-white btn-lg @if(Request::segment(2)=='') btn-clean active @endif">
                    <i class="flaticon2-protection icon-lg"></i>
                </a>
            </li>
            @endif
            <!--end::Item-->
            <!--begin::Item-->
            <li class="nav-item mb-5" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Timeline">
                <a href="{{ URL::to('dashboard/timeline')}}" class="nav-link btn btn-icon btn-icon-white btn-lg @if(Request::segment(2)=='timeline') btn-clean active @endif">
                    <i class="flaticon-list-3 icon-lg"></i>
                </a>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            @if($user->type=='member')
            <li class="nav-item mb-5" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Blogs">
                <a href="{{ URL::to('dashboard/blogs')}}" class="nav-link btn btn-icon btn-icon-white btn-lg @if(Request::segment(2)=='blogs') btn-clean active @endif">
                    <i class="flaticon2-list-3 icon-lg"></i>
                </a>
            </li>
            @endif
            <!--end::Item-->
            <!--begin::Item-->
            <li class="nav-item mb-5" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Comments">
                <a href="{{ URL::to('dashboard/comments')}}" class="nav-link btn btn-icon btn-icon-white btn-lg @if(Request::segment(2)=='comments') btn-clean active @endif">
                    <i class="flaticon2-chat-1 icon-lg"></i>
                </a>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            @if($user->type=='member')
            <li class="nav-item mb-5" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Reviews">
                <a href="{{ URL::to('dashboard/reviews')}}" class="nav-link btn btn-icon btn-icon-white btn-lg @if(Request::segment(2)=='reviews') btn-clean active @endif">
                    <i class="flaticon2-file-1 icon-lg"></i>
                </a>
            </li>
            @endif
            <!--end::Item-->
            <!--begin::Item-->
            <li class="nav-item mb-5" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Questions">
                <a href="{{ URL::to('dashboard/questions')}}" class="nnav-link btn btn-icon btn-icon-white btn-lg @if(Request::segment(2)=='questions') btn-clean active @endif">
                    <i class="flaticon-questions-circular-button icon-lg"></i>
                </a>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            @if($user->type=='member')
            <li class="nav-item mb-5" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Answers">
                <a href="{{ URL::to('dashboard/answers')}}" class="nnav-link btn btn-icon btn-icon-white btn-lg @if(Request::segment(2)=='answers') btn-clean active @endif">
                    <i class="flaticon-chat-1 icon-lg"></i>
                </a>
            </li>
            @endif
            <!--end::Item-->
            <!--begin::Item-->
            @if($user->type=='member')
            <li class="nav-item mb-5" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Followers">
                <a href="{{ URL::to('dashboard/followers')}}" class="nav-link btn btn-icon btn-icon-white btn-hover-text-white btn-lg @if(Request::segment(2)=='followers') btn-clean active @endif">
                    <i class="flaticon-network icon-lg"></i>
                </a>
            </li>
            @endif
            <!--end::Item-->
             <!--begin::Item-->
             @if($user->type=='user')
             <li class="nav-item mb-5" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Followings">
                 <a href="{{ URL::to('dashboard/followings')}}" class="nav-link btn btn-icon btn-icon-white btn-hover-text-white btn-lg @if(Request::segment(2)=='followings') btn-clean active @endif">
                     <i class="flaticon-network icon-lg"></i>
                 </a>
             </li>
             @endif
             <!--end::Item-->
            <!--begin::Item-->
            <li class="nav-item mb-5" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Profile">
                <a href="{{ URL::to('dashboard/profile')}}" class="nav-link btn btn-icon btn-icon-white btn-hover-text-white btn-lg @if(Request::segment(2)=='profile') btn-clean active @endif">
                    <i class="flaticon-profile-1 icon-lg"></i>
                </a>
            </li>
            <!--end::Item-->
        </ul>
        <!--end::Nav-->
    </div>
    <!--end::Nav Wrapper-->
    
</div>
<!--end::Aside-->