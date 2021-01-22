@extends('layout.dashboard')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex flex-column-fluid">
    <div class="card card-custom gutter-b w-100 col-12 col-sm-10 offset-sm-1">
        <div class="card-header">
            <div class="card-title">
                <div class="card-label">
                    <div class="font-weight-bolder">Activities</div>
                </div>
            </div>
        </div>
        <div class="card-body">
        <div class="timeline timeline-basic">
                        <div class="timeline-preview">
                            <!--begin::Timeline-->
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