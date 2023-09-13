<?php

namespace App\Http\Controllers;

use App\Models\menuSettings;
use Illuminate\Http\Request;

class MenuSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getMenus()
    {
        $menus = menuSettings::all();
        return view("/dashboard/pages/menuSettings", compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(menuSettings $menuSettings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(menuSettings $menuSettings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, menuSettings $menuSettings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(menuSettings $menuSettings)
    {
        //
    }
}
