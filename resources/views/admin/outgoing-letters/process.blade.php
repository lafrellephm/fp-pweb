@extends('layouts.admin')

@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('page-title', 'Process Letter')

@section('page-content')
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-4 mt-3">
        <div>
            <h2 style="font-size: 20px; font-weight: 600; color: #4E5967; margin: 0 0 8px 0;">Proses Surat</h2>
            <p style="font-size: 14px; color: #6A7380; margin: 0;">Assign a letter number and date, then forward to Pimpinan for approval.</p>
        </div>
        <a href="{{ route('admin.outgoing-letters.show', $letter->id) }}" class="btn btn-outline-secondary" style="height: 40px; border-radius: 6px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>Batal</a>
    </div>

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="alert" role="alert" style="background-color: #FEE2E2; border: 1px solid #FECACA; color: #991B1B; border-radius: 8px; padding: 16px 20px; margin-bottom: 20px;">
            <strong style="font-size: 14px; font-weight: 600;">Please fix the following errors:</strong>
            <ul style="margin: 8px 0 0 0; padding-left: 20px; font-size: 14px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Letter Summary Card -->
    <div class="card mb-4" style="border-radius: 12px; border: 1px solid rgba(1,61,209,0.12); box-shadow: 0 1px 4px rgba(0,0,0,0.06); background-color: #F8FAFC;">
        <div class="card-header" style="background-color: #F8FAFC; border-bottom: 1px solid #E0E3E8; padding: 20px 24px; border-radius: 12px 12px 0 0;">
            <div class="d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#066FD1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                </svg>
                <h3 class="card-title m-0" style="font-weight: 600; font-size: 16px; color: #1A2744;">Letter Summary</h3>
            </div>
        </div>
        <div class="card-body" style="padding: 24px; background-color: #F8FAFC;">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <div style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Diajukan Oleh</div>
                        <div style="font-size: 14px; font-weight: 500; color: #1A2744;">{{ $letter->submittedBy->name ?? '-' }}</div>
                        @if($letter->submittedBy)
                            <div style="font-size: 13px; color: #6A7380;">{{ $letter->submittedBy->email }}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <div style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Tujuan</div>
                        <div style="font-size: 14px; color: #4E5967;">{{ $letter->purpose }}</div>
                    </div>
                    <div class="mb-3">
                        <div style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Jenis Surat</div>
                        <div style="font-size: 14px; color: #4E5967;">
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
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <div style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Related Name</div>
                        <div style="font-size: 14px; color: #4E5967;">{{ $letter->related_name }}</div>
                    </div>
                    <div class="mb-3">
                        <div style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Ditujukan Kepada</div>
                        <div style="font-size: 14px; color: #4E5967;">{{ $letter->addressed_to }}</div>
                    </div>
                    @if($letter->letter_type === 'assignment')
                        <div class="mb-3">
                            <div style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Event</div>
                            <div style="font-size: 14px; color: #4E5967;">{{ $letter->event_name ?? '-' }}</div>
                            <div style="font-size: 13px; color: #6A7380;">{{ $letter->event_date ? $letter->event_date->format('d F Y') : '-' }} — {{ $letter->event_location ?? '-' }}</div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="mt-2" style="border-top: 1px solid #E0E3E8; padding-top: 16px;">
                <div style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Letter Body</div>
                <div style="font-size: 14px; color: #4E5967; white-space: pre-wrap; background: #FFFFFF; padding: 16px; border-radius: 6px; border: 1px solid rgba(1,61,209,0.08);">{{ $letter->letter_body }}</div>
            </div>
        </div>
    </div>

    <!-- Processing Form -->
    <div class="card" style="border-radius: 12px; border: 1px solid rgba(1,61,209,0.12); box-shadow: 0 1px 4px rgba(0,0,0,0.06);">
        <div class="card-header bg-white" style="border-bottom: 1px solid #f1f3f8; padding: 20px 24px;">
            <div class="d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#066FD1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                </svg>
                <h3 class="card-title m-0" style="font-weight: 600; font-size: 16px; color: #1A2744;">Assign Letter Details</h3>
            </div>
        </div>
        <div class="card-body" style="padding: 24px;">
            <form action="{{ route('admin.outgoing-letters.update', $letter->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="letter_number" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Assign Letter Number <span style="color: #EF4444;">*</span></label>
                        <input type="text" name="letter_number" id="letter_number" class="form-control @error('letter_number') is-invalid @enderror" style="height: 38px; border-radius: 6px;" placeholder="e.g. 001/ORG-PWEB/VI/2026" value="{{ old('letter_number') }}" required>
                        @error('letter_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="letter_date" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Tanggal Surat<span style="color: #EF4444;">*</span></label>
                        <input type="date" name="letter_date" id="letter_date" class="form-control @error('letter_date') is-invalid @enderror" style="height: 38px; border-radius: 6px;" value="{{ old('letter_date', date('Y-m-d')) }}" required>
                        @error('letter_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-3" style="border-top: 1px solid #f1f3f8; padding-top: 20px;">
                    <a href="{{ route('admin.outgoing-letters.show', $letter->id) }}" class="btn btn-secondary" style="height: 40px; border-radius: 6px;">Batal</a>
                    <button type="submit" class="btn btn-primary" style="height: 40px; border-radius: 6px; background-color: #066FD1; border-color: #066FD1;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                            <line x1="22" y1="2" x2="11" y2="13"></line>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                        </svg>
                        Forward to Pimpinan for Approval
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
