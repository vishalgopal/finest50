@extends('layout.dashboard')

@section('title', 'Dashboard - Stories')

@section('content')
<style>
    .dropzone .dz-preview .dz-image {
        width: 100%;
        height: 100%;
        max-height: 660px;
        border-radius: 0;
    }

    .dropzone .dz-preview .dz-image img {
        width: 100%;
        object-fit: cover;
    }

    .dropzone.dropzone-default .dz-remove {
        font-size: 14px;
    }
</style>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid pt-10" id="kt_content">

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Dashboard-->

            <div class="row">
                <div class="col-12">
                    <div class="card card-custom gutter-b">
                        <div class="card-header">
                            <h3 class="card-title">Stories</h3>
                            <div class="card-toolbar">
                                <a href="{{ URL::to('dashboard/blog/create')}}" class="btn btn-sm btn-primary font-weight-bold">
                                <i class="flaticon-plus"></i>Create New</a>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <!--begin::Row-->
            <div class="row">
                @foreach($blogs as $blog)
                <div class="col-xl-4" id="blog-{{ $blog->id }}">
                        <!--begin::Mixed Widget 10-->
                        <div class="card card-custom card-stretch gutter-b">

                            <!--begin::Body-->
                            <div class="card-body d-flex flex-column">
                                <div class="flex-grow-1 pb-5">
                                    <div class="bgi-no-repeat bgi-size-cover rounded min-h-265px mb-4"
                                        style="background-image: url({{ asset('img/large/' .$blog->image) }})">
                                    </div>
                                    <!--begin::Link-->
                                    <a href="{{ URL::to('blog/'.$blog->slug) }}"
                                        class="text-dark font-weight-bolder text-hover-primary font-size-h4">{{ $blog->title }}
                                    </a>
                                    <!--end::Link-->
                                    <!--begin::Desc-->
                                    <p class="text-dark-50 font-weight-normal font-size-lg mt-6">
                                        {!! Str::limit(strip_tags($blog->description), 150, ' ...') !!}
                                    </p>
                                    <div class="font-size-sm text-muted mt-2">
                                        {{ $blog->created_at->diffForHumans() }}</div>
                                    <!--end::Desc-->
                                    <!--begin::Action-->
                                    <div class="d-flex align-items-center">
                                        <a href="{{ URL::to('blog/'.$blog->slug) }}"
                                            class="btn btn-hover-text-primary btn-hover-icon-primary btn-sm btn-text-dark-50 bg-light-primary rounded font-weight-bolder font-size-sm p-2 mr-2">
                                            <span class="svg-icon svg-icon-md svg-icon-primary pr-2">
                                                <!--begin::Svg Icon | path:/assets/media/svg/icons/Communication/Group-chat.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <path
                                                            d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z"
                                                            fill="#000000"></path>
                                                        <path
                                                            d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z"
                                                            fill="#000000" opacity="0.3"></path>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>{{ $blog->comment_count }}</a>
                                        <a href="#"
                                            class="btn btn-hover-text-danger btn-hover-icon-danger btn-sm btn-text-dark-50 bg-hover-light-danger rounded font-weight-bolder font-size-sm p-2">
                                            <span class="svg-icon svg-icon-md svg-icon-dark-25 pr-1">
                                                <!--begin::Svg Icon | path:/assets/media/svg/icons/General/Heart.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                        <path
                                                            d="M16.5,4.5 C14.8905,4.5 13.00825,6.32463215 12,7.5 C10.99175,6.32463215 9.1095,4.5 7.5,4.5 C4.651,4.5 3,6.72217984 3,9.55040872 C3,12.6834696 6,16 12,19.5 C18,16 21,12.75 21,9.75 C21,6.92177112 19.349,4.5 16.5,4.5 Z"
                                                            fill="#000000" fill-rule="nonzero"></path>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>{{ $blog->likers()->count() }}</a>
                                        <a href=" {{ URL::to('dashboard/blog/edit/' . $blog->slug) }}"
                                            class="btn btn-hover-text-primary btn-hover-icon-primary btn-sm btn-text-dark-50 bg-hover-light-primary rounded font-weight-bolder font-size-sm p-2">
                                            <span class="svg-icon svg-icon-md svg-icon-dark-25 pr-1">
                                                <i class="flaticon-edit-1"></i>
                                                <!--end::Svg Icon-->
                                            </span></a>
                                            <a href="#"
                                            class="btn btn-hover-text-danger btn-hover-icon-danger delete-btn btn-sm btn-text-dark-50 bg-hover-light-danger rounded font-weight-bolder font-size-sm p-2" data-blid="{{ $blog->id }}">
                                                <span class="svg-icon svg-icon-md svg-icon-dark-25 pr-1">
                                                    <i class="flaticon2-trash"></i>
                                                    <!--end::Svg Icon-->
                                                </span></a>
                                    </div>
                                    <!--end::Action-->
                                </div>
                                <!--begin::Team-->

                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Mixed Widget 10-->
                    </div>
                    <!-- end : col-4 -->
                @endforeach

            </div>
            <!--end::Row-->
            @if($blogs->total() > 12)
                <div class="row">
                    <div class="col-12">
                        <div class="card card-custom gutter-b">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center flex-wrap">
                                    {{ $blogs->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!--end::Dashboard-->


                </div>
                <!--end::Container-->
            </div>
            <!--end::Entry-->
        </div>
        <!--end::Content-->

        @endsection
        @section('js')
        {{-- <script src="{{ asset('assets/plugins/custom/uppy/uppy.bundle.js?v=7.1.2') }}">
        </script>
        <script src="{{ asset('assets/js/pages/crud/file-upload/uppy.js?v=7.1.2') }}">
        </script> --}}
        {{-- <script
            src="{{ asset('assets/js/pages/crud/file-upload/dropzonejs.js?v=7.1.2') }}">
        </script> --}}
        <script src="//cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
        <script>
            // Dropzone.autoDiscover = false;

            // Dropzone.options.myDropzone = {
            //     addRemoveLinks: true,
            //     url: "yourUrl",
            //     paramName: "image",
            //     maxFiles: 1,
            //     thumbnailWidth: null,
            //     thumbnailHeight: null,
            //     init: function () {
            //         this.on("thumbnail", function (file, dataUrl) {
            //                 $('.dz-image').last().find('img').attr({
            //                     width: '100%',
            //                     height: '100%'
            //                 });
            //             }),
            //             this.on("success", function (file) {
            //                 $('.dz-image').css({
            //                     "width": "100%",
            //                     "height": "auto"
            //                 });
            //             });


            //     }
            // };

            // var myDropzone = new Dropzone('div#myDropzone');

            // $('.submit-btn').click(function () {
            //     var category_id = $('#category_id').val();
            //     var description = $('#description').val();
            //     var $title = $('#title').val();
            //     var $image = $('#image').val();
            //     if (title != "") {
            //         $.ajaxSetup({
            //             headers: {
            //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //             }
            //         });
            //         $.ajax({
            //             type: 'post',
            //             url: APP_URL + '/blog/update',
            //             data: {
            //                 category_id: category_id,
            //                 description: description,
            //                 title: title,
            //                 image: image,
            //             },
            //             success: function (response) {
            //                 if (response.status) {
            //                     swal("Thankyou!",
            //                         response.msg,
            //                         "success");
            //                     if (response.msg == "Removed Flag") {
            //                         $current.html('<i class="fa fa-flag text-medium"></i>');
            //                     } else {
            //                         $current.html('<i class="fa fa-flag text-danger"></i>');
            //                     }
            //                 } else {
            //                     swal("Oops!", "Something went wrong, Please try again", "warning");
            //                 }
            //             },
            //             error: function (response) {
            //                 swal("Oops!", "Something went wrong, Please try again", "warning");
            //             }
            //         });
            //     }
            //     return false;
            // });

            $(document).ready(function (e) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#image').change(function () {

                    let reader = new FileReader();
                    reader.onload = (e) => {
                        $('#image_preview_container').attr('src', e.target.result);
                        $('.dropzone-msg-title').hide();
                    }
                    reader.readAsDataURL(this.files[0]);

                });

                // $('#blog-post').submit(function (e) {
                //     e.preventDefault();
                //     for (instance in CKEDITOR.instances) {
                //         CKEDITOR.instances[instance].updateElement();
                //     }
                //     var formData = new FormData(this);
                //     $.ajax({
                //         type: 'POST',
                //         url: APP_URL + '/blog/save',
                //         data: formData,
                //         cache: false,
                //         contentType: false,
                //         processData: false,
                //         success: (data) => {
                //             this.reset();
                //             swal(response.msg);
                //         },
                //         error: function (reject) {
                //             var errors = $.parseJSON(reject.responseText);
                //             $.each(errors.errors, function (key, val) {
                //                 console.log(key + " - - " + val);
                //                 $("#" + key + "_error").text(val);
                //             });
                //         }
                //     });
                // });

                $('.delete-btn').click(function (e) {
                    e.preventDefault();
                    swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this story!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                        type: 'DELETE',
                        url: APP_URL + '/blog/delete/' + $(this).data('blid'),
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            $('#blog-' + $(this).data('blid')).fadeOut( "slow", function() {
                                $('#blog-' + $(this).data('blid')).remove();
                            });
                            // swal(data.msg, { icon: "success", });
                        },
                        error: function (reject) {
                            var errors = $.parseJSON(reject.responseText);
                            $.each(errors.errors, function (key, val) {
                                console.log(key + " - - " + val);
                                $("#" + key + "_error").text(val);
                            });
                        }
                    });
                    }
                    });
                    
                });
            });

            // var avatar1 = new KTImageInput('kt_image_1');
        </script>
        @endsection