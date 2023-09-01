@php
$messageData;
@endphp
<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="inbox"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="inbox"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            @if (\Session::has('success'))
            <div class="alert alert-success mb-4" style="margin-bottom: 5px;">
                <p style="color: white;font-weight:bold">{!! \Session::get('success') !!}</p>
            </div>
            @elseif (\Session::has('error'))
            <div class="alert alert-warning mb-4" style="margin-bottom: 5px;">
                <p style="color: white;font-weight:bold">{!! \Session::get('success') !!}</p>
            </div>
            @elseif (\Session::has('deleteSelected'))
            <div class="alert alert-success mb-4" style="margin-bottom: 5px;">
                <p style="color: white;font-weight:bold">{!! \Session::get('deleteSelected') !!}</p>
            </div>
            @elseif (\Session::has('readSelected'))
            <div class="alert alert-success mb-4" style="margin-bottom: 5px;">
                <p style="color: white;font-weight:bold">{!! \Session::get('readSelected') !!}</p>
            </div>
            @elseif (\Session::has('unreadSelected'))
            <div class="alert alert-warning mb-4" style="margin-bottom: 5px;">
                <p style="color: white;font-weight:bold">{!! \Session::get('unreadSelected') !!}</p>
            </div>
            @endif
            <div class="card">

                <div class="table-responsive">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal2" id="delete-selected-modal" style="display: none;margin:5px">
                        <i class="material-icons">delete</i> Delete Selected
                    </button>
                    <button type="button" class="btn btn-info" id="read-selected-button" style="display: none;margin:5px">
                        <i class="material-icons">done_all</i> Mark As Read
                    </button>
                    <button type="button" class="btn btn-warning" id="unread-selected-button" style="display: none;margin:5px">
                        <i class="material-icons">markunread</i> Mark As Unread
                    </button>

                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                    <input type="checkbox" id="select-all-checkbox">
                                </th>
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">Full Name</th>
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Telephone</th>
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">E-Mail</th>
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Message</th>
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Date</th>
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Status</th>
                                <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inboxData as $inbox)
                            <tr>
                                <td class="align-middle text-center"><input type="checkbox" name="selected_rows[]" value="{{$inbox->id}}"></td>
                                <td class="align-middle text-center">{{$inbox->fullname}}</td>
                                <td class="align-middle text-center">{{$inbox->telephone}}</td>
                                <td class="align-middle text-center">{{$inbox->email}}</td>
                                <td class="align-middle text-center"> <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#messageModal" data-message="{{$inbox->message}}">

                                        <div class="ripple-container">Read Message</div>
                                    </button>
                                </td>
                                <td class="align-middle text-center">{{$inbox->created_at}}</td>
                                @if ($inbox->status === '1')
                                <td class="align-middle text-center"><span class="badge bg-gradient-success">Opened</span></td>
                                @elseif ($inbox->status === '0')
                                <td class="align-middle text-center"><span class="badge bg-gradient-warning">Unread</span></td>
                                @endif
                                <td class="align-middle text-center">
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
                                            <form method="POST" action="inbox/{{ $inbox->id }}">
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Message Modal -->
            <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Message</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Message content will be displayed here -->
                            <div id="messageContent"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
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

            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>



<!-- Message Modal Script -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the modal and message content element
        const modal = document.getElementById("exampleModal");
        const messageContent = document.getElementById("messageContent");

        // Get all buttons with the data-message attribute
        const messageButtons = document.querySelectorAll('[data-message]');

        // Attach a click event listener to each button
        messageButtons.forEach(function(button) {
            button.addEventListener("click", function() {
                // Retrieve the message from the data attribute
                const message = button.getAttribute("data-message");

                // Populate the message content in the modal
                messageContent.innerHTML = message;
            });
        });

        // Clear the message content when the modal is hidden
        modal.addEventListener("hidden.bs.modal", function() {
            messageContent.innerHTML = "";
        });
    });
</script>

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
                $("#delete-selected-modal").show();
                $("#read-selected-button").show();
                $("#unread-selected-button").show();
            } else {
                $("#delete-selected-modal").hide();
                $("#read-selected-button").hide();
                $("#unread-selected-button").hide();
            }
        }

        // Delete Selected button click event
        $("#delete-selected-button").click(function() {
            var deleteSelected = [];
            $(".table tbody input[type='checkbox']:checked").each(function() {
                deleteSelected.push($(this).val());
            });

            if (deleteSelected.length > 0) {
                $.ajax({
                    url: `inbox/selectedAction/deleteSelected`,
                    method: "POST",
                    data: {
                        ids: deleteSelected,
                        action: 'deleteSelected',
                        _token: '{!! csrf_token() !!}'
                    },
                    success: function(data) {
                        // alert(data);
                        window.location.reload();
                    },
                    error: function(error) {
                        alert("An error occurred while deleting selected items.");
                    }
                });
            }
        });

        // Read Selected button click event
        $("#read-selected-button").click(function() {
            var readSelected = [];
            $(".table tbody input[type='checkbox']:checked").each(function() {
                readSelected.push($(this).val());
            });

            if (readSelected.length > 0) {
                $.ajax({
                    url: `inbox/selectedAction/readSelected`,
                    method: "POST",
                    data: {
                        ids: readSelected,
                        action: 'readSelected',
                        _token: '{!! csrf_token() !!}'
                    },
                    success: function(data) {
                        window.location.reload();
                    },
                    error: function(error) {
                        alert("An error occurred while deleting selected items.");
                    }
                });
            }
        });


        // UnRead Selected button click event
        $("#unread-selected-button").click(function() {
            var unreadSelected = [];
            $(".table tbody input[type='checkbox']:checked").each(function() {
                unreadSelected.push($(this).val());
            });

            if (unreadSelected.length > 0) {
                $.ajax({
                    url: `inbox/selectedAction/unreadSelected`,
                    method: "POST",
                    data: {
                        ids: unreadSelected,
                        action: 'unreadSelected',
                        _token: '{!! csrf_token() !!}'
                    },
                    success: function(data) {
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