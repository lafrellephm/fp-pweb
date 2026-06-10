@extends('layouts.admin')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('page-title', 'Add Incoming Letter')

@section('page-content')
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-4 mt-3">
        <div>
            <h2 style="font-size: 20px; font-weight: 600; color: #4E5967; margin: 0 0 8px 0;">Add Incoming Letter</h2>
            <p style="font-size: 14px; color: #6A7380; margin: 0;">Register a new incoming letter to the system.</p>
        </div>
        <a href="{{ route('admin.incoming-letters.index') }}" class="btn btn-outline-secondary" style="height: 40px; border-radius: 6px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Back to Letters
        </a>
    </div>

    <div class="card" style="border-radius: 12px; border: 1px solid rgba(1,61,209,0.12); box-shadow: 0 1px 4px rgba(0,0,0,0.06); max-width: 800px;">
        <div class="card-body" style="padding: 32px;">
            <form action="{{ route('admin.incoming-letters.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="letter_number" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Letter Number <span class="text-danger">*</span></label>
                        <input type="text" name="letter_number" id="letter_number" class="form-control @error('letter_number') is-invalid @enderror" style="height: 38px; border-radius: 6px;" value="{{ old('letter_number') }}" required>
                        @error('letter_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="letter_type" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Letter Type <span class="text-danger">*</span></label>
                        <select name="letter_type" id="letter_type" class="form-select @error('letter_type') is-invalid @enderror" style="height: 38px; border-radius: 6px;" required>
                            <option value="" disabled selected>Select type</option>
                            <option value="invitation" {{ old('letter_type') == 'invitation' ? 'selected' : '' }}>Invitation</option>
                            <option value="announcement" {{ old('letter_type') == 'announcement' ? 'selected' : '' }}>Announcement</option>
                        </select>
                        @error('letter_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="letter_date" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Letter Date <span class="text-danger">*</span></label>
                        <input type="date" name="letter_date" id="letter_date" class="form-control @error('letter_date') is-invalid @enderror" style="height: 38px; border-radius: 6px;" value="{{ old('letter_date') }}" required>
                        @error('letter_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="received_date" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Received Date <span class="text-danger">*</span></label>
                        <input type="date" name="received_date" id="received_date" class="form-control @error('received_date') is-invalid @enderror" style="height: 38px; border-radius: 6px;" value="{{ old('received_date', date('Y-m-d')) }}" required>
                        @error('received_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="sender" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Sender <span class="text-danger">*</span></label>
                    <input type="text" name="sender" id="sender" class="form-control @error('sender') is-invalid @enderror" style="height: 38px; border-radius: 6px;" value="{{ old('sender') }}" required>
                    @error('sender')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="subject" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Subject <span class="text-danger">*</span></label>
                    <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" style="height: 38px; border-radius: 6px;" value="{{ old('subject') }}" required>
                    @error('subject')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="file_path" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">File Attachment (Optional)</label>
                    <input type="file" name="file_path" id="file_path" class="form-control @error('file_path') is-invalid @enderror" style="height: 38px; border-radius: 6px;" accept=".pdf,.jpg,.jpeg,.png">
                    <div class="form-text mt-1">Accepted formats: PDF, JPG, PNG. Max size: 2MB.</div>
                    @error('file_path')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end pt-3" style="border-top: 1px solid #f1f3f8;">
                    <a href="{{ route('admin.incoming-letters.index') }}" class="btn btn-link text-muted me-3" style="text-decoration: none; height: 40px; border-radius: 6px;">Cancel</a>
                    <button type="submit" class="btn btn-primary px-4" style="height: 40px; border-radius: 6px; background-color: #066FD1; border-color: #066FD1;">Save Letter</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
