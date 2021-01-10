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
                            <h3 class="card-title">Upload Story</h3>
                            <div class="card-toolbar">
                                <a href="{{ URL::to('dashboard/blogs')}}" class="btn btn-sm btn-primary font-weight-bold">
                                <i class="flaticon2-back"></i>Back to Stories</a>
                            </div>
                        </div>

                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" id="blog-post"
                                action="javascript:void(0)">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12 mb-5">
                                        <div class="form-group">
                                            <h6>Story Title</h6>
                                            <input type="text" class="form-control" placeholder="Enter Blog Title"
                                                name="title" id="title">
                                            <span id="title_error"></span>


                                        </div>

                                        <h6>Featured Image</h6>

                                        <div class="dropzone dropzone-default" id="myDropzone" name="image"></div>


                                        <div class="dropzone dropzone-default" id="kt_dropzone_1">
                                            <div class="dropzone-msg dz-message needsclick">
                                                <h3 class="dropzone-msg-title">Drop files here or click to upload.</h3>
                                                <span class="dropzone-msg-desc">Upload image</span>
                                            </div>
                                        </div>
                                        <span class="form-text text-muted">Max file size is 5MB.</span>


                                        <input type="file" id="image" name="image" />
                                        <span id="image_error"></span> 


                                        <h6 class="mt-5">Story Content</h6>
                                        <textarea class="ckeditor" name="description" id="description"></textarea>
                                        <span id="description_error"></span>
                                        {{-- class="ckeditor" --}}
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <h6>Category</h6>
                                        <select class="form-control" id="category_id" name="category_id">
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                        <span id="category_id_error"></span>

                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <h6>Status</h6>
                                        <select class="form-control" id="status" name="status">
                                            <option value="draft">Draft</option>
                                            <option value="published">Publish</option>
                                        </select>
                                        <span id="category_id_error"></span>

                                    </div>
                                </div>
                                <div class="text-left mt-5"><button href="" type="submit"
                                        class="btn btn-primary">Submit</button></div>
                            </form>
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
        <script src="{{ asset('assets/plugins/custom/uppy/uppy.bundle.js?v=7.1.2') }}">
        </script>
        <script src="{{ asset('assets/js/pages/crud/file-upload/uppy.js?v=7.1.2') }}">
        </script>
        <script
            src="{{ asset('assets/js/pages/crud/file-upload/dropzonejs.js?v=7.1.2') }}">
        </script>
        <script src="//cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
        <script type="text/javascript">
            CKEDITOR.replace('description', {
                filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
        </script>
        <script>
            
            Dropzone.autoDiscover = false;

            Dropzone.options.myDropzone = {
                addRemoveLinks: true,
                url: "yourUrl",
                paramName: "image",
                maxFiles: 1,
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

            var myDropzone = new Dropzone('div#myDropzone');

            $('.submit-btn').click(function () {
                var category_id = $('#category_id').val();
                var description = $('#description').val();
                var $title = $('#title').val();
                var $image = $('#image').val();
                if (title != "") {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'post',
                        url: APP_URL + '/blog/update',
                        data: {
                            category_id: category_id,
                            description: description,
                            title: title,
                            image: image,
                        },
                        success: function (response) {
                            if (response.status) {
                                swal("Thankyou!",
                                    response.msg,
                                    "success");
                                if (response.msg == "Removed Flag") {
                                    $current.html('<i class="fa fa-flag text-medium"></i>');
                                } else {
                                    $current.html('<i class="fa fa-flag text-danger"></i>');
                                }
                            } else {
                                swal("Oops!", "Something went wrong, Please try again", "warning");
                            }
                        },
                        error: function (response) {
                            swal("Oops!", "Something went wrong, Please try again", "warning");
                        }
                    });
                }
                return false;
            });

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

                $('#blog-post').submit(function (e) {
                    e.preventDefault();
                    for (instance in CKEDITOR.instances) {
                        CKEDITOR.instances[instance].updateElement();
                    }
                    var formData = new FormData(this);
                    $.ajax({
                        type: 'POST',
                        url: APP_URL + '/blog/save',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            this.reset();
                            alert('Image has been uploaded successfully');
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
        </script>
        @endsection