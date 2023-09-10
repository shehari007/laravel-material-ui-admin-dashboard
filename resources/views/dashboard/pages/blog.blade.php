<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.sidebar activePage="blog"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.auth titlePage="Blogs"></x-navbars.navs.auth>
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
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addNewBlogModal"><i class="material-icons">add</i>Add New Blog</button>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmCheckBoxModalBlogs" id="delete-selected-modal-blogs" style="display: none;">
                <i class="material-icons">delete</i> Delete Selected
            </button>
            <div class="card">
                <div class="table-responsive">

                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                    <input type="checkbox" id="select-all-checkbox-blogs">
                                </th>
                                <!-- <th class="text-center text-uppercase text-sm font-weight-bolder opacity-7">#</th> -->
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">Heading</th>
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Url Address</th>
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Date</th>
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blogs as $index=>$blog)
                            <tr>
                                
                                <td class="align-middle text-center"><input type="checkbox" name="selected_rows[]" value="{{ $blog->id }}"></td>
                                <!-- <td class="align-middle text-center">{{ $index+1 }}</td> -->
                                <td class="align-middle text-center">{{ $blog->heading }}</td>
                                <td class="align-middle text-center">{{ $blog->url }}</td>
                                <td class="align-middle text-center">{{ $blog->created_at }}</td>
                                <td class="align-middle text-center">
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editModalBlogs{{ $blog->id }}">
                                        <i class="material-icons">edit</i>
                                    </button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmModalBlogs{{ $blog->id }}">
                                        <i class="material-icons">delete</i>
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Delete Confirm Modal -->
                            <div class="modal fade" id="deleteConfirmModalBlogs{{ $blog->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalBlogsLabel{{ $blog->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Confirm Delete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="blog/{{ $blog->id }}">
                                                @csrf
                                                <div>
                                                    <p>Are you sure you want to delete this Blog?</p>
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
                            <div class="modal fade" id="editModalBlogs{{ $blog->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalBlogsLabel{{ $blog->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" style="min-width: 80%;" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Edit Blog Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="margin-left: 20%;">
                                            <form role="form" class="form-vertical" id="tab1_form" method="POST" enctype="multipart/form-data" action="blog/editBlogs/{{ $blog->id }}">
                                                @csrf
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="heading" class="col-sm-3 control-label">Heading</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" required class="form-control" id="heading" value="{{ $blog->heading }}" name="heading">
                                                    </div>
                                                    <div class="input-group input-group-outline my-3">
                                                        <label for="list_img" class="col-sm-3 control-label">List IMG</label>
                                                        <div class="col-sm-9">
                                                            <input type="file" class="form-control" accept=".jpeg, .jpg, .png, .gif" size="2000000" id="list_img" name="list_img">
                                                            <br>
                                                            @if ($blog->list_img === '')
                                                            <p>NO PIC UPLOADED</p>
                                                            @else
                                                            <img src="{{ asset('storage/blog/listImages/' . $blog->list_img) }}" id="logo_src" style="max-width: 100px; max-height: 100px;">
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
                                                            @if ($blog->list_background === '')
                                                            <p>NO PIC UPLOADED</p>
                                                            @else
                                                            <img src="{{ asset('storage/blog/backImages/' . $blog->list_background) }}" id="logo_src2" style="max-width: 100px; max-height: 100px;">
                                                            @endif
                                                            <p style="margin-left:10px;font-size:13px;margin-top:5px;">
                                                                Photo should not be more than 2MB.</p>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="input-group input-group-outline my-3">
                                                    <label for="desc" class="col-sm-3 control-label">Description</label>

                                                    <div class="col-sm-9">

                                                        <textarea id="editorBlogs{{ $blog->id }}" name="description" style="min-height: 40%;">{{ $blog->description }}</textarea>
                                                    </div>

                                                </div>

                                                <div class="input-group input-group-outline my-3">
                                                    <label for="so_title" class="col-sm-3 control-label">SEO Title</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" required class="form-control" id="seo_title" value="{{ $blog->seo_title }}" name="seo_title"></input>
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="seo_keywords" class="col-sm-3 control-label">SEO Keywords</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" required class="form-control" value="{{ $blog->seo_keywords }}" id="seo_keywords" name="seo_keywords"></input>
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="seo_desc" class="col-sm-3 control-label">SEO Description</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" required class="form-control" id="seo_desc" value="{{ $blog->seo_description }}" name="seo_desc"></input>
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
            <div class="modal fade" id="deleteConfirmCheckBoxModalBlogs" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmCheckboxModalBlogsLabel" aria-hidden="true">
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
                                <p>Are you sure you want to delete the selected blogs?</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" id="delete-selected-button-blogs" data-bs-dismiss="modal">Yes</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add New Modal -->
            <div class="modal fade" id="addNewBlogModal" tabindex="-1" role="dialog" aria-labelledby="addNewBlogModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="min-width: 80%;" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Add New Blog</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="margin-left: 20%;">
                            <form role="form" class="form-vertical" id="tab1_form" method="POST" enctype="multipart/form-data" action="blog/insertNewBlog">
                                @csrf
                                <div class="input-group input-group-outline my-3">
                                    <label for="heading" class="col-sm-3 control-label">Heading</label>
                                    <div class="col-sm-9">
                                        <input type="text" required class="form-control" id="heading" name="heading">
                                    </div>
                                    <div class="input-group input-group-outline my-3">
                                        <label for="list_img" class="col-sm-3 control-label">List IMG</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control" id="list_img" accept=".jpeg, .jpg, .png, .gif" size="2000000" name="list_img">
                                            <br>
                                            <img id="imagePreviewBlogs" src="" alt="Image Preview" style="display: none; max-width: 100px; max-height: 100px;">
                                            <p style="margin-left:10px;font-size:13px;margin-top:5px;">
                                                Photo should not be more than 2MB.</p>
                                        </div>

                                    </div>
                                    <div class="input-group input-group-outline my-3">
                                        <label for="back_img" class="col-sm-3 control-label">Background IMG</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control" id="back_img" accept=".jpeg, .jpg, .png, .gif" size="2000000" name="back_img">
                                            <br>
                                            <img id="imagePreviewBlogs2" src="" alt="Image Preview2" style="display: none; max-width: 100px; max-height: 100px;">
                                            <p style="margin-left:10px;font-size:13px;margin-top:5px;">
                                                Photo should not be more than 2MB.</p>
                                        </div>

                                    </div>
                                </div>

                                <div class="input-group input-group-outline my-3">
                                    <label for="desc" class="col-sm-3 control-label">Description</label>

                                    <div class="col-sm-9">

                                        <textarea id="editorBlog" name="description" style="min-height: 40%;"></textarea>
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

<!-- CKD Editor -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('[id^="editorBlog"]').forEach(function(textarea) {
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
            displayImagePreview(this, document.getElementById('imagePreviewBlogs'));
        });

        document.getElementById('back_img').addEventListener('change', function() {
            displayImagePreview(this, document.getElementById('imagePreviewBlogs2'));
        });

</script>

<!-- Checkbox Operations -->
<script>
    $(document).ready(function() {
        // Select All checkbox
        $("#select-all-checkbox-blogs").change(function() {
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
                $("#delete-selected-modal-blogs").show();

            } else {
                $("#delete-selected-modal-blogs").hide();

            }
        }

        // Delete Selected button click event
        $("#delete-selected-button-blogs").click(function() {
            var deleteSelected = [];
            $(".table tbody input[type='checkbox']:checked").each(function() {
                deleteSelected.push($(this).val());
            });

            if (deleteSelected.length > 0) {
                $.ajax({
                    url: `blog/deleteSelected/deleteCheckedBlogs`,
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
