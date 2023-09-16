<?php

namespace App\Http\Controllers;

use App\Models\menuSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class MenuSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getMenus()
    {
        $topMenus = menuSettings::select('menu_heading', 'id', 'order', 'page_url', 'out_page_url')
            ->where('menu_type', 'top')
            ->orderBy('order', 'asc') // Sort by 'order' column in ascending order
            ->get();

        $menus = menuSettings::select('menu_heading', 'top_id', 'order', 'page_url', 'out_page_url')
            ->where('menu_type', 'sub')
            ->orderBy('order', 'asc') // Sort by 'order' column in ascending order
            ->get();
            $webPages = DB::table('webpages')->get();
        return view("/dashboard/pages/menuSettings", compact('topMenus', 'menus', 'webPages'));
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
