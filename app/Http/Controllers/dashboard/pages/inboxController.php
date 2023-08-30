<?php

namespace App\Http\Controllers\dashboard\pages;

use App\Http\Controllers\Controller;
use App\Models\dashboard\pages\inbox;
use Illuminate\Http\Request;

class inboxController extends Controller
{
    public static function index()
    {
        $inbox = inbox::all();
        return view('/dashboard/pages/inbox/inbox', compact('inbox'));
    }

    public function create()
    {
        return view('inbox.create');
    }

    public function store(Request $request)
    {
        inbox::create($request->all());
        return redirect()->route('inbox');
    }

    public function edit(inbox $product)
    {
        return view('inbox.edit', compact('inbox'));
    }

    public function update(Request $request, inbox $inbox)
    {
        $inbox->update($request->all());
        return redirect()->route('inbox');
    }

    public function destroy(inbox $inbox)
    {
        $inbox->delete();
        return redirect()->route('inbox');
    }
}
