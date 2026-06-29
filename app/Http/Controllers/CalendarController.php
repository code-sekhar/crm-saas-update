<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FollowUp;
use App\Models\Activity;

class CalendarController extends Controller
{
    public function index()
    {
        return view('calendar.index');
    }

    public function events()
    {
        $events = [];

        $followUps = FollowUp::where(
            'tenant_id',
            auth()->user()->tenant_id
        )->with('lead')->get();

        foreach($followUps as $followUp){

            $color = '#fbbf24';

            if($followUp->status=='Completed'){
                $color='#22c55e';
            }

            if($followUp->status=='Overdue'){
                $color='#ef4444';
            }

            // $events[]=[

            //     'id'=>$followUp->id,

            //     'title'=>$followUp->lead->name,

            //     'start'=>$followUp->follow_up_date,

            //     'color'=>$color,

            //     'url'=>route(
            //         'leads.show',
            //         $followUp->lead_id
            //     )

            // ];
            $events[] = [

                'id' => $followUp->id,

                'title' => $followUp->lead->name,

                'start' => $followUp->follow_up_date . ' ' . $followUp->follow_up_time,

                'url' => route('leads.show', $followUp->lead_id),

                'backgroundColor' => $color,

                'borderColor' => $color,

                'extendedProps' => [

                    'time' => $followUp->follow_up_time,

                    'priority' => $followUp->priority,

                    'status' => $followUp->status,

                ]

            ];
        }

        return response()->json($events);
    }

    public function updateDate(Request $request, FollowUp $followUp)
    {
        abort_if(
            $followUp->tenant_id != auth()->user()->tenant_id,
            403
        );

        $oldDate = $followUp->follow_up_date;

        $followUp->update([
            'follow_up_date' => $request->follow_up_date
        ]);

        Activity::create([
            'tenant_id' => auth()->user()->tenant_id,
            'lead_id'   => $followUp->lead_id,
            'user_id'   => auth()->id(),
            'action'    => 'followup_rescheduled',
            'description' => 'Follow-up rescheduled from '
                .$oldDate.' to '.$request->follow_up_date
        ]);

        return response()->json([
            'success' => true
        ]);
    }
}
