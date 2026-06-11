@extends('layouts.user')

@section('page-title', 'Buat Surat Baru')

@section('page-content')
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-4 mt-3">
        <div>
            <h2 style="font-size: 20px; font-weight: 600; color: #4E5967; margin: 0 0 8px 0;">Buat Surat Baru</h2>
            <p style="font-size: 14px; color: #6A7380; margin: 0;">Isi formulir di bawah ini untuk mengajukan surat keluar baru.</p>
        </div>
        <a href="{{ route('user.outgoing-letters.index') }}" class="btn btn-outline-secondary" style="height: 40px; border-radius: 6px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>Kembali ke Surat Saya</a>
    </div>

    <div class="card" style="border-radius: 12px; border: 1px solid rgba(1,61,209,0.12); box-shadow: 0 1px 4px rgba(0,0,0,0.06); max-width: 800px;">
        <div class="card-body" style="padding: 32px;">
            <form action="{{ route('user.outgoing-letters.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Section 1: Letter Type --}}
                <div class="mb-4 pb-3" style="border-bottom: 1px solid #f1f3f8;">
                    <h3 style="font-size: 16px; font-weight: 600; color: #1A2744; margin-bottom: 16px;">Jenis Surat</h3>
                    <div class="mb-3">
                        <label for="letter_type" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Jenis Surat<span class="text-danger">*</span></label>
                        <select name="letter_type" id="letter_type" class="form-select @error('letter_type') is-invalid @enderror" style="height: 38px; border-radius: 6px;" required>
                            <option value="" disabled {{ old('letter_type') ? '' : 'selected' }}>Pilih jenis surat</option>
                            <option value="recommendation" {{ old('letter_type') == 'recommendation' ? 'selected' : '' }}>Surat Rekomendasi</option>
                            <option value="active_certificate" {{ old('letter_type') == 'active_certificate' ? 'selected' : '' }}>Keterangan Anggota Aktif</option>
                            <option value="assignment" {{ old('letter_type') == 'assignment' ? 'selected' : '' }}>Surat Tugas</option>
                        </select>
                        @error('letter_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Section 2: General Fields --}}
                <div class="mb-4 pb-3" style="border-bottom: 1px solid #f1f3f8;">
                    <h3 style="font-size: 16px; font-weight: 600; color: #1A2744; margin-bottom: 16px;">Detail Surat</h3>

                    <div class="mb-3">
                        <label for="related_name" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Nama yang Bersangkutan<span class="text-danger">*</span></label>
                        <input type="text" name="related_name" id="related_name" class="form-control @error('related_name') is-invalid @enderror" style="height: 38px; border-radius: 6px;" value="{{ old('related_name') }}" required>
                        @error('related_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="purpose" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Tujuan / Alasan<span class="text-danger">*</span></label>
                        <input type="text" name="purpose" id="purpose" class="form-control @error('purpose') is-invalid @enderror" style="height: 38px; border-radius: 6px;" value="{{ old('purpose') }}" required>
                        @error('purpose')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="addressed_to" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Ditujukan Kepada<span class="text-danger">*</span></label>
                        <input type="text" name="addressed_to" id="addressed_to" class="form-control @error('addressed_to') is-invalid @enderror" style="height: 38px; border-radius: 6px;" value="{{ old('addressed_to') }}" required>
                        @error('addressed_to')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="letter_body" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Isi Surat<span class="text-danger">*</span></label>
                        <textarea name="letter_body" id="letter_body" class="form-control @error('letter_body') is-invalid @enderror" rows="5" required>{{ old('letter_body') }}</textarea>
                        @error('letter_body')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="file_path" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Dokumen Pendukung (PDF/Gambar)</label>
                        <input type="file" name="file_path" id="file_path" class="form-control @error('file_path') is-invalid @enderror" style="height: 38px; border-radius: 6px;" accept=".pdf,.jpg,.jpeg,.png">
                        <div class="form-text mt-1">Format yang diterima: PDF, JPG, PNG. Ukuran maksimal: 2MB.</div>
                        @error('file_path')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Section 3: Assignment Fields (conditionally visible) --}}
                <div id="assignment-fields" class="mb-4 pb-3" style="border-bottom: 1px solid #f1f3f8; display: none;">
                    <h3 style="font-size: 16px; font-weight: 600; color: #1A2744; margin-bottom: 16px;">Detail Penugasan</h3>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="event_name" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Nama Acara</label>
                            <input type="text" name="event_name" id="event_name" class="form-control @error('event_name') is-invalid @enderror" style="height: 38px; border-radius: 6px;" value="{{ old('event_name') }}">
                            @error('event_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="event_date" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Tanggal Acara</label>
                            <input type="date" name="event_date" id="event_date" class="form-control @error('event_date') is-invalid @enderror" style="height: 38px; border-radius: 6px;" value="{{ old('event_date') }}">
                            @error('event_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="event_location" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Lokasi Acara</label>
                        <input type="text" name="event_location" id="event_location" class="form-control @error('event_location') is-invalid @enderror" style="height: 38px; border-radius: 6px;" value="{{ old('event_location') }}">
                        @error('event_location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Submit / Cancel --}}
                <div class="d-flex justify-content-end pt-3">
                    <a href="{{ route('user.outgoing-letters.index') }}" class="btn btn-link text-muted me-3" style="text-decoration: none; height: 40px; border-radius: 6px;">Batal</a>
                    <button type="submit" class="btn btn-primary px-4" style="height: 40px; border-radius: 6px; background-color: #066FD1; border-color: #066FD1;">Buat Surat</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const letterType = document.getElementById('letter_type');
    const assignmentFields = document.getElementById('assignment-fields');

    function toggleAssignmentFields() {
        if (letterType.value === 'assignment') {
            assignmentFields.style.display = 'block';
        } else {
            assignmentFields.style.display = 'none';
        }
    }

    letterType.addEventListener('change', toggleAssignmentFields);
    toggleAssignmentFields(); // run on page load
</script>
@endpush
