<?php

namespace App\Http\Controllers;

use App\Models\webpages;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class WebpagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getWebPages()
    {
        $webpages = webpages::all();
        return view("/dashboard/pages/webPages", compact('webpages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function insertNewWebPage(Request $request)
    {
        $img1 = '';
        $img2 = '';
        $url = $request->input('heading');
        $modifiedUrl = str_replace(' ', '-', $url) . '.html';


        if ($request->hasFile('list_img')) {
            $request->validate([
                'list_img' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $uploadedFile = $request->file('list_img');
            $originalFilename = $uploadedFile->getClientOriginalName();
            $img1 = Str::random(20) . '_' . $originalFilename;
            $uploadedFile->storeAs('public/webPages/listImages', $img1);
        }
        if ($request->hasFile('back_img')) {
            $request->validate([
                'backimg' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $uploadedFile = $request->file('back_img');
            $originalFilename = $uploadedFile->getClientOriginalName();
            $img2 = Str::random(20) . '_' . $originalFilename;
            $uploadedFile->storeAs('public/webPages/backImages', $img2);
        }
        $newRecord = new webpages([
            'heading' => $request->input('heading'),
            'url' => $modifiedUrl,
            'list_img' => $img1,
            'list_background' => $img2,
            'description' => $request->input('description'),
            'seo_title' => $request->input('seo_title'),
            'seo_keywords' => $request->input('seo_keywords'),
            'seo_description' => $request->input('seo_desc'),
        ]);
        $newRecord->save();
        return redirect()->route('webPageshome')->with('success', 'New Web Page Added successfully.');
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
    public function show(webpages $webpages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editWebPage(Request $request, $id)
    {
        $url = $request->input('heading');
        $modifiedUrl = str_replace(' ', '-', $url) . '.html';

        $table = webpages::where('id', $id)->first();
        $img1 = $table->list_img;
        $img2 = $table->list_background;

        if ($request->hasFile('list_img')) {
            $request->validate([
                'list_img' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            if ($table->list_img !== '') {
                Storage::delete('public/webPages/listImages/' . $table->list_img);
            }
            $uploadedFile = $request->file('list_img');
            $originalFilename = $uploadedFile->getClientOriginalName();
            $img1 = Str::random(20) . '_' . $originalFilename;
            $uploadedFile->storeAs('public/webPages/listImages', $img1);
        }
        if ($request->hasFile('back_img')) {
            $request->validate([
                'backimg' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            if ($table->list_background) {
                Storage::delete('public/webPages/backImages/' . $table->list_background);
            }
            $uploadedFile = $request->file('back_img');
            $originalFilename = $uploadedFile->getClientOriginalName();
            $img2 = Str::random(20) . '_' . $originalFilename;
            $uploadedFile->storeAs('public/webPages/backImages', $img2);
        }
        $table->update([
            'heading' => $request->input('heading'),
            'url' => $modifiedUrl,
            'list_img' => $img1,
            'list_background' => $img2,
            'description' => $request->input('description'),
            'seo_title' => $request->input('seo_title'),
            'seo_keywords' => $request->input('seo_keywords'),
            'seo_description' => $request->input('seo_desc'),
        ]);
        return redirect()->route('webPageshome')->with('success', 'Web Page Record Edited Successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, webpages $webpages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(webpages $webpages)
    {
        //
    }
}
