@php
$activeTab = request()->path();
@endphp
<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="generalSettings"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="General Settings"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
        <nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul>
</nav>
            <div class="nav-wrapper position-relative end-0">
                @if (\Session::has('message'))
                <div class="alert alert-success">
                <p style="color: white;font-weight:bold">{!! \Session::get('message') !!}</p>
                </div>
                @endif
                <ul class="nav nav-pills nav-fill p-1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" role="tab" aria-controls="sitesettings" aria-selected="true" href="#site-settings">
                            Site Settings
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" role="tab" aria-controls="siteinfo" aria-selected="false" href="#site-info">
                            Site Info
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" role="tab" aria-controls="smtpinfo" aria-selected="false" href="#smtp">
                            SMTP Info
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade active show" id="site-settings" role="tabpanel">
                    <div class="card card-frame mt-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    @foreach($allData as $item1)
                                    @if ($item1->type=="SITESET")
                                    <form role="form" class="form-horizontal" id="tab1_form" method="POST" enctype="multipart/form-data" action="generalSettings/{{ $item1->type }}">
                                        @csrf
                                        <div class="input-group input-group-outline my-3">
                                            <label for="logo" class="col-sm-3 control-label">Logo Upload</label>
                                            <div class="col-sm-9">
                                                <input type="file" class="form-control" id="logo" name="logo">
                                                <br>
                                                <img src="{{ asset('storage/logo/' . $item1->siteset_picsrc) }}" id="logo_src"
                                                    width="200">
                                                <p style="margin-left:10px;font-size:13px;margin-top:5px;">
                                                    Photo should not be more than this size 188 x 71 px.</p>
                                            </div>

                                        </div>

                                        <div class="input-group input-group-outline my-3">
                                            <label for="default_dil" class="col-sm-3 control-label">Default Language</label>

                                            <div class="col-sm-9">

                                                <select class="form-control" name="default_dil" id="default_dil">
                                                    <option value="auto"  {!! $item1->siteset_deflang==="auto"? "selected" : "" !!}>Auto</option>
                                                    <option value="tr"  {!! $item1->siteset_deflang==="tr"? "selected" : "" !!}>Turkish</option>
                                                    <option value="en" {!! $item1->siteset_deflang==="en"? "selected" : "" !!}>English</option>
                                                </select>
                                            </div>

                                        </div>

                                        <div class="input-group input-group-outline my-3">
                                            <label for="permalink" class="col-sm-3 control-label">SEF Link
                                                Structure:</label>
                                            <div class="col-sm-9">

                                                <div class="radio radio-info radio-inline">
                                                    <input type="radio" id="inlineRadio1" value="1" name="permalink"  {!! $item1->siteset_sef==="1"? "checked" : "" !!}>
                                                    <label for="inlineRadio1">On</label>
                                                </div>
                                                <div class="radio radio-inline">
                                                    <input type="radio" id="inlineRadio2" value="0" name="permalink"  {!! $item1->siteset_sef==="0"? "checked" : "" !!}>
                                                    <label for="inlineRadio2">Off</label> <span style="margin-left:10px;font-size:13px;margin-top:5px;">(You can turn Off for foreign Languages. e.g Turkish)</span>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="input-group input-group-outline my-3">
                                            <label for="permalink" class="col-sm-3 control-label">Homepage
                                                Slogan:</label>
                                            <div class="col-sm-9">

                                                <div class="radio radio-info radio-inline">
                                                    <input type="radio" id="radio1" value="1" name="aslogan" {!! $item1->siteset_homesl==="1"? "checked" : "" !!}>
                                                    <label for="radio1">On</label>
                                                </div>
                                                <div class="radio radio-inline">
                                                    <input type="radio" id="radio2" value="0" name="aslogan" {!! $item1->siteset_homesl==="0"? "checked" : "" !!}>
                                                    <label for="radio2">Off</label>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="input-group input-group-outline my-3">
                                            <label for="permalink" class="col-sm-3 control-label">Homepage
                                                Service:</label>
                                            <div class="col-sm-9">

                                                <div class="radio radio-info radio-inline">
                                                    <input type="radio" id="radio3" value="1" name="ahizmetler" {!! $item1->siteset_homesrv==="1"? "checked" : "" !!}>
                                                    <label for="radio3">On</label>
                                                </div>
                                                <div class="radio radio-inline">
                                                    <input type="radio" id="radio4" value="0" name="ahizmetler" {!! $item1->siteset_homesrv==="0"? "checked" : "" !!}>
                                                    <label for="radio4">Off</label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="input-group input-group-outline my-3">
                                            <label for="permalink" class="col-sm-3 control-label">Homepage Featured Product:</label>
                                            <div class="col-sm-9">

                                                <div class="radio radio-info radio-inline">
                                                    <input type="radio" id="radio5" value="1" name="aourunler" {!! $item1->siteset_homefeat==="1"? "checked" : "" !!}>
                                                    <label for="radio5">On</label>
                                                </div>
                                                <div class="radio radio-inline">
                                                    <input type="radio" id="radio6" value="0" name="aourunler" {!! $item1->siteset_homefeat==="0"? "checked" : "" !!}>
                                                    <label for="radio6">Off</label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="input-group input-group-outline my-3">
                                            <label for="permalink" class="col-sm-3 control-label">Homepage 3 Blocks:</label>
                                            <div class="col-sm-9">

                                                <div class="radio radio-info radio-inline">
                                                    <input type="radio" id="radio7" value="1" name="abloklar" {!! $item1->siteset_home3block==="1"? "checked" : "" !!}>
                                                    <label for="radio7">On</label>
                                                </div>
                                                <div class="radio radio-inline">
                                                    <input type="radio" id="radio8" value="0" name="abloklar" {!! $item1->siteset_home3block==="0"? "checked" : "" !!}>
                                                    <label for="radio8">Off</label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="input-group input-group-outline my-3">
                                            <label for="permalink" class="col-sm-3 control-label">Homepage
                                                References:</label>
                                            <div class="col-sm-9">

                                                <div class="radio radio-info radio-inline">
                                                    <input type="radio" id="radio9" value="1" name="areferanslar" {!! $item1->siteset_homeref==="1"? "checked" : "" !!}>
                                                    <label for="radio9">On</label>
                                                </div>
                                                <div class="radio radio-inline">
                                                    <input type="radio" id="radio10" value="0" name="areferanslar" {!! $item1->siteset_homeref==="0"? "checked" : "" !!}>
                                                    <label for="radio10">Off</label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="input-group input-group-outline my-3">
                                            <label class="control-label col-md-3">Theme Color1:</label>
                                            <div class="col-md-4">
                                                <input type="text" class="colorpicker-default form-control" name="renk1" value="{{ $item1->siteset_theme1 }}">
                                            </div>
                                        </div>


                                        <div class="input-group input-group-outline my-3">
                                            <label class="control-label col-md-3">Theme Color2:</label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="renk2" value="{{ $item1->siteset_theme2 }}">
                                            </div>
                                        </div>




                                        <div align="right">
                                            <button type="submit" class="btn btn-success" onclick="">Submit</button>
                                        </div>

                                    </form>
                                    @endif
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="site-info" role="tabpanel">
                    <div class="card card-frame mt-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    @foreach($allData as $data)
                                        @if($data->type==='SITEINFO')
                                    <form role="form" class="form-horizontal" id="tab2_form" method="POST" action="generalSettings/{{$data->type}}">
                                        @csrf
                                        <div class="input-group input-group-outline my-3">
                                            <label for="title" class="col-sm-3 control-label">Homepage Title</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="title" name="title" value="{{ $data->siteinfo_title }}">
                                            </div>
                                        </div>

                                        <div class="input-group input-group-outline my-3">
                                            <label for="keywords" class="col-sm-3 control-label">
                                                Keywords</label>
                                            <div class="col-sm-9">
                                                <input name="keywords" id="keywords" class="form-control tags" value="{{ $data->siteinfo_keywords }}">
                                            </div>
                                        </div>

                                        <div class="input-group input-group-outline my-3">
                                            <label for="description" class="col-sm-3 control-label">Site Description</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" rows="5" id="description" name="description">{{ $data->siteinfo_description }}</textarea>
                                            </div>
                                        </div>

                                        <div class="input-group input-group-outline my-3">
                                            <label for="facebook" class="col-sm-3 control-label">Facebook</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="facebook" name="facebook" value="{{ $data->siteinfo_fb }}">
                                            </div>
                                        </div>


                                        <div class="input-group input-group-outline my-3">
                                            <label for="twitter" class="col-sm-3 control-label">Twitter</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="twitter" name="twitter" value="{{ $data->siteinfo_twitter }}">
                                            </div>
                                        </div>

                                        <div class="input-group input-group-outline my-3">
                                            <label for="instagram" class="col-sm-3 control-label">Instagram</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="instagram" name="instagram" value="{{ $data->siteinfo_insta }}">
                                            </div>
                                        </div>

                                        <div class="input-group input-group-outline my-3">
                                            <label for="google" class="col-sm-3 control-label">Google+</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="google" name="google" value="{{ $data->siteinfo_google }}">
                                            </div>
                                        </div>

                                        <div class="input-group input-group-outline my-3">
                                            <label for="google_maps" class="col-sm-3 control-label">Google Maps</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="google_maps" name="google_maps" value="{{ $data->siteinfo_googlemap }}">
                                            </div>
                                        </div>




                                        <div class="input-group input-group-outline my-3">
                                            <label for="slogan1" class="col-sm-3 control-label">Slogan 1</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="slogan1" name="slogan1" value="{{ $data->siteinfo_sl1 }}">
                                            </div>
                                        </div>


                                        <div class="input-group input-group-outline my-3">
                                            <label for="slogan2" class="col-sm-3 control-label">Slogan 2</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="slogan2" name="slogan2" value="{{ $data->siteinfo_sl2 }}">
                                            </div>
                                        </div>

                                        <div class="input-group input-group-outline my-3">
                                            <label for="telefon" class="col-sm-3 control-label">Telephone</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="telefon" name="telefon" value="{{ $data->siteinfo_telephone }}">
                                            </div>
                                        </div>

                                        <div class="input-group input-group-outline my-3">
                                            <label for="faks" class="col-sm-3 control-label">Fax</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="faks" name="faks" value="{{ $data->siteinfo_fax }}">
                                            </div>
                                        </div>

                                        <div class="input-group input-group-outline my-3">
                                            <label for="email" class="col-sm-3 control-label">E-Mail</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="email" name="email" value="{{ $data->siteinfo_email }}">
                                            </div>
                                        </div>


                                        <div class="input-group input-group-outline my-3">
                                            <label for="adres" class="col-sm-3 control-label">Address</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" rows="5" id="adres" name="adres">{{ $data->siteinfo_address }}</textarea>
                                            </div>
                                        </div>

                                        <div class="input-group input-group-outline my-3">
                                            <label for="analytics" class="col-sm-3 control-label">Analytics Code</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" rows="5" id="analytics" name="analytics">{{ $data->siteinfo_ac }}</textarea>
                                            </div>
                                        </div>
                                        <div align="right">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>


                                    </form>
                                    @endif
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="smtp" role="tabpanel">
                    <div class="card card-frame mt-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    @foreach($allData as $item)
                                    @if($item->type==='SMTP')
                                    <form role="form" class="form-horizontal" id="tab3_form" method="POST" action="generalSettings/{{$item->type}}">
                                        @csrf
                                        <div class="alert alert-info" style="color:aliceblue;" role="alert">Your contact form can work
                                            It is mandatory to fill in the information below. Please ask your system administrator,
                                            create an e-mail account for you and provide the following information
                                            please ask.</div>
                                        <div class="input-group input-group-outline my-3">
                                            <label for="smtp_host" class="col-sm-3 control-label">SMTP Server:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="smtp_host" name="smtp_host" placeholder="Örn: mail.domain.com" value="{{ $item->smtp_server }}">
                                            </div>
                                        </div>

                                        <div class="input-group input-group-outline my-3">
                                            <label for="smtp_port" class="col-sm-3 control-label">SMTP Port:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="smtp_port" name="smtp_port" placeholder="587" value="{{ $item->smtp_port }}">
                                            </div>
                                        </div>

                                        <div class="input-group input-group-outline my-3">
                                            <label for="smtp_protokol" class="col-sm-3 control-label">SMTP Protocol:
                                            </label>
                                            <div class="col-sm-9">
                                                <select name="smtp_protokol" id="smtp_protokol" class="form-control">
                                                    <option value="yok" {!! $item->smtp_protocol === 'yok'? 'selected': '' !!}>Yok</option>
                                                    <option value="tls" {!! $item->smtp_protocol === 'tls'? 'selected': '' !!}>TLS</option>
                                                    <option value="ssl" {!! $item->smtp_protocol === 'ssl'? 'selected': '' !!}>SSL</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="input-group input-group-outline my-3">
                                            <label for="smtp_username" class="col-sm-3 control-label">E-Mail:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="smtp_email" name="smtp_email" placeholder="Örn: info@example.com" value="{{ $item->smtp_email }}">
                                            </div>
                                        </div>

                                        <div class="input-group input-group-outline my-3">
                                            <label for="smtp_password" class="col-sm-3 control-label">E-Mail Password:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="smtp_password" name="smtp_password" value="{{ $item->smtp_psw }}">
                                            </div>
                                        </div>
                                        <div align="right">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>


                                    </form>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>