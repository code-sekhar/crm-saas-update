<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Lead;
use App\Models\Task;
use App\Models\FollowUp;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){
        $tenantId = auth()->user()->tenant_id;
        $todayLeads = Lead::where('tenant_id', $tenantId)->whereDate('created_at', today())->count();

        $totalLeads = Lead::where('tenant_id', $tenantId)->count();

        $newLeads = Lead::where('tenant_id', $tenantId)
            ->where('status', 'New')
            ->count();

        $wonLeads = Lead::where('tenant_id', $tenantId)
            ->where('status', 'Won')
            ->count();

        $lostLeads = Lead::where('tenant_id', $tenantId)
            ->where('status', 'Lost')
            ->count();

        $recentLeads = Lead::where('tenant_id', $tenantId)
            ->latest()
            ->take(5)
            ->get();
        $pendingTasks = Task::where(
                'tenant_id',
                auth()->user()->tenant_id
            )->where('status', 'Pending')
            ->count();

        // Follow-up Statistics
        $todayFollowUps = FollowUp::where('tenant_id', $tenantId)
            ->whereDate('follow_up_date', Carbon::today())
            ->where('status', 'Pending')
            ->count();

        $upcomingFollowUps = FollowUp::where('tenant_id', $tenantId)
            ->whereDate('follow_up_date', '>', Carbon::today())
            ->where('status', 'Pending')
            ->count();

        $overdueFollowUps = FollowUp::where('tenant_id', $tenantId)
            ->whereDate('follow_up_date', '<', Carbon::today())
            ->where('status', 'Pending')
            ->count();

        $completedFollowUps = FollowUp::where('tenant_id', $tenantId)
            ->where('status', 'Completed')
            ->count();
        $conversionRate = $totalLeads > 0
        ? round(($wonLeads / $totalLeads) * 100)
        : 0;
        $newLeads = Lead::where('tenant_id', $tenantId)
        ->where('status', 'New')
        ->count();

        $contactedLeads = Lead::where('tenant_id', $tenantId)
            ->where('status', 'Contacted')
            ->count();

        $qualifiedLeads = Lead::where('tenant_id', $tenantId)
            ->where('status', 'Qualified')
            ->count();

        $proposalLeads = Lead::where('tenant_id', $tenantId)
            ->where('status', 'Proposal')
            ->count();

        $negotiationLeads = Lead::where('tenant_id', $tenantId)
            ->where('status', 'Negotiation')
            ->count();
        $statusChart = [

            'New' => $newLeads,

            'Contacted' => $contactedLeads,

            'Qualified' => $qualifiedLeads,

            'Proposal' => $proposalLeads,

            'Negotiation' => $negotiationLeads,

            'Won' => $wonLeads,

            'Lost' => $lostLeads,

        ];
        $monthlyLeads = [];

        for ($i = 1; $i <= 12; $i++) {

            $monthlyLeads[] = Lead::where('tenant_id', $tenantId)
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', $i)
                ->count();

        }

        return view('dashboard', compact(
            'totalLeads',
            'newLeads',
            'wonLeads',
            'lostLeads',
            'recentLeads',
            'pendingTasks',
            'todayFollowUps',
            'upcomingFollowUps',
            'overdueFollowUps',
            'completedFollowUps',
            'todayLeads',
            'conversionRate',
            'newLeads',
            'contactedLeads',
            'qualifiedLeads',
            'proposalLeads',
            'negotiationLeads',
            'statusChart',
            'monthlyLeads'
        ));
    }
}
