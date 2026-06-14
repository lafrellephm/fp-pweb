@extends('layouts.admin')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('page-title', 'Admin Dashboard')

@section('page-content')
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-4 mt-3">
        <div>
            <h2>Dashboard Admin</h2>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <!-- Card 1: Total Surat Masuk -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="p-4 card-custom" style="background: #FFFFFF; height: 100%;">
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; border-radius: 8px; background-color: rgba(6,111,209,0.1); color: #066FD1;">
                        <!-- Mail Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-mail">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                            <path d="M3 7l9 6l9 -6" />
                        </svg>
                    </div>
                    <div>
                        <div style="font-size: 12px; font-weight: 500; color: #6A7380; text-transform: uppercase; letter-spacing: 0.5px;">Total Surat Masuk</div>
                        <div class="mt-1" style="font-size: 32px; font-weight: 700; color: #066FD1; ">{{ $totalIncoming }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Menunggu Persetujuan -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="p-4 card-custom" style="background: #FFFFFF; height: 100%;">
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; border-radius: 8px; background-color: rgba(217,119,6,0.1); color: #D97706;">
                        <!-- Clock Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-clock">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                            <path d="M12 7v5l3 3" />
                        </svg>
                    </div>
                    <div>
                        <div style="font-size: 12px; font-weight: 500; color: #6A7380; text-transform: uppercase; letter-spacing: 0.5px;">Menunggu Persetujuan</div>
                        <div class="mt-1" style="font-size: 32px; font-weight: 700; color: #D97706; ">{{ $pendingApproval }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3: Active Dispositions -->
        {{-- <div class="col-12 col-md-6 col-lg-3">
            <div class="p-4 card-custom" style="background: #FFFFFF; height: 100%;">
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; border-radius: 8px; background-color: rgba(37,99,235,0.1); color: #2563EB;">
                        <!-- Users Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                        </svg>
                    </div>
                    <div>
                        <div style="font-size: 12px; font-weight: 500; color: #6A7380; text-transform: uppercase; letter-spacing: 0.5px;">Menunggu Disposisi</div>
                        <div class="mt-1" style="font-size: 32px; font-weight: 700; color: #2563EB; ">{{ $activeDisposition }}</div>
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- Card 4: Surat Sent -->
        <div class="col-12 col-md-4 col-lg-4">
            <div class="p-4 card-custom" style="background: #FFFFFF; height: 100%;">
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; border-radius: 8px; background-color: rgba(5,150,105,0.1); color: #059669;">
                        <!-- Check Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M5 12l5 5l10 -10" />
                        </svg>
                    </div>
                    <div>
                        <div style="font-size: 12px; font-weight: 500; color: #6A7380; text-transform: uppercase; letter-spacing: 0.5px;">Surat Keluar</div>
                        <div class="mt-1" style="font-size: 32px; font-weight: 700; color: #059669; ">{{ $totalSent }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Surat Section --}}
    <div class="card card-custom">
        <div class=" py-3" style="border-bottom: 1px solid #f1f3f8; ">
            <h4>Surat Terbaru</h4>
        </div>
        <div class="table-responsive">
            <table class="table table-vcenter mb-0">
                <thead style="background-color: #F8FAFC;">
                    <tr>
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Perihal / Tujuan</th>
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Jenis</th>
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Status</th>
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Tanggal Diajukan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentLetters as $letter)
                        <tr>
                            <td style="font-weight: 500; color: #1A2744;">{{ Str::limit($letter->purpose, 40) }}</td>
                            <td>
                                @if($letter->letter_type === 'recommendation')
                                    Rekomendasi
                                @elseif($letter->letter_type === 'active_certificate')
                                    Keterangan Aktif
                                @elseif($letter->letter_type === 'assignment')
                                    Surat Tugas
                                @endif
                            </td>
                            <td>
                                <x-status-badge :status="$letter->status" />
                            </td>
                            <td class="text-muted">{{ $letter->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <x-empty-state colspan="4" message="Belum ada surat yang diajukan." />
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
