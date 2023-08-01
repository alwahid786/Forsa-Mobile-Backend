@extends('layouts.admin.admin-default')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@section('content')
@include('includes.admin.navbar')
<main class="content-wrapper">




    <div class="col-sm-12 col-md-12 text-center">
      @if(Session::has('success'))
        <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success') }}</p>
      @endif

      @if(Session::has('error'))
        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('error') }}</p>
      @endif

      <form class="form-inline categoryForm " method="post" action="{{ route('category.post') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <input type="text" name="category_name" class="form-control" style="width: 400px;height: 50px;" id="exampleInputName2" placeholder="Category Name" required>

        </div>
        <div class="form-group">
          <input name="category_image" style="width: 400px;" class="ml-3" type="file" required>

        </div>
        <button type="submit" class="btn btn-success">Add Category</button>
      </form>

    </div>


    <div class="container-fluid py-3" >
       <div class="heading-top">
          {{-- <h1>All Clients</h1> --}}
       </div>
       <div class="client-table pt-2">
        <table id="detail-table"  style="width:100%">
            <thead>
              <tr>
                <th >Category Name</th>
                <th>Category Image</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($category as $cat)
                <tr>
                  <td>{{ $cat->category_name }}</td>
                  <td > <img style="width: 145px;" src="{{ asset('public/category/'.($cat->category_image)) }}" alt="{{ $cat->category_image }}"> </td>
                  <td >
                    <button class="btn btn-primary">Edit</button>
                    <button type="button" class="btn btn-danger deleteButton" src-attr="{{ $cat->id }}" onclick="deleteModal({{ $cat->id }})">Delete</button>
                  </td>
                </tr>
              @endforeach

            </tbody>
          </table>
       </div>
    </div>
</main>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h4 class="text-center">Are you sure you want to delete this category</h4>
      </div>
      <div class="modal-footer">

        <form action="{{ route('delete.category') }}" method="post">
          @csrf
          <input type="hidden" class="categoryId" name="category_id">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>

        </form>


      </div>
    </div>
  </div>
</div>
<!-- End Delete Modal -->

@endsection
@section('admininsertjavascript')
<script>
    $('body').addClass('bg-clr')
</script>
{{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script>

  function deleteModal(id) {
    $('.categoryId').val(id)
    $("#deleteModal").modal('show');
  }


</script>
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
  $('.sidenav  li:nth-of-type(2)').addClass('active');
</script>
@endsection
