<?php

namespace App\Http\Controllers;

use App\Models\photogallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PhotogalleryController extends Controller
{

    public function getGallery()
    {
        $photos = photogallery::orderBy('created_at', 'desc')->get();
        return view("/dashboard/pages/photoGallery", compact('photos'));
    }



    public function fileUpload(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $imageName = time() . Str::random(5) . '.' . $image->extension();
            $image->storeAs('public/PhotoGallery/Gallery', $imageName);
            $newRecord = new photogallery([
                'src' => $imageName,
            ]);
            $newRecord->save();
            return response()->json(['success' => $imageName]);
        }

        return response()->json(['error' => 'File not found in the request.'], 400);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function deletePhoto($id)
    {

        $table = photogallery::find($id);

        if (!$table) {
            return redirect()->route('photoGalleryhome')->with('error', 'Photo not found delete failed.');
        }
        if ($table->src !== '') {
            Storage::delete('public/PhotoGallery/Gallery/' . $table->src);
        }

        $table->delete();
        return redirect()->route('photoGalleryhome')->with('success', 'Photo deleted successfully!.');
    }


    public function deleteGallery()
    {
        $tables = photogallery::all();

        foreach ($tables as $table) {

            if ($table->src !== '') {
                Storage::delete('public/PhotoGallery/Gallery/' . $table->src);
            }
            $table->delete();
        }

        return redirect()->route('photoGalleryhome')->with('success', 'Gallery deleted successfully!.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(photogallery $photogallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, photogallery $photogallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(photogallery $photogallery)
    {
        //
    }
}
