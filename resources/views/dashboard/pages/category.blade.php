<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.sidebar activePage="products"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.auth titlePage="Category"></x-navbars.navs.auth>
            <!-- End Navbar -->
            <div class="container-fluid py-4">
            @if (\Session::has('success'))
            <div class="alert alert-success mb-4" style="margin-bottom: 5px;">
                <p style="color: white;font-weight:bold">{!! \Session::get('success') !!}</p>
            </div>
            @elseif (\Session::has('error'))
            <div class="alert alert-danger mb-4" style="margin-bottom: 5px;">
                <p style="color: white;font-weight:bold">{!! \Session::get('error') !!}</p>
            </div>
            @elseif (\Session::has('list_img'))
            <div class="alert alert-warning mb-4" style="margin-bottom: 5px;">
                <p style="color: white;font-weight:bold">{!! \Session::get('list_img') !!}</p>
            </div>
            @elseif (\Session::has('back_img'))
            <div class="alert alert-success mb-4" style="margin-bottom: 5px;">
                <p style="color: white;font-weight:bold">{!! \Session::get('back_img') !!}</p>
            </div>
            @endif
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addNewCategoryModal"><i class="material-icons">add</i>Add New</button>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmCheckBoxModalCategory" id="delete-selected-modal-category" style="display: none;">
                <i class="material-icons">delete</i> Delete Selected
            </button>
            <div class="card">
                <div class="table-responsive">

                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                    <input type="checkbox" id="select-all-checkbox-pages">
                                </th>
                                <!-- <th class="text-center text-uppercase text-sm font-weight-bolder opacity-7">#</th> -->
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">Heading</th>
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Url Address</th>
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Order No.</th>
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Date</th>
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $index=>$categories)
                            <tr>

                                <td class="align-middle text-center"><input type="checkbox" name="selected_rows[]" value="{{ $categories->id }}"></td>
                                <!-- <td class="align-middle text-center">{{ $index+1 }}</td> -->
                                <td class="align-middle text-center">{{ $categories->heading }}</td>
                                <td class="align-middle text-center">{{ $categories->url }}</td>
                                <td class="align-middle text-center">{{ $categories->order }}</td>
                                <td class="align-middle text-center">{{ $categories->created_at }}</td>
                                <td class="align-middle text-center">
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editModalCategory{{ $categories->id }}">
                                        <i class="material-icons">edit</i>
                                    </button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmModalCategory{{ $categories->id }}">
                                        <i class="material-icons">delete</i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Delete Confirm Modal -->
                            <div class="modal fade" id="deleteConfirmModalCategory{{ $categories->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalCategoryLabel{{ $categories->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Confirm Delete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="category/{{ $categories->id }}">
                                                @csrf
                                                <div>
                                                    <p>Are you sure you want to delete this Category?</p>
                                                </div>
                                                <div align='right'>
                                                    <button type="submit" class="btn btn-danger" class="btn bg-gradient-primary">Yes</button>
                                                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">No</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModalCategory{{ $categories->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalCategoryLabel{{ $categories->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" style="min-width: 80%;" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Edit Category Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="margin-left: 20%;">
                                            <form role="form" class="form-vertical" id="tab1_form" method="POST" enctype="multipart/form-data" action="category/editCategory/{{ $categories->id }}">
                                                @csrf
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="heading" class="col-sm-3 control-label">Heading</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" required class="form-control" id="heading" value="{{ $categories->heading }}" name="heading">
                                                    </div>

                                                </div>
                                               
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="orderno" class="col-sm-3 control-label">Order No.</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" required class="form-control" id="orderno" value="{{ $categories->order }}" name="orderno">
                                                    </div>

                                                </div>

                                                <div class="input-group input-group-outline my-3">
                                                    <label for="list_img" class="col-sm-3 control-label">List IMG</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" class="form-control" accept=".jpeg, .jpg, .png, .gif" size="2000000" id="list_img" name="list_img">
                                                        <br>
                                                        @if ($categories->list_img === '')
                                                        <p>NO PIC UPLOADED</p>
                                                        @else
                                                        <img src="{{ asset('storage/category/listImages/' . $categories->list_img) }}" id="logo_src" style="max-width: 100px; max-height: 100px;">
                                                        @endif
                                                        <p style="margin-left:10px;font-size:13px;margin-top:5px;">
                                                            Photo should not be more than 2MB.</p>
                                                    </div>

                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="back_img" class="col-sm-3 control-label">Background IMG</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" class="form-control" id="back_img" accept=".jpeg, .jpg, .png, .gif" size="2000000" name="back_img">
                                                        <br>
                                                        @if ($categories->list_background === '')
                                                        <p>NO PIC UPLOADED</p>
                                                        @else
                                                        <img src="{{ asset('storage/category/backImages/' . $categories->list_background) }}" id="logo_src2" style="max-width: 100px; max-height: 100px;">
                                                        @endif
                                                        <p style="margin-left:10px;font-size:13px;margin-top:5px;">
                                                            Photo should not be more than 2MB.</p>
                                                    </div>

                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="desc" class="col-sm-3 control-label">Description</label>

                                                    <div class="col-sm-9">

                                                        <textarea id="editorProducts{{ $categories->id }}" name="description" style="min-height: 40%;">{{ $categories->description }}</textarea>
                                                    </div>

                                                </div>

                                                <div class="input-group input-group-outline my-3">
                                                    <label for="so_title" class="col-sm-3 control-label">SEO Title</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" required class="form-control" id="seo_title" value="{{ $categories->seo_title }}" name="seo_title"></input>
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="seo_keywords" class="col-sm-3 control-label">SEO Keywords</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" required class="form-control" value="{{ $categories->seo_keywords }}" id="seo_keywords" name="seo_keywords"></input>
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="seo_desc" class="col-sm-3 control-label">SEO Description</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" required class="form-control" id="seo_desc" value="{{ $categories->seo_description }}" name="seo_desc"></input>
                                                    </div>
                                                </div>
                                                <div align="right">
                                                    <button type="submit" class="btn btn-success" onclick="">Submit</button>
                                                </div>

                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>

            <!-- CheckBox Delete Modal Confirm -->
            <div class="modal fade" id="deleteConfirmCheckBoxModalCategory" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmCheckBoxModalCategoryLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Confirm Delete</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <p>Are you sure you want to delete the selected Categories?</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" id="delete-selected-button-category" data-bs-dismiss="modal">Yes</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add New Modal -->
            <div class="modal fade" id="addNewCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addNewCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="min-width: 80%;" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Add New Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="margin-left: 20%;">
                            <form role="form" class="form-vertical" id="tab1_form" method="POST" enctype="multipart/form-data" action="category/insertNewCategory">
                                @csrf
                                <div class="input-group input-group-outline my-3">
                                    <label for="heading" class="col-sm-3 control-label">Heading</label>
                                    <div class="col-sm-9">
                                        <input type="text" required class="form-control" id="heading" name="heading">
                                    </div>

                                </div>
                                <div class="input-group input-group-outline my-3">
                                                    <label for="orderno" class="col-sm-3 control-label">Order No.</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" required class="form-control" id="orderno" name="orderno">
                                                    </div>

                                                </div>

                                <div class="input-group input-group-outline my-3">
                                    <label for="list_img" class="col-sm-3 control-label">List IMG</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control" id="list_img" accept=".jpeg, .jpg, .png, .gif" size="2000000" name="list_img">
                                        <br>
                                        <img id="imagePreviewCategory" src="" alt="Image Preview" style="display: none; max-width: 100px; max-height: 100px;">
                                        <p style="margin-left:10px;font-size:13px;margin-top:5px;">
                                            Photo should not be more than 2MB.</p>
                                    </div>

                                </div>
                                <div class="input-group input-group-outline my-3">
                                    <label for="back_img" class="col-sm-3 control-label">Background IMG</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control" id="back_img" accept=".jpeg, .jpg, .png, .gif" size="2000000" name="back_img">
                                        <br>
                                        <img id="imagePreviewCategory2" src="" alt="Image Preview2" style="display: none; max-width: 100px; max-height: 100px;">
                                        <p style="margin-left:10px;font-size:13px;margin-top:5px;">
                                            Photo should not be more than 2MB.</p>
                                    </div>

                                </div>

                                <div class="input-group input-group-outline my-3">
                                    <label for="desc" class="col-sm-3 control-label">Description</label>

                                    <div class="col-sm-9">

                                        <textarea id="editorProducts" name="description" style="min-height: 40%;"></textarea>
                                    </div>

                                </div>

                                <div class="input-group input-group-outline my-3">
                                    <label for="so_title" class="col-sm-3 control-label">SEO Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" required class="form-control" id="seo_title" name="seo_title"></input>
                                    </div>
                                </div>
                                <div class="input-group input-group-outline my-3">
                                    <label for="seo_keywords" class="col-sm-3 control-label">SEO Keywords</label>
                                    <div class="col-sm-9">
                                        <input type="text" required class="form-control" id="seo_keywords" name="seo_keywords"></input>
                                    </div>
                                </div>
                                <div class="input-group input-group-outline my-3">
                                    <label for="seo_desc" class="col-sm-3 control-label">SEO Description</label>
                                    <div class="col-sm-9">
                                        <input type="text" required class="form-control" id="seo_desc" name="seo_desc"></input>
                                    </div>
                                </div>
                                <div align="right">
                                    <button type="submit" class="btn btn-success" onclick="">Submit</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <x-footers.auth></x-footers.auth>
        </div>
        </main>
        <x-plugins></x-plugins>

</x-layout>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('[id^="editorProducts"]').forEach(function(textarea) {
            ClassicEditor
                .create(textarea)
                .catch(error => {
                    console.error(error);
                });
        });
    });
</script>

<!-- Image Preview Script -->
<script>
    // Function to display image preview
    function displayImagePreview(input, previewElement) {
        var fileInput = input;
        var imagePreview = previewElement;

        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                console.log('Image data loaded successfully.');
                imagePreview.style.display = 'block';
                imagePreview.src = e.target.result;
            };

            reader.readAsDataURL(fileInput.files[0]);
        } else {
            imagePreview.style.display = 'none';
            imagePreview.src = '';
        }
    }

    // Attach event listeners
    document.getElementById('list_img').addEventListener('change', function() {
        displayImagePreview(this, document.getElementById('imagePreviewCategory'));
    });

    document.getElementById('back_img').addEventListener('change', function() {
        displayImagePreview(this, document.getElementById('imagePreviewCategory2'));
    });
</script>

<!-- Checkbox Operations -->

<script>
    $(document).ready(function() {
        // Select All checkbox
        $("#select-all-checkbox-pages").change(function() {
            $(".table tbody input[type='checkbox']").prop('checked', this.checked);
            updateDeleteButtonVisibility();
        });

        // Individual checkboxes
        $(".table tbody input[type='checkbox']").change(function() {
            updateDeleteButtonVisibility();
        });

        // Function to update the visibility of the Delete button
        function updateDeleteButtonVisibility() {
            var checkedCount = $(".table tbody input[type='checkbox']:checked").length;
            if (checkedCount > 0) {
                $("#delete-selected-modal-category").show();

            } else {
                $("#delete-selected-modal-category").hide();

            }
        }

        // Delete Selected button click event
        $("#delete-selected-button-category").click(function() {
            var deleteSelected = [];
            $(".table tbody input[type='checkbox']:checked").each(function() {
                deleteSelected.push($(this).val());
            });

            if (deleteSelected.length > 0) {
                $.ajax({
                    url: `category/deleteSelected/deleteCheckedCategories`,
                    method: "POST",
                    data: {
                        ids: deleteSelected,
                        _token: '{!! csrf_token() !!}'
                    },
                    success: function(data) {
                        //alert();
                        window.location.reload();
                    },
                    error: function(error) {
                        alert("An error occurred while deleting selected items.");
                    }
                });
            }
        });
    });
</script>
