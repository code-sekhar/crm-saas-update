<?php

namespace App\Http\Controllers;

use App\Models\LeadNote;
use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\Activity;

class LeadNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            $request->validate([
                'lead_id' => 'required|exists:leads,id',
                'note'    => 'required|string'
            ]);

            $lead = Lead::findOrFail($request->lead_id);

            abort_if(
                $lead->tenant_id != auth()->user()->tenant_id,
                403
            );

            LeadNote::create([
                'tenant_id' => auth()->user()->tenant_id,
                'lead_id'   => $lead->id,
                'user_id'   => auth()->id(),
                'note'      => $request->note
            ]);
            Activity::create([
                'tenant_id'  => auth()->user()->tenant_id,
                'lead_id'    => $lead->id,
                'user_id'    => auth()->id(),
                'action'     => 'Note Added',
                'description'=> 'Added a note.',
            ]);

            return redirect()
                ->back()
                ->with('success', 'Note Added Successfully');
        }

    /**
     * Display the specified resource.
     */
    public function show(LeadNote $leadNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeadNote $leadNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LeadNote $leadNote)
    {
        abort_if(
            $leadNote->tenant_id != auth()->user()->tenant_id,
            403
        );

        $request->validate([
            'note' => 'required|string'
        ]);

        $leadNote->update([
            'note' => $request->note
        ]);
        Activity::create([
            'tenant_id'  => auth()->user()->tenant_id,
            'lead_id'    => $leadNote->lead_id,
            'user_id'    => auth()->id(),
            'action'     => 'Note Updated',
            'description'=> 'Updated a note.',
        ]);

        return redirect()
            ->back()
            ->with('success','Note Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeadNote $leadNote)
    {
        abort_if(
            $leadNote->tenant_id != auth()->user()->tenant_id,
            403
        );

        Activity::create([
            'tenant_id'  => auth()->user()->tenant_id,
            'lead_id'    => $leadNote->lead_id,
            'user_id'    => auth()->id(),
            'action'     => 'Note Deleted',
            'description'=> 'Deleted a note.',
        ]);

        $leadNote->delete();

        return back()->with(
            'success',
            'Note Deleted Successfully'
        );
    }
}
