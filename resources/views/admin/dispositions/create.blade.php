@extends('layouts.admin')

@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('page-title', 'Buat Disposisi')

@section('page-content')
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-4 mt-3">
        <div>
            <h2>Buat Disposisi</h2>
            <p class="m-0" style="font-size: 14px; color: #6A7380; ">Buat disposisi baru untuk surat masuk.</p>
        </div>
        <a href="{{ route('admin.dispositions.index') }}" class="btn btn-outline-secondary" style="height: 40px; border-radius: 6px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Kembali ke Disposisi
        </a>
    </div>

    <div class="card" style="border-radius: 12px; border: 1px solid rgba(1,61,209,0.12); box-shadow: 0 1px 4px rgba(0,0,0,0.06); max-width: 800px;">
        <div class="card-body p-4 p-md-5\">
            <form action="{{ route('admin.dispositions.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="incoming_letter_id" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Surat Masuk <span class="text-danger">*</span></label>
                    <select name="incoming_letter_id" id="incoming_letter_id" class="form-select @error('incoming_letter_id') is-invalid @enderror" style="height: 38px; border-radius: 6px;" required>
                        <option value="" disabled {{ old('incoming_letter_id', $selectedLetterId) ? '' : 'selected' }}>Pilih surat masuk</option>
                        @foreach($incomingLetters as $letter)
                            <option value="{{ $letter->id }}" {{ (int) old('incoming_letter_id', $selectedLetterId) === $letter->id ? 'selected' : '' }}>
                                {{ $letter->letter_number }} â€” {{ $letter->subject }}
                            </option>
                        @endforeach
                    </select>
                    @error('incoming_letter_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="assigned_to" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Ditujukan Kepada <span class="text-danger">*</span></label>
                    <select name="assigned_to" id="assigned_to" class="form-select @error('assigned_to') is-invalid @enderror" style="height: 38px; border-radius: 6px;" required>
                        <option value="" disabled {{ old('assigned_to') ? '' : 'selected' }}>Pilih pengguna</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ (int) old('assigned_to') === $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('assigned_to')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="instructions" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Instruksi <span class="text-danger">*</span></label>
                    <textarea name="instructions" id="instructions" class="form-control @error('instructions') is-invalid @enderror" rows="5" required>{{ old('instructions') }}</textarea>
                    @error('instructions')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end pt-3" style="border-top: 1px solid #f1f3f8;">
                    <a href="{{ route('admin.dispositions.index') }}" class="btn btn-link text-muted me-3" style="text-decoration: none; height: 40px; border-radius: 6px;">Batal</a>
                    <button type="submit" class="btn btn-primary px-4" style="height: 40px; border-radius: 6px; background-color: #066FD1; border-color: #066FD1;">Simpan Disposisi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
