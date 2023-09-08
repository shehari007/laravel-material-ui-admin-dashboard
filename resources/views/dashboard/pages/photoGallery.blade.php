<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.sidebar activePage="photoGallery"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.auth titlePage="photoGallery"></x-navbars.navs.auth>
            <!-- End Navbar -->
            <div class="container-fluid py-4">
            <div id="dropzone" class="dropzone">
    <p>Drag and drop picture files here or click to select<input type="file" id="fileInput" multiple style="display: none;"></p>
    
</div>
                <x-footers.auth></x-footers.auth>
            </div>
        </main>
        <x-plugins></x-plugins>

</x-layout>
<script>
    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('fileInput');

    dropzone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropzone.classList.add('dragover');
    });

    dropzone.addEventListener('dragleave', () => {
        dropzone.classList.remove('dragover');
    });

    dropzone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropzone.classList.remove('dragover');

        const files = e.dataTransfer.files;
        processFiles(files);
    });

    fileInput.addEventListener('change', (e) => {
        const files = e.target.files;
        processFiles(files);
    });

    function processFiles(files) {
        console.log(files)
        // Handle the dropped or selected files here
        // Implement the file upload logic (e.g., using FormData)

        // const formData = new FormData();
        // for (const file of files) {
        //     formData.append('pictures[]', file);
        // }

        // // Continue with the file upload logic
        // // ...

        // // Clear the file input if needed
        fileInput.value = null;
    }
</script>