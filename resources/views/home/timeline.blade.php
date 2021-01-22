@extends('layout.main')

@section('title', 'Timeline')

@section('meta')

@endsection
@section('content')


<!-- Content
      ============================================= -->
<section id="content">
    <div class="content-wrap pb-0">
        <div class="container clearfix">

            <div class="row col-mb-50 mb-0">

                <div class="col-lg-12">

                    <div class="heading-block fancy-title border-bottom-0 title-bottom-border">
                        <h4>Time<span>line</span></h4>
                    </div>
                    <!--begin::Timeline-->
                    <div class="timeline timeline-3">
                        <div class="timeline-items scrolling-pagination">
                            @foreach ($activites as $activity)
                                @php
                                $properties = json_decode($activity->properties);
                                
                                $subjecttype = explode('\\',$activity->subject_type);
                                if ($subjecttype[1] == 'Blog'){
                                    $labelcolor = "label-light-success";
                                }
                                elseif($subjecttype[1] == 'Answer'){
                                    $labelcolor = "label-light-warning";
                                }
                                elseif($subjecttype[1] == 'User'){
                                    $labelcolor = "label-light-primary";
                                }elseif($subjecttype[1] == 'Comment'){
                                    $labelcolor = "label-light-danger";
                                }
                                else{
                                    $labelcolor = "label-light-dark";
                                }
                                @endphp   
                            <div class="timeline-item border-0">
                                <div class="timeline-media">
                                    <img alt="Pic" src = "{{  $properties->useravatar }}">
                                </div>
                                <div class="timeline-content">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div class="mr-2">																				
                                            <a href="{{ URL::to($properties->slug) }}" class="text-dark-75 text-hover-primary font-weight-bold">{{ $activity->description }}</a>
                                            <span class="text-muted ml-2">{{ $activity->created_at->diffForHumans() }}</span>
                                            @php
                                                $properties = json_decode($activity->properties);
                                                
                                                $subjecttype = explode('\\',$activity->subject_type);
                                                if ($subjecttype[1] == 'Blog'){
                                                    $labelcolor = "label-light-success";
                                                }
                                                elseif($subjecttype[1] == 'Answer'){
                                                    $labelcolor = "label-light-warning";
                                                }
                                                elseif($subjecttype[1] == 'User'){
                                                    $labelcolor = "label-light-primary";
                                                }elseif($subjecttype[1] == 'Comment'){
                                                    $labelcolor = "label-light-danger";
                                                }
                                                else{
                                                    $labelcolor = "label-light-dark";
                                                }
                                            @endphp
                                            <span class="label {{ $labelcolor }} font-weight-bolder label-inline ml-2">{{ $subjecttype[1] }}</span>
                                        </div>
                                        
                                    </div>
                                    <div class="pb-5">
                                    @if ($subjecttype[1] == "Blog")
                                    <a href="{{ URL::to($properties->slug) }}">
                                        <img src="{{ asset('/storage/'.$properties->image) }}" class="w-25" alt="">
                                    </a>
                                    @endif
                                    </div>
                                @if ($subjecttype[1] == "Blog" || $subjecttype[1] == "Comment" || $subjecttype[1] == "Answer" )
                                    <p class="p-0">{{ $properties->description ?? '' }}</p>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!--end::Timeline-->
                    

                </div>


            </div>
            {{ $activites->links() }}
        </div>


    </div>
</section><!-- #content end -->

@endsection