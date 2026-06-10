@extends('layouts.admin')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('page-title', 'Incoming Letter Detail')

@section('page-content')
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-4 mt-3">
        <div>
            <h2 style="font-size: 20px; font-weight: 600; color: #4E5967; margin: 0 0 8px 0;">Incoming Letter Detail</h2>
            <p style="font-size: 14px; color: #6A7380; margin: 0;">View complete details and track dispositions.</p>
        </div>
        <a href="{{ route('admin.incoming-letters.index') }}" class="btn btn-outline-secondary" style="height: 40px; border-radius: 6px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Back to Letters
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 8px;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <!-- Letter Details -->
        <div class="col-lg-8 mb-4">
            <div class="card h-100" style="border-radius: 12px; border: 1px solid rgba(1,61,209,0.12); box-shadow: 0 1px 4px rgba(0,0,0,0.06);">
                <div class="card-header bg-white" style="border-bottom: 1px solid #f1f3f8; padding: 20px 24px;">
                    <div class="d-flex align-items-center justify-content-between">
                        <h3 class="card-title m-0" style="font-weight: 600; font-size: 16px; color: #1A2744;">Letter Information</h3>
                        <div>
                            @if($letter->status === 'unassigned')
                                <span class="badge" style="background-color: #FEF3C7; color: #D97706; padding: 6px 10px; border-radius: 4px; font-weight: 500;">Unassigned</span>
                            @elseif($letter->status === 'assigned')
                                <span class="badge" style="background-color: #DBEAFE; color: #2563EB; padding: 6px 10px; border-radius: 4px; font-weight: 500;">Assigned</span>
                            @elseif($letter->status === 'completed')
                                <span class="badge" style="background-color: #D1FAE5; color: #059669; padding: 6px 10px; border-radius: 4px; font-weight: 500;">Completed</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body" style="padding: 24px;">
                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Letter Number</div>
                        <div class="col-sm-8" style="font-weight: 600; color: #1A2744;">{{ $letter->letter_number }}</div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Sender</div>
                        <div class="col-sm-8 text-dark">{{ $letter->sender }}</div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Subject</div>
                        <div class="col-sm-8 text-dark">{{ $letter->subject }}</div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Letter Type</div>
                        <div class="col-sm-8 text-dark">{{ ucfirst($letter->letter_type) }}</div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Letter Date</div>
                        <div class="col-sm-8 text-dark">{{ $letter->letter_date->format('d F Y') }}</div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted" style="font-weight: 500; font-size: 14px;">Received Date</div>
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
                                    View Attachment
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Status Update Form -->
        <div class="col-lg-4 mb-4">
            <div class="card" style="border-radius: 12px; border: 1px solid rgba(1,61,209,0.12); box-shadow: 0 1px 4px rgba(0,0,0,0.06);">
                <div class="card-header bg-white" style="border-bottom: 1px solid #f1f3f8; padding: 20px 24px;">
                    <h3 class="card-title m-0" style="font-weight: 600; font-size: 16px; color: #1A2744;">Update Status</h3>
                </div>
                <div class="card-body" style="padding: 24px;">
                    <form action="{{ route('admin.incoming-letters.status', $letter->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="status" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Current Status</label>
                            <select name="status" id="status" class="form-select" style="height: 38px; border-radius: 6px;">
                                <option value="unassigned" {{ $letter->status === 'unassigned' ? 'selected' : '' }}>Unassigned</option>
                                <option value="assigned" {{ $letter->status === 'assigned' ? 'selected' : '' }}>Assigned</option>
                                <option value="completed" {{ $letter->status === 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" style="height: 40px; border-radius: 6px; background-color: #066FD1; border-color: #066FD1;">Update Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Dispositions Section -->
    <div class="card mt-2" style="border-radius: 12px; border: 1px solid rgba(1,61,209,0.12); box-shadow: 0 1px 4px rgba(0,0,0,0.06); overflow: hidden;">
        <div class="card-header bg-white" style="border-bottom: 1px solid #f1f3f8; padding: 20px 24px;">
            <div class="d-flex align-items-center justify-content-between">
                <h3 class="card-title m-0" style="font-weight: 600; font-size: 16px; color: #1A2744;">Dispositions</h3>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-vcenter mb-0">
                <thead style="background-color: #F8FAFC;">
                    <tr>
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Assigned To</th>
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Instructions</th>
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Status</th>
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($letter->dispositions as $disposition)
                        <tr>
                            <td style="font-weight: 500; color: #1A2744;">{{ optional($disposition->assignedTo)->name ?? '-' }}</td>
                            <td>{{ Str::limit($disposition->instructions, 50) }}</td>
                            <td>
                                @if($disposition->status === 'unread')
                                    <span class="badge bg-secondary">Unread</span>
                                @elseif($disposition->status === 'read')
                                    <span class="badge bg-info">Read</span>
                                @elseif($disposition->status === 'completed')
                                    <span class="badge bg-success">Completed</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($disposition->status) }}</span>
                                @endif
                            </td>
                            <td class="text-muted">{{ $disposition->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                No dispositions created yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
