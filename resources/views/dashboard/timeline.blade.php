@extends('layout.dashboard')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex flex-column-fluid">
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                <div class="card-label">
                    <div class="font-weight-bolder">Timeline</div>
                </div>
            </div>
        </div>
        <div class="card-body">
        <div class="timeline timeline-basic">
                        <div class="timeline-preview">
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
    
</div>
<!--end::Entry-->
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js"></script>
<script type="text/javascript">
    // $('ul.pagination').hide();
    $(function() {
        $('.scrolling-pagination').jscroll({
            autoTrigger: true,
            debug: true,
            padding: 0,
            nextSelector: '.pagination li.active + li a',
            contentSelector: 'div.scrolling-pagination',
            callback: function() {
                $('ul.pagination').remove();
            }
        });
    });
</script>
@endsection