<?php

namespace App\Services;

use App\Models\AuditLog;
use Jenssegers\Agent\Agent;

class AuditLogService
{
    public static function log(

        string $module,

        string $action,

        ?int $recordId,

        string $description,

        ?array $oldValues = null,

        ?array $newValues = null

    ): void {

        if (!auth()->check()) {

            return;

        }

        $agent = new Agent();

        AuditLog::create([

            'tenant_id' => auth()->user()->tenant_id,

            'user_id' => auth()->id(),

            'module' => $module,

            'action' => $action,

            'record_id' => $recordId,

            'description' => $description,

            'ip_address' => request()->ip(),

            'browser' => $agent->browser(),

            'platform' => $agent->platform(),

            'old_values' => $oldValues,

            'new_values' => $newValues,

        ]);
    }
}
