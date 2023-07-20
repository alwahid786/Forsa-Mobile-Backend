@extends('layouts.admin.admin-default')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@section('content')
@include('includes.admin.navbar')
<main class="content-wrapper">
    <div class="container-fluid py-3" >
       <div class="heading-top">
          <h1>Plots Details</h1>
       </div>
       <div class="plot-detail-avenue-section">
            <div class="col-12 inner-heading">
               <h1>Avenue Society</h1>
            </div>
            <div class="detail-cards">
                <div class="detail-card-item">
                    <div class="detail-card-outer">
                       <div class="detail-card-content">
                        <p>Plot No:</p>
                        <p>03251-21251</p>
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
                        <p>Address:</p>
                        <p>New colony 33 streemy</p>
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
       <div class="client-table">
        <div class="col-12 inner-heading">
            <h1>Clients Detail</h1>
         </div>
        <table id="detail-table"  style="width:100%">
            <thead>
              <tr>
                <th >Name</th>
                <th class="number-plots">No of Plots</th>
                <th>Manager</th>
                <th>Address</th>
                <th>Investment</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td data-column="Name">Jawad</td>
                <td data-column="No of Plots">12</td>
                <td data-column="Manager">Hammad</td>
                <td data-column="Address" class="address">Plot 266, Block B H.B.F.C Society, Lahore, Punjab, Pakistan</td>
                <td data-column="Investment">50 Lacs</td>
                <td ><a class="call" href="">call</a></td>
              </tr>
              <tr>
                <td data-column="Name">Jawad</td>
                <td data-column="No of Plots">12</td>
                <td data-column="Manager">Hammad</td>
                <td data-column="Address">Plot 266, Block B H.B.F.C Society, Lahore, Punjab, Pakistan</td>
                <td data-column="Investment">50 Lacs</td>
                <td ><a class="call" href="">call</a></td>
              </tr>
              <tr>
                <td data-column="Name">Jawad</td>
                <td data-column="No of Plots">12</td>
                <td data-column="Manager">Hammad</td>
                <td data-column="Address" class="address">Plot 266, Block B H.B.F.C Society, Lahore, Punjab, Pakistan</td>
                <td data-column="Investment">50 Lacs</td>
                <td ><a class="call" href="">call</a></td>
              </tr>
              <tr>
                <td data-column="Name">Jawad</td>
                <td data-column="No of Plots">12</td>
                <td data-column="Manager">Hammad</td>
                <td data-column="Address">Plot 266, Block B H.B.F.C Society, Lahore, Punjab, Pakistan</td>
                <td data-column="Investment">50 Lacs</td>
                <td ><a class="call" href="">call</a></td>
              </tr>
              <tr>
                <td data-column="Name">Jawad</td>
                <td data-column="No of Plots">12</td>
                <td data-column="Manager">Hammad</td>
                <td data-column="Address" class="address">Plot 266, Block B H.B.F.C Society, Lahore, Punjab, Pakistan</td>
                <td data-column="Investment">50 Lacs</td>
                <td ><a class="call" href="">call</a></td>
              </tr>
              <tr>
                <td data-column="Name">Jawad</td>
                <td data-column="No of Plots">12</td>
                <td data-column="Manager">Hammad</td>
                <td data-column="Address">Plot 266, Block B H.B.F.C Society, Lahore, Punjab, Pakistan</td>
                <td data-column="Investment">50 Lacs</td>
                <td ><a class="call" href="">call</a></td>
              </tr>
              <tr>
                <td data-column="Name">Jawad</td>
                <td data-column="No of Plots">12</td>
                <td data-column="Manager">Hammad</td>
                <td data-column="Address" class="address">Plot 266, Block B H.B.F.C Society, Lahore, Punjab, Pakistan</td>
                <td data-column="Investment">50 Lacs</td>
                <td ><a class="call" href="">call</a></td>
              </tr>
              <tr>
                <td data-column="Name">Jawad</td>
                <td data-column="No of Plots">12</td>
                <td data-column="Manager">Hammad</td>
                <td data-column="Address">Plot 266, Block B H.B.F.C Society, Lahore, Punjab, Pakistan</td>
                <td data-column="Investment">50 Lacs</td>
                <td ><a class="call" href="">call</a></td>
              </tr>
              <tr>
                <td data-column="Name">Jawad</td>
                <td data-column="No of Plots">12</td>
                <td data-column="Manager">Hammad</td>
                <td data-column="Address" class="address">Plot 266, Block B H.B.F.C Society, Lahore, Punjab, Pakistan</td>
                <td data-column="Investment">50 Lacs</td>
                <td ><a class="call" href="">call</a></td>
              </tr>
              <tr>
                <td data-column="Name">Jawad</td>
                <td data-column="No of Plots">12</td>
                <td data-column="Manager">Hammad</td>
                <td data-column="Address">Plot 266, Block B H.B.F.C Society, Lahore, Punjab, Pakistan</td>
                <td data-column="Investment">50 Lacs</td>
                <td ><a class="call" href="">call</a></td>
              </tr>
              <tr>
                <td data-column="Name">Jawad</td>
                <td data-column="No of Plots">12</td>
                <td data-column="Manager">Hammad</td>
                <td data-column="Address" class="address">Plot 266, Block B H.B.F.C Society, Lahore, Punjab, Pakistan</td>
                <td data-column="Investment">50 Lacs</td>
                <td ><a class="call" href="">call</a></td>
              </tr>
              <tr>
                <td data-column="Name">Jawad</td>
                <td data-column="No of Plots">12</td>
                <td data-column="Manager">Hammad</td>
                <td data-column="Address">Plot 266, Block B H.B.F.C Society, Lahore, Punjab, Pakistan</td>
                <td data-column="Investment">50 Lacs</td>
                <td ><a class="call" href="">call</a></td>
              </tr>
         
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
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function () {
    $('#detail-table').DataTable({
        "ordering": false,
        "info":     false,
        "searching": false,
        "lengthChange": false,
        "pageLength": 5,
        language: {
    'paginate': {
      'previous': '<i class="fa fa-chevron-left p-left" aria-hidden="true"></i>',
      'next': '<i class="fa fa-chevron-right p-right" aria-hidden="true"></i>'
    }
  }
    });
});
</script>
<script>
  $('.sidenav  li:nth-of-type(2)').addClass('active');
</script>
@endsection