<?php

namespace App\Http\Controllers;

use App\Models\categories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getCategories()
    {
        $categories = categories::all();
        return view("/dashboard/pages/category", compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function insertNewCategory(Request $request)
    {
        $img1 = '';
        $img2 = '';
        $url = $request->input('heading');
        $modifiedUrl = 'category/'.str_replace(' ', '-', $url) . '.html';


        if ($request->hasFile('list_img')) {
            $request->validate([
                'list_img' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $uploadedFile = $request->file('list_img');
            $originalFilename = $uploadedFile->getClientOriginalName();
            $img1 = Str::random(20) . '_' . $originalFilename;
            $uploadedFile->storeAs('public/category/listImages', $img1);
        }
        if ($request->hasFile('back_img')) {
            $request->validate([
                'backimg' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $uploadedFile = $request->file('back_img');
            $originalFilename = $uploadedFile->getClientOriginalName();
            $img2 = Str::random(20) . '_' . $originalFilename;
            $uploadedFile->storeAs('public/category/backImages', $img2);
        }
        $newRecord = new categories([
            'heading' => $request->input('heading'),
            'order' => $request->input('orderno'),
            'url' => $modifiedUrl,
            'list_img' => $img1,
            'list_background' => $img2,
            'description' => $request->input('description'),
            'seo_title' => $request->input('seo_title'),
            'seo_keywords' => $request->input('seo_keywords'),
            'seo_description' => $request->input('seo_desc'),
        ]);
        $newRecord->save();
        return redirect()->route('categoryhome')->with('success', 'New Category Added successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function editCategory(Request $request, $id)
    {
        $url = $request->input('heading');
        $modifiedUrl = 'category/'. str_replace(' ', '-', $url) . '.html';

        $table = categories::where('id', $id)->first();
        $img1 = $table->list_img;
        $img2 = $table->list_background;

        if ($request->hasFile('list_img')) {
            $request->validate([
                'list_img' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            if ($table->list_img !== '') {
                Storage::delete('public/category/listImages/' . $table->list_img);
            }
            $uploadedFile = $request->file('list_img');
            $originalFilename = $uploadedFile->getClientOriginalName();
            $img1 = Str::random(20) . '_' . $originalFilename;
            $uploadedFile->storeAs('public/category/listImages', $img1);
        }
        if ($request->hasFile('back_img')) {
            $request->validate([
                'backimg' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            if ($table->list_background) {
                Storage::delete('public/category/backImages/' . $table->list_background);
            }
            $uploadedFile = $request->file('back_img');
            $originalFilename = $uploadedFile->getClientOriginalName();
            $img2 = Str::random(20) . '_' . $originalFilename;
            $uploadedFile->storeAs('public/category/backImages', $img2);
        }
        $table->update([
            'heading' => $request->input('heading'),
            'order' => $request->input('orderno'),
            'url' => $modifiedUrl,
            'list_img' => $img1,
            'list_background' => $img2,
            'description' => $request->input('description'),
            'seo_title' => $request->input('seo_title'),
            'seo_keywords' => $request->input('seo_keywords'),
            'seo_description' => $request->input('seo_desc'),
        ]);
        return redirect()->route('categoryhome')->with('success', 'Category Record Edited Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function deleteCategory($id)
    {
         
        $table = categories::find($id);

        if (!$table) {
            return redirect()->route('categoryhome')->with('error', 'Category not found delete failed.');
        }
        if ($table->list_img !== '') {
            Storage::delete('public/category/listImages/' . $table->list_img);
        }
        if ($table->list_background !== '') {
            Storage::delete('public/category/backImages/' . $table->list_background);
        }

        $table->delete();
        return redirect()->route('categoryhome')->with('success', 'Category deleted successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function deleteSelectedCategories(Request $request, $typeCategory)
    {
        if ($typeCategory === 'deleteCheckedCategories') {

            $tables = categories::whereIn('id', $request->ids)->get();

            foreach ($tables as $table) {
                if ($table->list_img !== '') {
                    Storage::delete('public/category/listImages/' . $table->list_img);
                }
                if ($table->list_background !== '') {
                    Storage::delete('public/category/backImages/' . $table->list_background);
                }

                $table->delete();
            }

            Session::flash('success', 'Selected Categories deleted successfully');
            return true;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, categories $categories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(categories $categories)
    {
        //
    }
}
