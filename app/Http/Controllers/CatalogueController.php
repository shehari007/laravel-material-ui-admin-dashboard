<?php

namespace App\Http\Controllers;

use App\Models\catalogue;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CatalogueController extends Controller
{
    public function getCatalogues()
    {
        $catalogues = catalogue::all();
        return view("/dashboard/pages/catalogue", compact('catalogues'));
    }

    public function insertNewCatalogue(Request $request)
    {

        $doc = '';

        if ($request->hasFile('doc')) {
            $request->validate([
                'doc' => 'file|mimes:pdf,doc,docx|max:5120',
            ]);

            $uploadedFile = $request->file('doc');
            $originalFileExt = $uploadedFile->getClientOriginalExtension();
            $doc = time() . Str::random(5) . '.' . $originalFileExt;
            $uploadedFile->storeAs('public/E-Catalogues/Files', $doc);
        }

        $newRecord = new catalogue([
            'heading' => $request->input('heading'),
            'order' => $request->input('order'),
            'src' => $doc,
        ]);
        $newRecord->save();
        return redirect()->route('catalogueshome')->with('success', 'New Catalogue Added successfully!');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function deleteCatalogue($id)
    {
        $table = catalogue::find($id);

        if (!$table) {
            return redirect()->route('catalogueshome')->with('error', 'Cataogue not found delete failed.');
        }
        if ($table->src !== '') {
            Storage::delete('public/E-Catalogues/Files/' . $table->src);
        }

        $table->delete();
        return redirect()->route('catalogueshome')->with('success', 'Catalogue deleted successfully!');
    }


    public function editCatalogue(Request $request, $id)
    {

        $table = catalogue::where('id', $id)->first();
        $doc = $table->src;

        if ($request->hasFile('doc')) {
            $request->validate([
                'doc' => 'file|mimes:pdf,doc,docx|max:5120',
            ]);

            $uploadedFile = $request->file('doc');
            $originalFileExt = $uploadedFile->getClientOriginalExtension();
            $doc = time() . Str::random(5) . '.' . $originalFileExt;
            $uploadedFile->storeAs('public/E-Catalogues/Files', $doc);
        }

        $table->update([
            'heading' => $request->input('heading'),
            'order' => $request->input('order'),
            'vlink' => $doc,

        ]);
        return redirect()->route('catalogueshome')->with('success', 'Catalogue Record Edited Successfully!');
    }



    public function deleteSelectedCatalogues(Request $request, $typeCatalogue)
    {
        if ($typeCatalogue === 'deleteCheckedCatalogues') {

            $tables = catalogue::whereIn('id', $request->ids)->get();

            foreach ($tables as $table) {

                if ($table->src !== '') {
                    Storage::delete('public/E-Catalogues/Files/' . $table->src);
                }
                $table->delete();
            }

            Session::flash('success', 'Selected Catalogues deleted successfully!');
            return true;
        }
    }
}
