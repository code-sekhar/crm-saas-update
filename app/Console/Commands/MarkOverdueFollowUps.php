<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Models\FollowUp;
use App\Models\Activity;

#[Signature('app:mark-overdue-follow-ups')]
#[Description('Command description')]
class MarkOverdueFollowUps extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $followUps = FollowUp::where('status', 'Pending')
            ->whereDate('follow_up_date', '<', today())
            ->get();
        // dd($followUps->toArray());

        $this->info('Found: '.$followUps->count());

        foreach ($followUps as $followUp) {

            $this->info('Updating Follow-up ID: '.$followUp->id);

            $followUp->update([
                'status' => 'Overdue'
            ]);

            Activity::create([
                'tenant_id'   => $followUp->tenant_id,
                'lead_id'     => $followUp->lead_id,
                'user_id'     => $followUp->user_id,
                'action'      => 'followup_overdue',
                'description' => 'Follow-up automatically marked as overdue.'
            ]);
        }

        $this->info('Done');

        return Command::SUCCESS;
    }
}
