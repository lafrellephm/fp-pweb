@extends('layouts.user')

@section('page-title', 'My Dashboard')

@section('page-content')
<div class="container-fluid">   
    <div class="d-flex align-items-center justify-content-between mb-4 mt-3">
        <h2>Dashboard {{ auth()->user()->name }}</h2>
    </div>

    {{-- Statistic Cards --}}
    <div class="row g-3 mb-4">
        {{-- Card 1: Total Submitted --}}
        <div class="col-12 col-md-6 col-lg-3">
            <div class="p-4" style="background: #FFFFFF; border-radius: 12px;  border: 1px solid rgba(1, 61, 209, 0.12); box-shadow: 0 1px 4px rgba(0,0,0,0.06); height: 100%;">
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
                        <div class="mt-1" style="font-size: 32px; font-weight: 700; color: #066FD1; ">{{ $totalLetters }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 2: Drafts --}}
        <div class="col-12 col-md-6 col-lg-3">
            <div class="p-4" style="background: #FFFFFF; border-radius: 12px;  border: 1px solid rgba(1, 61, 209, 0.12); box-shadow: 0 1px 4px rgba(0,0,0,0.06); height: 100%;">
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; border-radius: 8px; background-color: rgba(78,89,103,0.1); color: #4E5967;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                    </div>
                    <div>
                        <div style="font-size: 12px; font-weight: 500; color: #6A7380; text-transform: uppercase; letter-spacing: 0.5px;">Draf</div>
                        <div class="mt-1" style="font-size: 32px; font-weight: 700; color: #4E5967; ">{{ $draftCount }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 3: Menunggu Persetujuan --}}
        <div class="col-12 col-md-6 col-lg-3">
            <div class="p-4" style="background: #FFFFFF; border-radius: 12px;  border: 1px solid rgba(1, 61, 209, 0.12); box-shadow: 0 1px 4px rgba(0,0,0,0.06); height: 100%;">
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; border-radius: 8px; background-color: rgba(217,119,6,0.1); color: #D97706;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                            <path d="M12 7v5l3 3"></path>
                        </svg>
                    </div>
                    <div>
                        <div style="font-size: 12px; font-weight: 500; color: #6A7380; text-transform: uppercase; letter-spacing: 0.5px;">Menunggu Persetujuan</div>
                        <div class="mt-1" style="font-size: 32px; font-weight: 700; color: #D97706; ">{{ $pendingCount }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 4: Approved / Sent --}}
        <div class="col-12 col-md-6 col-lg-3">
            <div class="p-4" style="background: #FFFFFF; border-radius: 12px;  border: 1px solid rgba(1, 61, 209, 0.12); box-shadow: 0 1px 4px rgba(0,0,0,0.06); height: 100%;">
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; border-radius: 8px; background-color: rgba(5,150,105,0.1); color: #059669;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12l5 5l10 -10"></path>
                        </svg>
                    </div>
                    <div>
                        <div style="font-size: 12px; font-weight: 500; color: #6A7380; text-transform: uppercase; letter-spacing: 0.5px;">Disetujui / Terkirim</div>
                        <div class="mt-1" style="font-size: 32px; font-weight: 700; color: #059669; ">{{ $approvedCount }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Surat Section --}}
    <div class="card" style="border-radius: 12px; border: 1px solid rgba(1,61,209,0.12); box-shadow: 0 1px 4px rgba(0,0,0,0.06); overflow: hidden;">
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
    {{-- Notification Popup Modal --}}
    @if(isset($popupNotification))
    <div class="modal fade" id="notificationPopupModal" tabindex="-1" aria-labelledby="notificationPopupModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center pt-0 pb-4 px-4">
                    @if($popupNotification->title === 'Surat Disetujui')
                        <div class="mb-3 d-flex justify-content-center">
                            <div style="width: 50px; height: 50px; background-color: rgba(16,185,129,0.1); color: #10B981; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                </svg>
                            </div>
                        </div>
                    @else
                        <div class="mb-3 d-flex justify-content-center">
                            <div style="width: 50px; height: 50px; background-color: rgba(220,38,38,0.1); color: #DC2626; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="15" y1="9" x2="9" y2="15"></line>
                                    <line x1="9" y1="9" x2="15" y2="15"></line>
                                </svg>
                            </div>
                        </div>
                    @endif
                    <h4 class="mb-2" style="font-weight: 700; color: #1A2744;">{{ $popupNotification->title }}</h4>
                    <p style="font-size: 14px; color: #6A7380; line-height: 1.5; margin-bottom: 20px;">
                        {{ $popupNotification->message }}
                    </p>
                    <a href="{{ route('user.outgoing-letters.index') }}" class="btn btn-primary w-100" style="height: 40px; border-radius: 6px;">
                        Lihat Surat Saya
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (typeof bootstrap !== 'undefined') {
                var notificationModal = new bootstrap.Modal(document.getElementById('notificationPopupModal'));
                notificationModal.show();
            }
        });
    </script>
    @endif
</div>
@endsection
