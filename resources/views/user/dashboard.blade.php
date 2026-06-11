@extends('layouts.user')

@section('page-title', 'My Dasbor')

@section('page-content')
<div class="container-fluid">
    <div style="margin-bottom: 24px; margin-top: 12px;">
        <h2 style="font-size: 20px; font-weight: 600; color: #4E5967; margin: 0 0 8px 0;">Selamat datang kembali, {{ auth()->user()->name }}!</h2>
        <p style="font-size: 14px; color: #6A7380; margin: 0;">Berikut adalah ringkasan pengajuan surat Anda.</p>
    </div>

    {{-- Statistic Cards --}}
    <div class="row g-3 mb-4">
        {{-- Card 1: Total Submitted --}}
        <div class="col-12 col-md-6 col-xl-3">
            <div style="background: #FFFFFF; border-radius: 12px; padding: 24px; border: 1px solid rgba(1, 61, 209, 0.12); box-shadow: 0 1px 4px rgba(0,0,0,0.06); height: 100%;">
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; border-radius: 8px; background-color: rgba(6,111,209,0.1); color: #066FD1;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                        </svg>
                    </div>
                    <div>
                        <div style="font-size: 12px; font-weight: 500; color: #6A7380; text-transform: uppercase; letter-spacing: 0.5px;">Total Diajukan</div>
                        <div style="font-size: 32px; font-weight: 700; color: #066FD1; margin-top: 4px;">{{ $totalLetters }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 2: Drafts --}}
        <div class="col-12 col-md-6 col-xl-3">
            <div style="background: #FFFFFF; border-radius: 12px; padding: 24px; border: 1px solid rgba(1, 61, 209, 0.12); box-shadow: 0 1px 4px rgba(0,0,0,0.06); height: 100%;">
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; border-radius: 8px; background-color: rgba(78,89,103,0.1); color: #4E5967;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                    </div>
                    <div>
                        <div style="font-size: 12px; font-weight: 500; color: #6A7380; text-transform: uppercase; letter-spacing: 0.5px;">Draf</div>
                        <div style="font-size: 32px; font-weight: 700; color: #4E5967; margin-top: 4px;">{{ $draftCount }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 3: Menunggu Persetujuan --}}
        <div class="col-12 col-md-6 col-xl-3">
            <div style="background: #FFFFFF; border-radius: 12px; padding: 24px; border: 1px solid rgba(1, 61, 209, 0.12); box-shadow: 0 1px 4px rgba(0,0,0,0.06); height: 100%;">
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; border-radius: 8px; background-color: rgba(217,119,6,0.1); color: #D97706;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                            <path d="M12 7v5l3 3"></path>
                        </svg>
                    </div>
                    <div>
                        <div style="font-size: 12px; font-weight: 500; color: #6A7380; text-transform: uppercase; letter-spacing: 0.5px;">Menunggu Persetujuan</div>
                        <div style="font-size: 32px; font-weight: 700; color: #D97706; margin-top: 4px;">{{ $pendingCount }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 4: Approved / Sent --}}
        <div class="col-12 col-md-6 col-xl-3">
            <div style="background: #FFFFFF; border-radius: 12px; padding: 24px; border: 1px solid rgba(1, 61, 209, 0.12); box-shadow: 0 1px 4px rgba(0,0,0,0.06); height: 100%;">
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; border-radius: 8px; background-color: rgba(5,150,105,0.1); color: #059669;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12l5 5l10 -10"></path>
                        </svg>
                    </div>
                    <div>
                        <div style="font-size: 12px; font-weight: 500; color: #6A7380; text-transform: uppercase; letter-spacing: 0.5px;">Disetujui / Terkirim</div>
                        <div style="font-size: 32px; font-weight: 700; color: #059669; margin-top: 4px;">{{ $approvedCount }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Surat Section --}}
    <div class="card" style="border-radius: 12px; border: 1px solid rgba(1,61,209,0.12); box-shadow: 0 1px 4px rgba(0,0,0,0.06); overflow: hidden;">
        <div class="card-header bg-white" style="border-bottom: 1px solid #f1f3f8; padding: 20px 24px;">
            <h3 class="card-title m-0" style="font-weight: 600; font-size: 16px; color: #1A2744;">Surat Terbaru</h3>
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
                                    Recommendation
                                @elseif($letter->letter_type === 'active_certificate')
                                    Active Certificate
                                @elseif($letter->letter_type === 'assignment')
                                    Assignment
                                @endif
                            </td>
                            <td>
                                @if($letter->status === 'draft')
                                    <span class="status-badge status-draft">Draf</span>
                                @elseif($letter->status === 'pending_approval')
                                    <span class="status-badge status-menunggu_approval">Menunggu Persetujuan</span>
                                @elseif($letter->status === 'approved')
                                    <span class="status-badge status-disetujui">Disetujui</span>
                                @elseif($letter->status === 'rejected')
                                    <span class="status-badge status-ditolak">Ditolak</span>
                                @elseif($letter->status === 'sent')
                                    <span class="status-badge status-terkirim">Terkirim</span>
                                @endif
                            </td>
                            <td class="text-muted">{{ $letter->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">Anda belum mengajukan surat apapun.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
