<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use App\Models\Activity;


class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {
        $leads = Lead::where(
            'tenant_id',
            auth()->user()->tenant_id
        )->latest()->get();

        return view(
            'leads.index',
            compact('leads')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('leads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $lead = Lead::create([
            'tenant_id' => auth()->user()->tenant_id,

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'source' => $request->source,

            'status' => 'New',
            'value' => $request->value,
            'user_id' => auth()->id()
        ]);
        Activity::create([
            'tenant_id'  => auth()->user()->tenant_id,
            'lead_id'    => $lead->id,
            'user_id'    => auth()->id(),
            'action'     => 'Lead Created',
            'description'=> 'New lead created: '.$lead->name,
        ]);

        return redirect()
            ->route('leads.index')
            ->with('success', 'Lead Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lead $lead)
    {
        abort_if(
            $lead->tenant_id != auth()->user()->tenant_id,
            403
        );
        $lead->load([
            'tasks',
            'leadNotes.user',
            'followUps.user',
            'activities.user'
        ]);

        return view('leads.show', compact('lead'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lead $lead)
    {
        abort_if(
            $lead->tenant_id != auth()->user()->tenant_id,
            403
        );

        return view('leads.edit', compact('lead'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lead $lead)
    {
        abort_if(
            $lead->tenant_id != auth()->user()->tenant_id,
            403
        );
        $request->validate([
            'status' => 'required|in:New,Contacted,Qualified,Proposal,Negotiation,Won,Lost',
        ]);

        $lead->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'source' => $request->source,
            'status' => $request->status,
            'value' => $request->value,

        ]);
        Activity::create([
            'tenant_id'  => auth()->user()->tenant_id,
            'lead_id'    => $lead->id,
            'user_id'    => auth()->id(),
            'action'     => 'Lead Updated',
            'description'=> 'Lead information updated.',
        ]);

        return redirect()->route('leads.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lead $lead)
    {
        abort_if(
            $lead->tenant_id != auth()->user()->tenant_id,
            403
        );
        Activity::create([
            'tenant_id'  => auth()->user()->tenant_id,
            'lead_id'    => $lead->id,
            'user_id'    => auth()->id(),
            'action'     => 'Lead Deleted',
            'description'=> 'Lead deleted.',
        ]);

        $lead->delete();

        return redirect()
            ->route('leads.index')
            ->with('success', 'Lead Deleted');
    }
    public function updateStatus(Request $request, Lead $lead)
    {
        $oldStatus = $lead->status;

        $lead->update([
            'status' => $request->status
        ]);

        Activity::create([

            'tenant_id' => auth()->user()->tenant_id,

            'lead_id' => $lead->id,

            'user_id' => auth()->id(),

            'action' => 'lead_status_changed',

            'description' =>
                "Lead moved from {$oldStatus} to {$request->status}"

        ]);

        return response()->json([
            'success' => true
        ]);
    }
}
