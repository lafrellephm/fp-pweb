@extends('layouts.admin')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('page-title', 'Admin Dashboard')

@section('page-content')
<div style="margin-bottom: 24px;">
    <h2 style="font-size: 20px; font-weight: 600; color: #4E5967; margin: 0 0 8px 0;">Dashboard admin</h2>
    {{-- <p style="font-size: 14px; color: #6A7380; margin: 0;">Overview of all letters and dispositions.</p> --}}
</div>

<div class="row g-3">
    <!-- Card 1: Total Incoming Letters -->
    <div class="col-12 col-md-6 col-xl-3">
        <div style="background: #FFFFFF; border-radius: 12px; padding: 24px; border: 1px solid rgba(1, 61, 209, 0.12); box-shadow: 0 1px 4px rgba(0,0,0,0.06); height: 100%;">
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; border-radius: 8px; background-color: rgba(6,111,209,0.1); color: #066FD1;">
                    <!-- Mail Icon -->
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-mail">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                        <path d="M3 7l9 6l9 -6" />
                    </svg> --}}
                </div>
                <div>
                    <div style="font-size: 12px; font-weight: 500; color: #6A7380; text-transform: uppercase; letter-spacing: 0.5px;">Total Incoming Letters</div>
                    <div style="font-size: 32px; font-weight: 700; color: #066FD1; margin-top: 4px;">{{ $totalIncoming }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 2: Pending Approval -->
    <div class="col-12 col-md-6 col-xl-3">
        <div style="background: #FFFFFF; border-radius: 12px; padding: 24px; border: 1px solid rgba(1, 61, 209, 0.12); box-shadow: 0 1px 4px rgba(0,0,0,0.06); height: 100%;">
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; border-radius: 8px; background-color: rgba(217,119,6,0.1); color: #D97706;">
                    <!-- Clock Icon -->
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-clock">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                        <path d="M12 7v5l3 3" />
                    </svg> --}}
                </div>
                <div>
                    <div style="font-size: 12px; font-weight: 500; color: #6A7380; text-transform: uppercase; letter-spacing: 0.5px;">Pending Approval</div>
                    <div style="font-size: 32px; font-weight: 700; color: #D97706; margin-top: 4px;">{{ $pendingApproval }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 3: Active Dispositions -->
    <div class="col-12 col-md-6 col-xl-3">
        <div style="background: #FFFFFF; border-radius: 12px; padding: 24px; border: 1px solid rgba(1, 61, 209, 0.12); box-shadow: 0 1px 4px rgba(0,0,0,0.06); height: 100%;">
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; border-radius: 8px; background-color: rgba(37,99,235,0.1); color: #2563EB;">
                    <!-- Users Icon -->
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                    </svg> --}}
                </div>
                <div>
                    <div style="font-size: 12px; font-weight: 500; color: #6A7380; text-transform: uppercase; letter-spacing: 0.5px;">Active Dispositions</div>
                    <div style="font-size: 32px; font-weight: 700; color: #2563EB; margin-top: 4px;">{{ $activeDisposition }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 4: Letters Sent -->
    <div class="col-12 col-md-6 col-xl-3">
        <div style="background: #FFFFFF; border-radius: 12px; padding: 24px; border: 1px solid rgba(1, 61, 209, 0.12); box-shadow: 0 1px 4px rgba(0,0,0,0.06); height: 100%;">
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; border-radius: 8px; background-color: rgba(5,150,105,0.1); color: #059669;">
                    <!-- Check Icon -->
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M5 12l5 5l10 -10" />
                    </svg> --}}
                </div>
                <div>
                    <div style="font-size: 12px; font-weight: 500; color: #6A7380; text-transform: uppercase; letter-spacing: 0.5px;">Letters Sent</div>
                    <div style="font-size: 32px; font-weight: 700; color: #059669; margin-top: 4px;">{{ $totalSent }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
