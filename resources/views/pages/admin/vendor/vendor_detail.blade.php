@extends('layouts.admin.admin-default')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@section('content')
@include('includes.admin.navbar')
<style>
    .backButton {
        background: #6cc2b6;
    width: 125px;
    height: 40px;
    margin-left: 16px;
    margin-bottom: 20px;
    border-style: none;
    border-radius: 5px;
    color: white;
    }
</style>
<main class="content-wrapper">


    <div class="plot-detail-avenue-section">
        <a href="{{ url('vendor_list') }}"><button class="backButton">Back to Vendors</button></a>
        <div class="col-12 inner-heading">
           <img src="{{ $vendorDetail->profile_img }}" alt="">
        </div>
        <div class="detail-cards">
            <div class="detail-card-item">
                <div class="detail-card-outer">
                   <div class="detail-card-content">

                    <p>Name:</p>
                    <p>{{ $vendorDetail->name . ' ' .$vendorDetail->last_name}}</p>
                   </div>
                   <div class="detail-card-content">
                    <p>Email:</p>
                    <p>{{ $vendorDetail->email}}</p>
                </div>
                   <div class="detail-card-content">
                    <p>Phone Number:</p>
                    <p>{{ $vendorDetail->phone}}</p>
                   </div>

                </div>
            </div>
            <div class="detail-card-item">
                <div class="detail-card-outer">

                    <div class="detail-card-content">
                        <p>User Name:</p>
                        <p>{{ $vendorDetail->username}}</p>
                    </div>
                    <div class="detail-card-content">
                        <p>Country:</p>
                        <p>{{ $vendorDetail->country}}</p>
                    </div>
                    <div class="detail-card-content">
                    <p>City:</p>
                    <p>{{ $vendorDetail->city}}</p>
                    </div>
                </div>
            </div>
            <div class="detail-card-item">
                <div class="detail-card-outer">

                   <div class="detail-card-content">
                    <p>Location:</p>
                    <p>{{ $vendorDetail->location}}</p>
                   </div>
                </div>
            </div>
        </div>

   </div>


</main>




@endsection
@section('admininsertjavascript')
<script>
    $('body').addClass('bg-clr')
</script>
{{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script>




</script>

<script>
  $('.sidenav  li:nth-of-type(3)').addClass('active');
</script>
@endsection
