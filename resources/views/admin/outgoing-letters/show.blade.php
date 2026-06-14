@extends('layouts.admin')

@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('page-title', 'Outgoing Letter Detail')

@section('page-content')
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-4 mt-3">
        <div>
            <h2>Detail Surat Keluar</h2>
        </div>
        <a href="{{ route('admin.outgoing-letters.index') }}" class="btn btn-outline-secondary">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Kembali ke Surat
        </a>
    </div>


    {{-- Rejection Note Alert --}}
    @if($letter->status === 'rejected' && $letter->rejection_note)
        <div class="alert mb-4\" role="alert" class="py-3 px-4" style="background-color: #FEE2E2; border: 1px solid #FECACA; color: #991B1B; border-radius: 8px;  ">
            <div class="d-flex align-items-start">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-3 flex-shrink-0 mt-1">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="15" y1="9" x2="9" y2="15"></line>
                    <line x1="9" y1="9" x2="15" y2="15"></line>
                </svg>
                <div>
                    <strong style="font-size: 14px; font-weight: 600;">Rejection Note</strong>
                    <p class="mt-1" style=" font-size: 14px;">{{ $letter->rejection_note }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <!-- Detail Surat -->
        <div class="col-lg-8 mb-4">
            <div class="card card-custom">
                <div class="card-header bg-white p4" style="border-bottom: 1px solid #f1f3f8; ">
                    <div class="d-flex justify-content-between py-2 m-2">
                        <h3>Informasi Surat</h3>
                        <div>
                            <x-status-badge :status="$letter->status" />
                        </div>
                    </div>
                </div>
                <div class="card-body p-4\">
                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Diajukan Oleh</div>
                        <div class="col-sm-8">
                            <span style="font-weight: 600; color: #1A2744;">{{ $letter->createdBy->name ?? '-' }}</span>
                            @if($letter->createdBy)
                                <br><span style="font-size: 13px; color: #6A7380;">{{ $letter->createdBy->email }}</span>
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
                                Rekomendasi
                            @elseif($letter->letter_type === 'active_certificate')
                                Keterangan Aktif
                            @elseif($letter->letter_type === 'assignment')
                                Surat Tugas
                            @else
                                {{ ucfirst($letter->letter_type) }}
                            @endif
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Related Nama</div>
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
                        <div class="row mb-4 pt-3" style="border-top: 1px solid #f1f3f8; ">
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

                    <div class="row mb-4 pt-3" style="border-top: 1px solid #f1f3f8; ">
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
                                    Lihat Lampiran
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Aksi Panel -->
        <div class="col-lg-4 mb-4">
            <div class="card card-custom">
                <div class="card-header bg-white p-4" style="border-bottom: 1px solid #f1f3f8; ">
                    <h3 >Persetujuan Surat</h3>
                </div>
                <div class="card-body p-4">
                    @if($letter->status === 'draft')
                        <a href="{{ route('admin.outgoing-letters.process', $letter->id) }}" id="btn-process" class="btn btn-success w-100 mb-3" style="height: 40px; border-radius: 6px; color: #FFFFFF;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            Setujui & Beri Nomor
                        </a>

                        <button type="button" class="btn btn-danger w-100 mb-3" data-bs-toggle="modal" data-bs-target="#rejectModal" style="height: 40px; border-radius: 6px; font-size: 14px; font-weight: 500;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="15" y1="9" x2="9" y2="15"></line>
                                <line x1="9" y1="9" x2="15" y2="15"></line>
                            </svg>
                            Tolak
                        </button>
                    @endif

                    @if($letter->status === 'approved')
                        <button type="button" class="btn btn-success w-100 mb-3" data-bs-toggle="modal" data-bs-target="#sentModal" style="height: 40px; border-radius: 6px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                <line x1="22" y1="2" x2="11" y2="13"></line>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                            </svg>Tandai Terkirim
                        </button>
                        <a href="{{ route('admin.outgoing-letters.print', $letter->id) }}" target="_blank" class="btn btn-primary w-100 mb-3" style="height: 40px; border-radius: 6px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                                <rect x="6" y="14" width="12" height="8"></rect>
                            </svg>
                            Cetak Surat
                        </a>
                    @endif

                    @if($letter->status === 'sent')
                        <a href="{{ route('admin.outgoing-letters.print', $letter->id) }}" target="_blank" class="btn btn-primary w-100 mb-3" style="height: 40px; border-radius: 6px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                                <rect x="6" y="14" width="12" height="8"></rect>
                            </svg>
                            Cetak Surat
                        </a>
                    @endif

                    @if($letter->status === 'pending_approval')
                        <button type="button" class="btn btn-success w-100 mb-3" data-bs-toggle="modal" data-bs-target="#approveModal" style="height: 40px; border-radius: 6px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            Setujui Surat
                        </button>

                        <button type="button" class="btn btn-danger w-100 mb-3" data-bs-toggle="modal" data-bs-target="#rejectModal" style="height: 40px; border-radius: 6px; font-size: 14px; font-weight: 500;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="15" y1="9" x2="9" y2="15"></line>
                                <line x1="9" y1="9" x2="15" y2="15"></line>
                            </svg>
                            Tolak
                        </button>
                    @endif

                    @if($letter->status === 'rejected')
                        <div class="text-center py-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#9BA3AF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            <p class="mt-3" style="font-size: 13px; color: #6A7380; ">
                                Surat ini telah ditolak. Pengguna dapat merevisi dan mengajukan ulang.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Approve Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title" id="approveModalLabel" style="font-weight: 600;">Konfirmasi Persetujuan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p style="color: #4E5967;">Apakah Anda yakin ingin menyetujui surat ini?</p>
      </div>
      <div class="modal-footer border-0 pt-0">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius: 6px;">Batal</button>
        <form method="POST" action="{{ route('admin.outgoing-letters.approve', $letter->id) }}" class="m-0">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-success" style="border-radius: 6px;">Setujui Surat</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Sent Modal -->
<div class="modal fade" id="sentModal" tabindex="-1" aria-labelledby="sentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title" id="sentModalLabel" style="font-weight: 600;">Konfirmasi Terkirim</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p style="color: #4E5967;">Apakah Anda yakin ingin menandai surat ini sebagai terkirim?</p>
      </div>
      <div class="modal-footer border-0 pt-0">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius: 6px;">Batal</button>
        <form method="POST" action="{{ route('admin.outgoing-letters.sent', $letter->id) }}" class="m-0">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-success" style="border-radius: 6px;">Tandai Terkirim</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title" id="rejectModalLabel" style="font-weight: 600;">Penolakan Surat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="{{ route('admin.outgoing-letters.reject', $letter->id) }}">
          @csrf
          @method('PATCH')
          <div class="modal-body">
              <div class="mb-3">
                  <label for="rejection_note" class="form-label" style="font-weight: 500; color: #4E5967; font-size: 14px;">Catatan Penolakan <span style="color: #EF4444;">*</span></label>
                  <textarea name="rejection_note" id="rejection_note" class="form-control p-2" rows="4" required maxlength="1000" placeholder="Tulis alasan penolakan surat ini..." style="border-radius: 6px; border: 1px solid rgba(1, 61, 209, 0.08); min-height: 120px; font-size: 14px; resize: vertical;">{{ old('rejection_note') }}</textarea>
                  <div class="form-text mt-1" style="font-size: 12px; color: #9BA3AF;">Maksimal 1000 karakter</div>
              </div>
          </div>
          <div class="modal-footer border-0 pt-0">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius: 6px;">Batal</button>
            <button type="submit" class="btn btn-danger" style="border-radius: 6px;">Konfirmasi Tolak</button>
          </div>
      </form>
    </div>
  </div>
</div>

@endsection
