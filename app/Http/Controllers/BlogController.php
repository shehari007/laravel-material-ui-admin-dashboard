<?php

namespace App\Http\Controllers;

use App\Models\blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
  
    public function getBlogs()
    {
        $blogs = blog::all();
        return view("/dashboard/pages/blog", compact('blogs'));
    }

  
    public function insertNewBlog(Request $request)
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
            $uploadedFile->storeAs('public/blog/listImages', $img1);
        }
        if ($request->hasFile('back_img')) {
            $request->validate([
                'backimg' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $uploadedFile = $request->file('back_img');
            $originalFilename = $uploadedFile->getClientOriginalName();
            $img2 = Str::random(20) . '_' . $originalFilename;
            $uploadedFile->storeAs('public/blog/backImages', $img2);
        }
        $newRecord = new blog([
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
        return redirect()->route('bloghome')->with('success', 'New Blog Added successfully.');
    }

  
    public function deleteSelectedBlogs(Request $request, $typeBlog)
    {
        if ($typeBlog === 'deleteCheckedBlogs') {

            $tables = blog::whereIn('id', $request->ids)->get();

            foreach ($tables as $table) {
                if ($table->list_img !== '') {
                    Storage::delete('public/blog/listImages/' . $table->list_img);
                }
                if ($table->list_background !== '') {
                    Storage::delete('public/blog/backImages/' . $table->list_background);
                }

                $table->delete();
            }

            Session::flash('success', 'Selected Blogs deleted successfully');
            return true;
        }
    }


    public function editBlogs(Request $request, $id)
    {
        $url = $request->input('heading');
        $modifiedUrl = str_replace(' ', '-', $url) . '.html';

        $table = blog::where('id', $id)->first();
        $img1 = $table->list_img;
        $img2 = $table->list_background;

        if ($request->hasFile('list_img')) {
            $request->validate([
                'list_img' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            if ($table->list_img !== '') {
                Storage::delete('public/blog/listImages/' . $table->list_img);
            }
            $uploadedFile = $request->file('list_img');
            $originalFilename = $uploadedFile->getClientOriginalName();
            $img1 = Str::random(20) . '_' . $originalFilename;
            $uploadedFile->storeAs('public/blog/listImages', $img1);
        }
        if ($request->hasFile('back_img')) {
            $request->validate([
                'backimg' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            if ($table->list_background) {
                Storage::delete('public/blog/backImages/' . $table->list_background);
            }
            $uploadedFile = $request->file('back_img');
            $originalFilename = $uploadedFile->getClientOriginalName();
            $img2 = Str::random(20) . '_' . $originalFilename;
            $uploadedFile->storeAs('public/blog/backImages', $img2);
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
        return redirect()->route('bloghome')->with('success', 'Blog Record Edited Successfully.');
    }

 
    public function deleteBlog($id)
    {
        
        $table = blog::find($id);

        if (!$table) {
            return redirect()->route('bloghome')->with('error', 'Blog not found delete failed.');
        }
        if ($table->list_img !== '') {
            Storage::delete('public/blog/listImages/' . $table->list_img);
        }
        if ($table->list_background !== '') {
            Storage::delete('public/blog/backImages/' . $table->list_background);
        }

        $table->delete();
        return redirect()->route('bloghome')->with('success', 'Blog deleted successfully.');
    }

   
    public function destroy(blog $blog)
    {
        //
    }
}
