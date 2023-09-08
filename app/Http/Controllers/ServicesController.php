<?php

namespace App\Http\Controllers;

use App\Models\services;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ServicesController extends Controller
{

    public function getServices()
    {
        $services = services::all(); // Retrieve 10 services per page
        return view("/dashboard/pages/services", compact('services'));
    }


    public function insertNewService(Request $request)
    {

        $img2 = '';
        $url = $request->input('heading');
        $modifiedUrl = str_replace(' ', '-', $url) . '.html';

        if ($request->hasFile('back_img')) {
            $request->validate([
                'backimg' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $uploadedFile = $request->file('back_img');
            $originalFilename = $uploadedFile->getClientOriginalName();
            $img2 = Str::random(20) . '_' . $originalFilename;
            $uploadedFile->storeAs('public/services/backImages', $img2);
        }
        $newRecord = new services([
            'heading' => $request->input('heading'),
            'short_desc' => $request->input('shortDesc'),
            'out_link' => $request->input('outLink') ?: '',
            'icon_type' => $request->input('matIcon'),
            'show_home' => $request->input('showPage'),
            'url' => $modifiedUrl,
            'list_background' => $img2,
            'description' => $request->input('description'),
            'seo_title' => $request->input('seo_title'),
            'seo_keywords' => $request->input('seo_keywords'),
            'seo_description' => $request->input('seo_desc'),
        ]);
        $newRecord->save();
        return redirect()->route('serviceshome')->with('success', 'New Service Added successfully.');
    }

    public function editService(Request $request, $id)
    {
        $url = $request->input('heading');
        $modifiedUrl = str_replace(' ', '-', $url) . '.html';

        $table = services::where('id', $id)->first();
        $img2 = $table->list_background;

        if ($request->hasFile('back_img')) {
            $request->validate([
                'backimg' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            if ($table->list_background) {
                Storage::delete('public/services/backImages/' . $table->list_background);
            }
            $uploadedFile = $request->file('back_img');
            $originalFilename = $uploadedFile->getClientOriginalName();
            $img2 = Str::random(20) . '_' . $originalFilename;
            $uploadedFile->storeAs('public/services/backImages', $img2);
        }
        $table->update([
            'heading' => $request->input('heading'),
            'short_desc' => $request->input('shortDesc'),
            'out_link' => $request->input('outLink') ?: '',
            'icon_type' => $request->input('matIcon'),
            'show_home' => $request->input('showPage'),
            'url' => $modifiedUrl,
            'list_background' => $img2,
            'description' => $request->input('description'),
            'seo_title' => $request->input('seo_title'),
            'seo_keywords' => $request->input('seo_keywords'),
            'seo_description' => $request->input('seo_desc'),
        ]);
        return redirect()->route('serviceshome')->with('success', 'Service Record Edited Successfully.');
    }


    public function deleteService($id)
    {
        $table = services::find($id);

        if (!$table) {
            return redirect()->route('serviceshome')->with('error', 'Service not found delete failed.');
        }
        if ($table->list_background !== '') {
            Storage::delete('public/services/backImages/' . $table->list_background);
        }

        $table->delete();
        return redirect()->route('serviceshome')->with('success', 'Service deleted successfully.');
    }

    public function deleteSelectedServices(Request $request, $typeService)
    {
        if ($typeService === 'deleteCheckedServices') {

            $tables = services::whereIn('id', $request->ids)->get();

            foreach ($tables as $table) {
                if ($table->list_background !== '') {
                    Storage::delete('public/services/backImages/' . $table->list_background);
                }

                $table->delete();
            }

            Session::flash('success', 'Selected Services deleted successfully');
            return true;
        }
    }
}
