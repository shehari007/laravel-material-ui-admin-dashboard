<?php

namespace App\Http\Controllers;

use App\Models\branch;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class BranchController extends Controller
{
    public function getBranches()
    {
        $branches = branch::all();
        return view("/dashboard/pages/branches", compact('branches'));
    }


    public function insertNewBranch(Request $request)
    {

        $newRecord = new branch([
            'location' => $request->input('location'),
            'order' => $request->input('order'),
            'address' => $request->input('address'),
            'telephone' => $request->input('telephone'),
            'gsm' => $request->input('gsm'),
            'email' => $request->input('email'),
            'google_map_link' => $request->input('google_map_link'),

        ]);
        $newRecord->save();
        return redirect()->route('brancheshome')->with('success', 'New Branch Added successfully.');
    }

    public function editBranch(Request $request, $id)
    {
       

        $table = branch::where('id', $id)->first();
        $table->update([
            'location' => $request->input('location'),
            'order' => $request->input('order'),
            'address' => $request->input('address'),
            'telephone' => $request->input('telephone'),
            'gsm' => $request->input('gsm'),
            'email' => $request->input('email'),
            'google_map_link' => $request->input('google_map_link'),
        ]);
        return redirect()->route('brancheshome')->with('success', 'Branch Record Edited Successfully.');
    }


    public function deleteBranch($id)
    {
        $table = branch::find($id);

        if (!$table) {
            return redirect()->route('brancheshome')->with('error', 'Branch not found delete failed.');
        }
       
        $table->delete();
        return redirect()->route('brancheshome')->with('success', 'Branch deleted successfully.');
    }

    public function deleteSelectedBranches(Request $request, $typeBranch)
    {
        if ($typeBranch === 'deleteCheckedBranches') {

            $tables = branch::whereIn('id', $request->ids)->get();

            foreach ($tables as $table) {
               
                $table->delete();
            }

            Session::flash('success', 'Selected Branches deleted successfully');
            return true;
        }
    }
}
