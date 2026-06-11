@extends('layouts.admin')

@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('page-title', 'Outgoing Letter Detail')

@section('page-content')
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-4 mt-3">
        <div>
            <h2 style="font-size: 20px; font-weight: 600; color: #4E5967; margin: 0 0 8px 0;">Outgoing Letter Detail</h2>
            <p style="font-size: 14px; color: #6A7380; margin: 0;">View complete details of this outgoing letter submission.</p>
        </div>
        <a href="{{ route('admin.outgoing-letters.index') }}" class="btn btn-outline-secondary" style="height: 40px; border-radius: 6px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Back to Letters
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 8px;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Rejection Note Alert --}}
    @if($letter->status === 'rejected' && $letter->rejection_note)
        <div class="alert" role="alert" style="background-color: #FEE2E2; border: 1px solid #FECACA; color: #991B1B; border-radius: 8px; padding: 16px 20px; margin-bottom: 20px;">
            <div class="d-flex align-items-start">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-3 flex-shrink-0" style="margin-top: 2px;">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="15" y1="9" x2="9" y2="15"></line>
                    <line x1="9" y1="9" x2="15" y2="15"></line>
                </svg>
                <div>
                    <strong style="font-size: 14px; font-weight: 600;">Rejection Note</strong>
                    <p style="margin: 4px 0 0 0; font-size: 14px;">{{ $letter->rejection_note }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <!-- Letter Details -->
        <div class="col-lg-8 mb-4">
            <div class="card h-100" style="border-radius: 12px; border: 1px solid rgba(1,61,209,0.12); box-shadow: 0 1px 4px rgba(0,0,0,0.06);">
                <div class="card-header bg-white" style="border-bottom: 1px solid #f1f3f8; padding: 20px 24px;">
                    <div class="d-flex align-items-center justify-content-between">
                        <h3 class="card-title m-0" style="font-weight: 600; font-size: 16px; color: #1A2744;">Informasi Surat</h3>
                        <div>
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
                        </div>
                    </div>
                </div>
                <div class="card-body" style="padding: 24px;">
                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Diajukan Oleh</div>
                        <div class="col-sm-8">
                            <span style="font-weight: 600; color: #1A2744;">{{ $letter->submittedBy->name ?? '-' }}</span>
                            @if($letter->submittedBy)
                                <br><span style="font-size: 13px; color: #6A7380;">{{ $letter->submittedBy->email }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Tujuan</div>
                        <div class="col-sm-8 text-dark">{{ $letter->purpose }}</div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Jenis Surat</div>
                        <div class="col-sm-8 text-dark">
                            @if($letter->letter_type === 'recommendation')
                                Recommendation
                            @elseif($letter->letter_type === 'active_certificate')
                                Active Certificate
                            @elseif($letter->letter_type === 'assignment')
                                Assignment
                            @else
                                {{ ucfirst($letter->letter_type) }}
                            @endif
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Related Name</div>
                        <div class="col-sm-8 text-dark">{{ $letter->related_name }}</div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Ditujukan Kepada</div>
                        <div class="col-sm-8 text-dark">{{ $letter->addressed_to }}</div>
                    </div>

                    @if($letter->letter_number)
                        <div class="row mb-4">
                            <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Nomor Surat</div>
                            <div class="col-sm-8" style="font-weight: 600; color: #1A2744;">{{ $letter->letter_number }}</div>
                        </div>
                    @endif

                    @if($letter->letter_date)
                        <div class="row mb-4">
                            <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Tanggal Surat</div>
                            <div class="col-sm-8 text-dark">{{ $letter->letter_date->format('d F Y') }}</div>
                        </div>
                    @endif

                    @if($letter->letter_type === 'assignment')
                        <div class="row mb-4" style="border-top: 1px solid #f1f3f8; padding-top: 16px;">
                            <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Nama Acara</div>
                            <div class="col-sm-8 text-dark">{{ $letter->event_name ?? '-' }}</div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Tanggal Acara</div>
                            <div class="col-sm-8 text-dark">{{ $letter->event_date ? $letter->event_date->format('d F Y') : '-' }}</div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Lokasi Acara</div>
                            <div class="col-sm-8 text-dark">{{ $letter->event_location ?? '-' }}</div>
                        </div>
                    @endif

                    <div class="row mb-4" style="border-top: 1px solid #f1f3f8; padding-top: 16px;">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Letter Body</div>
                        <div class="col-sm-8 text-dark" style="white-space: pre-wrap;">{{ $letter->letter_body }}</div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Submitted On</div>
                        <div class="col-sm-8 text-dark">{{ $letter->created_at->format('d F Y, H:i') }}</div>
                    </div>

                    @if($letter->approvedBy)
                        <div class="row mb-4">
                            <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Approved By</div>
                            <div class="col-sm-8 text-dark">{{ $letter->approvedBy->name }}</div>
                        </div>
                    @endif

                    @if($letter->file_path)
                        <div class="row mt-4 pt-4" style="border-top: 1px solid #f1f3f8;">
                            <div class="col-12">
                                <a href="{{ asset('storage/' . $letter->file_path) }}" target="_blank" class="btn btn-outline-primary" style="border-radius: 6px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line x1="16" y1="13" x2="8" y2="13"></line>
                                        <line x1="16" y1="17" x2="8" y2="17"></line>
                                        <polyline points="10 9 9 9 8 9"></polyline>
                                    </svg>
                                    View Attachment
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Actions Panel -->
        <div class="col-lg-4 mb-4">
            <div class="card" style="border-radius: 12px; border: 1px solid rgba(1,61,209,0.12); box-shadow: 0 1px 4px rgba(0,0,0,0.06);">
                <div class="card-header bg-white" style="border-bottom: 1px solid #f1f3f8; padding: 20px 24px;">
                    <h3 class="card-title m-0" style="font-weight: 600; font-size: 16px; color: #1A2744;">Aksi</h3>
                </div>
                <div class="card-body" style="padding: 24px;">
                    @if($letter->status === 'draft')
                        <a href="{{ route('admin.outgoing-letters.process', $letter->id) }}" class="btn btn-primary w-100 mb-3" style="height: 40px; border-radius: 6px; background-color: #066FD1; border-color: #066FD1;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                            Process This Letter
                        </a>
                    @endif

                    @if($letter->status === 'approved')
                        <form action="{{ route('admin.outgoing-letters.sent', $letter->id) }}" method="POST" onsubmit="return confirm('Mark this letter as sent?');">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-primary w-100 mb-3" style="height: 40px; border-radius: 6px; background-color: #059669; border-color: #059669;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                    <line x1="22" y1="2" x2="11" y2="13"></line>
                                    <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                </svg>Tandai Terkirim</button>
                        </form>
                        <a href="#" onclick="window.print();" class="btn btn-secondary w-100 mb-3" style="height: 40px; border-radius: 6px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                                <rect x="6" y="14" width="12" height="8"></rect>
                            </svg>
                            Print Letter
                        </a>
                    @endif

                    @if($letter->status === 'sent')
                        <a href="#" onclick="window.print();" class="btn btn-secondary w-100 mb-3" style="height: 40px; border-radius: 6px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                                <rect x="6" y="14" width="12" height="8"></rect>
                            </svg>
                            Print Letter
                        </a>
                    @endif

                    @if(in_array($letter->status, ['pending_approval', 'rejected']))
                        <div class="text-center py-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#9BA3AF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            <p style="font-size: 13px; color: #6A7380; margin-top: 12px;">
                                @if($letter->status === 'pending_approval')
                                    This letter is awaiting approval from Pimpinan.
                                @elseif($letter->status === 'rejected')
                                    This letter has been rejected. The user may revise and resubmit.
                                @endif
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
