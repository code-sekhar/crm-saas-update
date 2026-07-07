<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuditLog;
use App\Services\AuditLogService;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;

        $query = AuditLog::with('user')
            ->where('tenant_id', $tenantId);

        // Search User
        if ($request->filled('search')) {

            $query->whereHas('user', function ($q) use ($request) {

                $q->where(
                    'name',
                    'like',
                    '%' . $request->search . '%'
                );

            });

        }

        // Module Filter
        if ($request->filled('module')) {

            $query->where(
                'module',
                $request->module
            );

        }

        // Action Filter
        if ($request->filled('action')) {

            $query->where(
                'action',
                $request->action
            );

        }

        // From Date
        if ($request->filled('from')) {

            $query->whereDate(
                'created_at',
                '>=',
                $request->from
            );

        }

        // To Date
        if ($request->filled('to')) {

            $query->whereDate(
                'created_at',
                '<=',
                $request->to
            );

        }

        $logs = $query
            ->latest()
            ->paginate(20)
            ->withQueryString();
        $tenantId = auth()->user()->tenant_id;

        $totalLogs = AuditLog::where('tenant_id', $tenantId)->count();

        $todayLogs = AuditLog::where('tenant_id', $tenantId)
            ->whereDate('created_at', today())
            ->count();

        $leadLogs = AuditLog::where('tenant_id', $tenantId)
            ->where('module', 'Lead')
            ->count();

        $userLogs = AuditLog::where('tenant_id', $tenantId)
            ->where('module', 'User')
            ->count();

        return view(
            'audit-logs.index',
            compact('logs', 'totalLogs', 'todayLogs', 'leadLogs', 'userLogs')
        );
    }
    public function show(AuditLog $auditLog)
    {
        abort_unless(
            $auditLog->tenant_id == auth()->user()->tenant_id,
            403
        );

        return response()->json([
            'old_values' => $auditLog->old_values,
            'new_values' => $auditLog->new_values,
        ]);
    }
}
