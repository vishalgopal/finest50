@extends('layout.main')

@section('title', 'Search')

@section('meta')

@endsection
@section('content')
    <!-- Content
		============================================= -->
		<section id="content">
			{{-- <div class="content-wrap"> --}}
				{{-- <div class="container clearfix"> --}}

                
                    <div class="all-category-section">
                        <div class="container">
            
                            <div class="heading-block my-4 center">
                                <h3>Categories</h3>
                                <span>List of all Categories</span>
                            </div>
            
                            
                            <div class="row mt-5">
                                <div class="col-12">
                                {{-- <div class="tabs side-tabs responsive-tabs clearfix" id="tab-4">

                                <ul class="tab-nav clearfix">
                                    @foreach ($parentCategories as $parent)
                                        <li><a href="#{{ $parent->slug }}">{{ $parent->title }}</a></li>
                                    @endforeach
                                </ul>

                                <div class="tab-container pt-0">
                                    @foreach ($categories as $category)
                                    <div class="tab-content clearfix" id="{{ $category->slug }}">
                                        <div class="row">
                                            <div class="col-12">
                                                <h3 class="mb-0 text-primary">{{ $category->title }}</h3>
                                                <div class="divider mt-2 mb-3"><i class="icon-circle"></i></div>
                                            <ul class="all-cat-ul">
                                                <li><a href="{{ URL::to('members/'.$category->slug) }}">All</a></li> 
                                                @foreach ($category->children as $child)
                                                    <li><a href="{{ URL::to('members/'.$child->slug) }}">{{ $child->title }}</a></li>    
                                                @endforeach
                                            </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <!-- /tab -->
                                </div>

                                </div> --}}
                                <div class="row course-categories clearfix mb-4">
                                    @foreach ($categories as $category)
                                        <div class="col-lg-2 col-sm-3 col-6 mt-4">
                                            <div class="card hover-effect">
                                                <img class="card-img" src="img/small/{{ $category->image }}" alt="Card image">
                                                <a href="{{ URL::to('/members/' . $category->slug) }}" class="card-img-overlay rounded p-0"
                                                    style="background-color: rgba({{ rand(1, 251) }},{{ rand(1, 251) }},{{ rand(1, 251) }},0.8);">
                                                    <span><i class="icon-star1"></i>{{ $category->title }}</span>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                
                                </div>
                                </div>
                            </div>
                            <div class="clear"></div>
                           
            
                        </div>
                        {{-- </div> --}}
            
					
				{{-- </div> --}}
			</div>
		</section><!-- #content end -->

@endsection


@section('js')

@endsection
