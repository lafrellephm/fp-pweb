@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('sidebar')
    <div class="sidebar-nav-label">Utama</div>

    <a href="/admin/dashboard" class="sidebar-nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="3" width="7" height="7"></rect>
            <rect x="14" y="3" width="7" height="7"></rect>
            <rect x="14" y="14" width="7" height="7"></rect>
            <rect x="3" y="14" width="7" height="7"></rect>
        </svg>Dashboard</a>

    <div class="sidebar-nav-label fw-bold">Surat</div>

    <a href="/admin/incoming-letters" class="sidebar-nav-item {{ request()->is('admin/incoming-letters') && !request()->is('admin/incoming-letters/create') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
            <polyline points="22,6 12,13 2,6"></polyline>
        </svg>Surat Masuk</a>

    <a href="/admin/incoming-letters/create" class="sidebar-nav-item sidebar-sub-item {{ request()->is('admin/incoming-letters/create') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>Tambah Baru</a>

    <a href="/admin/outgoing-letters" class="sidebar-nav-item {{ request()->is('admin/outgoing-letters*') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="22" y1="2" x2="11" y2="13"></line>
            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
        </svg>Surat Keluar</a>

    <!-- <div class="sidebar-nav-label">Manajemen</div>

    <a href="/admin/dispositions" class="sidebar-nav-item {{ request()->is('admin/dispositions*') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
            <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
            <line x1="9" y1="12" x2="15" y2="12"></line>
            <line x1="9" y1="16" x2="15" y2="16"></line>
        </svg>Disposisi</a>

    <a href="/admin/users" class="sidebar-nav-item {{ request()->is('admin/users*') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
            <circle cx="9" cy="7" r="4"></circle>
            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
        </svg>Pengguna</a> -->

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
