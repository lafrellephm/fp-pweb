@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('sidebar')
    <div class="sidebar-nav-label">Menu</div>

    <a href="/pimpinan/dashboard" class="sidebar-nav-item {{ request()->is('pimpinan/dashboard') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="3" width="7" height="7"></rect>
            <rect x="14" y="3" width="7" height="7"></rect>
            <rect x="14" y="14" width="7" height="7"></rect>
            <rect x="3" y="14" width="7" height="7"></rect>
        </svg>Dashboard</a>

    <a href="/pimpinan/approval" class="sidebar-nav-item {{ request()->is('pimpinan/approval*') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
            <polyline points="22 4 12 14.01 9 11.01"></polyline>
        </svg>Persetujuan Surat</a>
@endsection

@section('content')
    @yield('page-content')
@endsection
