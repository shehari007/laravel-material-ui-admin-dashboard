<?php

namespace App\Http\Controllers;

use App\Models\videogallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class VideogalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getVideoGallery()
    {
        $videos = videogallery::all();
        return view("/dashboard/pages/videoGallery", compact('videos'));
    }

    public function insertNewVideo(Request $request)
    {
        $publicUrl = $request->input('vlink');
        $videoId = $this->getVideoIdFromUrl($publicUrl);

        $embedUrl = "https://www.youtube.com/embed/{$videoId}";

        $newRecord = new videogallery([
            'heading' => $request->input('heading'),
            'order' => $request->input('order'),
            'vlink' => $embedUrl,

        ]);
        $newRecord->save();
        return redirect()->route('videoGalleryhome')->with('success', 'New Video Added successfully!');
    }

    
    private function getVideoIdFromUrl($url)
    {
        
        $query = parse_url($url, PHP_URL_QUERY);
        parse_str($query, $queryArray);

        if (isset($queryArray['v'])) {
            return $queryArray['v'];
        } else {
           
            abort(404, 'Invalid YouTube URL');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function deleteVideo($id)
    {
        $table = videogallery::find($id);

        if (!$table) {
            return redirect()->route('videoGallery')->with('error', 'Video not found delete failed.');
        }

        $table->delete();
        return redirect()->route('videoGalleryhome')->with('success', 'Video deleted successfully!');
    }


    public function editVideo(Request $request, $id)
    {
        $publicUrl = $request->input('vlink');
        $videoId = $this->getVideoIdFromUrl($publicUrl);

        $embedUrl = "https://www.youtube.com/embed/{$videoId}";   

        $table = videogallery::where('id', $id)->first();

        $table->update([
            'heading' => $request->input('heading'),
            'order' => $request->input('order'),
            'vlink' => $embedUrl,

        ]);
        return redirect()->route('videoGalleryhome')->with('success', 'Video Record Edited Successfully!');
    }



    public function deleteSelectedVideos(Request $request, $typeVideo)
    {
        if ($typeVideo === 'deleteCheckedVideos') {

            $tables = videogallery::whereIn('id', $request->ids)->get();

            foreach ($tables as $table) {

                $table->delete();
            }

            Session::flash('success', 'Selected Videos deleted successfully!');
            return true;
        }
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
    public function show(videogallery $videogallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(videogallery $videogallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, videogallery $videogallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(videogallery $videogallery)
    {
        //
    }
}
