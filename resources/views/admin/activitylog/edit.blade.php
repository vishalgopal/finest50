
@extends('admin.layouts.app')
@section('content')

<section class="login-sec funds-sec about-page-content login-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 offset-sm-3 col-xs-12 offset-xs-0">
                <div class="card mx-auto rounded-0 border-0">
                    <div class="card-body">                       
                        <div id="login-form">
                            <form id="edit-book-form" class="mb-0"  data-parsley-validate enctype="multipart/form-data">
                                @csrf
                                <h3 class="text-center">Update Book</h3>
                                <hr>
                                <div class="row mt20">
                                    <input type="hidden" name="b_id" id="f_id" value="{{$book->id}}" readonly />
                                    <div class="col-12 form-group">
                                        <label for="title">Title</label>
                                        <input required type="text" value="{{$book->title}}" name="title" id="title" class="form-control not-dark" />
                                    
                                        <div class="error" id="error_title"></div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label for="thumbnailUrl">Thumbnail Image</label>
                                        <a href="{{asset($book->thumbnailUrl)}}" target="_blank"><img  id="pdf_thumbnailUrl" src="{{asset($book->thumbnailUrl)}}" class="" width="200" height="150"/></a>
                                        {{-- <img style="display: none;"   id="pdf_thumbnailUrl" src="{{asset('images/pdf.png')}}" class="" width="200" height="150"/> --}}
                                        <div class="inputfile-box2">
                                            <input type="file"  name="thumbnailUrl" id="thumbnailUrl" class="inputfile inputfile-1"  onchange="fileup(this,'image','pdf_thumbnailUrl')"  >
                                        </div>
                                        <div class="error" id="error_thumbnailUrl"></div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label for="hindiUrl">Uplaod Hindi Book</label>
                                        <a href="{{asset($book->hindiUrl)}}" target="_blank"><img  id="pdf_hindiUrl" src="{{asset('images/pdf.png')}}" class="" width="200" height="150"/></a>
                                        {{-- <img style="display: none;" id="pdf_hindiUrl" src="{{asset('images/pdf.png')}}" class="" width="200" height="150"/> --}}
                                        <div class="inputfile-box2">
                                            <input type="file"  name="hindiUrl" id="hindiUrl" class="inputfile inputfile-1"  onchange="fileup(this,'pdf','pdf_hindiUrl')"  >
                                        </div>
                                        <div class="error" id="error_hindiUrl"></div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label for="englishUrl">Uplaod English Book</label>
                                        <a href="{{asset($book->englishUrl)}}" target="_blank"><img  id="pdf_englishUrl" src="{{asset('images/pdf.png')}}" class="" width="200" height="150"/></a>
                                        {{-- <img style="display: none;" id="pdf_englishUrl" src="{{asset('images/pdf.png')}}" class="" width="200" height="150"/> --}}
                                        <div class="inputfile-box2">
                                            <input type="file"  name="englishUrl" id="englishUrl" class="inputfile inputfile-1"  onchange="fileup(this,'pdf','pdf_englishUrl')"  >
                                        </div>
                                        <div class="error" id="error_englishUrl"></div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label for="urdUurl">Uplaod Urdu Book</label>
                                        <a href="{{asset($book->urdUurl)}}" target="_blank"><img  id="pdf_urdUurl" src="{{asset('images/pdf.png')}}" class="" width="200" height="150"/></a>
                                       {{-- <img style="display: none;" id="pdf_urdUurl" src="{{asset('images/pdf.png')}}" class="" width="200" height="150"/> --}}
                                        <div class="inputfile-box2">
                                            <input type="file"  name="urdUurl" id="urdUurl" class="inputfile inputfile-1"  onchange="fileup(this,'pdf','pdf_urdUurl')"  >
                                        </div>
                                        <div class="error" id="error_urdUurl"></div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label for="year">Year</label>
                                        <input required type="number" value="{{$book->year}}" name="year" id="year" class="form-control not-dark" />
                                    
                                        <div class="error" id="error_year"></div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label for="sel1">Select Month</label>
                                        <select name="month" class="form-control" id="month" required>
                                            <option value="">Select</option>
                                            <option  @if($book->month=='January') selected @endif value="January">January</option>
                                            <option  @if($book->month=='Febuary') selected @endif value="Febuary">Febuary</option>
                                            <option  @if($book->month=='March') selected @endif value="March">March</option>
                                            <option  @if($book->month=='April') selected @endif value="April">April</option>
                                            <option  @if($book->month=='May') selected @endif value="May">May</option>
                                            <option  @if($book->month=='June') selected @endif value="June">June</option>
                                            <option  @if($book->month=='July') selected @endif value="July">July</option>
                                            <option  @if($book->month=='August') selected @endif value="August">August</option>
                                            <option  @if($book->month=='September') selected @endif value="September">September</option>
                                            <option  @if($book->month=='October') selected @endif value="October">October</option>
                                            <option  @if($book->month=='November') selected @endif value="November">November</option>
                                            <option  @if($book->month=='December') selected @endif value="December">December</option>                                         
                                        </select>
                                        <div class="error" id="error_month"></div>
                                    </div>

                                    <div class="col-12 form-group">
                                        <label for="sel1">Select Status</label>
                                        <select name="status" class="form-control" id="status" required>
                                            <option @if($book->status=='Active') selected @endif value="Active">Active</option>
                                            <option @if($book->status=='Inactive') selected @endif value="Inactive">Inactive</option>
                                        </select>
                                        <div class="error" id="error_status"></div>
                                    </div>

                                    
                                    <div class="col-12 form-group text-center">
                                        <button type="button" onclick="editbookForm();" class="btn btn-primary theme-btn" name="volunteer-edit-form-submit" value="edit">Submit</button>
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
        function editbookForm(){
                $('.error').empty();
                var SITEURL = '{{env("APP_URL")}}';               
                if ($('#edit-book-form').parsley().isValid())
                {
				    var formData = new FormData(document.getElementById('edit-book-form'));
				    console.log(formData);

                    $.ajax({                 
                        url:SITEURL+"/book/update",
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
                                swal("Success", "Successfully updated!.", "success");
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
                    $('#edit-book-form').parsley().validate();
                }   
            }
    </script>
@endpush