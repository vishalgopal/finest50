@extends('layout.dashboard')

@section('title', 'Dashboard - Blogs')
@section ('css')
<link rel="stylesheet" href="{{ asset('css/basic.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/dropzone.min.css') }}" />
@endsection
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
    input[type="file"] {
  display: block;
}
.imageThumb {
  max-height: 75px;
  border: 2px solid;
  padding: 1px;
  cursor: pointer;
}
.pip {
  display: inline-block;
  margin: 10px 10px 0 0;
}
.remove {
  display: block;
  background: #444;
  border: 1px solid black;
  color: white;
  text-align: center;
  cursor: pointer;
}
.remove:hover {
  background: white;
  color: black;
}
</style>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid pt-10" id="kt_content">

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Dashboard-->

            <!--end::Dashboard-->

            <!-- Profile start -->
            <div class="row">
                <!-- Personal Details start -->
                <div class="col-12">
                    <div class="card card-custom gutter-b">
                        <div class="card-header border-0">
                            <h3 class="card-title">Personal Details</h3>
                        </div>

                        <div class="card-body pt-0">
                            <form class="form" id="personal-details">
                                <div class="form-group row">
                                    <div class="col-lg-3">
                                        <label class="d-block">Select Your Avatar:</label><br>
                                        <div class="image-input image-input-outline" id="kt_image_1">
                                            <div class="image-input-wrapper"
                                            @if ($user->avatar != '')
                                            @if (strpos($user->avatar, "http") === false)
                                            style="background-image: url({{ env('APP_URL') . "img/square/".$user->avatar }})"
                                            @else
                                            style="background-image: url({{ $user->avatar }})"
                                            @endif
                                        @else
                                        style="background-image: url({{  \Avatar::create($user->name)->toBase64() }})"
                                        @endif
                                                >
                                            
                                            </div>

                                            <label
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="change" data-toggle="tooltip" title=""
                                                data-original-title="Change avatar">
                                                <i class="fa fa-pen text-primary"></i>
                                                <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg" />
                                                {{-- <input type="hidden" name="profile_avatar_remove" /> --}}
                                            </label>

                                            <span
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                                <i class="ki ki-bold-close text-primary"></i>
                                            </span>
                                        </div>
                                        <span class="form-text text-muted">Allowed file types: <br>png, jpg, jpeg.</span>
                                    </div>

                                    <div class="col-lg-9">
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <label>Full Name:</label>
                                                <input type="text" class="form-control" placeholder="Enter full name" name="name" id="name" value="{{ $user->name ?? '' }}"/>
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Username:</label>
                                                <div class="input-group">
                                                    <label type="text" class="form-control" name="slug" id="slug"> {{ $user->slug ?? '' }} </label>
                                                </div>
                                            </div>                                            
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <label>Email:</label>
                                                <label type="email" class="form-control" placeholder="Enter email"  name="email" id="email" >{{ $user->email ?? '' }}</label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Display Email:</label>
                                                <span class="switch switch-sm">
                                                    <label>
                                                        <input type="hidden" name="display_email" value="0"/>
                                                        <input type="checkbox" @if ($user->display_email) checked="checked" @endif value="1"  name="display_email" />
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <label>Contact:</label>
                                                <label type="text" class="form-control"
                                                    placeholder="Enter contact number"  name="mobile" id="mobile">{{ $user->mobile ?? '' }}</label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Display Contact:</label>
                                                <span class="switch switch-sm">
                                                    <label>
                                                        <input type="hidden" name="display_mobile" value="0"/>
                                                        <input type="checkbox"  name="display_mobile" @if ($user->display_mobile) checked="checked" @endif  value="1"   />
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0">
                                            <div class="col-lg-6">
                                                <label>Password:</label>
                                                <div class="input-group">
                                                    <input type="password" name="new_password" class="form-control"
                                                        placeholder="Password" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Confirm Password:</label>
                                                <div class="input-group">
                                                    <input type="password" name="new_password_confirm" class="form-control"
                                                        placeholder="Confirm Password" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-3">
                                    </div>
                                    <div class="col-lg-9">
                                        <button type="submit" class="btn btn-primary submit-btn">Save</button>
                                    </div>
                                </div>
                            {{-- </form> --}}
                            <!--end::Details-->
                            <div class="separator separator-solid"></div>
                            <!--begin::Items-->
                            <div class="d-flex align-items-center flex-wrap mt-8">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                                    <span class="mr-4">
                                        <i
                                            class="flaticon-questions-circular-button display-4 text-muted font-weight-bold"></i>
                                    </span>
                                    <div class="d-flex flex-column text-dark-75">
                                        <span class="font-weight-bolder font-size-sm">Answers</span>
                                        <span class="font-weight-bolder font-size-h5">
                                            <span
                                                class="text-dark-50 font-weight-bold"></span>{{ $user->answers }}</span>
                                    </div>
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                                    <span class="mr-4">
                                        <i class="flaticon-chat-2 display-4 text-muted font-weight-bold"></i>
                                    </span>
                                    <div class="d-flex flex-column text-dark-75">
                                        <span class="font-weight-bolder font-size-sm">Stories</span>
                                        <span class="font-weight-bolder font-size-h5">
                                            <span
                                                class="text-dark-50 font-weight-bold"></span>{{ $user->stories }}</span>
                                    </div>
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                                    <span class="mr-4">
                                        <i class="flaticon-file-2 display-4 text-muted font-weight-bold"></i>
                                    </span>
                                    <div class="d-flex flex-column text-dark-75">
                                        <span class="font-weight-bolder font-size-sm">Reviews</span>
                                        <span class="font-weight-bolder font-size-h5">
                                            <span
                                                class="text-dark-50 font-weight-bold"></span>{{ $user->reviews }}</span>
                                    </div>
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                                    <span class="mr-4">
                                        <i class="flaticon-network display-4 text-muted font-weight-bold"></i>
                                    </span>
                                    <div class="d-flex flex-column flex-lg-fill">
                                        <span class="text-dark-75 font-weight-bolder font-size-sm">Followers</span>
                                        <a href="#" class="text-primary font-weight-bolder">{{ $user->follower }}</a>
                                    </div>
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                                    <span class="mr-4">
                                        <i class="flaticon-chat-1 display-4 text-muted font-weight-bold"></i>
                                    </span>
                                    <div class="d-flex flex-column">
                                        <span class="text-dark-75 font-weight-bolder font-size-sm">Comments</span>
                                        <a href="#" class="text-primary font-weight-bolder">View</a>
                                    </div>
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                {{-- <div class="d-flex align-items-center flex-lg-fill mb-2 float-left">
                            <span class="mr-4">
                                <i class="flaticon-network display-4 text-muted font-weight-bold"></i>
                            </span>
                            <div class="symbol-group symbol-hover">
                                <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip" title="Mark Stone">
                                    <img alt="Pic" src="/assets/media/users/300_25.jpg" />
                                </div>
                                <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip" title="Charlie Stone">
                                    <img alt="Pic" src="/assets/media/users/300_25.jpg" />
                                </div>
                                <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip" title="Mark Stone">
                                    <img alt="Pic" src="/assets/media/users/300_25.jpg" />
                                </div>
                                <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip" title="Charlie Stone">
                                    <img alt="Pic" src="/assets/media/users/300_25.jpg" />
                                </div>
                                <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip" title="Mark Stone">
                                    <img alt="Pic" src="/assets/media/users/300_25.jpg" />
                                </div>
                                <div class="symbol symbol-30 symbol-circle symbol-light">
                                    <span class="symbol-label font-weight-bold">5+</span>
                                </div>
                            </div>
                        </div> --}}
                                <!--end::Item-->
                            </div>

                        </div>
                        <!-- / card body -->

                    </div>
                </div>
                <!-- Personal details end -->

            </div>
            <!-- Profile end -->

            <div class="row">
                <!-- Professional Details start -->
                <div class="col-xl-4">
                    <div class="card card-custom card-stretch gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0">
                            <h3 class="card-title font-weight-bolder text-dark">Professional Details</h3>
                        </div>
                        <!--begin::Body-->

                        {{-- <form class="form" id="professional_details"> --}}
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-lg-12 form-group">
                                        <label>Designation:</label>
                                        <input type="text" class="form-control" placeholder="Enter Designation"  name="designation" id="designation" value="{{ $user->designation ?? '' }}"/>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <label>Company Name:</label>
                                        <input type="text" class="form-control" placeholder="Enter Company Name"  name="company_name" id="company_name" value="{{ $user->company_name ?? '' }}"/>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <label>Qualification:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Enter Qualification"  name="qualification" id="qualification" value="{{ $user->qualification ?? '' }}"/>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary submit-btn">Save</button>

                            </div>
                        {{-- </form> --}}

                    </div>
                </div>
                <!-- Professional Details end -->

                <!-- Address start -->
                <div class="col-xl-8">
                    <div class="card card-custom card-stretch gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0">
                            <h3 class="card-title font-weight-bolder text-dark">Address</h3>
                        </div>
                        <!--begin::Body-->

                        {{-- <form class="form"> --}}
                            <div class="card-body pt-0">
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Country:</label>
                                        <select class="form-control" name="country" id="country">
                                            <option value="{{ $user->country ?? '' }}">{{ $user->country ?? 'Select' }}</option>
                                            @foreach($countries as $country)
                                                <option value="{{ $country->country }}">{{ $country->country }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>State:</label>
                                        <select class="form-control"  name="state" id="state" >
                                            <option value="{{ $user->state ?? '' }}">{{ $user->state ?? 'Select State' }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label>City:</label>
                                        <select class="form-control"  name="city" id="city" >
                                            <option value="{{ $user->city ?? '' }}">{{ $user->city ?? 'City' }}</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Location:</label>
                                        <select class="form-control"  name="location" id="location" >
                                            <option value="{{ $user->location ?? '' }}">{{ $user->location ?? 'Select Location' }}</option>
                                            @foreach($locations as $location)
                                                <option value="{{ $location->title }}">{{ $location->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Pincode:</label>
                                        <input type="text" class="form-control" name="pincode" placeholder="Enter Pincode" value="{{ $user->pincode ?? '' }}" />
                                    </div>
                                </div>
                                <div class="form-group row d-none">
                                    <div class="col-lg-6">
                                        <label>Latitude:</label>
                                        <input type="text" class="form-control" placeholder="Enter Latitude" value=""/>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Longitude:</label>
                                        <input type="text" class="form-control" placeholder="Enter Longitude" value="" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Address1:</label>
                                        <textarea class="form-control" name="address1" id="address1" cols="30" rows="2"
                                            placeholder="Enter Address1">{{ $user->address1 ?? '' }}</textarea>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Address2:</label>
                                        <textarea class="form-control" name="address2" id="address2" cols="30" rows="2"
                                            placeholder="Enter Address2">{{ $user->address2 ?? '' }}</textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        {{-- </form> --}}

                    </div>
                </div>
                <!-- Address end -->

            </div>            

            <!-- Response start -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-custom card-stretch gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0">
                            <h3 class="card-title font-weight-bolder text-dark">Response</h3>
                        </div>
                        <div class="card-body pt-0">
                            
                            <!--begin::Items-->
                            <div class="d-flex align-items-center flex-wrap">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                                    <span class="mr-4">
                                        <i
                                            class="flaticon-clock-1 display-4 text-muted font-weight-bold"></i>
                                    </span>
                                    <div class="d-flex flex-column text-dark-75">
                                        <span class="font-weight-bolder font-size-sm">Response Time</span>
                                        <span class="font-weight-bolder font-size-h5">
                                            <span
                                                class="text-dark-50 font-weight-bold"></span>20 mins</span>
                                    </div>
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                                    <span class="mr-4">
                                        <i class="flaticon2-percentage display-4 text-muted font-weight-bold"></i>
                                    </span>
                                    <div class="d-flex flex-column text-dark-75">
                                        <span class="font-weight-bolder font-size-sm">Response Rate</span>
                                        <span class="font-weight-bolder font-size-h5">
                                            <span
                                                class="text-dark-50 font-weight-bold"></span>90</span>
                                    </div>
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                                    <span class="mr-4">
                                        <i class="flaticon-chat-2 display-4 text-muted font-weight-bold"></i>
                                    </span>
                                    <div class="d-flex flex-column text-dark-75">
                                        <span class="font-weight-bolder font-size-sm">Responses</span>
                                        <span class="font-weight-bolder font-size-h5">
                                            <span
                                                class="text-dark-50 font-weight-bold"></span>199</span>
                                    </div>
                                </div>
                                <!--end::Item-->
                            </div>                          
                        </div>
                    </div>
                </div>
            </div>
                    <!-- Response end -->

            <!-- Descriptions start -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-custom card-stretch gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0">
                            <h3 class="card-title font-weight-bolder text-dark">Descriptions</h3>
                        </div>
                        <div class="card-body pt-0">
                            <div class="form-group">
                                <label>Short Description:</label>
                                <input type="text" class="form-control" placeholder="Enter Short Description"  name="short_description" id="short_description" value="{{ $user->short_description ?? '' }}"/>
                            </div>
                            <div class="form-group">
                                <label>Long Description:</label>
                                <textarea class="ckeditor" name="long_description" id="long_description" >{{ $user->long_description ?? '' }}</textarea>
                            </div>
                            <div class="form-group">
                                <input type="file" id="images" name="images[]" data-url="{{ URL::to('/')}}/user/updateimages"  multiple />
                                <input type="hidden" name="file_ids" id="file_ids" value="">

                            </div>
                            <div class="form-group">
                                <div id="userimages"> Drop headers </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>

                            
                        </div>
                    </div>
                </div>
            </div>
                    <!-- Descriptions end -->
        </form>

                    <!--begin::Row-->
                    <div class="row mb-6">
                        <div class="col-lg-6">
                            <!--begin::Card-->
                            <div class="card card-custom card-stretch">
                                <div class="card-header border-0 ">
                                    <div class="card-title">
                                        <h3 class="card-label">Upload Pictures</h3>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="uppy" id="kt_uppy_1">
                                        <div class="uppy-dashboard"></div>
                                        <div class="uppy-progress"></div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Card-->
                        </div>
                        <div class="col-lg-6">
                            <!--begin::Card-->
                            <div class="card card-custom card-stretch">
                                <div class="card-header border-0">
                                    <div class="card-title">
                                        <h3 class="card-label">Upload Videos</h3>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="uppy" id="kt_uppy_2">
                                        <div class="uppy-dashboard"></div>
                                        <div class="uppy-progress"></div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Card-->
                        </div>
                    </div>
                    <!--end::Row-->

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
        </script>  --}}
        {{-- <script src="{{ asset('js/vendor/jquery.ui.widget.js') }}"></script>
        <script src="{{ asset('js/jquery.iframe-transport.js') }}"></script> --}}
        <script src="{{ asset('js/dropzone.min.js') }}"></script>
        <script src="{{ asset('js/dropzone-amd-module.min.js') }}"></script>

        {{--   <!-- The basic File Upload plugin -->
        <script src="{{ asset('js/jquery.fileupload.js') }}"></script>
        <!-- The File Upload processing plugin -->
        <script src="{{ asset('js/jquery.fileupload-process.js') }}"></script>
        <!-- The File Upload image preview & resize plugin -->
        <script src="{{ asset('js/jquery.fileupload-image.js') }}"></script>
        <!-- The File Upload audio preview plugin -->
        <script src="{{ asset('js/jquery.fileupload-audio.js') }}"></script>
        <!-- The File Upload video preview plugin -->
        <script src="{{ asset('js/jquery.fileupload-video.js') }}"></script>
        <!-- The File Upload validation plugin -->
        <script src="{{ asset('js/jquery.fileupload-validate.js') }}"></script>
        <!-- The File Upload user interface plugin -->
        <script src="{{ asset('js/jquery.fileupload-ui.js') }}"></script> --}}
        <script src="//cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
        <script>
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

        // File Uploaded
        // $(function () {
        //     $('#images').fileupload({
        //         dataType: 'json',
        //         add: function (e, data) {
        //             // $('#loading').text('Uploading...');
        //             data.submit();
        //         },
        //         done: function (e, data) {
        //             $.each(data.result.files, function (index, file) {
        //                 // $('<p/>').html(file.name + ' (' + file.size + ' KB)').appendTo($('#files_list'));
        //                 if ($('#file_ids').val() != '') {
        //                     $('#file_ids').val($('#file_ids').val() + ',');
        //                 }
        //                 $('#file_ids').val($('#file_ids').val() + file.fileID);
        //             });
        //             $('#loading').text('');
        //         }
        //     });
        // });
            Dropzone.autoDiscover = false;

            Dropzone.options.myDropzone = {
                addRemoveLinks: true,
            autoProcessQueue: false,
                url: APP_URL + "/user/updateimages",
                paramName: "images",
                maxFiles: 5,
                thumbnailWidth: null,
                thumbnailHeight: null,
                init: function () {
                    this.on("thumbnail", function (file, dataUrl) {
                            $('.dz-image').last().find('img').attr({
                                width: '100%',
                                height: '100%'
                            });
                        }),
                        this.on("success", function (file) {
                            $('.dz-image').css({
                                "width": "100%",
                                "height": "auto"
                            });
                        });


                }
            };
            $("#userimages").dropzone({ url: "/file/post" });

            // var myDropzone = new Dropzone('#userimages');

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

                $('#personal-details').submit(function (e) {
                    e.preventDefault();
                    formid = this.id;
                    console.log('Processing form [' +formid+ ']');
                    for (instance in CKEDITOR.instances) {
                        CKEDITOR.instances[instance].updateElement();
                    }
                    var formData = new FormData(this);
                    $.ajax({
                        type: 'POST',
                        url: APP_URL + '/user/update',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            // this.reset();
                            swal(data.msg);
                            // alert('Image has been uploaded successfully');
                        },
                        error: function (reject) {
                            var errors = $.parseJSON(reject.responseText);
                            $.each(errors.errors, function (key, val) {
                                console.log(key + " - - " + val);
                                $("#" + key + "_error").text(val);
                            });
                        }
                    });
                });

                $('#professional_details').submit(function (e) {
                    e.preventDefault();
                    for (instance in CKEDITOR.instances) {
                        CKEDITOR.instances[instance].updateElement();
                    }
                    var formData = new FormData(this);
                    $.ajax({
                        type: 'POST',
                        url: APP_URL + '/user/update',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            // this.reset();
                            swal(data.msg);
                            // alert('Image has been uploaded successfully');
                        },
                        error: function (reject) {
                            var errors = $.parseJSON(reject.responseText);
                            $.each(errors.errors, function (key, val) {
                                console.log(key + " - - " + val);
                                $("#" + key + "_error").text(val);
                            });
                        }
                    });
                });
            });

            var avatar1 = new KTImageInput('kt_image_1');

            $("#country").change(function(){
        // alert($(this).val());
        $('#state').html("");
        if($(this).val() == "")
        {
            alert("Please select Country");
        }
        else
        {
            $.ajax({
                url: APP_URL + "/getState",
                type: "POST",
                // dataType: "json",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {country: $(this).val()},
                success:function(data)
                { 
                    var index = 0;
                    console.log(data);
                    data.forEach(function(item){
                        console.log(item.state);
                        
                        $('#state').append("<option value='"+item.state+"'>"+item.state+"</option>");
                        // $('#state_chosen .chosen-results').append('<li class="active-result result-selected" data-option-array-index="'+index+'">'+item.state+'</li>');
                        // index++;

                    });
                    
                },
            });
        }
    });

    $("#state").change(function(){
        // alert($(this).val());
        $('#city').html("");
        if($(this).val() == "")
        {
            alert("Please select State");
        }
        else
        {
            $.ajax({
                url: APP_URL + "/getCity",
                type: "POST",
                // dataType: "json",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {state: $(this).val()},
                success:function(data)
                { 
                    var index = 0;
                    console.log(data);
                    data.forEach(function(item){
                        console.log(item.city);
                        
                        $('#city').append("<option value='"+item.city+"'>"+item.city+"</option>");
                        // $('#state_chosen .chosen-results').append('<li class="active-result result-selected" data-option-array-index="'+index+'">'+item.state+'</li>');
                        // index++;

                    });
                    
                },
            });
        }
    });

    $(document).ready(function() {
  if (window.File && window.FileList && window.FileReader) {
    $("#images").on("change", function(e) {
        console.log("image upload");
      var files = e.target.files,
        filesLength = files.length;
        console.log(filesLength);
      for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
          $("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\">Remove image</span>" +
            "</span>").insertAfter("#images");
          $(".remove").click(function(){
            $(this).parent(".pip").remove();
          });
          
          // Old code here
          /*$("<img></img>", {
            class: "imageThumb",
            src: e.target.result,
            title: file.name + " | Click to remove"
          }).insertAfter("#files").click(function(){$(this).remove();});*/
          
        });
        fileReader.readAsDataURL(f);
      }
    });
  } else {
    alert("Your browser doesn't support to File API")
  }
});
        </script>
        @endsection