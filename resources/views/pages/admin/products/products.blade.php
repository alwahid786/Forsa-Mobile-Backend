@extends('layouts.admin.admin-default')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@section('content')
@include('includes.admin.navbar')
<main class="content-wrapper">

    <div class="container-fluid py-3">
        <div class="heading-top">
            <h1>All Products</h1>
        </div>
        <div class="client-table pt-2">
            <table id="detail-table" style="width: 100%">
                <thead>
                    <tr>
                        <th>Vendor Name</th>
                        <th>Product Name</th>
                        <th>No of Solds</th>
                        <th>Product Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if(sizeof($products)>0)
                    @foreach ($products as $product)
                    <tr>
                        <td>{{$product['vendor']['name'] ?? '-'}}</td>
                        <td>{{$product['title'] ?? '-'}}</td>
                        <td>{{$product['orders_count'] ?? '-'}}</td>
                        <td>${{$product['price'] ?? '-'}}</td>
                        <td><a href="{{(url('product-details', ['id' => $product['vendor']]))}}"><button type="button" class="btn btn-primary">View</button></a></td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
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
    $('#detail-table').DataTable({
        "ordering": false,
        "info": true,
        "searching": true,
        "lengthChange": true,
        "pageLength": 10,
        language: {
            'paginate': {
                'previous': '<i class="fa fa-chevron-left p-left" aria-hidden="true"></i>',
                'next': '<i class="fa fa-chevron-right p-right" aria-hidden="true"></i>'
            }
        }
    });
</script>

<script>
    $('.sidenav  li:nth-of-type(2)').addClass('active');
</script>
@endsection