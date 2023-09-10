<?php

namespace App\Http\Controllers;

use App\Models\document;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function getDocuments()
    {
        $documents = document::all();
        return view("/dashboard/pages/documents", compact('documents'));
    }

    public function insertNewDocument(Request $request)
    {

        $doc = '';

        if ($request->hasFile('doc')) {
            $request->validate([
                'doc' => 'file|mimes:pdf,doc,docx|max:5120',
            ]);

            $uploadedFile = $request->file('doc');
            $originalFileExt = $uploadedFile->getClientOriginalExtension();
            $doc = time() . Str::random(5) . '.' . $originalFileExt;
            $uploadedFile->storeAs('public/Documents/Files', $doc);
        }

        $newRecord = new document([
            'heading' => $request->input('heading'),
            'order' => $request->input('order'),
            'src' => $doc,
        ]);
        $newRecord->save();
        return redirect()->route('documentshome')->with('success', 'New Documents Added successfully!');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function deleteDocument($id)
    {
        $table = document::find($id);

        if (!$table) {
            return redirect()->route('documentshome')->with('error', 'Document not found delete failed.');
        }
        if ($table->src !== '') {
            Storage::delete('public/Documents/Files/' . $table->src);
        }

        $table->delete();
        return redirect()->route('documentshome')->with('success', 'Document deleted successfully!');
    }


    public function editDocument(Request $request, $id)
    {

        $table = document::where('id', $id)->first();
        $doc = $table->src;

        if ($request->hasFile('doc')) {
            $request->validate([
                'doc' => 'file|mimes:pdf,doc,docx|max:5120',
            ]);

            $uploadedFile = $request->file('doc');
            $originalFileExt = $uploadedFile->getClientOriginalExtension();
            $doc = time() . Str::random(5) . '.' . $originalFileExt;
            $uploadedFile->storeAs('public/Documents/Files', $doc);
        }

        $table->update([
            'heading' => $request->input('heading'),
            'order' => $request->input('order'),
            'vlink' => $doc,

        ]);
        return redirect()->route('documentshome')->with('success', 'Document Record Edited Successfully!');
    }



    public function deleteSelectedDocuments(Request $request, $typeDocument)
    {
        if ($typeDocument === 'deleteCheckedDocuments') {

            $tables = document::whereIn('id', $request->ids)->get();

            foreach ($tables as $table) {

                if ($table->src !== '') {
                    Storage::delete('public/Documents/Files/' . $table->src);
                }
                $table->delete();
            }

            Session::flash('success', 'Selected Documents deleted successfully!');
            return true;
        }
    }
}
