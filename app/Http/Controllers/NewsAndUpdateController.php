<?php

namespace App\Http\Controllers;

use App\Models\newsAndUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class NewsAndUpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getNewsAndUpdates()
    {
        $news = newsAndUpdate::all();
        return view("/dashboard/pages/newsAndUpdates", compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function insertNew(Request $request)
    {
        $img1 = ' ';
        $img2 = ' ';
        $url = $request->input('heading');
        $modifiedUrl = str_replace(' ', '-', $url) . '.html';


        if ($request->hasFile('list_img')) {
            $request->validate([
                'list_img' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            // if ($request->fails()) {
            //     Session::flash('list_img', 'Listing Image failed, size should be less than equal to 2MB');
            // }
            // else {
            $uploadedFile = $request->file('list_img');
            $originalFilename = $uploadedFile->getClientOriginalName();
            $img1 = Str::random(20) . '_' . $originalFilename;
            $uploadedFile->storeAs('public/newsAndUpdates/listImages', $img1);
           // }
        }
        if ($request->hasFile('back_img')) {
            $request->validate([
                'backimg' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            // if ($request->fails()) {
            //     Session::flash('back_img', 'Background Image failed, size should be less than equal to 2MB');
            // }
            // else {
            $uploadedFile = $request->file('back_img');
            $originalFilename = $uploadedFile->getClientOriginalName();
            $img2 = Str::random(20) . '_' . $originalFilename;
            $uploadedFile->storeAs('public/newsAndUpdates/backImages', $img2);
          //  }
        }
        $newRecord = new newsAndUpdate([
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
        return redirect()->route('newsAndupdateshome')->with('success', 'New Record Added successfully.');
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
    public function show(newsAndUpdate $newsAndUpdate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(newsAndUpdate $newsAndUpdate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, newsAndUpdate $newsAndUpdate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(newsAndUpdate $newsAndUpdate)
    {
        //
    }
}
