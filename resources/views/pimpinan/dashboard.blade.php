@extends('layouts.pimpinan')

@section('page-title', 'Pimpinan Dashboard')

@section('page-content')
<div style="margin-bottom: 24px;">
    <h2 style="font-size: 20px; font-weight: 600; color: #4E5967; margin: 0 0 8px 0;">Pimpinan Dashboard</h2>
    <p style="font-size: 14px; color: #6A7380; margin: 0;">Overview of letters awaiting your approval.</p>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px;">
    <div style="background: #FFFFFF; border-radius: 12px; padding: 24px; border: 1px solid rgba(1, 61, 209, 0.12); box-shadow: rgba(0, 0, 0, 0.06) 0px 20px 25px -5px, rgba(0, 0, 0, 0.04) 0px 10px 10px -5px;">
        <div style="font-size: 12px; font-weight: 500; color: #6A7380; text-transform: uppercase; letter-spacing: 0.5px;">Pending Approval</div>
        <div style="font-size: 32px; font-weight: 700; color: #EAB308; margin-top: 8px;">0</div>
        <div style="font-size: 12px; color: #6A7380; margin-top: 4px;">Letters awaiting decision</div>
    </div>

    <div style="background: #FFFFFF; border-radius: 12px; padding: 24px; border: 1px solid rgba(1, 61, 209, 0.12); box-shadow: rgba(0, 0, 0, 0.06) 0px 20px 25px -5px, rgba(0, 0, 0, 0.04) 0px 10px 10px -5px;">
        <div style="font-size: 12px; font-weight: 500; color: #6A7380; text-transform: uppercase; letter-spacing: 0.5px;">Approved</div>
        <div style="font-size: 32px; font-weight: 700; color: #10B981; margin-top: 8px;">0</div>
        <div style="font-size: 12px; color: #6A7380; margin-top: 4px;">Letters approved</div>
    </div>

    <div style="background: #FFFFFF; border-radius: 12px; padding: 24px; border: 1px solid rgba(1, 61, 209, 0.12); box-shadow: rgba(0, 0, 0, 0.06) 0px 20px 25px -5px, rgba(0, 0, 0, 0.04) 0px 10px 10px -5px;">
        <div style="font-size: 12px; font-weight: 500; color: #6A7380; text-transform: uppercase; letter-spacing: 0.5px;">Rejected</div>
        <div style="font-size: 32px; font-weight: 700; color: #EF4444; margin-top: 8px;">0</div>
        <div style="font-size: 12px; color: #6A7380; margin-top: 4px;">Letters rejected</div>
    </div>
</div>
@endsection
