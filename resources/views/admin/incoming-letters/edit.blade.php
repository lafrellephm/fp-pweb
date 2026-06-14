@extends('layouts.admin')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('page-title', 'Ubah Incoming Letter')

@section('page-content')
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-4 mt-3">
        <div>
            <h2>Ubah Incoming Letter</h2>
            <p class="m-0" style="font-size: 14px; color: #6A7380; ">Perbarui information for this incoming letter.</p>
        </div>
        <a href="{{ route('admin.incoming-letters.index') }}" class="btn btn-outline-secondary" style="height: 40px; border-radius: 6px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Kembali ke Surat
        </a>
    </div>

    <div class="card card-custom card-form">
        <div class="card-body p-4 p-md-5\">
            <form action="{{ route('admin.incoming-letters.update', $letter->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="letter_number" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Nomor Surat<span class="text-danger">*</span></label>
                        <input type="text" name="letter_number" id="letter_number" class="form-control @error('letter_number') is-invalid @enderror" style="height: 38px; border-radius: 6px;" value="{{ old('letter_number', $letter->letter_number) }}" required>
                        @error('letter_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="letter_type" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Jenis Surat<span class="text-danger">*</span></label>
                        <select name="letter_type" id="letter_type" class="form-select @error('letter_type') is-invalid @enderror" style="height: 38px; border-radius: 6px;" required>
                            <option value="undangan" {{ old('letter_type', $letter->letter_type) == 'undangan' ? 'selected' : '' }}>Undangan</option>
                            <option value="pengumuman" {{ old('letter_type', $letter->letter_type) == 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                        </select>
                        @error('letter_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="urgency" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Tingkat Urgensi<span class="text-danger">*</span></label>
                        <select name="urgency" id="urgency" class="form-select @error('urgency') is-invalid @enderror" style="height: 38px; border-radius: 6px;" required>
                            <option value="normal" {{ old('urgency', $letter->urgency) == 'normal' ? 'selected' : '' }}>Normal</option>
                            <option value="urgent" {{ old('urgency', $letter->urgency) == 'urgent' ? 'selected' : '' }}>Mendesak</option>
                            <option value="critical" {{ old('urgency', $letter->urgency) == 'critical' ? 'selected' : '' }}>Kritis</option>
                        </select>
                        @error('urgency')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="letter_date" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Tanggal Surat<span class="text-danger">*</span></label>
                        <input type="date" name="letter_date" id="letter_date" class="form-control @error('letter_date') is-invalid @enderror" style="height: 38px; border-radius: 6px;" value="{{ old('letter_date', $letter->letter_date->format('Y-m-d')) }}" required>
                        @error('letter_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="received_date" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Tanggal Diterima <span class="text-danger">*</span></label>
                        <input type="date" name="received_date" id="received_date" class="form-control @error('received_date') is-invalid @enderror" style="height: 38px; border-radius: 6px;" value="{{ old('received_date', $letter->received_date->format('Y-m-d')) }}" required>
                        @error('received_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="sender" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Pengirim<span class="text-danger">*</span></label>
                    <input type="text" name="sender" id="sender" class="form-control @error('sender') is-invalid @enderror" style="height: 38px; border-radius: 6px;" value="{{ old('sender', $letter->sender) }}" required>
                    @error('sender')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="subject" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Perihal <span class="text-danger">*</span></label>
                    <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" style="height: 38px; border-radius: 6px;" value="{{ old('subject', $letter->subject) }}" required>
                    @error('subject')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="file_path" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Lampiran File (Opsional)</label>
                    <input type="file" name="file_path" id="file_path" class="form-control @error('file_path') is-invalid @enderror" style="height: 38px; border-radius: 6px;" accept=".pdf,.jpg,.jpeg,.png">
                    <div class="form-text mt-1">Leave empty to keep the current file. Accepted formats: PDF, JPG, PNG. Max size: 2MB.</div>
                    
                    @if($letter->file_path)
                        <div class="mt-2">
                            <a href="{{ asset('storage/' . $letter->file_path) }}" target="_blank" class="btn btn-sm btn-warning" style="border-radius: 6px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                </svg>
                                Lihat Current File
                            </a>
                        </div>
                    @endif
                    
                    @error('file_path')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end pt-3" style="border-top: 1px solid #f1f3f8;">
                    <a href="{{ route('admin.incoming-letters.index') }}" class="btn btn-link text-muted me-3" style="text-decoration: none; height: 40px; border-radius: 6px;">Batal</a>
                    <button type="submit" class="btn btn-primary px-4" style="height: 40px; border-radius: 6px; background-color: #066FD1; border-color: #066FD1;">Perbarui Surat</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
