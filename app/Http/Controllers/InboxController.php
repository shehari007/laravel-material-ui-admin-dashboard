<?php

namespace App\Http\Controllers;

use App\Models\inbox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InboxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getInbox()
    {
        $inboxData = inbox::all();
        return view("/dashboard/pages/inbox", compact('inboxData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    public function deleteInbox($id)
    {
        $inbox = inbox::find($id);

        if (!$inbox) {
            return redirect()->route('inboxhome')->with('error', 'Inbox message not found.');
        }

        $inbox->delete();
        return redirect()->route('inboxhome')->with('success', 'Inbox message deleted successfully.');
    }



    public function selectedAction(Request $req, $type)
    {
        if ($type=="deleteSelected")
        {
            inbox::whereIn('id', $req->ids)->delete();
            Session::flash('deleteSelected', 'Selected items deleted successfully');
            return true;
        }
        else if ($type=="readSelected")
        {
            inbox::whereIn('id', $req->ids)->update(["status" => "1"]);
            Session::flash('readSelected', 'Selected items Marked as Read successfully');
            return true;
        }
        else if ($type=="unreadSelected")
        {
            inbox::whereIn('id', $req->ids)->update(["status" => "0"]);
            Session::flash('unreadSelected', 'Selected items Marked as Unread successfully');
            return true;
        }

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
    public function show(inbox $inbox)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(inbox $inbox)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, inbox $inbox)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(inbox $inbox)
    {
        //
    }
}
