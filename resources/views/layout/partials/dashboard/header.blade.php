
								<!--begin::Header Menu Wrapper-->
								<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
									<!--begin::Header Menu-->
									<div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
										<!--begin::Header Nav-->
										<ul class="menu-nav">
											@if($user->type=='member')
											<li class="menu-item @if(Request::segment(2)=='') menu-item-active @endif">
												<a href="{{ URL::to('dashboard')}}" class="menu-link">
													<span class="menu-text">Dashboard</span>
												</a>
											</li>	
											@endif
											<li class="menu-item @if(Request::segment(2)=='timeline') menu-item-active @endif">
												<a href="{{ URL::to('dashboard/timeline')}}" class="menu-link">
													<span class="menu-text">Timeline</span>
												</a>
											</li>	
											@if($user->type=='member')
											<li class="menu-item @if(Request::segment(2)=='blogs') menu-item-active @endif">
												<a href="{{ URL::to('dashboard/blogs')}}" class="menu-link">
													<span class="menu-text">Blogs</span>
												</a>
											</li>
											@endif
											<li class="menu-item @if(Request::segment(2)=='comments') menu-item-active @endif">
												<a href="{{ URL::to('dashboard/comments')}}" class="menu-link">
													<span class="menu-text">Comments</span>
												</a>
											</li>
											@if($user->type=='member')
											<li class="menu-item @if(Request::segment(2)=='reviews') menu-item-active @endif">
												<a href="{{ URL::to('dashboard/reviews')}}" class="menu-link">
													<span class="menu-text">Reviews</span>
												</a>
											</li>
											@endif
											<li class="menu-item @if(Request::segment(2)=='questions') menu-item-active @endif">
												<a href="{{ URL::to('dashboard/questions')}}" class="menu-link">
													<span class="menu-text">Questions</span>
												</a>
											</li>
											@if($user->type=='member')
											<li class="menu-item @if(Request::segment(2)=='answers') menu-item-active @endif">
												<a href="{{ URL::to('dashboard/answers')}}" class="menu-link">
													<span class="menu-text">Answers</span>
												</a>
											</li>
											@endif
											<li class="menu-item @if(Request::segment(2)=='chat') menu-item-active @endif">
												<a href="{{ URL::to('dashboard/chat')}}" class="menu-link">
													<span class="menu-text">Chat</span>
												</a>
											</li>
											@if($user->type=='member')
											<li class="menu-item @if(Request::segment(2)=='followers') menu-item-active @endif">
												<a href="{{ URL::to('dashboard/followers')}}" class="menu-link">
													<span class="menu-text">Followers</span>
												</a>
											</li>
											@else	
											<li class="menu-item @if(Request::segment(2)=='followings') menu-item-active @endif">
												<a href="{{ URL::to('dashboard/followings')}}" class="menu-link">
													<span class="menu-text">Followings</span>
												</a>
											</li>
											@endif
											{{-- <li class="menu-item @if(Request::segment(2)=='profile') menu-item-active @endif">
												<a href="{{ URL::to('dashboard/profile')}}" class="menu-link">
													<span class="menu-text">Profile</span>
												</a>
											</li>	 --}}
											
										</ul>
										<!--end::Header Nav-->
									</div>
									<!--end::Header Menu-->
								</div>
								<!--end::Header Menu Wrapper-->
							</div>
							<!--end::Left-->
							<!--begin::Topbar-->
							<div class="topbar">
								<!--begin::Chat-->
								<div class="topbar-item mr-5">
									{{-- <div class="btn btn-icon btn-clean btn-primary btn-lg" data-toggle="modal" data-target="#kt_chat_modal"  style="position: fixed; bottom: 10px; right: 10px;"> --}}
									<a class="btn btn-icon btn-primary btn-lg" href="{{URL::to('/dashboard/chat') }}" style="position: fixed; bottom: 10px; right: 10px;">
										<i class="flaticon2-chat-1"></i>
									</a>
								</div>
								<!--end::Chat-->
								<!--begin::User-->
								<div class="topbar-item">
									<div class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
										<div class="d-flex flex-column text-right">
											<!-- <span class="text-muted font-weight-bold font-size-base d-none d-md-inline">Jason Muller</span>
											<span class="text-dark-75 font-weight-bolder font-size-base d-none d-md-inline">PR Manager</span> -->
											<img src="{{ $user->avatar }}" alt="" width="35" height="35">
										</div>
										<!-- <span class="symbol symbol-35 symbol-light-primary">
											<span class="symbol-label font-size-h5 font-weight-bold">S</span>
										</span> -->
									</div>
								</div>
								<!--end::User-->
							</div>
							<!--end::Topbar-->
						