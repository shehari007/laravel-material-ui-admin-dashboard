<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="newsAndupdates"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="News & Updates"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            @if (\Session::has('success'))
            <div class="alert alert-success mb-4" style="margin-bottom: 5px;">
                <p style="color: white;font-weight:bold">{!! \Session::get('success') !!}</p>
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
            <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#addNewModal"><i class="material-icons">add</i>Add New</button>
            <div class="card">
                <div class="table-responsive">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal2" id="delete-selected-modal" style="display: none;margin:5px">
                        <i class="material-icons">delete</i> Delete Selected
                    </button>
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                    <input type="checkbox" id="select-all-checkbox">
                                </th>
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">Heading</th>
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Url Address</th>
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Date</th>
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($news as $news)
                            <tr>
                                <td class="align-middle text-center"><input type="checkbox" name="selected_rows[]" value=""></td>
                                <td class="align-middle text-center">{{ $news->heading }}</td>
                                <td class="align-middle text-center">{{ $news->url }}</td>
                                <td class="align-middle text-center">{{ $news->created_at }}</td>
                                <td class="align-middle text-center">
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editModal{{ $news->id }}">
                                        <i class="material-icons">edit</i>
                                    </button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal">
                                        <i class="material-icons">delete</i>
                                    </button>
                                </td>
                            </tr>
                            <!-- Delete Confirm Modal -->
                            <div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Confirm Delete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="">
                                                @csrf
                                                <div>
                                                    <p>Are you sure you want to delete this message?</p>
                                                </div>
                                                <button type="submit" class="btn btn-danger" class="btn bg-gradient-primary">Yes</button>
                                                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">No</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{ $news->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $news->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" style="min-width: 80%;" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Edit News & Updates</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="margin-left: 20%;">
                                            <form role="form" class="form-vertical" id="tab1_form" method="POST" enctype="multipart/form-data" action="newsAndupdates/insertNew">
                                                @csrf
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="heading" class="col-sm-3 control-label">Heading</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" required class="form-control" id="heading" value="{{ $news->heading }}" name="heading">
                                                    </div>
                                                    <div class="input-group input-group-outline my-3">
                                                        <label for="list_img" class="col-sm-3 control-label">List IMG</label>
                                                        <div class="col-sm-9">
                                                            <input type="file" class="form-control" id="list_img" name="list_img">
                                                            <br>
                                                            @if ($news->list_img === ' ')
                                                            <p>NO PIC UPLOADED</p>
                                                            @else
                                                            <img src="{{ asset('storage/newsAndUpdates/listImages/' . $news->list_img) }}" id="logo_src" style="max-width: 100px; max-height: 100px;">
                                                            @endif
                                                            <p style="margin-left:10px;font-size:13px;margin-top:5px;">
                                                                Photo should not be more than 2MB.</p>
                                                        </div>

                                                    </div>
                                                    <div class="input-group input-group-outline my-3">
                                                        <label for="back_img" class="col-sm-3 control-label">Background IMG</label>
                                                        <div class="col-sm-9">
                                                            <input type="file" class="form-control" id="back_img" name="back_img">
                                                            <br>
                                                            @if ($news->list_background === ' ')
                                                            <p>NO PIC UPLOADED</p>
                                                            @else
                                                            <img src="{{ asset('storage/newsAndUpdates/backImages/' . $news->list_background) }}" id="logo_src2" style="max-width: 100px; max-height: 100px;">
                                                            @endif
                                                            <p style="margin-left:10px;font-size:13px;margin-top:5px;">
                                                                Photo should not be more than 2MB.</p>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="input-group input-group-outline my-3">
                                                    <label for="desc" class="col-sm-3 control-label">Description</label>

                                                    <div class="col-sm-9">

                                                        <textarea id="editor{{ $news->id }}" name="description" style="min-height: 40%;">{{ $news->description }}</textarea>
                                                    </div>

                                                </div>

                                                <div class="input-group input-group-outline my-3">
                                                    <label for="so_title" class="col-sm-3 control-label">SEO Title</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" required class="form-control" id="seo_title" value="{{ $news->seo_title }}" name="seo_title"></input>
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="seo_keywords" class="col-sm-3 control-label">SEO Keywords</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" required class="form-control" value="{{ $news->seo_keywords }}" id="seo_keywords" name="seo_keywords"></input>
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="seo_desc" class="col-sm-3 control-label">SEO Description</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" required class="form-control" id="seo_desc" value="{{ $news->seo_description }}" name="seo_desc"></input>
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
            <div class="modal fade" id="deleteConfirmModal2" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel2" aria-hidden="true">
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
                                <p>Are you sure you want to delete the selected messages?</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" id="delete-selected-button" data-bs-dismiss="modal">Yes</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add New Modal -->
            <div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="min-width: 80%;" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Add New News & Updates</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="margin-left: 20%;">
                            <form role="form" class="form-vertical" id="tab1_form" method="POST" enctype="multipart/form-data" action="newsAndupdates/insertNew">
                                @csrf
                                <div class="input-group input-group-outline my-3">
                                    <label for="heading" class="col-sm-3 control-label">Heading</label>
                                    <div class="col-sm-9">
                                        <input type="text" required class="form-control" id="heading" name="heading">
                                    </div>
                                    <div class="input-group input-group-outline my-3">
                                        <label for="list_img" class="col-sm-3 control-label">List IMG</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control" id="list_img" name="list_img">
                                            <br>
                                            <img id="imagePreview" src="#" alt="Image Preview" style="display: none; max-width: 100px; max-height: 100px;">
                                            <p style="margin-left:10px;font-size:13px;margin-top:5px;">
                                                Photo should not be more than 2MB.</p>
                                        </div>

                                    </div>
                                    <div class="input-group input-group-outline my-3">
                                        <label for="back_img" class="col-sm-3 control-label">Background IMG</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control" id="back_img" name="back_img">
                                            <br>
                                            <img id="imagePreview2" src="#2" alt="Image Preview2" style="display: none; max-width: 100px; max-height: 100px;">
                                            <p style="margin-left:10px;font-size:13px;margin-top:5px;">
                                                Photo should not be more than 2MB.</p>
                                        </div>

                                    </div>
                                </div>

                                <div class="input-group input-group-outline my-3">
                                    <label for="desc" class="col-sm-3 control-label">Description</label>

                                    <div class="col-sm-9">

                                        <textarea id="editor" name="description" style="min-height: 40%;"></textarea>
                                    </div>

                                </div>

                                <div class="input-group input-group-outline my-3">
                                    <label for="so_title" class="col-sm-3 control-label">SEO Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" required class="form-control" id="seo_title" name="seo_title"></input>
                                    </div>
                                </div>
                                <div class="input-group input-group-outline my-3">
                                    <label for="seo_keywords" class="col-sm-3 control-label">SEO Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" required class="form-control" id="seo_keywords" name="seo_keywords"></input>
                                    </div>
                                </div>
                                <div class="input-group input-group-outline my-3">
                                    <label for="seo_desc" class="col-sm-3 control-label">SEO Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" required class="form-control" id="seo_desc" name="seo_desc"></input>
                                    </div>
                                </div>
                                <div align="right">
                                    <button type="submit" class="btn btn-success" onclick="">Submit</button>
                                </div>

                            </form>
                        </div>
                        <!-- <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn bg-gradient-primary">Save changes</button>
                        </div> -->
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
        document.querySelectorAll('[id^="editor"]').forEach(function(textarea) {
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
    document.getElementById('list_img').addEventListener('change', function() {
        var fileInput = this;
        var imagePreview = document.getElementById('imagePreview');

        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                imagePreview.style.display = 'block';
                imagePreview.src = e.target.result;
            };

            reader.readAsDataURL(fileInput.files[0]);
        } else {
            imagePreview.style.display = 'none';
            imagePreview.src = '#';
        }
    });
    document.getElementById('back_img').addEventListener('change', function() {
        var fileInput = this;
        var imagePreview = document.getElementById('imagePreview2');

        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                imagePreview.style.display = 'block';
                imagePreview.src = e.target.result;
            };

            reader.readAsDataURL(fileInput.files[0]);
        } else {
            imagePreview.style.display = 'none';
            imagePreview.src = '#2';
        }
    });
</script>