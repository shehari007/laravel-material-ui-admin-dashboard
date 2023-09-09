<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="photoGallery"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Photo Gallery"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            @if (\Session::has('success'))
            <div class="alert alert-success">
                <p style="color: white;font-weight:bold">{!! \Session::get('success') !!}</p>
            </div>
            @elseif (\Session::has('error'))
            <div class="alert alert-danger">
                <p style="color: white;font-weight:bold">{!! \Session::get('error') !!}</p>
            </div>
            @endif
            <div class="alert alert-info" role="alert" style="color: white;">
                <span class="alert-icon align-middle">
                    <span class="material-icons text-md">
                        info_outline
                    </span>
                </span>
                <span class="alert-text"><strong>Important!</strong> Please Refresh The Page After Successfully Uploading Files to Show All the Uploaded Content</span>
            </div>
            <div class="alert alert-secondary" role="alert" style="color: white;">
                <span class="alert-icon align-middle">
                    <span class="material-icons text-md">
                        error_outline
                    </span>
                </span>
                <span class="alert-text"><strong>Careful!</strong> Only File Size Max 2MB and Images jpeg, png, jpg, gif are accepted</span>
            </div>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteGallery"> <span class="material-icons">
                    delete
                </span>Delete All Photos</button>
            <div id="dropzone">
                <form class="dropzone" action="photoGallery/fileUpload" id="file-upload" enctype="multipart/form-data">
                    @csrf
                    <div class="dz-message">
                        <h4>Drag and Drop Single / Multiple Photos Here</h4><br>
                    </div>
                </form>
            </div>
            <br />
            <br />
            <div style="display: flex; flex-wrap: wrap;">
                @foreach ($photos as $photo)
                <div style="width: 200px; height: 200px; margin: 10px;margin-top:35px;">
                    <div class="card" data-animation="true" style="width: 100%; height: 100%;">
                        <div class="card-header p-0 position-relative mt-n3 mx-3 z-index-2">
                            <a class="d-block blur-shadow-image" style=" height: 180px; overflow: hidden;">
                                <img src="{{ asset('storage/PhotoGallery/Gallery/' . $photo->src) }}" width="150" height="150" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg" style="object-fit: fill; object-position: center center; width: 100%; height: 100%;">
                            </a>
                            <div class="colored-shadow" style="background-image: url(&quot;https://demos.creative-tim.com/test/material-dashboard-pro/assets/img/products/product-1-min.jpg&quot;);"></div>
                        </div>
                        <div class="card-body text-center">
                            <div class="d-flex mx-auto" style="margin-top: -4.2rem;">
                                <button type="button" class="btn btn-danger text-light mx-auto border-0" data-bs-toggle="modal" data-bs-target="#deleteConfirmModalPhoto{{ $photo->id }}">
                                    <i class="material-icons text-xl">close</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete Confirm Modal -->
                <div class="modal fade" id="deleteConfirmModalPhoto{{ $photo->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalPhotoLabel{{ $photo->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Confirm Delete</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="photoGallery/deletePhoto/{{ $photo->id }}">
                                    @csrf
                                    <div align="center">
                                        <img src="{{ asset('storage/PhotoGallery/Gallery/' . $photo->src) }}" width="150" height="150" alt="img-blur-shadow" />
                                        <p>Are you sure you want to delete this Photo?</p>
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

                @endforeach
            </div>



            <!-- Delete Gallery Modal -->
            <div class="modal fade" id="deleteGallery" tabindex="-1" role="dialog" aria-labelledby="deleteGalleryLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Confirm Delete</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="photoGallery/deleteGallery/">
                                @csrf
                                <div align="center">
                                    <img src="{{ asset('storage/warning.avif') }}" width="150" height="150" alt="img-blur-shadow" />
                                    <p><b>Are you sure you want to delete all the Photos?<br />This will empty the Gallery and permanently delete all the files.<br />This cannot be undone!</b></p>
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



            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>

<!-- Auto File Handler -->
<script>
    var dropzone = new Dropzone('#file-upload', {
        previewTemplate: document.querySelector('#preview-template').innerHTML,
        parallelUploads: 3,
        thumbnailHeight: 150,
        thumbnailWidth: 150,
        maxFilesize: 5,
        filesizeBase: 1500,
        thumbnail: function(file, dataUrl) {
            if (file.previewElement) {
                file.previewElement.classList.remove("dz-file-preview");
                var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
                for (var i = 0; i < images.length; i++) {
                    var thumbnailElement = images[i];
                    thumbnailElement.alt = file.name;
                    thumbnailElement.src = dataUrl;
                }
                setTimeout(function() {
                    file.previewElement.classList.add("dz-image-preview");
                }, 1);
            }
        }
    });

    var minSteps = 6,
        maxSteps = 60,
        timeBetweenSteps = 100,
        bytesPerStep = 100000;
    dropzone.uploadFiles = function(files) {
        var self = this;
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            totalSteps = Math.round(Math.min(maxSteps, Math.max(minSteps, file.size / bytesPerStep)));
            for (var step = 0; step < totalSteps; step++) {
                var duration = timeBetweenSteps * (step + 1);
                setTimeout(function(file, totalSteps, step) {
                    return function() {
                        file.upload = {
                            progress: 100 * (step + 1) / totalSteps,
                            total: file.size,
                            bytesSent: (step + 1) * file.size / totalSteps
                        };
                        self.emit('uploadprogress', file, file.upload.progress, file.upload
                            .bytesSent);
                        if (file.upload.progress == 100) {
                            file.status = Dropzone.SUCCESS;
                            self.emit("success", file, 'success', null);
                            self.emit("complete", file);
                            self.processQueue();
                        }
                    };
                }(file, totalSteps, step), duration);
            }
        }
    }
</script>
<!-- DropZone CSS -->
<style>
    .dropzone {
        background: #e3e6ff;
        border-radius: 13px;
        margin-left: auto;
        margin-right: auto;
        border: 2px dotted #1833FF;
    }
</style>