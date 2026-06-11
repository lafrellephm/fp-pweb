@extends('layouts.admin')

@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('page-title', 'Review Surat Keluar')

@section('page-content')
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-4 mt-3">
        <div>
            <h2 style="font-size: 20px; font-weight: 600; color: #4E5967; margin: 0 0 8px 0;">Review Surat Keluar</h2>
            <p style="font-size: 14px; color: #6A7380; margin: 0;">Tinjau surat ini sebelum menyetujui atau menolak.</p>
        </div>
        <a href="{{ route('admin.outgoing-letters.show', $letter->id) }}" class="btn btn-outline-secondary" style="height: 40px; border-radius: 6px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Kembali ke Detail
        </a>
    </div>

    @if($errors->any())
        <div class="alert" role="alert" style="background-color: #FEE2E2; border: 1px solid #FECACA; color: #991B1B; border-radius: 8px; padding: 16px 20px; margin-bottom: 20px;">
            <ul class="mb-0" style="font-size: 14px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        {{-- Letter Summary Card --}}
        <div class="col-lg-8 mb-4">
            <div class="card h-100" style="border-radius: 12px; border: 1px solid rgba(1,61,209,0.12); box-shadow: rgba(0, 0, 0, 0.06) 0px 20px 25px -5px, rgba(0, 0, 0, 0.04) 0px 10px 10px -5px; padding: 0;">
                <div class="card-header bg-white" style="border-bottom: 1px solid #f1f3f8; padding: 20px 24px; border-radius: 12px 12px 0 0;">
                    <div class="d-flex align-items-center justify-content-between">
                        <h3 class="card-title m-0" style="font-weight: 600; font-size: 16px; color: #1A2744;">Informasi Surat</h3>
                        <span class="status-badge status-menunggu_approval">Menunggu Persetujuan</span>
                    </div>
                </div>
                <div class="card-body" style="padding: 24px;">
                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Nama Terkait</div>
                        <div class="col-sm-8" style="font-weight: 600; color: #1A2744;">{{ $letter->related_name }}</div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Keperluan</div>
                        <div class="col-sm-8 text-dark">{{ $letter->purpose }}</div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Ditujukan Kepada</div>
                        <div class="col-sm-8 text-dark">{{ $letter->addressed_to }}</div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Nomor Surat</div>
                        <div class="col-sm-8" style="font-weight: 600; color: #1A2744;">{{ $letter->letter_number }}</div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Tanggal Surat</div>
                        <div class="col-sm-8 text-dark">{{ $letter->letter_date->format('d F Y') }}</div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Jenis Surat</div>
                        <div class="col-sm-8 text-dark">
                            @if($letter->letter_type === 'recommendation')
                                Surat Rekomendasi
                            @elseif($letter->letter_type === 'active_certificate')
                                Surat Keterangan Aktif
                            @elseif($letter->letter_type === 'assignment')
                                Surat Tugas
                            @else
                                {{ ucfirst($letter->letter_type) }}
                            @endif
                        </div>
                    </div>

                    @if($letter->letter_type === 'assignment')
                        <div class="row mb-4" style="border-top: 1px solid #f1f3f8; padding-top: 16px;">
                            <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Nama Kegiatan</div>
                            <div class="col-sm-8 text-dark">{{ $letter->event_name ?? '-' }}</div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Tanggal Kegiatan</div>
                            <div class="col-sm-8 text-dark">{{ $letter->event_date ? $letter->event_date->format('d F Y') : '-' }}</div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Lokasi Kegiatan</div>
                            <div class="col-sm-8 text-dark">{{ $letter->event_location ?? '-' }}</div>
                        </div>
                    @endif

                    <div class="row mb-4" style="border-top: 1px solid #f1f3f8; padding-top: 16px;">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Isi Surat</div>
                        <div class="col-sm-8 text-dark" style="white-space: pre-wrap;">{{ $letter->letter_body }}</div>
                    </div>

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
                                    Lihat Lampiran
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Decision Card --}}
        <div class="col-lg-4 mb-4">
            <div class="card" style="border-radius: 12px; border: 1px solid rgba(1,61,209,0.12); box-shadow: rgba(0, 0, 0, 0.06) 0px 20px 25px -5px, rgba(0, 0, 0, 0.04) 0px 10px 10px -5px; padding: 0;">
                <div class="card-header bg-white" style="border-bottom: 1px solid #f1f3f8; padding: 20px 24px; border-radius: 12px 12px 0 0;">
                    <h3 class="card-title m-0" style="font-weight: 600; font-size: 16px; color: #1A2744;">Keputusan</h3>
                </div>
                <div class="card-body" style="padding: 24px;">
                    {{-- Setujui Form --}}
                    <form method="POST" action="{{ route('admin.outgoing-letters.approve', $letter->id) }}" id="approve-form" class="mb-3">
                        @csrf
                        @method('PATCH')
                        <button type="submit" id="btn-approve" class="btn w-100" style="height: 40px; border-radius: 6px; background-color: #10B981; color: #FFFFFF; border: none; font-size: 14px; font-weight: 500;" onclick="return confirm('Apakah Anda yakin ingin menyetujui surat ini?')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            Setujui
                        </button>
                    </form>

                    {{-- Tolak Section --}}
                    <button type="button" id="btn-show-reject" class="btn w-100 mb-3" style="height: 40px; border-radius: 6px; background-color: #EF4444; color: #FFFFFF; border: none; font-size: 14px; font-weight: 500;" onclick="showRejectForm()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="15" y1="9" x2="9" y2="15"></line>
                            <line x1="9" y1="9" x2="15" y2="15"></line>
                        </svg>
                        Tolak
                    </button>

                    {{-- Tolak Form (hidden by default) --}}
                    <form method="POST" action="{{ route('admin.outgoing-letters.reject', $letter->id) }}" id="reject-form" style="display: none;">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="rejection_note" class="form-label" style="font-weight: 500; color: #4E5967;">Catatan Penolakan <span style="color: #EF4444;">*</span></label>
                            <textarea name="rejection_note" id="rejection_note" class="form-control" rows="4" required maxlength="1000" placeholder="Tulis alasan penolakan surat ini..." style="border-radius: 6px; border: 1px solid rgba(1, 61, 209, 0.08); min-height: 120px; padding: 12px; font-size: 14px; resize: vertical;">{{ old('rejection_note') }}</textarea>
                            <div class="form-text" style="font-size: 12px; color: #9BA3AF; margin-top: 4px;">Maksimal 1000 karakter</div>
                        </div>
                        <button type="submit" id="btn-confirm-reject" class="btn w-100" style="height: 40px; border-radius: 6px; background-color: #EF4444; color: #FFFFFF; border: none; font-size: 14px; font-weight: 500;" onclick="return confirm('Apakah Anda yakin ingin menolak surat ini?')">
                            Konfirmasi Tolak
                        </button>
                        <button type="button" class="btn btn-outline-secondary w-100 mt-2" style="height: 40px; border-radius: 6px; font-size: 14px; font-weight: 500;" onclick="hideRejectForm()">
                            Batal
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showRejectForm() {
        document.getElementById('reject-form').style.display = 'block';
        document.getElementById('btn-show-reject').style.display = 'none';
        document.getElementById('btn-approve').closest('form').style.display = 'none';
        document.getElementById('rejection_note').focus();
    }

    function hideRejectForm() {
        document.getElementById('reject-form').style.display = 'none';
        document.getElementById('btn-show-reject').style.display = 'block';
        document.getElementById('btn-approve').closest('form').style.display = 'block';
    }
</script>
@endsection
