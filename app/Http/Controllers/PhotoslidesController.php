<?php

namespace App\Http\Controllers;

use App\Models\photoslides;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
class PhotoslidesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getPhotoSliders()
    {
        $slides = photoslides::all();
        return view("/dashboard/pages/photoSlider", compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function insertNewSlider(Request $request)
    {
    
        $img2 = '';

        if ($request->hasFile('back_img')) {
            $request->validate([
                'backimg' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $uploadedFile = $request->file('back_img');
            $originalFilename = $uploadedFile->getClientOriginalName();
            $img2 = Str::random(20) . '_' . $originalFilename;
            $uploadedFile->storeAs('public/photoSlider/backImages', $img2);
        }
        $newRecord = new photoslides([
            'heading' => $request->input('heading'),
            'order' => $request->input('order'),
            'list_background' => $img2,
            
        ]);
        $newRecord->save();
        return redirect()->route('photoSliderhome')->with('success', 'New Slider Added successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function deleteSlide($id)
    {
        $table = photoslides::find($id);

        if (!$table) {
            return redirect()->route('photoSliderhome')->with('error', 'Slide not found delete failed.');
        }
        
        if ($table->list_background !== '') {
            Storage::delete('public/photoSlider/backImages/' . $table->list_background);
        }

        $table->delete();
        return redirect()->route('photoSliderhome')->with('success', 'Slide deleted successfully.');
    }

    public function editSlide(Request $request, $id)
    {
        
        $table = photoslides::where('id', $id)->first();
        $img2 = $table->list_background;

        if ($request->hasFile('back_img')) {
            $request->validate([
                'backimg' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            if ($table->list_background) {
                Storage::delete('public/photoSlider/backImages/' . $table->list_background);
            }
            $uploadedFile = $request->file('back_img');
            $originalFilename = $uploadedFile->getClientOriginalName();
            $img2 = Str::random(20) . '_' . $originalFilename;
            $uploadedFile->storeAs('public/photoSlider/backImages', $img2);
        }
        $table->update([
            'heading' => $request->input('heading'),
            'order' => $request->input('order'),
            'list_background' => $img2,
           
        ]);
        return redirect()->route('photoSliderhome')->with('success', 'Slide Record Edited Successfully.');
    }

    

    public function deleteSelectedSlides(Request $request, $typeSlide)
    {
        if ($typeSlide === 'deleteCheckedSlides') {

            $tables = photoslides::whereIn('id', $request->ids)->get();

            foreach ($tables as $table) {
               
                if ($table->list_background !== '') {
                    Storage::delete('public/photoSlider/backImages/' . $table->list_background);
                }

                $table->delete();
            }

            Session::flash('success', 'Selected Slides deleted successfully');
            return true;
        }
    }


    public function update(Request $request, photoslides $photoslides)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(photoslides $photoslides)
    {
        //
    }
}
