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


    <div class="plot-detail-avenue-section m-5">
        <a href="{{ url('products') }}"><button class="backButton">Back to Products</button></a>
        <div class="col-12 inner-heading">
           <img src="{{ $product['profile_img'] ?? '-' }}" alt="">
        </div>
        <div class="detail-cards">
            <div class="detail-card-item">
                <div class="detail-card-outer">
                   <div class="detail-card-content">

                    <p>Product Name:</p>
                    <p>{{ $product['title'] ?? '-'}}</p>
                   </div>
                   <div class="detail-card-content">
                    <p>Price:</p>
                    <p>${{ $product['price'] ?? '-'}}</p>
                </div>
                   <div class="detail-card-content">
                    <p>Brand:</p>
                    <p>{{ $product['brand'] ?? '-'}}</p>
                   </div>

                </div>
            </div>
            <div class="detail-card-item">
                <div class="detail-card-outer">

                    <div class="detail-card-content">
                        <p>Condition:</p>
                        <p>{{ $product['condition'] ?? '-'}}</p>
                    </div>
                    <div class="detail-card-content">
                        <p>Discounted Price:</p>
                        <p>{{ $product['discount_price'] ?? '-'}}</p>
                    </div>
                    <div class="detail-card-content">
                    <p>Vendor Name:</p>
                    <p>{{ $product['vendor']['name'] ?? '-'}}</p>
                    </div>
                </div>
            </div>
            <div class="detail-card-item">
                <div class="detail-card-outer">

                   <div class="detail-card-content">
                    <p>Location:</p>
                    <p>{{ $product['location'] ?? '-'}}</p>
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
  $('.sidenav  li:nth-of-type(2)').addClass('active');
</script>
@endsection
