<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;

class KanbanController extends Controller
{
    public function index()
    {
        // $leads = Lead::where(
        //     'tenant_id',
        //     auth()->user()->tenant_id
        // )->get();
        $leads = Lead::with(['followUps' => function ($query) {

            $query->latest('follow_up_date');

        }])
        ->where('tenant_id', auth()->user()->tenant_id)
        ->get();

        return view(
            'leads.kanban',
            compact('leads')
        );
    }
}
