@props(['activePage'])

<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 d-flex text-wrap align-items-center" href=" {{ route('dashboard') }} ">
            <img src="{{ asset('assets') }}/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-2 font-weight-bold text-white">Corporate Website Configuration Panel</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="sidenav navbar navbar-vertical" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <!-- <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Laravel examples</h6>
            </li> -->
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'dashboard' ? 'active bg-gradient-primary' : '' }} "
                    href="{{ route('dashboard') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fa fa-home ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'generalSettings' ? 'active bg-gradient-primary' : '' }} "
                    href="{{ route('generalSettingshome') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fa fa-cog ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">General Settings</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'inbox' ? 'active bg-gradient-primary' : '' }} "
                    href="{{ route('inboxhome') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fa fa-inbox ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Inbox</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'newsAndupdates' ? 'active bg-gradient-primary' : '' }} "
                    href="{{ route('newsAndupdateshome') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fa fa-newspaper-o ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">News & Updates</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'blog' ? 'active bg-gradient-primary' : '' }} "
                    href="{{ route('bloghome') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fa fa-rss ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Blogs</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'webPages' ? 'active bg-gradient-primary' : '' }} "
                    href="{{ route('webPageshome') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fa fa-globe ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Web Pages</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'products' ? 'active bg-gradient-primary' : '' }} "
                    href="{{ route('productshome') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fa fa-shopping-cart ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Products</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'services' ? 'active bg-gradient-primary' : '' }} "
                    href="{{ route('serviceshome') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fa fa-server ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Services</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'photoSlider' ? 'active bg-gradient-primary' : '' }} "
                    href="{{ route('photoSlider') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fa fa-picture-o ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Photo Slider</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'photoGallery' ? 'active bg-gradient-primary' : '' }} "
                    href="{{ route('photoGallery') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fa fa-camera ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Photo Gallery</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'videoGallery' ? 'active bg-gradient-primary' : '' }} "
                    href="{{ route('videoGallery') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fa fa-video-camera ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Video Gallery</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'references' ? 'active bg-gradient-primary' : '' }} "
                    href="{{ route('references') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fa fa-rebel ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">References</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'branches' ? 'active bg-gradient-primary' : '' }} "
                    href="{{ route('branches') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fa fa-superpowers ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Branches</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'locations' ? 'active bg-gradient-primary' : '' }} "
                    href="{{ route('locations') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fa fa-thumb-tack ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Locations</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'documents' ? 'active bg-gradient-primary' : '' }} "
                    href="{{ route('documents') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fa fa-book ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Documents</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'user-profile' ? 'active bg-gradient-primary' : '' }} "
                    href="{{ route('user-profile') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">User Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'user-management' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('user-management') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;" class="fas fa-lg fa-list-ul ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">User Management</span>
                </a>
            </li>
        </ul>
    </div>
   
    </div>
</aside>
