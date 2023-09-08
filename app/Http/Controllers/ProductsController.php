<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getProducts()
    {
        $products = DB::table('products')->get();
        $categories = DB::table('categories')
        ->orderBy('order', 'asc')
        ->get();
        $products = products::all();
        return view("/dashboard/pages/products", compact('products', 'categories'));
    }


    public function insertNewProduct(Request $request)
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
            $uploadedFile->storeAs('public/products/listImages', $img1);
        }
        if ($request->hasFile('back_img')) {
            $request->validate([
                'backimg' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $uploadedFile = $request->file('back_img');
            $originalFilename = $uploadedFile->getClientOriginalName();
            $img2 = Str::random(20) . '_' . $originalFilename;
            $uploadedFile->storeAs('public/products/backImages', $img2);
        }
        $newRecord = new products([
            'heading' => $request->input('heading'),
            'feat_prod' => $request->input('featProd'),
            'category' => $request->input('category'),
            'url' => $modifiedUrl,
            'list_img' => $img1,
            'list_background' => $img2,
            'description' => $request->input('description'),
            'seo_title' => $request->input('seo_title'),
            'seo_keywords' => $request->input('seo_keywords'),
            'seo_description' => $request->input('seo_desc'),
        ]);
        $newRecord->save();
        return redirect()->route('productshome')->with('success', 'New Product Added successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function deleteProduct($id)
    {
        $table = products::find($id);

        if (!$table) {
            return redirect()->route('productshome')->with('error', 'Product not found, delete failed.');
        }
        if ($table->list_img !== '') {
            Storage::delete('public/products/listImages/' . $table->list_img);
        }
        if ($table->list_background !== '') {
            Storage::delete('public/products/backImages/' . $table->list_background);
        }

        $table->delete();
        return redirect()->route('productshome')->with('success', 'Product deleted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function deleteSelectedProducts(Request $request, $typeProduct)
    {
        if ($typeProduct === 'deleteCheckedProducts') {

            $tables = products::whereIn('id', $request->ids)->get();

            foreach ($tables as $table) {
                if ($table->list_img !== '') {
                    Storage::delete('public/products/listImages/' . $table->list_img);
                }
                if ($table->list_background !== '') {
                    Storage::delete('public/products/backImages/' . $table->list_background);
                }

                $table->delete();
            }

            Session::flash('success', 'Selected Products deleted successfully');
            return true;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editProduct(Request $request, $id)
    {
        $url = $request->input('heading');
        $modifiedUrl = str_replace(' ', '-', $url) . '.html';

        $table = products::where('id', $id)->first();
        $img1 = $table->list_img;
        $img2 = $table->list_background;

        if ($request->hasFile('list_img')) {
            $request->validate([
                'list_img' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            if ($table->list_img !== '') {
                Storage::delete('public/products/listImages/' . $table->list_img);
            }
            $uploadedFile = $request->file('list_img');
            $originalFilename = $uploadedFile->getClientOriginalName();
            $img1 = Str::random(20) . '_' . $originalFilename;
            $uploadedFile->storeAs('public/products/listImages', $img1);
        }
        if ($request->hasFile('back_img')) {
            $request->validate([
                'backimg' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            if ($table->list_background) {
                Storage::delete('public/products/backImages/' . $table->list_background);
            }
            $uploadedFile = $request->file('back_img');
            $originalFilename = $uploadedFile->getClientOriginalName();
            $img2 = Str::random(20) . '_' . $originalFilename;
            $uploadedFile->storeAs('public/products/backImages', $img2);
        }
        $table->update([
            'heading' => $request->input('heading'),
            'feat_prod' => $request->input('featProd'),
            'category' => $request->input('category'),
            'url' => $modifiedUrl,
            'list_img' => $img1,
            'list_background' => $img2,
            'description' => $request->input('description'),
            'seo_title' => $request->input('seo_title'),
            'seo_keywords' => $request->input('seo_keywords'),
            'seo_description' => $request->input('seo_desc'),
        ]);
        return redirect()->route('productshome')->with('success', 'Product Record Edited Successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(products $products)
    {
        //
    }
}
