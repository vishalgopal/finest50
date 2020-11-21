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
                    <div class="col-12">
                <!--begin::Items-->
                <div class="card card-custom gutter-b card-stretch">
                    <div class="card-body d-flex flex-row">
                                <div class="row w-100">
                                    <!--begin::Item-->
                                    @foreach ($followings as $following)
                                    <div class="col-sm-3 col-6 d-flex align-items-center justify-content-between mb-5">
                                        <div class="d-flex align-items-center mr-2">
                                            <div class="symbol symbol-50 symbol-light mr-3 flex-shrink-0">
                                                <div class="symbol-label">
                                                    <img src="{{ $following->avatar }}" alt="{{ $following->name }}" class="h-75" />
                                                </div>
                                            </div>
                                            <div>
                                                <a href="{{ URL::to('member/'.$following->slug) }}" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">{{ $following->name }}</a>
                                                <div class="font-size-sm text-muted font-weight-bold mt-1">{{ $following->created_at->diffForHumans() }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <!--end::Item-->
                                </div>
                                <!--end::Items-->
                <!--end::Row-->
                    </div>
                </div>
                </div>
                </div>

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
    
</script>
@endsection