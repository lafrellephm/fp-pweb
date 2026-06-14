@extends('layouts.admin')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('page-title', 'Incoming Letter Detail')

@section('page-content')
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-4 mt-3">
        <div>
            <h2>Incoming Letter Detail</h2>
            <p class="m-0" style="font-size: 14px; color: #6A7380; ">Lihat complete details and track dispositions.</p>
        </div>
        <a href="{{ route('admin.incoming-letters.index') }}" class="btn btn-outline-secondary" style="height: 40px; border-radius: 6px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Kembali ke Surat
        </a>
    </div>


    <div class="row">
        <!-- Detail Surat -->
        <div class="col-lg-8 mb-4">
            <div class="card card-custom h-100">
                <div class="card-header bg-white py-4 px-4" style="border-bottom: 1px solid #f1f3f8; ">
                    <div class="d-flex align-items-center justify-content-between">
                        <h3>Informasi Surat</h3>
                            <x-status-badge :status="$letter->status" />
                        </div>
                    </div>
                </div>
                <div class="card-body p-4\">
                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Nomor Surat</div>
                        <div class="col-sm-8" style="font-weight: 600; color: #1A2744;">{{ $letter->letter_number }}</div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Pengirim</div>
                        <div class="col-sm-8 text-dark">{{ $letter->sender }}</div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Perihal</div>
                        <div class="col-sm-8 text-dark">{{ $letter->subject }}</div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Jenis Surat</div>
                        <div class="col-sm-8 text-dark">{{ ucfirst($letter->letter_type) }}</div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Tanggal Surat</div>
                        <div class="col-sm-8 text-dark">{{ $letter->letter_date->format('d F Y') }}</div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Tanggal Diterima</div>
                        <div class="col-sm-8 text-dark">{{ $letter->received_date->format('d F Y') }}</div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Created By</div>
                        <div class="col-sm-8 text-dark">{{ $letter->createdBy->name ?? '-' }}</div>
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

        <!-- Status Perbarui Form -->
        <div class="col-lg-4 mb-4">
            <div class="card card-custom">
                <div class="card-header bg-white py-4 px-4" style="border-bottom: 1px solid #f1f3f8; ">
                    <h3>Perbarui Status</h3>
                </div>
                <div class="card-body p-4\">
                    <form action="{{ route('admin.incoming-letters.status', $letter->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="status" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Current Status</label>
                            <select name="status" id="status" class="form-select" style="height: 38px; border-radius: 6px;">
                                <option value="received" {{ $letter->status === 'received' ? 'selected' : '' }}>Diterima</option>
                                <option value="completed" {{ $letter->status === 'completed' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" style="height: 40px; border-radius: 6px; background-color: #066FD1; border-color: #066FD1;">Perbarui Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Removed Dispositions Section -->
</div>
@endsection
