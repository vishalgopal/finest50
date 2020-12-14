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

                
                    <div class="section pop-stories-bg">
                        <div class="container">
            
                            <div class="heading-block border-bottom-0 my-4 mob-my center">
                                <h3>Categories</h3>
                                <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla natus mollitia ipsum.
                                    Voluptatibus, perspiciatis placeat.</span>
                            </div>
            
                            <div class="row course-categories clearfix mb-4">
                                @foreach ($categories as $category)
                                    <div class="col-lg-2 col-sm-3 col-6 mt-4">
                                        <div class="card hover-effect">
                                            <img class="card-img" src="img/small/{{ $category->image }}" alt="Card image">
                                            <a href="{{ URL::to('/members/' . $category->slug) }}" class="card-img-overlay rounded p-0"
                                                style="background-color: rgba({{ rand(1, 251) }},{{ rand(1, 251) }},{{ rand(1, 251) }},0.8);">
                                                <span><i class="icon-music1"></i>{{ $category->title }}</span>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
            
                            </div>
                            <div class="clear"></div>
                           
            
                        </div>
                        {{-- </div> --}}
            
					
                    {{-- Pagination --}}
                    {{ $categories->links() }}
				{{-- </div> --}}
			</div>
		</section><!-- #content end -->

@endsection


@section('js')

@endsection
