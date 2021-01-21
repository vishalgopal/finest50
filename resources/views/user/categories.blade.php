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
                                <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla natus mollitia ipsum.
                                    Voluptatibus, perspiciatis placeat.</span>
                            </div>
            
                            <!-- <div class="row course-categories clearfix mb-4">
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
            
                            </div> -->
                            <div class="row mt-5">
                                <div class="col-12">
                                <div class="tabs side-tabs responsive-tabs clearfix" id="tab-4">

<ul class="tab-nav clearfix">
    <li><a href="#tabs-1">Doctor</a></li>
    <li><a href="#tabs-2">Development</a></li>
    <li><a href="#tabs-3">Music</a></li>
    <li><a href="#tabs-4">Business</a></li>
    <li><a href="#tabs-4">Teacher</a></li>
    <li><a href="#tabs-4">Food</a></li>
    <li><a href="#tabs-4">Lifestyle</a></li>
    <li><a href="#tabs-4">Photography</a></li>
    <li><a href="#tabs-4">Enginners</a></li>
    <li><a href="#tabs-4">Academics</a></li>
</ul>

<div class="tab-container pt-0">

    <div class="tab-content clearfix" id="tabs-1">
        <div class="row">
            <div class="col-12">
                <h3 class="mb-0 text-primary">Doctor</h3>
                <div class="divider mt-2 mb-3"><i class="icon-circle"></i></div>
            <ul class="all-cat-ul">
                <li><a href="#">Family Physician</a></li>    
                <li><a href="#">Internal Medicine Physician</a></li>
                <li><a href="#">Pediatrician</a></li>    
                <li><a href="#">Obstetrician/Gynecologist (OB/GYN)</a></li>
                <li><a href="#">Surgeon</a></li>    
                <li><a href="#">Psychiatrist</a></li>
                <li><a href="#">Cardiologist</a></li>    
                <li><a href="#">Dermatologist</a></li>
                <li><a href="#">Endocrinologist</a></li>    
                <li><a href="#">Gastroenterologist</a></li>
                <li><a href="#">Infectious Disease Physician</a></li>    
                <li><a href="#">Nephrologist</a></li>
                <li><a href="#">Ophthalmologist</a></li>    
                <li><a href="#">Otolaryngologist</a></li>
                <li><a href="#">Pulmonologist</a></li>
                <li><a href="#">Neurologist</a></li>
                <li><a href="#">Physician Executive</a></li>
                <li><a href="#">Radiologist</a></li>
                <li><a href="#">Anesthesiologist</a></li> 
        </ul>
            </div>
        </div>
    </div>
    <!-- /tab -->
    <div class="tab-content clearfix" id="tabs-2">
        Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.
    </div>
    <div class="tab-content clearfix" id="tabs-3">
        <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
        Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.
    </div>
    <div class="tab-content clearfix" id="tabs-4">
        Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.
    </div>

</div>

</div>
                                </div>
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
