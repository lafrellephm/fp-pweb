@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('sidebar')
    <div class="sidebar-nav-label">Menu</div>

    <a href="/user/dashboard" class="sidebar-nav-item {{ request()->is('user/dashboard') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="3" width="7" height="7"></rect>
            <rect x="14" y="3" width="7" height="7"></rect>
            <rect x="14" y="14" width="7" height="7"></rect>
            <rect x="3" y="14" width="7" height="7"></rect>
        </svg>Dashboard</a>

    <a href="/user/outgoing-letters/create" class="sidebar-nav-item {{ request()->is('user/outgoing-letters/create') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>Buat Surat</a>

    <a href="/user/outgoing-letters" class="sidebar-nav-item {{ request()->is('user/outgoing-letters') && !request()->is('user/outgoing-letters/create') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
            <polyline points="14 2 14 8 20 8"></polyline>
            <line x1="16" y1="13" x2="8" y2="13"></line>
            <line x1="16" y1="17" x2="8" y2="17"></line>
        </svg>Surat Saya</a>

    {{--  --}}

    <div class="sidebar-nav-label mt-4">Informasi</div>
    <a href="/about" class="sidebar-nav-item {{ request()->is('about') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" y1="16" x2="12" y2="12"></line>
            <line x1="12" y1="8" x2="12.01" y2="8"></line>
        </svg>Tentang Kami</a>
@endsection

@section('notification-bell')
    @php
        $unreadCount = auth()->user()->notifications()->where('is_read', false)->count();
    @endphp
    <a href="{{ route('notifications.index') }}" class="navbar-notification" title="Notifikasi" style="text-decoration: none;">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
        </svg>
        @if($unreadCount > 0)
            <span style="position: absolute; top: -4px; right: -4px; background-color: #EF4444; color: #FFFFFF; font-size: 10px; font-weight: 500; padding: 2px 6px; border-radius: 6px; border: 1px solid var(--card-bg); line-height: 1;">
                {{ $unreadCount > 99 ? '99+' : $unreadCount }}
            </span>
        @endif
    </a>
@endsection

@section('content')
    @yield('page-content')
@endsection
