
@extends('admin.layouts.app')
@section('content')

<section class="login-sec funds-sec about-page-content login-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 offset-sm-3 col-xs-12 offset-xs-0">
                <div class="card mx-auto rounded-0 border-0">
                    <div class="card-body">                       
                        <div id="login-form">
                            <form id="create-books-form" class="mb-0"  data-parsley-validate enctype="multipart/form-data">
                                @csrf
                                <h3 class="text-center">Create Book</h3>
                                <hr>
                                <div class="row mt20">
                                    <div class="col-12 form-group">
                                        <label for="title">Title</label>
                                        <input required type="text" value="" name="title" id="title" class="form-control not-dark" />
                                    
                                        <div class="error" id="error_title"></div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label for="thumbnailUrl">Thumbnail Image</label>
                                        <img style="display: none;"   id="pdf_thumbnailUrl" src="{{asset('images/pdf.png')}}" class="" width="200" height="150"/>
                                        <div class="inputfile-box2">
                                            <input  required type="file"  name="thumbnailUrl" id="thumbnailUrl" class="inputfile inputfile-1"  onchange="fileup(this,'image','pdf_thumbnailUrl')"  >
                                        </div>
                                        <div class="error" id="error_thumbnailUrl"></div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label for="hindiUrl">Uplaod Hindi Book</label>
                                        <img style="display: none;" id="pdf_hindiUrl" src="{{asset('images/pdf.png')}}" class="" width="200" height="150"/>
                                        <div class="inputfile-box2">
                                            <input  required type="file"  name="hindiUrl" id="hindiUrl" class="inputfile inputfile-1"  onchange="fileup(this,'pdf','pdf_hindiUrl')"  >
                                        </div>
                                        <div class="error" id="error_hindiUrl"></div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label for="englishUrl">Uplaod English Book</label>
                                        <img style="display: none;" id="pdf_englishUrl" src="{{asset('images/pdf.png')}}" class="" width="200" height="150"/>
                                        <div class="inputfile-box2">
                                            <input  required type="file"  name="englishUrl" id="englishUrl" class="inputfile inputfile-1"  onchange="fileup(this,'pdf','pdf_englishUrl')"  >
                                        </div>
                                        <div class="error" id="error_englishUrl"></div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label for="urdUurl">Uplaod Urdu Book</label>
                                        <img style="display: none;" id="pdf_urdUurl" src="{{asset('images/pdf.png')}}" class="" width="200" height="150"/>
                                        <div class="inputfile-box2">
                                            <input  required type="file"  name="urdUurl" id="urdUurl" class="inputfile inputfile-1"  onchange="fileup(this,'pdf','pdf_urdUurl')"  >
                                        </div>
                                        <div class="error" id="error_urdUurl"></div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label for="year">Year</label>
                                        <input required type="number" value="" name="year" id="year" class="form-control not-dark" />
                                    
                                        <div class="error" id="error_year"></div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label for="sel1">Select Month</label>
                                        <select name="month" class="form-control" id="month" required>
                                            <option value="">Select</option>
                                            <option value="January">January</option>
                                            <option value="Febuary">Febuary</option>
                                            <option value="March">March</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>                                         
                                        </select>
                                        <div class="error" id="error_month"></div>
                                    </div>

                                    <div class="col-12 form-group">
                                        <label for="sel1">Select Status</label>
                                        <select name="status" class="form-control" id="status" required>
                                            <option value="">Select</option>
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>                                          
                                        </select>
                                        <div class="error" id="error_status"></div>
                                    </div>

                                    
                                    <div class="col-12 form-group text-center">
                                        <button type="button" onclick="createBookForm();" class="btn btn-primary theme-btn" name="volunteer-edit-form-submit" value="edit">Submit</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@push('scripts')
     {{-- <script>
            function fileup1(input, id) {
                $('#preview_file_img').show();
            };
    </script> --}}
    
<script>
    function fileup(input,type, id) {
        id='#'+id;
        $(id).show();
        if(type=='image'){
            
            // id = id || '#pdf_thumbnailUrl';
            if (input.files && input.files[0]) {
                var reader = new FileReader(); 
                reader.onload = function (e) {
                    $(id)
                            .attr('src', e.target.result)
                            .width(200)
                            .height(150);
                }; 
                reader.readAsDataURL(input.files[0]);
            }
       
        }
    };
</script>
    
<script>
        function createBookForm(){
                $('.error').empty();
                var SITEURL = '{{env("APP_URL")}}';               
                if ($('#create-books-form').parsley().isValid())
                {
				    var formData = new FormData(document.getElementById('create-books-form'));
				    console.log(formData);

                    $.ajax({                 
                        url:SITEURL+"/book/store",
                        type:"POST",
                        dataType: 'json',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success:function(data)
                        {        
                            console.log(data);

                            if (data.status == "success")
                            {
                                swal("Success", "Successfully Submitted!.", "success");
                                setTimeout("window.location.href='"+SITEURL+"/books';", 3000);
                            }
                            else  if (data.status == "auth_error")
                            {
                                swal("Error", "Authentication Error!.", "error");    
                            }
                            else
                                swal("Error", "Something went wrong!.", "error");       
                            
                        },
                        error: function (request, status, error) {
                                $('.error').empty();
                                json = $.parseJSON(request.responseText);
                                console.log(json);
                                $.each(json.errors, function(key, value){
                                var error_key='<div class="alert alert-danger" role="alert">'+value+'.</div>';
                                console.log(error_key);
                                $('#error_'+key).show();
                                $('#error_'+key).append(error_key);
                                });
                                // $("#result").html('');
                            }
                    });
                    

                }
                else
                {
                    $('#create-books-form').parsley().validate();
                }   
            }
    </script>
@endpush