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

        <form class="categoryForm d-flex flex-column justify-content-center align-items-center" method="post"
            action="{{ route('subcategory.post') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">

                <label class="picture mt-5" for="picture__input" tabIndex="0">
                    <span class="picture__image"></span>
                </label>

                <input type="file" name="category_image" id="picture__input" required>

            </div>
            <div class="form-group select_field">
                <select id="subcategory" name="selected_category_id">
                    <option value="" disabled selected>Select Subcategory</option>
                    @foreach ($category as $cat)
                    <option value="{{ $cat->id }}">{{$cat->category_name}}</option>
                    @endforeach
                </select>

            </div>
            <div class="form-group">
                <input type="text" name="category_name" class="form-control" style="width: 400px;height: 50px;"
                    id="exampleInputName2" placeholder="SubCategory Name" required>

            </div>
            <button type="submit" class="btn btn-success">Add SubCategory</button>
        </form>

    </div>


    <div class="container-fluid py-3">
        <div class="heading-top">
            {{-- <h1>All Clients</h1> --}}
        </div>
        <div class="client-table pt-2">
            <table id="detail-table" style="width:100%">
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>SubCategory Name</th>
                        <th>SubCategory Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category as $cat)
                    @if (!empty($cat->parent_id))
                    <tr>
                        <td>{{ $cat->parentCategory->category_name }}</td>
                        <td>{{ $cat->category_name }}</td>
                        <td>
                            <img style="width: 145px;" src="{{ asset('public/category/'.($cat->category_image)) }}"
                                alt="{{ $cat->category_image }}">
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary" onclick="editModal({{ $cat->id }})">Edit</button>
                            <button type="button" class="btn btn-danger deleteButton" src-attr="{{ $cat->id }}"
                                onclick="deleteModal({{ $cat->id }})">Delete</button>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
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

{{-- edit modal --}}

<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">

                <form class="categoryForm d-flex flex-column justify-content-center align-items-center" method="post"
                    action="{{ route('edit.subcategory') }}" enctype="multipart/form-data">
                    @csrf
                
                    <div class="form-group">
                
                        {{-- image --}}
                
                        <label class="picture_d" for="picture__input_modal" tabIndex="0">
                            <span class="picture__image_d"><img src="" alt="" id="modalImageSrc"></span>
                        </label>
                
                        <input type="file" name="category_image" id="picture__input_modal">
                
                        <input type="hidden" name="category_id" id="category_id">
                
                        {{-- end image --}}
                
                    </div>
             <div class="form-group select_field">
                <select id="subcategory" name="selected_category_id">
                    <option value="" disabled selected>Select Subcategory</option>
                    @foreach ($category as $cat)
                    <option value="{{ $cat->id }}">{{$cat->category_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                        <input type="text" name="category_name" class="form-control" style="width: 400px;height: 50px;" id="category_name"
                            placeholder="Category Name" required>
                    
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
    $('.categoryId').val(id)
    $("#deleteModal").modal('show');
  }
function editModal(id) {

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

$.ajax({

url: '{{ route("edit.category.view") }}',
type: "POST",
data: {id : id},
dataType: 'json',

success: function(data) {

var categoryName = data.data.category_name;
var categoryImage = '{{ asset('public/category') }}' + '/' + data.data.category_image;

$("#category_name").val(categoryName)
$('#modalImageSrc').attr('src', categoryImage)
$('#category_id').val(id)
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


    // form image script
    const inputFile = document.querySelector("#picture__input");
    const pictureImage = document.querySelector(".picture__image");
    const pictureImageTxt = "Choose an image";
    pictureImage.innerHTML = pictureImageTxt;

    inputFile.addEventListener("change", function (e) {
      const inputTarget = e.target;
      const file = inputTarget.files[0];

      if (file) {
        const reader = new FileReader();

        reader.addEventListener("load", function (e) {
          const readerTarget = e.target;

          const img = document.createElement("img");
          img.src = readerTarget.result;
          img.classList.add("picture__img");

          pictureImage.innerHTML = "";
          pictureImage.appendChild(img);
        });

        reader.readAsDataURL(file);
      } else {
        pictureImage.innerHTML = pictureImageTxt;
      }
    });

    // form image script end

    // form image modal script

    const inputFileTest = document.querySelector("#picture__input_modal");
    const pictureImage_d = document.querySelector(".picture__image_d");
    const pictureImageTxt_d = "Choose an image";
    pictureImage.innerHTML = pictureImageTxt_d;

    inputFileTest.addEventListener("change", function (e) {
      const inputTarget = e.target;
      const file = inputTarget.files[0];

      if (file) {
        const reader = new FileReader();

        reader.addEventListener("load", function (e) {
          const readerTarget = e.target;

          const img = document.createElement("img");
          img.src = readerTarget.result;
          img.classList.add("picture__image_d");

          pictureImage_d.innerHTML = "";
          pictureImage_d.appendChild(img);
        });

        reader.readAsDataURL(file);
      } else {
        pictureImage_d.innerHTML = pictureImageTxt_d;
      }
    });


    // form image modal script end

});
</script>
<script>
    $('.sidenav  li:nth-of-type(5)').addClass('active');
</script>

@endsection