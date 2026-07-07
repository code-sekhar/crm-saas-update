<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanySetting;
use Illuminate\Support\Facades\Storage;
use App\Services\AuditLogService;

class CompanySettingController extends Controller
{
    public function index()
    {
        $setting = CompanySetting::firstOrCreate(

            [
                'tenant_id'=>auth()->user()->tenant_id
            ],

            [
                'company_name'=>'My Company'
            ]

        );

        return view(
            'settings.company',
            compact('setting')
        );
    }
    public function store(Request $request)
    {
        $request->validate([

            'company_name' => 'required|max:255',

            'email' => 'nullable|email',

            'phone' => 'nullable|max:30',

            'website' => 'nullable|url',

            'gst_number' => 'nullable|max:100',

            'currency' => 'required|max:10',

            'timezone' => 'required|max:100',

            'address' => 'nullable',

            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        ]);

        $setting = CompanySetting::firstOrCreate(

            [
                'tenant_id' => auth()->user()->tenant_id
            ]
        );

        if ($request->hasFile('logo')) {

            // old logo delete
            if ($setting->logo && Storage::disk('public')->exists($setting->logo)) {

                Storage::disk('public')->delete($setting->logo);

            }

            $setting->logo = $request
                ->file('logo')
                ->store('company-logo', 'public');
        }

        $setting->company_name = $request->company_name;

        $setting->email = $request->email;

        $setting->phone = $request->phone;

        $setting->website = $request->website;

        $setting->gst_number = $request->gst_number;

        $setting->currency = $request->currency;

        $setting->timezone = $request->timezone;

        $setting->address = $request->address;
        AuditLogService::log(
            module: 'Company Setting',
            action: 'Updated',
            recordId: $setting->id,
            description: 'Updated Company Settings',
            newValues: $setting->toArray()
        );

        $setting->save();

        return back()->with(

            'success',

            'Company settings updated successfully.'

        );
    }
}
