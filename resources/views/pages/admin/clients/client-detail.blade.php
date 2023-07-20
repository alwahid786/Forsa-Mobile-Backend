@extends('layouts.admin.admin-default')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@section('content')
@include('includes.admin.navbar')
<main class="content-wrapper">
    <div class="container-fluid py-3" >
       <div class="heading-top">
          <h1>Client's Details</h1>
       </div>
       <div class="plot-detail-avenue-section">
            <div class="col-12 inner-heading">
               <h1><img class="pr-2" src="{{asset('public/assets/images/tag.svg')}}" alt="tag">Jawad Ali</h1>
            </div>
            <div class="detail-cards">
                <div class="detail-card-item">
                    <div class="detail-card-outer">
                       <div class="detail-card-content">
                        <p>No of Plots</p>
                        <p>02</p>
                       </div>
                       <div class="detail-card-content">
                        <p>Plot Dimension:</p>
                        <p>2000*2000</p>
                       </div>
                       <div class="detail-card-content">
                        <p>Purchase Date:</p>
                        <p>22-May-2022</p>
                       </div>
                       <div class="detail-card-content">
                        <p>Sold Price:</p>
                        <p>1095,000</p>
                       </div>
                    </div>
                </div>
                <div class="detail-card-item">
                    <div class="detail-card-outer">
                       <div class="detail-card-content">
                        <p>Manager Name:</p>
                        <p>Hammad Ali</p>
                       </div>
                       <div class="detail-card-content">
                        <p>Plot Area:</p>
                        <p>2 Kanal</p>
                       </div>
                       <div class="detail-card-content">
                        <p>Society:</p>
                        <p>HBFC Society</p>
                       </div>
                    </div>
                </div>
                <div class="detail-card-item">
                    <div class="detail-card-outer">
                       <div class="detail-card-content">
                        <p>Price:</p>
                        <p>2,000,000</p>
                       </div>
                       <div class="detail-card-content">
                        <p>No of Clients</p>
                        <p>03</p>
                       </div>
                       <div class="detail-card-content">
                        <p>Sold Date:</p>
                        <p>22-Nov-2021</p>
                       </div>
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
<script>
    $('.sidenav  li:nth-of-type(3)').addClass('active');
</script>
@endsection