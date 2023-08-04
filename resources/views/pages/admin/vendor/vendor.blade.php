@extends('layouts.admin.admin-default')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@section('content')
@include('includes.admin.navbar')
<main class="content-wrapper">




    <div class="container-fluid py-3" >
       <div class="heading-top">
          {{-- <h1>All Clients</h1> --}}
       </div>
       <div class="client-table pt-2">
        <table id="detail-table"  style="width:100%">
            <thead>
              <tr>
                <th >Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Detail</th>

              </tr>
            </thead>
            <tbody>

              @foreach ($vendor as $user)
                <tr>

                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->phone }}</td>
                  <td>
                    <a href="{{ url('vendor_detail') }}/{{ $user->id }}"><button class="btn btn-primary">Detail</button></a>
                  </td>

                </tr>
              @endforeach

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




</script>
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
  $('.sidenav  li:nth-of-type(3)').addClass('active');
</script>
@endsection
