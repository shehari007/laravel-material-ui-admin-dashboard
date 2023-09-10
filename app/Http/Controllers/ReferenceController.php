<?php

namespace App\Http\Controllers;

use App\Models\reference;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ReferenceController extends Controller
{
    public function getReferences()
    {
        $references = reference::orderBy('created_at', 'desc')->get();
        return view("/dashboard/pages/references", compact('references'));
    }



    public function fileUploadRef(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:min_width=150,min_height=150,max_width=150,max_height=150',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $imageName = time() . Str::random(5) . '.' . $image->extension();
            $image->storeAs('public/References/Gallery', $imageName);
            $newRecord = new reference([
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
    public function deletePhotoRef($id)
    {

        $table = reference::find($id);

        if (!$table) {
            return redirect()->route('referenceshome')->with('error', 'Photo not found delete failed.');
        }
        if ($table->src !== '') {
            Storage::delete('public/References/Gallery/' . $table->src);
        }

        $table->delete();
        return redirect()->route('referenceshome')->with('success', 'Photo deleted successfully!.');
    }


    public function deleteGalleryRef()
    {
        $tables = reference::all();

        foreach ($tables as $table) {

            if ($table->src !== '') {
                Storage::delete('public/References/Gallery/' . $table->src);
            }
            $table->delete();
        }

        return redirect()->route('referenceshome')->with('success', 'References Gallery deleted successfully!.');
    }

    /**
     * Display the specified resource.
     */
    public function show(reference $reference)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(reference $reference)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, reference $reference)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(reference $reference)
    {
        //
    }
}
