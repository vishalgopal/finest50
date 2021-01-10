
@extends('admin.layouts.app')
@section('content')
<div class="hidden-print with-border">
<a href="{{url('book/add')}}" class="btn btn-primary float-right mb-3"data-style="zoom-in"><span class="ladda-label"><i class="fa fa-plus"></i> Add</span></a>
</div>
<table id="table_id" class="display table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Sr. No.</th>
            <th>Title</th>
            <th>Thumbnail</th>
            <th>Hindi</th>
            <th>English</th>
            <th>Urdu</th>
            <th>Month</th>
            <th>Year</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>        
            @foreach ($activities as $key=> $item)
            <tr>
                <td>{{$key+1}}</td>
                {{-- @if($item->subject_type="App\Blog") --}}
                <td>{{$item->subject_type   }}</td>
                {{-- @endif --}}
                <td>
                    @isset($item->thumbnailUrl)
                    <a href="{{asset($item->thumbnailUrl)}}" target="_blank" ><img src="{{asset($item->thumbnailUrl)}}" height="50px;width:100%"></a></td>                    
                    @endisset
                </td> 
                <td>
                    @isset($item->hindiUrl)
                    <a href="{{asset($item->hindiUrl)}}" target="_blank" ><img src="{{asset('images/pdf.png')}}" height="50px;width:100%"></a></td>                    
                    @endisset
                </td> 
                <td>
                    @isset($item->englishUrl)
                    <a href="{{asset($item->englishUrl)}}" target="_blank" ><img src="{{asset('images/pdf.png')}}" height="50px;width:100%"></a></td>                    
                    @endisset
                </td> 
                <td>
                    @isset($item->urduUrl)
                    <a href="{{asset($item->urduUrl)}}" target="_blank" ><img src="{{asset('images/pdf.png')}}" height="50px;width:100%"></a></td>                    
                    @endisset
                </td> 
                <td>{{$item->year}}</td> 
                <td>{{$item->month}}</td> 
                <td>{{$item->status}}</td> 
                <td>
                    <a class="btn btn-link" href="{{url('book/edit/'.$item->id)}}"><i class="fa fa-pencil-square"></i> </a> 
                     <a class="btn btn-link" onclick="deletealert({{$item->id}});"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
       
    </tbody>
    <tfoot>
        <tr>
            <th>Sr. No.</th>
            <th>Title</th>
            <th>Thumbnail</th>
            <th>Hindi</th>
            <th>English</th>
            <th>Urdu</th>
            <th>Month</th>
            <th>Year</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>

<div id="myDiv" style="display:none;position: fixed;left: 0px;top: 0px;width: 100%;height: 100%;z-index: 9999;background: url('{{asset('images/151.gif')}}') 50% 50% no-repeat rgba(249, 249, 249, 0);"></div>
@if(session()->has('store_success'))
        @push('scripts')
        <script>                    
        swal("", "Your data has been Successfully Submitted.", "success");    
        </script>
        @endpush
        
    @php Session::forget('store_success');@endphp
@endif
@endsection
@push('scripts')
    <script>
        function deletealert(c_id) {
            swal({
                    title: "Are you sure?",
                    text: "You want to delete!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    cancelButtonText: "No, cancel it!",
                    confirmButtonText: 'Yes, I am sure!',
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {

                    if (isConfirm) {
                                $.ajax({
                                    url:baseurl+"book/delete_data",
                                    type:"POST",
                                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                    data:{
                                        c_id:c_id,
                                    },
                                    success:function(data)
                                    {
                                        console.log("data "+data);
                                        if(data == "success")
                                        {
                                        swal("Status", "Your data has been Successfully deleted.", "success");
                                        setTimeout(function () {
                                        location.href=baseurl+'books';
                                        }, 4000);
                                        }
                                        else
                                        {                               
                                        swal("Status", "Oops something went wrong.", "error");
                                        }

                                    },
                        });
                    } else {
                        location.reload(true);
                    }
                });
        }
    </script>
@endpush