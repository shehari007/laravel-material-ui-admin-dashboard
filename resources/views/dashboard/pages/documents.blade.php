<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.sidebar activePage="documents"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.auth titlePage="Documents"></x-navbars.navs.auth>
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
            @elseif (\Session::has('back_img'))
            <div class="alert alert-success mb-4" style="margin-bottom: 5px;">
                <p style="color: white;font-weight:bold">{!! \Session::get('back_img') !!}</p>
            </div>
            @endif
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addNewModalDocument"><i class="material-icons">add</i>Add New Document</button>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCheckedConfirmModalDocumet" id="delete-selected-modal-document" style="display: none;">
                <i class="material-icons">delete</i> Delete Selected
            </button>
            <div class="card">
                <div class="table-responsive">

                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                    <input type="checkbox" id="select-all-checkbox">
                                </th>
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">Heading</th>
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Order No.</th>
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Date</th>
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($documents as $document)
                            <tr>
                                <td class="align-middle text-center"><input type="checkbox" name="selected_rows[]" value="{{ $document->id }}"></td>
                                <td class="align-middle text-center">{{ $document->heading }}</td>
                                <td class="align-middle text-center">{{ $document->order }}</td>
                                <td class="align-middle text-center">{{ $document->created_at }}</td>
                                <td class="align-middle text-center">
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editModalDocument{{ $document->id }}">
                                        <i class="material-icons">edit</i>
                                    </button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmModalDocument{{ $document->id }}">
                                        <i class="material-icons">delete</i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Delete Confirm Modal -->
                            <div class="modal fade" id="deleteConfirmModalDocument{{ $document->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalDocumentLabel{{ $document->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Confirm Delete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="documents/deleteDocument/{{ $document->id }}">
                                                @csrf
                                                <div>
                                                    <p>Are you sure you want to delete this Video Document Data?</p>
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
                            <div class="modal fade" id="editModalDocument{{ $document->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalDocumentLabel{{ $document->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" style="min-width: 80%;" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Edit Document Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="margin-left: 20%;">
                                            <form role="form" class="form-vertical" id="tab1_form" method="POST" enctype="multipart/form-data" action="documents/editDocument/{{ $document->id }}">
                                                @csrf
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="heading" class="col-sm-3 control-label">Heading</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" required class="form-control" id="heading" value="{{ $document->heading }}" name="heading">
                                                    </div>


                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="order" class="col-sm-3 control-label">Order No.</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" required class="form-control" id="order" value="{{ $document->order }}" name="order">
                                                    </div>

                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="vlink" class="col-sm-3 control-label">Select Document</label>
                                                    <div class="col-sm-9">
                                                    <input type="file" class="form-control" accept=".pdf,.doc,.docx" size="5000000" id="doc" name="doc">
                                                        <hr>
                                                        <p>Download the file by clicking here <span><a href="{{ asset('storage/Documents/Files/' . $document->src) }}" download="">download</a></span></p> 

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
            <div class="modal fade" id="deleteCheckedConfirmModalDocumet" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalDocumentLabel2" aria-hidden="true">
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
                                <p>Are you sure you want to delete the selected Documents Data?</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" id="delete-selected-button-documents" data-bs-dismiss="modal">Yes</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add New Modal -->
            <div class="modal fade" id="addNewModalDocument" tabindex="-1" role="dialog" aria-labelledby="addNewModalDocumentLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="min-width: 80%;" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Add New Document Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="margin-left: 20%;">
                            <form role="form" class="form-vertical" id="tab1_form" method="POST" enctype="multipart/form-data" action="documents/insertNewDocument">
                                @csrf
                                <div class="input-group input-group-outline my-3">
                                    <label for="heading" class="col-sm-3 control-label">Heading</label>
                                    <div class="col-sm-9">
                                        <input type="text" required class="form-control" id="heading" name="heading">
                                    </div>

                                </div>
                                <div class="input-group input-group-outline my-3">
                                    <label for="order" class="col-sm-3 control-label">Order No.</label>
                                    <div class="col-sm-9">
                                        <input type="text" required class="form-control" id="order" name="order">
                                    </div>

                                </div>
                                <div class="input-group input-group-outline my-3">
                                    <label for="vlink" class="col-sm-3 control-label">Select Document</label>
                                    <div class="col-sm-9">
                                    <input type="file" class="form-control" accept=".pdf,.doc,.docx" size="5000000" id="doc" name="doc">
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


<!-- Checkbox Operations -->
<script>
    $(document).ready(function() {
        // Select All checkbox
        $("#select-all-checkbox").change(function() {
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
                $("#delete-selected-modal-document").show();

            } else {
                $("#delete-selected-modal-document").hide();

            }
        }

        // Delete Selected button click event
        $("#delete-selected-button-documents").click(function() {
            var deleteSelected = [];
            $(".table tbody input[type='checkbox']:checked").each(function() {
                deleteSelected.push($(this).val());
            });

            if (deleteSelected.length > 0) {
                $.ajax({
                    url: `documents/deleteSelectedDocuments/deleteCheckedDocuments`,
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