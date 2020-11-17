@extends('layout.dashboard')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex flex-column-fluid">
    <iframe src="{{ URL::to('/chat') }}" width="100%" height="100%"  ></iframe>
</div>
<!--end::Entry-->
@endsection

@section('js')


@endsection