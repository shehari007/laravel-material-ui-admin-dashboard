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
                <div style="display: flex; flex-direction: row; justify-content: space-between;">
                    <ul class="nav">
                        @foreach($menus as $topMenu)
                        @if ($topMenu->top_menu_heading!=='')
                        <li style="margin-top: 65px;margin-right: 15px;margin-left:55px;">{{ $topMenu->top_menu_heading }}
                            <a href="#"> <i class="material-icons">delete</i></a>
                            <a href="#"> <i class="material-icons">edit</i></a>
                            <ul style="list-style: none;">
                                @foreach($menus as $subMenu)
                                @if ($subMenu->top_id == $topMenu->id)
                                <li style="margin-left: -25px;" >{{ $subMenu->sub_menu }}
                                    <a href="menuSettings?delete={{ $subMenu->id }}"> <i class="material-icons">delete</i></a>
                                    <a href="menuSettings?edit={{ $subMenu->id }}""> <i class="material-icons">edit</i></a>
                                   
                                </li>
                                @endif
                                @endforeach
                            </ul>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
                <br/>
                <br/>
                <hr/>
                <h5 style="margin-top:25px;margin-left:25px">ADD MENU / EDIT MENU</h5>
                <br/>
                <div style="margin-left: 25%;">
                <form role="form" class="form-vertical" id="tab1_form" method="POST" enctype="multipart/form-data" action="documents/insertNewDocument">
                                @csrf
                                <div class="input-group input-group-outline my-3">
                                            <label for="top_menu" class="col-sm-3 control-label">Top Menu</label>

                                            <div class="col-sm-9">

                                                <select class="form-control" name="top_menu" id="top_menu">
                                                    <option value="auto"  >Auto</option>
                                                    <option value="tr" >Turkish</option>
                                                    <option value="en">English</option>
                                                </select>
                                            </div>

                                        </div>
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
                                            <label for="top_menu" class="col-sm-3 control-label">Select Page</label>

                                            <div class="col-sm-9">

                                                <select class="form-control" name="top_menu" id="top_menu">
                                                    <option value="auto"  >Auto</option>
                                                    <option value="tr" >Turkish</option>
                                                    <option value="en">English</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="input-group input-group-outline my-3">
                                    <label for="heading" class="col-sm-3 control-label">Outer Page Link</label>
                                    <div class="col-sm-9">
                                        <input type="text" required class="form-control" id="heading" name="heading">
                                    <p><b>Info: </b>If you wantto link any outside page you can past the link here.</p>
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