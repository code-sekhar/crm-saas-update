<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoginActivity;

class LoginActivityController extends Controller
{
    public function index(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;

        $query = LoginActivity::with('user')
                    ->where('tenant_id',$tenantId);

        // Search User
        if($request->filled('search')){

            $query->whereHas('user',function($q) use($request){

                $q->where(
                    'name',
                    'like',
                    '%'.$request->search.'%'
                );

            });

        }

        // From Date
        if($request->filled('from')){

            $query->whereDate(
                'login_at',
                '>=',
                $request->from
            );

        }

        // To Date
        if($request->filled('to')){

            $query->whereDate(
                'login_at',
                '<=',
                $request->to
            );

        }

        $activities = $query
            ->latest('login_at')
            ->paginate(15)
            ->withQueryString();

        return view(
            'login-activities.index',
            compact('activities')
        );
    }
}
