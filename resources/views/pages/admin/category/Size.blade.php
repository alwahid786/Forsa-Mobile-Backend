@extends('layouts.admin.admin-default')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@section('content')
@include('includes.admin.navbar')
<main class="content-wrapper">




    <div class="">
        @if(Session::has('success'))
        <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success') }}</p>
        @endif

        @if(Session::has('error'))
        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('error') }}</p>
        @endif

        <form class="categoryForm d-flex flex-column justify-content-center align-items-center " method="post"
            action="{{ route('addsize.post') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group select_field">
                <select id="category" name="category_id">
                    <option value="" disabled selected>Select Category</option>
                    @foreach ($category as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>

                    @endforeach
                </select>

            </div>
            <div class="form-group">
                <input type="text" name="title" class="form-control" style="width: 400px;height: 50px;"
                    id="exampleInputName2" placeholder="Add Size" required>

            </div>
            <button type="submit" class="btn btn-success">Add Size</button>
        </form>

    </div>


    <div class="container-fluid py-3">
        <div class="heading-top">
            {{-- <h1>All Clients</h1> --}}
        </div>
        <div class="client-table pt-2">
            <table id="detail-table" style="width: 100%">
                <thead>
                    <tr>
                        <th>Serial Number</th>
                        <th>Category Name</th>
                        <th>Size</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($size as $size)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $size->category->category_name }}</td>
                        <td>{{ $size->size }}</td>
                        <td>
                            <button type="button" class="btn btn-primary" onclick="editModal({{ $size->id }})">Edit</button>
                            <button type="button" onclick="deleteModal({{ $size->id }})" class="btn btn-danger">Delete</button>
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
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <h4 class="text-center">Are you sure you want to delete this Size</h4>
        </div>
        <div class="modal-footer">

          <form action="{{ route('delete.size') }}" method="post">
            @csrf
            <input type="hidden" class="sizeId" name="size_id">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Delete</button>

          </form>


        </div>
      </div>
    </div>
  </div>
  <!-- End Delete Modal -->

  {{-- edit modal --}}

<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body">

        <form class="categoryForm d-flex flex-column justify-content-center align-items-center" method="post" action="{{ route('edit.size') }}" enctype="multipart/form-data">
          @csrf

          <div class="form-group">

            <div class="form-group select_field">
                <select id="category" class="categoryName" name="category_id">
                    <option value="" disabled selected>Select Category</option>
                    @foreach ($category as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>

                    @endforeach
                </select>

            </div>

            <input type="hidden" class="id" name="id">

            <div class="form-group">
                <input type="text" name="title" class="form-control title" style="width: 400px;height: 50px;"
                    id="exampleInputName2" >

            </div>

          </div>

          <button type="submit" class="btn btn-success">Update Category</button>
        </form>

        </div>

      </div>
    </div>
  </div>

  {{-- edit modal end --}}



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
    $('.sizeId').val(id)
    $("#deleteModal").modal('show');
}

function editModal(id) {

    // $("#editmodal").modal('show');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({

    url: '{{ route("size.data") }}',
    type: "GET",
    data: {id : id},
    dataType: 'json',

    success: function(data) {

        var categoryName = data.data.category.id

        var size = data.data.size
        var id = data.data.id

        $('.title').val(size)

        $('.id').val(id)

        $(".categoryName").val(categoryName).attr('selected', true)
        $("#editmodal").modal('show');

    },
    error: function(data) {

    }

    });

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
    $('.sidenav  li:nth-of-type(7)').addClass('active');
</script>
@endsection
