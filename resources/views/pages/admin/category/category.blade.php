@extends('layouts.admin.admin-default')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@section('content')
@include('includes.admin.navbar')
<main class="content-wrapper">
    <div class="container-fluid py-3" >
       <div class="heading-top">
          <h1>All Clients</h1>
       </div>
       <div class="client-table pt-2">
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
                  <td class="name-person" data-column="Name"><img src="{{asset('public/assets/images/tag.svg')}}" alt="tag"> <a href="{{url('client-detail')}}">Jawad</a> </td>
                  <td data-column="No of Plots">12</td>
                  <td data-column="Manager">Hammad</td>
                  <td data-column="Address" class="address">Plot 266, Block B H.B.F.C Society, Lahore, Punjab, Pakistan</td>
                  <td data-column="Investment">50 Lacs</td>
                  <td ><a class="call" href="">call</a></td>
              </tr>
              <tr>
                <td class="name-person" data-column="Name"><img src="{{asset('public/assets/images/tag.svg')}}" alt="tag"> <a href="{{url('client-detail')}}">Jawad</a> </td>
                <td data-column="No of Plots">12</td>
                <td data-column="Manager">Hammad</td>
                <td data-column="Address" class="address">Plot 266, Block B H.B.F.C Society, Lahore, Punjab, Pakistan</td>
                <td data-column="Investment">50 Lacs</td>
                <td ><a class="call" href="">call</a></td>
            </tr>
            <tr>
              <td class="name-person" data-column="Name"><img src="{{asset('public/assets/images/tag.svg')}}" alt="tag"> <a href="{{url('client-detail')}}">Jawad</a> </td>
              <td data-column="No of Plots">12</td>
              <td data-column="Manager">Hammad</td>
              <td data-column="Address" class="address">Plot 266, Block B H.B.F.C Society, Lahore, Punjab, Pakistan</td>
              <td data-column="Investment">50 Lacs</td>
              <td ><a class="call" href="">call</a></td>
          </tr>
          <tr>
            <td class="name-person" data-column="Name"><img src="{{asset('public/assets/images/tag.svg')}}" alt="tag"> <a href="{{url('client-detail')}}">Jawad</a> </td>
            <td data-column="No of Plots">12</td>
            <td data-column="Manager">Hammad</td>
            <td data-column="Address" class="address">Plot 266, Block B H.B.F.C Society, Lahore, Punjab, Pakistan</td>
            <td data-column="Investment">50 Lacs</td>
            <td ><a class="call" href="">call</a></td>
        </tr>
        <tr>
          <td class="name-person" data-column="Name"><img src="{{asset('public/assets/images/tag.svg')}}" alt="tag"> <a href="{{url('client-detail')}}">Jawad</a> </td>
          <td data-column="No of Plots">12</td>
          <td data-column="Manager">Hammad</td>
          <td data-column="Address" class="address">Plot 266, Block B H.B.F.C Society, Lahore, Punjab, Pakistan</td>
          <td data-column="Investment">50 Lacs</td>
          <td ><a class="call" href="">call</a></td>
      </tr>
      <tr>
        <td class="name-person" data-column="Name"><img src="{{asset('public/assets/images/tag.svg')}}" alt="tag"> <a href="{{url('client-detail')}}">Jawad</a> </td>
        <td data-column="No of Plots">12</td>
        <td data-column="Manager">Hammad</td>
        <td data-column="Address" class="address">Plot 266, Block B H.B.F.C Society, Lahore, Punjab, Pakistan</td>
        <td data-column="Investment">50 Lacs</td>
        <td ><a class="call" href="">call</a></td>
    </tr>
    <tr>
      <td class="name-person" data-column="Name"><img src="{{asset('public/assets/images/tag.svg')}}" alt="tag"> <a href="{{url('client-detail')}}">Jawad</a> </td>
      <td data-column="No of Plots">12</td>
      <td data-column="Manager">Hammad</td>
      <td data-column="Address" class="address">Plot 266, Block B H.B.F.C Society, Lahore, Punjab, Pakistan</td>
      <td data-column="Investment">50 Lacs</td>
      <td ><a class="call" href="">call</a></td>
  </tr>
  <tr>
    <td class="name-person" data-column="Name"><img src="{{asset('public/assets/images/tag.svg')}}" alt="tag"> <a href="{{url('client-detail')}}">Jawad</a> </td>
    <td data-column="No of Plots">12</td>
    <td data-column="Manager">Hammad</td>
    <td data-column="Address" class="address">Plot 266, Block B H.B.F.C Society, Lahore, Punjab, Pakistan</td>
    <td data-column="Investment">50 Lacs</td>
    <td ><a class="call" href="">call</a></td>
</tr>
<tr>
  <td class="name-person" data-column="Name"><img src="{{asset('public/assets/images/tag.svg')}}" alt="tag"> <a href="{{url('client-detail')}}">Jawad</a> </td>
  <td data-column="No of Plots">12</td>
  <td data-column="Manager">Hammad</td>
  <td data-column="Address" class="address">Plot 266, Block B H.B.F.C Society, Lahore, Punjab, Pakistan</td>
  <td data-column="Investment">50 Lacs</td>
  <td ><a class="call" href="">call</a></td>
</tr>
<tr>
  <td class="name-person" data-column="Name"><img src="{{asset('public/assets/images/tag.svg')}}" alt="tag"> <a href="{{url('client-detail')}}">Jawad</a> </td>
  <td data-column="No of Plots">12</td>
  <td data-column="Manager">Hammad</td>
  <td data-column="Address" class="address">Plot 266, Block B H.B.F.C Society, Lahore, Punjab, Pakistan</td>
  <td data-column="Investment">50 Lacs</td>
  <td ><a class="call" href="">call</a></td>
</tr>
<tr>
  <td class="name-person" data-column="Name"><img src="{{asset('public/assets/images/tag.svg')}}" alt="tag"> <a href="{{url('client-detail')}}">Jawad</a> </td>
  <td data-column="No of Plots">12</td>
  <td data-column="Manager">Hammad</td>
  <td data-column="Address" class="address">Plot 266, Block B H.B.F.C Society, Lahore, Punjab, Pakistan</td>
  <td data-column="Investment">50 Lacs</td>
  <td ><a class="call" href="">call</a></td>
</tr>
<tr>
  <td class="name-person" data-column="Name"><img src="{{asset('public/assets/images/tag.svg')}}" alt="tag"> <a href="{{url('client-detail')}}">Jawad</a> </td>
  <td data-column="No of Plots">12</td>
  <td data-column="Manager">Hammad</td>
  <td data-column="Address" class="address">Plot 266, Block B H.B.F.C Society, Lahore, Punjab, Pakistan</td>
  <td data-column="Investment">50 Lacs</td>
  <td ><a class="call" href="">call</a></td>
</tr>
<tr>
  <td class="name-person" data-column="Name"><img src="{{asset('public/assets/images/tag.svg')}}" alt="tag"> <a href="{{url('client-detail')}}">Jawad</a> </td>
  <td data-column="No of Plots">12</td>
  <td data-column="Manager">Hammad</td>
  <td data-column="Address" class="address">Plot 266, Block B H.B.F.C Society, Lahore, Punjab, Pakistan</td>
  <td data-column="Investment">50 Lacs</td>
  <td ><a class="call" href="">call</a></td>
</tr>
<tr>
  <td class="name-person" data-column="Name"><img src="{{asset('public/assets/images/tag.svg')}}" alt="tag"> <a href="{{url('client-detail')}}">Jawad</a> </td>
  <td data-column="No of Plots">12</td>
  <td data-column="Manager">Hammad</td>
  <td data-column="Address" class="address">Plot 266, Block B H.B.F.C Society, Lahore, Punjab, Pakistan</td>
  <td data-column="Investment">50 Lacs</td>
  <td ><a class="call" href="">call</a></td>
</tr>
<tr>
  <td class="name-person" data-column="Name"><img src="{{asset('public/assets/images/tag.svg')}}" alt="tag"> <a href="{{url('client-detail')}}">Jawad</a> </td>
  <td data-column="No of Plots">12</td>
  <td data-column="Manager">Hammad</td>
  <td data-column="Address" class="address">Plot 266, Block B H.B.F.C Society, Lahore, Punjab, Pakistan</td>
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
        "pageLength": 12,
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
  $('.sidenav  li:nth-of-type(3)').addClass('active');
</script>
@endsection