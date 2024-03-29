@extends('layouts.admin.admin-default')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@section('content')
    @include('includes.admin.navbar')
    <main class="content-wrapper">

        <div class="">
            @if (Session::has('success'))
                <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success') }}</p>
            @endif

            @if (Session::has('error'))
                <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('error') }}</p>
            @endif

            <form class="brandForm d-flex flex-column justify-content-center align-items-center" id="brandForm" method="post"
                action="{{ route('brands.post') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">

                    <label class="picture mt-5" for="picture__input" tabIndex="0">
                        <span class="picture__image"></span>
                    </label>

                    <input type="file" name="brand_image" id="picture__input" accept="image/*">
                    <p style="color: red;font-size: 14px;padding-top: 10px;" class="d-none" id="imageErrorMessage">Brand
                        image field is required</p>
                </div>
                <div class="form-group">
                    <input type="text" name="brand_name" class="form-control" style="width: 400px;height: 50px;"
                        id="brandNameField" placeholder="Brand Name">
                    <p style="color: red;font-size: 14px;padding-top: 10px;" class="d-none" id="nameErrorMessage">Brand
                        name field is required</p>
                </div>
                <button type="submit" class="btn btn-success">Add Brand</button>
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
                            <th>Brand Name</th>
                            <th>Brand Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $brand)
                            <tr>
                                <td>{{ $brand->brand_name }}</td>
                                <td><a target="_blank" href="{{ $brand->brand_image }}"><img
                                            style="width: 100px;height: 100px;border-radius: 5px;"
                                            src="{{ $brand->brand_image }}" alt="{{ $brand->brand_image }}"></a></td>
                                <td>
                                    <button type="button" class="btn btn-primary"
                                        onclick="editModal({{ $brand->id }})">Edit</button>
                                    <button type="button" class="btn btn-danger deleteButton"
                                        src-attr="{{ $brand->id }}"
                                        onclick="deleteModal({{ $brand->id }})">Delete</button>
                                </td>
                            </tr>
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
                    <h4 class="text-center">Are you sure you want to delete this brand</h4>
                </div>
                <div class="modal-footer">

                    <form action="{{ route('delete.brand') }}" method="post">
                        @csrf
                        <input type="hidden" class="brandId" name="brand_id">
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
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">

                    <form class="categoryForm d-flex flex-column justify-content-center align-items-center" method="post"
                        id="editCategoryForm" action="{{ route('edit.brand') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">

                            {{-- image --}}

                            <label class="picture_d" for="picture__input_modal" tabIndex="0">
                                <span class="picture__image_d"><img src="" alt="" id="modalImageSrc"></span>
                            </label>

                            <input type="file" name="brand_image" id="picture__input_modal" accept="image/*">

                            <input type="hidden" name="brand_id" id="brand_id">

                            {{-- end image --}}

                        </div>
                        <div class="form-group">
                            <input type="text" name="brand_name" class="form-control"
                                style="width: 400px;height: 50px;" id="brand_name" placeholder="Brand Name">

                            <p style="color: red;font-size: 14px;padding-top: 10px;" class="d-none"
                                id="nameEditErrorMessage">Brand name field is required</p>

                        </div>
                        <button type="submit" class="btn btn-success">Update Brand</button>
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
        $("#brandForm").on('submit', function() {
            var name = $("#brandNameField").val();
            var image = $("#picture__input").val();
            var hasError = false;

            if (name == '') {
                $("#nameErrorMessage").removeClass('d-none');
                hasError = true;
            } else {
                $("#nameErrorMessage").addClass('d-none');
            }

            if (image == '') {
                $("#imageErrorMessage").removeClass('d-none');
                hasError = true;
            } else {
                $("#imageErrorMessage").addClass('d-none');
            }

            if (hasError) {
                return false;
            }
        });


        function deleteModal(id) {
            $('.brandId').val(id)
            $("#deleteModal").modal('show');
        }

        // edit
        function editModal(id) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({

                url: '{{ route("edit.brand.view") }}',
                type: "POST",
                data: {
                    id: id
                },
                dataType: 'json',

                success: function(data) {
                    console.log("Uytwhgas as323", data)
                    var brandName = data.data.brand_name;
                    var brandImage = data.data.brand_image;

                    $("#brand_name").val(brandName)
                    $('#modalImageSrc').attr('src', brandImage)
                    $('#brand_id').val(id)
                    $("#editmodal").modal('show');

                },
                error: function(data) {

                }

            });

        }


    </script>

    <script>
        $(document).ready(function() {
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


            // form image script
            const inputFile = document.querySelector("#picture__input");
            const pictureImage = document.querySelector(".picture__image");
            const pictureImageTxt = "Choose an image";
            pictureImage.innerHTML = pictureImageTxt;

            inputFile.addEventListener("change", function(e) {
                const inputTarget = e.target;
                const file = inputTarget.files[0];

                if (file) {
                    const reader = new FileReader();

                    reader.addEventListener("load", function(e) {
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

            inputFileTest.addEventListener("change", function(e) {
                const inputTarget = e.target;
                const file = inputTarget.files[0];

                if (file) {
                    const reader = new FileReader();

                    reader.addEventListener("load", function(e) {
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
