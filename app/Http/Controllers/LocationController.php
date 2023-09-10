<?php

namespace App\Http\Controllers;

use App\Models\location;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class LocationController extends Controller
{
    public function getLocations()
    {
        $locations = location::all();
        return view("/dashboard/pages/locations", compact('locations'));
    }


    public function insertNewLocation(Request $request)
    {

        $newRecord = new location([
            'location' => $request->input('location'),
            'order' => $request->input('order'),
            'address' => $request->input('address'),
            'telephone' => $request->input('telephone'),
            'gsm' => $request->input('gsm'),
            'email' => $request->input('email'),
            'google_map_link' => $request->input('google_map_link'),

        ]);
        $newRecord->save();
        return redirect()->route('locationshome')->with('success', 'New Location Added successfully.');
    }

    public function editLocation(Request $request, $id)
    {
       

        $table = location::where('id', $id)->first();
        $table->update([
            'location' => $request->input('location'),
            'order' => $request->input('order'),
            'address' => $request->input('address'),
            'telephone' => $request->input('telephone'),
            'gsm' => $request->input('gsm'),
            'email' => $request->input('email'),
            'google_map_link' => $request->input('google_map_link'),
        ]);
        return redirect()->route('locationshome')->with('success', 'Location Record Edited Successfully.');
    }


    public function deleteLocation($id)
    {
        $table = location::find($id);

        if (!$table) {
            return redirect()->route('locationshome')->with('error', 'Location not found delete failed.');
        }
       
        $table->delete();
        return redirect()->route('locationshome')->with('success', 'Location deleted successfully.');
    }

    public function deleteSelectedLocations(Request $request, $typeLocation)
    {
        if ($typeLocation === 'deleteCheckedLocations') {

            $tables = location::whereIn('id', $request->ids)->get();

            foreach ($tables as $table) {
               
                $table->delete();
            }

            Session::flash('success', 'Selected Locations deleted successfully');
            return true;
        }
    }
}
