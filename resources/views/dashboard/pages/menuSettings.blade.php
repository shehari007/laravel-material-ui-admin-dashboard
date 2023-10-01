@php
$activeTab = request()->query();

@endphp
<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="menuSettings"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Menu Settings"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">

            <div class="card">
                <button type="button" class="btn btn-success" style="max-width: 100px;margin-top: 25px;margin-left:25px">Add</button>
                <div style="display: flex; flex-direction: row; justify-content: center;">
                    <div class="card" style="display: inline; width: 90%; justify-content:center;">

                        <ul style="display: inline;  list-style-type: none;">
                            @foreach ($menuItems as $m)
                            @if($m->parent_id===null)
                            <li style="float: left; margin-right:5%">{{$m->menu_title}}</li>
                            @endif
                          
                            @endforeach
                        </ul>


                    </div>
                </div>
                <br />
                <br />
                <hr />
                <h5 style="margin-top:25px;margin-left:25px">ADD MENU / EDIT MENU</h5>
                <br />
                <div style="margin-left: 25%;">
                    <form role="form" class="form-vertical" id="tab1_form" method="POST" enctype="multipart/form-data" action="documents/insertNewDocument">
                        @csrf
                        <div class="input-group input-group-outline my-3">
                            <label for="top_menu" class="col-sm-3 control-label">Top Menu</label>

                            <div class="col-sm-9">

                                <select class="form-control" name="top_menu" id="top_menu">
                                    <option value="null">None</option>
                                    @foreach ($menuItems as $top)
                                    @if($top->parent_id === null)
                                    <option value="{{ $top->id }}">{{ $top->menu_title }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="input-group input-group-outline my-3">
                            <label for="heading" class="col-sm-3 control-label">Heading</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ $activeTab ? json_decode($activeTab['edit'])->sub_menu : '' }}" required class="form-control" id="heading" name="heading">
                            </div>

                        </div>
                        <div class="input-group input-group-outline my-3">
                            <label for="order" class="col-sm-3 control-label">Order No.</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ $activeTab ? json_decode($activeTab['edit'])->order : '' }}" required class="form-control" id="order" name="order">
                            </div>

                        </div>
                        <div class="input-group input-group-outline my-3">
                            <label for="web_pages" class="col-sm-3 control-label">Select Page</label>

                            <div class="col-sm-9">

                                <select class="form-control" name="web_pages" id="web_pages">
                                    <option value="">None</option>
                                    @foreach($webPages as $page)
                                    <option value="{{ $page->url }}">{{$page->heading}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="input-group input-group-outline my-3">
                            <label for="heading" class="col-sm-3 control-label">Outer Page Link</label>
                            <div class="col-sm-9">
                                <input type="text" required class="form-control" id="heading" name="heading">
                                <p><b>Info: </b>If you want to link any outside page you can past the link here.</p>
                            </div>

                        </div>
                        <div align="right" style="margin-right: 25px;">
                            <button type="submit" class="btn btn-success" onclick="">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
<style>
    .menu_heading {
        margin-right: 15px;
    }
</style>
