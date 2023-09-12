<?php

namespace App\Http\Controllers;

use App\Models\generalSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class GeneralSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index1()
    {
        $allData = generalSettings::all();
        return view("/dashboard/pages/generalSettings", compact('allData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(generalSettings $generalSettings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(generalSettings $generalSettings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, generalSettings $generalSettings)
    {
        //
    }

    public function superUpdate(Request $request, $type)
    {
        if ($type == "SMTP") 
        {
            $table = generalSettings::where('type', $type)->first();
            $table->update([
                "smtp_server" => $request->input('smtp_host'),
                "smtp_port" => $request->input('smtp_port'),
                "smtp_protocol" => $request->input('smtp_protokol'),
                "smtp_email" => $request->input('smtp_email'),
                "smtp_psw" => $request->input('smtp_password'),
            ]);
            return redirect()->route("generalSettingshome")->with("message", "SMTP Data is successfully updated");
        } 
        
        else if ($type == "SITEINFO") 
        
        {
            $table = generalSettings::where('type', $type)->first();
            $table->update([
                "siteinfo_title" => $request->input('title'),
                "siteinfo_description" => $request->input('description'),
                "siteinfo_keywords" => $request->input('keywords'),
                "siteinfo_fb" => $request->input('facebook'),
                "siteinfo_twitter" => $request->input('twitter'),
                "siteinfo_insta" => $request->input('instagram'),
                "siteinfo_google" => $request->input('google'),
                "siteinfo_googlemap" => $request->input('google_maps'),
                "siteinfo_sl1" => $request->input('slogan1'),
                "siteinfo_sl2" => $request->input('slogan2'),
                "siteinfo_telephone" => $request->input('telefon'),
                "siteinfo_fax" => $request->input('faks'),
                "siteinfo_email" => $request->input('email'),
                "siteinfo_address" => $request->input('adres'),
                "siteinfo_ac" => $request->input('analytics'),
            ]);

            return redirect()->route("generalSettingshome")->with("message", "Site Info Data is successfully updated");
        } 

        else if ($type == "SITESET") 

        {
            $table = generalSettings::where('type', $type)->first();
            $request->validate([
                'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($request->hasFile('logo')) {
                if ($table->siteset_picsrc!==''){
                    Storage::delete('public/logo/' . $table->list_img);
                }
                $uploadedFile = $request->file('logo');
                $originalFilename = $uploadedFile->getClientOriginalName();
                $filename = Str::random(20) . '_' . $originalFilename;
                $filePath = $uploadedFile->storeAs('public/logo', $filename);

                $table->update([
                    "siteset_picsrc" => $filename
                ]);
            }

            $table->update([

                "siteset_deflang" => $request->input('default_dil'),
                "siteset_sef" => $request->input('permalink'),
                "siteset_homesl" => $request->input('aslogan'),
                "siteset_homesrv" => $request->input('ahizmetler'),
                "siteset_homefeat" => $request->input('aourunler'),
                "siteset_home3block" => $request->input('abloklar'),
                "siteset_homeref" => $request->input('areferanslar'),
                "siteset_theme1" => $request->input('renk1'),
                "siteset_theme2" => $request->input('renk2'),

            ]);

            return redirect()->route("generalSettingshome")->with("message", "Site Setting Data is successfully updated");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(generalSettings $generalSettings)
    {
        //
    }
}
