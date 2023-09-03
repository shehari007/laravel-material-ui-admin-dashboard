<?php

namespace App\Http\Controllers;

use App\Models\newsAndUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class NewsAndUpdateController extends Controller
{

    public function getNewsAndUpdates()
    {
        $news = newsAndUpdate::all();
        return view("/dashboard/pages/newsAndUpdates", compact('news'));
    }

    public function insertNew(Request $request)
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
            $uploadedFile->storeAs('public/newsAndUpdates/listImages', $img1);
        }
        if ($request->hasFile('back_img')) {
            $request->validate([
                'backimg' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $uploadedFile = $request->file('back_img');
            $originalFilename = $uploadedFile->getClientOriginalName();
            $img2 = Str::random(20) . '_' . $originalFilename;
            $uploadedFile->storeAs('public/newsAndUpdates/backImages', $img2);
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

    public function editNews(Request $request, $id)
    {

        $url = $request->input('heading');
        $modifiedUrl = str_replace(' ', '-', $url) . '.html';

        $table = newsAndUpdate::where('id', $id)->first();
        $img1 = $table->list_img;
        $img2 = $table->list_background;

        if ($request->hasFile('list_img')) {
            $request->validate([
                'list_img' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            if ($table->list_img !== '') {
                Storage::delete('public/newsAndUpdates/listImages/' . $table->list_img);
            }
            $uploadedFile = $request->file('list_img');
            $originalFilename = $uploadedFile->getClientOriginalName();
            $img1 = Str::random(20) . '_' . $originalFilename;
            $uploadedFile->storeAs('public/newsAndUpdates/listImages', $img1);
        }
        if ($request->hasFile('back_img')) {
            $request->validate([
                'backimg' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            if ($table->list_background) {
                Storage::delete('public/newsAndUpdates/backImages/' . $table->list_background);
            }
            $uploadedFile = $request->file('back_img');
            $originalFilename = $uploadedFile->getClientOriginalName();
            $img2 = Str::random(20) . '_' . $originalFilename;
            $uploadedFile->storeAs('public/newsAndUpdates/backImages', $img2);
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
        return redirect()->route('newsAndupdateshome')->with('success', 'News record edited successfully.');
    }

    public function deleteNews($id)
    {
        $table = newsAndUpdate::find($id);

        if (!$table) {
            return redirect()->route('newsAndupdateshome')->with('error', 'News not found delete failed.');
        }
        if ($table->list_img !== '') {
            Storage::delete('public/newsAndUpdates/listImages/' . $table->list_img);
        }
        if ($table->list_background !== '') {
            Storage::delete('public/newsAndUpdates/backImages/' . $table->list_background);
        }

        $table->delete();
        return redirect()->route('newsAndupdateshome')->with('success', 'News deleted successfully.');
    }

    public function deleteSelectedNews(Request $request, $type)
    {
        if ($type === 'deleteCheckedNews') {

            $tables = newsAndUpdate::whereIn('id', $request->ids)->get();

            foreach ($tables as $table) {
                if ($table->list_img !== '') {
                    Storage::delete('public/newsAndUpdates/listImages/' . $table->list_img);
                }
                if ($table->list_background !== '') {
                    Storage::delete('public/newsAndUpdates/backImages/' . $table->list_background);
                }

                $table->delete();
            }

            Session::flash('success', 'Selected items deleted successfully');
            return true;
        }
    }

}
