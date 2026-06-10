@extends('layouts.user')

@section('page-title', 'Letter Detail')

@section('page-content')
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-4 mt-3">
        <div>
            <h2 style="font-size: 20px; font-weight: 600; color: #4E5967; margin: 0 0 8px 0;">Letter Detail</h2>
            <p style="font-size: 14px; color: #6A7380; margin: 0;">View complete details of your submitted letter.</p>
        </div>
        <a href="{{ route('user.outgoing-letters.index') }}" class="btn btn-outline-secondary" style="height: 40px; border-radius: 6px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Back to My Letters
        </a>
    </div>

    {{-- Rejection Alert --}}
    @if($letter->status === 'rejected' && $letter->rejection_note)
        <div class="alert" role="alert" style="background-color: #FEE2E2; border: 1px solid #FECACA; color: #991B1B; border-radius: 8px; padding: 16px 20px; margin-bottom: 20px;">
            <div class="d-flex align-items-start">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-3 flex-shrink-0" style="margin-top: 2px;">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="15" y1="9" x2="9" y2="15"></line>
                    <line x1="9" y1="9" x2="15" y2="15"></line>
                </svg>
                <div>
                    <strong style="font-weight: 600;">Your letter was rejected.</strong>
                    <p style="margin: 4px 0 0 0; font-size: 14px;">Reason: {{ $letter->rejection_note }}</p>
                </div>
            </div>
        </div>
    @endif

    {{-- Letter Detail Card --}}
    <div class="card" style="border-radius: 12px; border: 1px solid rgba(1,61,209,0.12); box-shadow: 0 1px 4px rgba(0,0,0,0.06); max-width: 900px;">
        <div class="card-header bg-white" style="border-bottom: 1px solid #f1f3f8; padding: 20px 24px;">
            <div class="d-flex align-items-center justify-content-between">
                <h3 class="card-title m-0" style="font-weight: 600; font-size: 16px; color: #1A2744;">Letter Information</h3>
                <div>
                    @if($letter->status === 'draft')
                        <span class="status-badge status-draft">Draft</span>
                    @elseif($letter->status === 'pending_approval')
                        <span class="status-badge status-menunggu_approval">Pending Approval</span>
                    @elseif($letter->status === 'approved')
                        <span class="status-badge status-disetujui">Approved</span>
                    @elseif($letter->status === 'rejected')
                        <span class="status-badge status-ditolak">Rejected</span>
                    @elseif($letter->status === 'sent')
                        <span class="status-badge status-terkirim">Sent</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body" style="padding: 24px;">
            <div class="row mb-4">
                <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Letter Type</div>
                <div class="col-sm-8 text-dark">
                    @if($letter->letter_type === 'recommendation')
                        Recommendation Letter
                    @elseif($letter->letter_type === 'active_certificate')
                        Active Member Certificate
                    @elseif($letter->letter_type === 'assignment')
                        Assignment Letter
                    @endif
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Name of Person Concerned</div>
                <div class="col-sm-8 text-dark">{{ $letter->related_name }}</div>
            </div>
            <div class="row mb-4">
                <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Purpose / Reason</div>
                <div class="col-sm-8 text-dark">{{ $letter->purpose }}</div>
            </div>
            <div class="row mb-4">
                <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Addressed To</div>
                <div class="col-sm-8 text-dark">{{ $letter->addressed_to }}</div>
            </div>
            <div class="row mb-4">
                <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Letter Content</div>
                <div class="col-sm-8 text-dark" style="white-space: pre-wrap;">{{ $letter->letter_body }}</div>
            </div>

            @if($letter->letter_number)
                <div class="row mb-4">
                    <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Letter Number</div>
                    <div class="col-sm-8" style="font-weight: 600; color: #1A2744;">{{ $letter->letter_number }}</div>
                </div>
            @endif

            @if($letter->letter_date)
                <div class="row mb-4">
                    <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Letter Date</div>
                    <div class="col-sm-8 text-dark">{{ $letter->letter_date->format('d F Y') }}</div>
                </div>
            @endif

            {{-- Assignment-specific fields --}}
            @if($letter->letter_type === 'assignment')
                <div class="row mb-4 pt-3" style="border-top: 1px solid #f1f3f8;">
                    <div class="col-12 mb-3">
                        <span style="font-size: 14px; font-weight: 600; color: #1A2744;">Assignment Details</span>
                    </div>
                </div>
                @if($letter->event_name)
                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Event Name</div>
                        <div class="col-sm-8 text-dark">{{ $letter->event_name }}</div>
                    </div>
                @endif
                @if($letter->event_date)
                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Event Date</div>
                        <div class="col-sm-8 text-dark">{{ $letter->event_date->format('d F Y') }}</div>
                    </div>
                @endif
                @if($letter->event_location)
                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Event Location</div>
                        <div class="col-sm-8 text-dark">{{ $letter->event_location }}</div>
                    </div>
                @endif
            @endif

            <div class="row mb-4">
                <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Date Submitted</div>
                <div class="col-sm-8 text-dark">{{ $letter->created_at->format('d F Y, H:i') }}</div>
            </div>

            {{-- File Attachment --}}
            @if($letter->file_path)
                <div class="row mt-4 pt-4" style="border-top: 1px solid #f1f3f8;">
                    <div class="col-12">
                        <a href="{{ asset('storage/' . $letter->file_path) }}" target="_blank" class="btn btn-outline-primary" style="border-radius: 6px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                            </svg>
                            View Attachment
                        </a>
                    </div>
                </div>
            @endif

            {{-- Action Buttons (only for drafts) --}}
            @if($letter->status === 'draft')
                <div class="d-flex gap-2 mt-4 pt-4" style="border-top: 1px solid #f1f3f8;">
                    <a href="{{ route('user.outgoing-letters.edit', $letter->id) }}" class="btn btn-primary" style="height: 40px; border-radius: 6px; background-color: #066FD1; border-color: #066FD1;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                        Edit Letter
                    </a>
                    <form action="{{ route('user.outgoing-letters.destroy', $letter->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this letter?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger" style="height: 40px; border-radius: 6px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                            </svg>
                            Delete Letter
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
