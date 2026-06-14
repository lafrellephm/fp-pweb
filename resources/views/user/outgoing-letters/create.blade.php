@extends('layouts.user')

@section('page-title', 'Buat Surat Baru')

@section('page-content')
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-4 mt-3">
        <div>
            <h2>Buat Surat Baru</h2>
            <p class="m-0" style="font-size: 14px; color: #6A7380; ">Isi formulir di bawah ini untuk mengajukan surat keluar baru.</p>
        </div>
        <a href="{{ route('user.outgoing-letters.index') }}" class="btn btn-outline-secondary py-2" >
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>Kembali ke Surat Saya</a>
    </div>

    <div class="card card-custom card-form">
        <div class="card-body p-4 p-md-5\">
            <form action="{{ route('user.outgoing-letters.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Section 1: Letter Jenis --}}
                <div class="mb-4 pb-3" style="border-bottom: 1px solid #f1f3f8;">
                    <h4>Detail Surat</h4>
                    <div class="mb-3">
                        <label for="urgency" class="form-label">Tingkat Urgensi<span class="text-danger">*</span></label>
                        <select name="urgency" id="urgency" class="form-select @error('urgency') is-invalid @enderror" style="height: 38px; border-radius: 6px;" required>
                            <option value="normal" {{ old('urgency') == 'normal' ? 'selected' : '' }}>Normal</option>
                            <option value="urgent" {{ old('urgency') == 'urgent' ? 'selected' : '' }}>Mendesak</option>
                            <option value="critical" {{ old('urgency') == 'critical' ? 'selected' : '' }}>Kritis</option>
                        </select>
                        @error('urgency')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="letter_type" class="form-label">Jenis Surat<span class="text-danger">*</span></label>
                        <select name="letter_type" id="letter_type" class="form-select @error('letter_type') is-invalid @enderror" style="height: 38px; border-radius: 6px;" required>
                            <option value="" disabled {{ old('letter_type') ? '' : 'selected' }}>Pilih jenis surat</option>
                            <option value="recommendation" {{ old('letter_type') == 'recommendation' ? 'selected' : '' }}>Rekomendasi</option>
                            <option value="active_certificate" {{ old('letter_type') == 'active_certificate' ? 'selected' : '' }}>Keterangan Aktif</option>
                            <option value="assignment" {{ old('letter_type') == 'assignment' ? 'selected' : '' }}>Surat Tugas</option>
                        </select>
                        @error('letter_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Section 2: General Fields --}}
                <div class="mb-4 pb-3" style="border-bottom: 1px solid #f1f3f8;">
                    <div class="mb-3">
                        <label for="related_name" class="form-label" >Nama yang Bersangkutan<span class="text-danger">*</span></label>
                        <input type="text" name="related_name" id="related_name" class="form-control @error('related_name') is-invalid @enderror" style="height: 38px; border-radius: 6px;" value="{{ old('related_name') }}" required>
                        @error('related_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="purpose" class="form-label" >Tujuan / Alasan<span class="text-danger">*</span></label>
                        <input type="text" name="purpose" id="purpose" class="form-control @error('purpose') is-invalid @enderror" style="height: 38px; border-radius: 6px;" value="{{ old('purpose') }}" required>
                        @error('purpose')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="addressed_to" class="form-label" >Ditujukan Kepada<span class="text-danger">*</span></label>
                        <input type="text" name="addressed_to" id="addressed_to" class="form-control @error('addressed_to') is-invalid @enderror" style="height: 38px; border-radius: 6px;" value="{{ old('addressed_to') }}" required>
                        @error('addressed_to')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="letter_body" class="form-label" >Isi/Keterangan Tambahan<span class="text-danger">*</span></label>
                        <textarea name="letter_body" id="letter_body" class="form-control @error('letter_body') is-invalid @enderror" rows="5" required>{{ old('letter_body') }}</textarea>
                        @error('letter_body')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="file_path" class="form-label" >Dokumen Pendukung (PDF/Gambar)</label>
                        <input type="file" name="file_path" id="file_path" class="form-control @error('file_path') is-invalid @enderror" style="height: 38px; border-radius: 6px;" accept=".pdf,.jpg,.jpeg,.png">
                        <div class="form-text mt-1">Format yang diterima: PDF, JPG, PNG. Ukuran maksimal: 2MB.</div>
                        @error('file_path')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Section 3: Surat Tugas Fields (conditionally visible) --}}
                <div id="assignment-fields" class="mb-4 pb-3" style="border-bottom: 1px solid #f1f3f8; display: none;">
                    <h4 >Detail Penugasan</h4>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="event_name" class="form-label" >Nama Acara</label>
                            <input type="text" name="event_name" id="event_name" class="form-control @error('event_name') is-invalid @enderror" style="height: 38px; border-radius: 6px;" value="{{ old('event_name') }}">
                            @error('event_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="event_date" class="form-label" >Tanggal Acara</label>
                            <input type="date" name="event_date" id="event_date" class="form-control @error('event_date') is-invalid @enderror" style="height: 38px; border-radius: 6px;" value="{{ old('event_date') }}">
                            @error('event_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="event_location" class="form-label" >Lokasi Acara</label>
                        <input type="text" name="event_location" id="event_location" class="form-control @error('event_location') is-invalid @enderror" style="height: 38px; border-radius: 6px;" value="{{ old('event_location') }}">
                        @error('event_location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Kirim / Batal --}}
                <div class="d-flex justify-content-end">
                    <a href="{{ route('user.outgoing-letters.index') }}" class="btn btn-danger text-white me-3">Batal</a>
                    <button type="submit" class="btn btn-primary px-4" style="height: 40px; border-radius: 6px; background-color: #066FD1; border-color: #066FD1;">Buat Surat</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/assignment-toggle.js') }}"></script>
@endsection

