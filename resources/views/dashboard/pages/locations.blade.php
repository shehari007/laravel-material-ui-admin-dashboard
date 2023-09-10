<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.sidebar activePage="locations"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.auth titlePage="Locations"></x-navbars.navs.auth>
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
            @endif
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addNewModalLocation"><i class="material-icons">add</i>Add New Location</button>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCheckedConfirmModalLocation" id="delete-selected-modal-location" style="display: none;">
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
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">Location</th>
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Order No.</th>
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Telephone</th>
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($locations as $location)
                            <tr>
                                <td class="align-middle text-center"><input type="checkbox" name="selected_rows[]" value="{{ $location->id }}"></td>
                                <td class="align-middle text-center">{{ $location->location }}</td>
                                <td class="align-middle text-center">{{ $location->order }}</td>
                                <td class="align-middle text-center">{{ $location->telephone }}</td>
                                <td class="align-middle text-center">
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editModalLocation{{ $location->id }}">
                                        <i class="material-icons">edit</i>
                                    </button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmModalLocation{{ $location->id }}">
                                        <i class="material-icons">delete</i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Delete Confirm Modal -->
                            <div class="modal fade" id="deleteConfirmModalLocation{{ $location->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLocationLabel{{ $location->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Confirm Delete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="locations/deleteLocation/{{ $location->id }}">
                                                @csrf
                                                <div>
                                                    <p>Are you sure you want to delete this Location?</p>
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
                            <div class="modal fade" id="editModalLocation{{ $location->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLocationLabel{{ $location->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" style="min-width: 80%;" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Edit Location Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="margin-left: 20%;">
                                            <form role="form" class="form-vertical" id="tab1_form" method="POST" enctype="multipart/form-data" action="locations/editLocation/{{ $location->id }}">
                                                @csrf
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="location" class="col-sm-3 control-label">Location</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" required class="form-control" id="location" value="{{ $location->location }}" name="location">
                                                    </div>


                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="order" class="col-sm-3 control-label">Order No.</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" required class="form-control" id="order" value="{{ $location->order }}" name="order">
                                                    </div>

                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="address" class="col-sm-3 control-label">Address</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="address" value="{{ $location->address }}" name="address">
                                                    </div>

                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="telephone" class="col-sm-3 control-label">Telephone</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" required class="form-control" id="telephone" name="telephone" value="{{ $location->telephone }}">
                                                    </div>
                                                </div>
                                             
                                                
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="gsm" class="col-sm-3 control-label">GSM</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" required class="form-control" id="gsm" value="{{ $location->gsm }}" name="gsm"></input>
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="email" class="col-sm-3 control-label">Email</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" required class="form-control" value="{{ $location->email }}" id="email" name="email"></input>
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="google_map_link" class="col-sm-3 control-label">Google Map Link</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" required class="form-control" id="seo_desc" value="{{ $location->google_map_link }}" name="google_map_link"></input>
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
            <div class="modal fade" id="deleteCheckedConfirmModalLocation" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLocationLabel2" aria-hidden="true">
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
                                <p>Are you sure you want to delete the selected Locations?</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" id="delete-selected-button-locations" data-bs-dismiss="modal">Yes</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add New Modal -->
            <div class="modal fade" id="addNewModalLocation" tabindex="-1" role="dialog" aria-labelledby="addNewModalLocationLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="min-width: 80%;" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Add New Location</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="margin-left: 20%;">
                            <form role="form" class="form-vertical" id="tab1_form" method="POST" enctype="multipart/form-data" action="locations/insertNewLocation">
                                @csrf
                                <div class="input-group input-group-outline my-3">
                                                    <label for="location" class="col-sm-3 control-label">Location</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" required class="form-control" id="location"  name="location">
                                                    </div>


                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="order" class="col-sm-3 control-label">Order No.</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" required class="form-control" id="order"  name="order">
                                                    </div>

                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="address" class="col-sm-3 control-label">Address</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="address"  name="address">
                                                    </div>

                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="telephone" class="col-sm-3 control-label">Telephone</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" required class="form-control" id="telephone" name="telephone" >
                                                    </div>
                                                </div>
                                             
                                                
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="gsm" class="col-sm-3 control-label">GSM</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" required class="form-control" id="gsm"  name="gsm"></input>
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="email" class="col-sm-3 control-label">Email</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" required class="form-control" id="email" name="email"></input>
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="google_map_link" class="col-sm-3 control-label">Google Map Link</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" required class="form-control" id="seo_desc"  name="google_map_link"></input>
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
                $("#delete-selected-modal-location").show();

            } else {
                $("#delete-selected-modal-location").hide();

            }
        }

        // Delete Selected button click event
        $("#delete-selected-button-locations").click(function() {
            var deleteSelected = [];
            $(".table tbody input[type='checkbox']:checked").each(function() {
                deleteSelected.push($(this).val());
            });

            if (deleteSelected.length > 0) {
                $.ajax({
                    url: `locations/deleteSelected/deleteCheckedLocations`,
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