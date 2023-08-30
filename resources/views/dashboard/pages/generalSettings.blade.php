@php
$activeTab = request()->path();
@endphp
<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="generalSettings"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="generalSettings"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="nav-wrapper position-relative end-0">
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
                    <div class="card card-frame mt-5">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                <form role="form" class="form-horizontal" id="tab1_form" method="POST"
                                       >

                                        <div class="input-group input-group-outline my-3">
                                            <label for="logo" class="col-sm-3 control-label">Logo Upload</label>
                                            <div class="col-sm-9">
                                                <input type="file" class="form-control" id="logo" name="logo">
                                                <br>
                                                <!-- <img src="./Yönetim Paneli_files/49894ef4aa.jpg" id="logo_src"
                                                    width="200"> -->
                                                <p style="margin-left:10px;font-size:13px;margin-top:5px;">
                                                    Photo should be this size 188 x 71 px.</p>
                                            </div>

                                        </div>

                                        <div class="input-group input-group-outline my-3">
                                            <label for="default_dil" class="col-sm-3 control-label">Default Language</label>

                                            <div class="col-sm-9">

                                                <select class="form-control" name="default_dil" id="default_dil">
                                                    <option value="auto">Auto</option>
                                                    <option value="tr" >Turkish</option>
                                                    <option value="en"selected="">English</option>
                                                </select>
                                            </div>

                                        </div>

                                        <div class="input-group input-group-outline my-3">
                                            <label for="permalink" class="col-sm-3 control-label">SEF Link
                                                Structure:</label>
                                            <div class="col-sm-9">

                                                <div class="radio radio-info radio-inline">
                                                    <input type="radio" id="inlineRadio1" value="Evet" name="permalink"
                                                        checked="">
                                                    <label for="inlineRadio1">On</label>
                                                </div>
                                                <div class="radio radio-inline">
                                                    <input type="radio" id="inlineRadio2" value="Hayir"
                                                        name="permalink">
                                                    <label for="inlineRadio2">Off</label> <span
                                                        style="margin-left:10px;font-size:13px;margin-top:5px;">(You can turn Off for foreign Languages. e.g Turkish)</span>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="input-group input-group-outline my-3">
                                            <label for="permalink" class="col-sm-3 control-label">Homepage
                                                Slogan:</label>
                                            <div class="col-sm-9">

                                                <div class="radio radio-info radio-inline">
                                                    <input type="radio" id="radio1" value="1" name="aslogan" checked="">
                                                    <label for="radio1">On</label>
                                                </div>
                                                <div class="radio radio-inline">
                                                    <input type="radio" id="radio2" value="0" name="aslogan">
                                                    <label for="radio2">Off</label>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="input-group input-group-outline my-3">
                                            <label for="permalink" class="col-sm-3 control-label">Homepage
                                                Service:</label>
                                            <div class="col-sm-9">

                                                <div class="radio radio-info radio-inline">
                                                    <input type="radio" id="radio3" value="1" name="ahizmetler"
                                                        checked="">
                                                    <label for="radio3">On</label>
                                                </div>
                                                <div class="radio radio-inline">
                                                    <input type="radio" id="radio4" value="0" name="ahizmetler">
                                                    <label for="radio4">Off</label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="input-group input-group-outline my-3">
                                            <label for="permalink" class="col-sm-3 control-label">Homepage Featured Product:</label>
                                            <div class="col-sm-9">

                                                <div class="radio radio-info radio-inline">
                                                    <input type="radio" id="radio5" value="1" name="aourunler"
                                                        checked="">
                                                    <label for="radio5">On</label>
                                                </div>
                                                <div class="radio radio-inline">
                                                    <input type="radio" id="radio6" value="0" name="aourunler">
                                                    <label for="radio6">Off</label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="input-group input-group-outline my-3">
                                            <label for="permalink" class="col-sm-3 control-label">Homepage 3 Blocks:</label>
                                            <div class="col-sm-9">

                                                <div class="radio radio-info radio-inline">
                                                    <input type="radio" id="radio7" value="1" name="abloklar"
                                                        checked="">
                                                    <label for="radio7">On</label>
                                                </div>
                                                <div class="radio radio-inline">
                                                    <input type="radio" id="radio8" value="0" name="abloklar">
                                                    <label for="radio8">Off</label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="input-group input-group-outline my-3">
                                            <label for="permalink" class="col-sm-3 control-label">Homepage
                                                References:</label>
                                            <div class="col-sm-9">

                                                <div class="radio radio-info radio-inline">
                                                    <input type="radio" id="radio9" value="1" name="areferanslar"
                                                        checked="">
                                                    <label for="radio9">On</label>
                                                </div>
                                                <div class="radio radio-inline">
                                                    <input type="radio" id="radio10" value="0" name="areferanslar">
                                                    <label for="radio10">Off</label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="input-group input-group-outline my-3">
                                            <label class="control-label col-md-3">Theme Color1:</label>
                                            <div class="col-md-4">
                                                <input type="text" class="colorpicker-default form-control" name="renk1"
                                                    value="#494949">
                                            </div>
                                        </div>


                                        <div class="input-group input-group-outline my-3">
                                            <label class="control-label col-md-3">Theme Color2:</label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="renk2"
                                                    value="#bd2927">
                                            </div>
                                        </div>




                                        <div align="right">
                                            <button type="submit" class="btn btn-success"
                                                onclick="">Submit</button>
                                        </div>

                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="site-info" role="tabpanel">
                <div class="card card-frame mt-5">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                <form role="form" class="form-horizontal" id="tab2_form" method="POST"
                                       >





                                        <div class="input-group input-group-outline my-3">
                                            <label for="title" class="col-sm-3 control-label">Homepage Title</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="title" name="title"
                                                    value="Creative Business Kurumsal Firma Scripti">
                                            </div>
                                        </div>

                                        <div class="input-group input-group-outline my-3">
                                            <label for="keywords" class="col-sm-3 control-label">
                                                Keywords</label>
                                            <div class="col-sm-9">
                                                <input name="keywords" id="keywords" class="form-control tags"
                                                    value="firma scripti,kurumsal firma scripti,profesyonel firma scripti,ucuz firma scripti"
                                                   >
                                            
                                            </div>
                                        </div>

                                        <div class="input-group input-group-outline my-3">
                                            <label for="description" class="col-sm-3 control-label">Site Description</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" rows="5" id="description"
                                                    name="description">Creative Business Kurumsal Firma Scripti ile firma, kurum ya da kuruşunuzun etkileyici, ilgi çekici ve akılda kalıcı bir web sitesi olsun.</textarea>
                                            </div>
                                        </div>

                                        <div class="input-group input-group-outline my-3">
                                            <label for="facebook" class="col-sm-3 control-label">Facebook</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="facebook" name="facebook"
                                                    value="http://www.facebook.com">
                                            </div>
                                        </div>


                                        <div class="input-group input-group-outline my-3">
                                            <label for="twitter" class="col-sm-3 control-label">Twitter</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="twitter" name="twitter"
                                                    value="http://www.twitter.com">
                                            </div>
                                        </div>

                                        <div class="input-group input-group-outline my-3">
                                            <label for="instagram" class="col-sm-3 control-label">Instagram</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="instagram" name="instagram"
                                                    value="http://www.instagram.com">
                                            </div>
                                        </div>

                                        <div class="input-group input-group-outline my-3">
                                            <label for="google" class="col-sm-3 control-label">Google+</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="google" name="google"
                                                    value="http://www.google.com">
                                            </div>
                                        </div>

                                        <div class="input-group input-group-outline my-3">
                                            <label for="google_maps" class="col-sm-3 control-label">Google Maps</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="google_maps"
                                                    name="google_maps"
                                                    value="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d385396.60596766486!2d29.012179450000037!3d41.00532150000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14caa7040068086b%3A0xe1ccfe98bc01b0d0!2zxLBzdGFuYnVsLCBUw7xya2l5ZQ!5e0!3m2!1str!2s!4v1440361475672">
                                            </div>
                                        </div>




                                        <div class="input-group input-group-outline my-3">
                                            <label for="slogan1" class="col-sm-3 control-label">Slogan 1</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="slogan1" name="slogan1"
                                                    value="Bizi Tanıyın">
                                            </div>
                                        </div>


                                        <div class="input-group input-group-outline my-3">
                                            <label for="slogan2" class="col-sm-3 control-label">Slogan 2</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="slogan2" name="slogan2"
                                                    value="&quot;Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...&quot;">
                                            </div>
                                        </div>

                                        <div class="input-group input-group-outline my-3">
                                            <label for="telefon" class="col-sm-3 control-label">Telephone</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="telefon" name="telefon"
                                                    value="0212 444 1 444">
                                            </div>
                                        </div>

                                        <div class="input-group input-group-outline my-3">
                                            <label for="faks" class="col-sm-3 control-label">Fax</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="faks" name="faks"
                                                    value="(0212) 000 00 00">
                                            </div>
                                        </div>

                                        <div class="input-group input-group-outline my-3">
                                            <label for="email" class="col-sm-3 control-label">E-Mail</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="email" name="email"
                                                    value="info@example.com">
                                            </div>
                                        </div>


                                        <div class="input-group input-group-outline my-3">
                                            <label for="adres" class="col-sm-3 control-label">Address</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" rows="5" id="adres"
                                                    name="adres">Lorem ipsum dolor sit ametipsum dolor sit amet İstanbul/Türkiye</textarea>
                                            </div>
                                        </div>

                                        <div class="input-group input-group-outline my-3">
                                            <label for="analytics" class="col-sm-3 control-label">Analytics Code</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" rows="5" id="analytics"
                                                    name="analytics"></textarea>
                                            </div>
                                        </div>






                                        <div align="right">
                                            <button type="submit" class="btn btn-success"
                                               >Submit</button>
                                        </div>


                                    </form>

                                </div>
                            </div>
                        </div>
                </div>
                </div>
                <div class="tab-pane fade" id="smtp" role="tabpanel">
                <div class="card card-frame mt-5">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                <form role="form" class="form-horizontal" id="tab3_form" method="POST"
                                       >

                                        <div class="alert alert-info" role="alert">Your contact form can work
                                            It is mandatory to fill in the information below. Please ask your system administrator,
                                            create an e-mail account for you and provide the following information
                                            please ask.</div>
                                        <div class="input-group input-group-outline my-3">
                                            <label for="smtp_host" class="col-sm-3 control-label">SMTP Server:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="smtp_host" name="smtp_host"
                                                    placeholder="Örn: mail.domain.com" value="mail.example.com">
                                            </div>
                                        </div>

                                        <div class="input-group input-group-outline my-3">
                                            <label for="smtp_port" class="col-sm-3 control-label">SMTP Port:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="smtp_port" name="smtp_port"
                                                    placeholder="Genelde 587&#39;dir." value="587">
                                            </div>
                                        </div>

                                        <div class="input-group input-group-outline my-3">
                                            <label for="smtp_protokol" class="col-sm-3 control-label">SMTP Protocol:
                                            </label>
                                            <div class="col-sm-9">
                                                <select name="smtp_protokol" id="smtp_protokol" class="form-control">
                                                    <option value="">Yok</option>
                                                    <option value="tls" selected="">TLS</option>
                                                    <option value="ssl">SSL</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="input-group input-group-outline my-3">
                                            <label for="smtp_username" class="col-sm-3 control-label">E-Mail:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="smtp_username"
                                                    name="smtp_username" placeholder="Örn: info@example.com"
                                                    value="info@example.com">
                                            </div>
                                        </div>

                                        <div class="input-group input-group-outline my-3">
                                            <label for="smtp_password" class="col-sm-3 control-label">E-Mail Password:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="smtp_password"
                                                    name="smtp_password" value="123456">
                                            </div>
                                        </div>
                                        <div align="right">
                                            <button type="submit" class="btn btn-success"
                                                >Submit</button>
                                        </div>


                                    </form>
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