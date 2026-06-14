@extends('layouts.user')

@section('page-title', 'Letter Detail')

@section('page-content')
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-4 mt-3">
        <div>
            <h2>Detail Surat</h2>
            <p class="m-0">Lihat detail surat yang kamu berikan</p>
        </div>
        <a href="{{ route('user.outgoing-letters.index') }}" class="btn btn-outline-secondary">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Kembali ke Surat Saya</a>
    </div>

    {{-- Removed Rejection Alert from top, moved to Aksi Panel --}}

    <div class="row">
        <div class="col-lg-8">
            {{-- Letter Detail Card --}}
            <div class="card mb-4">
        <div class="card-header bg-white">
            <div class="d-flex align-items-center justify-content-between">
                <h4>Informasi Surat</h4>
                <div>
                    <x-status-badge :status="$letter->status" />
                </div>
            </div>
        </div>
        <div class="card-body p-4\">
            <div class="row mb-4">
                <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Jenis Surat</div>
                <div class="col-sm-8 text-dark">
                    @if($letter->letter_type === 'recommendation')
                        Rekomendasi
                    @elseif($letter->letter_type === 'active_certificate')
                        Keterangan Aktif
                    @elseif($letter->letter_type === 'assignment')
                        Surat Tugas
                    @endif
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Nama yang Bersangkutan</div>
                <div class="col-sm-8 text-dark">{{ $letter->related_name }}</div>
            </div>
            <div class="row mb-4">
                <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Tujuan / Alasan</div>
                <div class="col-sm-8 text-dark">{{ $letter->purpose }}</div>
            </div>
            <div class="row mb-4">
                <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Ditujukan Kepada</div>
                <div class="col-sm-8 text-dark">{{ $letter->addressed_to }}</div>
            </div>
            <div class="row mb-4">
                <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Isi Surat</div>
                <div class="col-sm-8 text-dark" style="white-space: pre-wrap;">{{ $letter->letter_body }}</div>
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

            {{-- Surat Tugas-specific fields --}}
            @if($letter->letter_type === 'assignment')
                <div class="row mb-4 pt-3" style="border-top: 1px solid #f1f3f8;">
                    <div class="col-12 mb-3">
                        <span style="font-size: 14px; font-weight: 600; color: #1A2744;">Detail Penugasan</span>
                    </div>
                </div>
                @if($letter->event_name)
                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Nama Acara</div>
                        <div class="col-sm-8 text-dark">{{ $letter->event_name }}</div>
                    </div>
                @endif
                @if($letter->event_date)
                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Tanggal Acara</div>
                        <div class="col-sm-8 text-dark">{{ $letter->event_date->format('d F Y') }}</div>
                    </div>
                @endif
                @if($letter->event_location)
                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Lokasi Acara</div>
                        <div class="col-sm-8 text-dark">{{ $letter->event_location }}</div>
                    </div>
                @endif
            @endif

            <div class="row mb-4">
                <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Tanggal Diajukan</div>
                <div class="col-sm-8 text-dark">{{ $letter->created_at->format('d F Y, H:i') }}</div>
            </div>

            {{-- File Lampiran was moved to iframe below --}}

        </div>
    </div>

    {{-- Tampilan Surat / Lampiran --}}
    @if(in_array($letter->status, ['approved', 'sent']))
        <div class="card mb-4">
            <div class="card-header bg-white p-4" style="border-bottom: 1px solid #f1f3f8;">
                <h4 class="mb-0">Tampilan Surat</h4>
            </div>
            <div class="card-body p-0">
                <iframe src="{{ route('user.outgoing-letters.print', $letter->id) }}" width="100%" height="800px" style="border: none; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;"></iframe>
            </div>
        </div>
    @elseif($letter->file_path)
        <div class="card mb-4">
            <div class="card-header bg-white p-4" style="border-bottom: 1px solid #f1f3f8;">
                <h4 class="mb-0">File Lampiran</h4>
            </div>
            <div class="card-body p-0">
                <iframe src="{{ asset('storage/' . $letter->file_path) }}" width="100%" height="800px" style="border: none; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;"></iframe>
            </div>
        </div>
    @endif
</div>

<div class="col-lg-4">
    <div class="card mb-4">
        <div class="card-header bg-white">
            <h4>Status & Aksi</h4>
        </div>
        <div class="card-body p-4">
            @if($letter->status === 'draft')
                <a href="{{ route('user.outgoing-letters.edit', $letter->id) }}" class="btn btn-primary w-100 mb-3" style="height: 40px; border-radius: 6px; background-color: #066FD1; border-color: #066FD1;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>Ubah Surat
                </a>
                <form action="{{ route('user.outgoing-letters.destroy', $letter->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus surat ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger w-100" style="height: 40px; border-radius: 6px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        </svg>
                        Hapus Surat
                    </button>
                </form>
            @elseif($letter->status === 'pending_approval')
                <div class="text-center py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#D97706" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <p class="mt-3" style="font-size: 13px; color: #6A7380;">
                        Surat ini sedang menunggu persetujuan dari Admin.
                    </p>
                </div>
            @elseif(in_array($letter->status, ['approved', 'sent']))
                <div class="text-center py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    <p class="mt-3 mb-3" style="font-size: 13px; color: #6A7380;">
                        Surat ini telah {{ $letter->status === 'approved' ? 'disetujui' : 'terkirim' }}.
                    </p>
                    <a href="{{ route('user.outgoing-letters.print', $letter->id) }}" target="_blank" class="btn btn-primary w-100 mb-3" style="height: 40px; border-radius: 6px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                            <polyline points="6 9 6 2 18 2 18 9"></polyline>
                            <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                            <rect x="6" y="14" width="12" height="8"></rect>
                        </svg>
                        Cetak Surat
                    </a>
                </div>
            @elseif($letter->status === 'rejected')
                <div class="text-center py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#DC2626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                    <p class="mt-3 mb-2" style="font-size: 13px; color: #6A7380;">
                        Surat ini telah ditolak.
                    </p>
                    <div class="p-3 text-start mb-3" style="background-color: #FEE2E2; border-radius: 6px; border: 1px solid #FECACA;">
                        <strong style="color: #991B1B; font-size: 13px;">Alasan:</strong>
                        <p class="mb-0 mt-1" style="color: #991B1B; font-size: 13px;">{{ $letter->rejection_note }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
</div>
@endsection
