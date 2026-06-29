<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<style>

@page{
    margin:25px;
}

/* ===================================
   COMPANY BRANDING
=================================== */

body{

    font-family: DejaVu Sans;

    color:#222;

    line-height:1.5;

}

.brand-header{

    width:100%;

    background:#2563eb;

    color:#fff;

    padding:18px;

    border-radius:8px;

    margin-bottom:20px;

}

.brand-name{

    font-size:28px;

    font-weight:bold;

}

.brand-subtitle{

    font-size:13px;

    color:#e5e7eb;

}

.logo{

    width:70px;

    height:70px;

}

.report-id{

    font-size:12px;

    color:#dbeafe;

}

.confidential{

    display:inline-block;

    margin-top:10px;

    padding:5px 10px;

    background:#ef4444;

    color:white;

    border-radius:4px;

    font-size:11px;

    font-weight:bold;

}

table{
    width:100%;
    border-collapse:collapse;
}

th,td{
    border:1px solid #dcdcdc;
    padding:8px;
}

th{
    background:#2563eb;
    color:white;
    text-align:center;
}

.header-table{
    border:none;
    margin-bottom:25px;
}

.header-table td{
    border:none;
}

.company{
    font-size:28px;
    font-weight:bold;
    color:#2563eb;
}

.subtitle{
    color:#666;
    font-size:13px;
}

.section-title{
    font-size:18px;
    font-weight:bold;
    color:#2563eb;
    margin:25px 0 10px;
}

.kpi-table td{
    text-align:center;
}

.kpi-value{
    font-size:22px;
    font-weight:bold;
}

.green{color:#16a34a;}
.red{color:#dc2626;}
.blue{color:#2563eb;}
.orange{color:#ea580c;}
.purple{color:#9333ea;}
.yellow{color:#ca8a04;}

.footer{
    position:fixed;
    bottom:-5px;
    left:0;
    right:0;
    text-align:center;
    font-size:11px;
    color:#777;
}
.header{

    width:100%;

    padding-bottom:20px;

    border-bottom:3px solid #2563eb;

}

.logo{

    width:70px;

    height:70px;

}

.company{

    font-size:30px;

    font-weight:bold;

    color:#2563eb;

}

.subtitle{

    color:#666;

    font-size:13px;

}

.report-title{

    margin-top:15px;

    font-size:22px;

    font-weight:bold;

    color:#111827;

}

.info{

    font-size:12px;

    color:#555;

    line-height:22px;

}

.section-title{

    margin-top:28px;

    margin-bottom:10px;

    font-size:22px;

    font-weight:bold;

    color:#2563eb;

}

.summary-box{

    border:1px solid #dbeafe;

    background:#f8fbff;

    padding:18px;

}

.summary-box p{

    margin:0;

    line-height:24px;

    color:#444;

    font-size:13px;

}

.summary-highlight{

    color:#2563eb;

    font-weight:bold;

}

.success{

    color:#16a34a;

    font-weight:bold;

}

.warning{

    color:#d97706;

    font-weight:bold;

}

.danger{

    color:#dc2626;

    font-weight:bold;

}
.kpi-grid{

    width:100%;

    margin-top:15px;

    border-spacing:10px;

}

.kpi-card{

    border:1px solid #e5e7eb;

    border-radius:8px;

    padding:15px;

    text-align:center;

    background:#ffffff;

}

.kpi-title{

    font-size:11px;

    color:#6b7280;

    margin-bottom:8px;

}

.kpi-value{

    font-size:28px;

    font-weight:bold;

}

.blue{

    color:#2563eb;

}

.green{

    color:#16a34a;

}

.red{

    color:#dc2626;

}

.orange{

    color:#d97706;

}

.purple{

    color:#7c3aed;
}
</style>

</head>

<body>

<!-- HEADER -->

{{-- <table class="header-table">

<tr>

<td width="60%">

<div class="company">

CRM SaaS

</div>

<div class="subtitle">

Reports & Analytics

</div>

</td>

<td width="40%" align="right">

<strong>Generated :</strong><br>

{{ now()->format('d M Y H:i') }}

</td>

</tr>

</table> --}}
<table class="header">

<tr>

<td width="70%">

<img
src="{{ public_path('logo.png') }}"
class="logo">

<div class="company">

CRM SaaS

</div>

<div class="subtitle">

Sales Management Platform

</div>

<div class="report-title">

EXECUTIVE SALES REPORT

</div>

</td>

<td
width="30%"
align="right">

<div class="info">

<strong>

Report ID

</strong>

<br>

REP-{{ now()->format('YmdHis') }}

<br><br>

<strong>

Generated

</strong>

<br>

{{ now()->format('d M Y') }}

<br>

{{ now()->format('h:i A') }}

<br><br>

<strong>

Prepared By

</strong>

<br>

{{ auth()->user()->name }}

</div>

</td>

</tr>

</table>

<h2 class="section-title">

Executive Summary

</h2>

<div class="summary-box">

<p>

This report summarizes the CRM performance for the selected period.

A total of

<span class="summary-highlight">

{{ number_format($totalLeads) }}

</span>

leads were generated.

Among them,

<span class="success">

{{ $wonLeads }}

Won

</span>

and

<span class="danger">

{{ $lostLeads }}

Lost

</span>

deals were recorded.

The current conversion rate stands at

<span class="summary-highlight">

{{ $conversionRate }}%

</span>.

The sales pipeline currently contains

<span class="warning">

₹ {{ number_format($expectedRevenue) }}

</span>

in expected revenue,

while completed deals have generated

<span class="success">

₹ {{ number_format($totalRevenue) }}

</span>

in actual revenue.

</p>

</div>
<hr>
<table width="100%" style="margin-top:15px;">

<tr>

<td>

@if($conversionRate >= 50)

<span style="background:#16a34a;color:white;padding:6px 12px;">
Excellent Performance
</span>

@elseif($conversionRate >= 25)

<span style="background:#2563eb;color:white;padding:6px 12px;">
Good Performance
</span>

@elseif($conversionRate >= 10)

<span style="background:#d97706;color:white;padding:6px 12px;">
Average Performance
</span>

@else

<span style="background:#dc2626;color:white;padding:6px 12px;">
Needs Improvement
</span>

@endif

</td>

</tr>

</table>

<hr>
<!-- FILTERS -->

<div class="section-title">

Applied Filters

</div>

<table>

<tr>

<th>Status</th>

<th>Source</th>

<th>User</th>

<th>Date Range</th>

</tr>

<tr>

<td>

{{ request('status') ?: 'All' }}

</td>

<td>

{{ request('source') ?: 'All' }}

</td>

<td>

{{ request('user') ?: 'All' }}

</td>

<td>

{{ request('from') ?: '-' }}

&nbsp; to &nbsp;

{{ request('to') ?: '-' }}

</td>

</tr>

</table>
<h2 class="section-title">
    Charts & Analytics
</h2>

<table width="100%" cellspacing="10">

    <tr>

        <td width="50%">
            <img src="{{ $statusChartImage }}" style="width:100%;">
        </td>

        <td width="50%">
            <img src="{{ $sourceChartImage }}" style="width:100%;">
        </td>

    </tr>

    <tr>

        <td width="50%">
            <img src="{{ $monthlyChartImage }}" style="width:100%;">
        </td>

        <td width="50%">
            <img src="{{ $revenueChartImage }}" style="width:100%;">
        </td>

    </tr>

</table>
<!-- KPI -->
<h2 class="section-title">

Performance Summary

</h2>

<table class="kpi-grid">

<tr>

<td width="33%">

<div class="kpi-card">

<div class="kpi-title">

Total Leads

</div>

<div class="kpi-value blue">

{{ number_format($totalLeads) }}

</div>

</div>

</td>

<td width="33%">

<div class="kpi-card">

<div class="kpi-title">

Won Deals

</div>

<div class="kpi-value green">

{{ $wonLeads }}

</div>

</div>

</td>

<td width="33%">

<div class="kpi-card">

<div class="kpi-title">

Lost Deals

</div>

<div class="kpi-value red">

{{ $lostLeads }}

</div>

</div>

</td>

</tr>

<tr>

<td>

<div class="kpi-card">

<div class="kpi-title">

Pending Tasks

</div>

<div class="kpi-value orange">

{{ $pendingTasks }}

</div>

</div>

</td>

<td>

<div class="kpi-card">

<div class="kpi-title">

Pending Follow Ups

</div>

<div class="kpi-value blue">

{{ $pendingFollowUps }}

</div>

</div>

</td>

<td>

<div class="kpi-card">

<div class="kpi-title">

Conversion Rate

</div>

<div class="kpi-value purple">

{{ $conversionRate }}%

</div>

</div>

</td>

</tr>

</table>

<!-- REVENUE -->

<h2 class="section-title">

Revenue Summary

</h2>

<table class="kpi-grid">

<tr>

<td width="25%">

<div class="kpi-card">

<div class="kpi-title">

Total Revenue

</div>

<div class="kpi-value green">

₹ {{ number_format($totalRevenue) }}

</div>

</div>

</td>

<td width="25%">

<div class="kpi-card">

<div class="kpi-title">

Expected Revenue

</div>

<div class="kpi-value blue">

₹ {{ number_format($expectedRevenue) }}

</div>

</div>

</td>

<td width="25%">

<div class="kpi-card">

<div class="kpi-title">

Average Deal

</div>

<div class="kpi-value purple">

₹ {{ number_format($averageDealValue) }}

</div>

</div>

</td>

<td width="25%">

<div class="kpi-card">

<div class="kpi-title">

Largest Deal

</div>

<div class="kpi-value orange">

₹ {{ number_format($largestDeal) }}

</div>

</div>

</td>

</tr>

</table>

<!-- WON DEALS -->

<div class="section-title">

Recent Won Deals

</div>

<table>

<thead>

<tr>

<th>Customer</th>

<th>Email</th>

<th>Status</th>

<th>Value</th>

<th>Date</th>

</tr>

</thead>

<tbody>

@if($recentWonDeals->count())

@foreach($recentWonDeals as $lead)

<tr>

<td>

{{ $lead->name }}

</td>

<td>

{{ $lead->email }}

</td>

<td>

{{ $lead->status }}

</td>

<td>

₹ {{ number_format($lead->value ?? 0) }}

</td>

<td>

{{ \Carbon\Carbon::parse($lead->created_at)->format('d M Y') }}

</td>

</tr>

@endforeach

@else

<tr>

<td colspan="5" align="center">

No Won Deals Found

</td>

</tr>

@endif

</tbody>

</table>

<!-- FOOTER -->

<div class="footer">

Generated by CRM SaaS |
{{ now()->year }}

</div>
<div
style="
margin-top:40px;
border-top:1px solid #ddd;
padding-top:12px;
font-size:11px;
color:#666;
">

<table width="100%">

<tr>

<td>

Generated by

<strong>

CRM SaaS

</strong>

</td>

<td align="center">

www.yourcrm.com

</td>

<td align="right">

{{ now()->format('d M Y H:i') }}

</td>

</tr>

</table>

</div>
</body>

</html>

