@extends('layouts.admin')

@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('page-title', 'Outgoing Letter Submissions')

@section('page-content')
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-4 mt-3">
        <div>
            <h2 style="font-size: 20px; font-weight: 600; color: #4E5967; margin: 0 0 8px 0;">Outgoing Letter Submissions</h2>
            <p style="font-size: 14px; color: #6A7380; margin: 0;">Review, process, and manage outgoing letters from users.</p>
        </div>
    </div>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-0" id="outgoingLetterTabs" role="tablist" style="border-bottom: 2px solid #E0E3E8;">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="submissions-tab" data-bs-toggle="tab" data-bs-target="#submissions-pane" type="button" role="tab" aria-controls="submissions-pane" aria-selected="true" style="font-size: 14px; font-weight: 500; border-radius: 6px 6px 0 0;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                </svg>
                Submissions
                @php
                    $submissionsCount = $letters->filter(fn($l) => in_array($l->status, ['draft', 'pending_approval', 'rejected']))->count();
                @endphp
                @if($submissionsCount > 0)
                    <span class="badge ms-1" style="background-color: #066FD1; color: #fff; font-size: 11px; padding: 2px 7px; border-radius: 9999px;">{{ $submissionsCount }}</span>
                @endif
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="archive-tab" data-bs-toggle="tab" data-bs-target="#archive-pane" type="button" role="tab" aria-controls="archive-pane" aria-selected="false" style="font-size: 14px; font-weight: 500; border-radius: 6px 6px 0 0;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                    <polyline points="21 8 21 21 3 21 3 8"></polyline>
                    <rect x="1" y="3" width="22" height="5"></rect>
                    <line x1="10" y1="12" x2="14" y2="12"></line>
                </svg>
                Archive
                @php
                    $archiveCount = $letters->filter(fn($l) => in_array($l->status, ['approved', 'sent']))->count();
                @endphp
                @if($archiveCount > 0)
                    <span class="badge ms-1" style="background-color: #059669; color: #fff; font-size: 11px; padding: 2px 7px; border-radius: 9999px;">{{ $archiveCount }}</span>
                @endif
            </button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="outgoingLetterTabContent">
        <!-- Submissions Tab -->
        <div class="tab-pane fade show active" id="submissions-pane" role="tabpanel" aria-labelledby="submissions-tab">
            <!-- Search & Filter Bar -->
            <div class="card mb-4" style="border-radius: 0 12px 12px 12px; padding: 24px; border: 1px solid rgba(1,61,209,0.12); border-top: none; box-shadow: 0 1px 4px rgba(0,0,0,0.06);">
                <form action="{{ route('admin.outgoing-letters.index') }}" method="GET" class="row g-3 align-items-end">
                    <input type="hidden" name="tab" value="submissions">
                    <div class="col-md-4">
                        <label for="search_sub" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Search Keyword</label>
                        <input type="text" name="search" id="search_sub" class="form-control" style="height: 38px; border-radius: 6px;" placeholder="Purpose, addressed to, name..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="status_sub" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Status</label>
                        <select name="status" id="status_sub" class="form-select" style="height: 38px; border-radius: 6px;">
                            <option value="">All Status</option>
                            <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draf</option>
                            <option value="pending_approval" {{ request('status') === 'pending_approval' ? 'selected' : '' }}>Menunggu Persetujuan</option>
                            <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="type_sub" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Jenis</label>
                        <select name="type" id="type_sub" class="form-select" style="height: 38px; border-radius: 6px;">
                            <option value="">All Types</option>
                            <option value="recommendation" {{ request('type') === 'recommendation' ? 'selected' : '' }}>Rekomendasi</option>
                            <option value="active_certificate" {{ request('type') === 'active_certificate' ? 'selected' : '' }}>Keterangan Aktif</option>
                            <option value="assignment" {{ request('type') === 'assignment' ? 'selected' : '' }}>Tugas</option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex">
                        <button type="submit" class="btn btn-secondary w-100 me-2" style="height: 38px; border-radius: 6px;">Filter</button>
                        @if(request()->hasAny(['search', 'status', 'type']))
                            <a href="{{ route('admin.outgoing-letters.index') }}" class="btn btn-outline-danger w-100" style="height: 38px; border-radius: 6px;">Reset</a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Data Table -->
            <div class="card" style="border-radius: 12px; border: 1px solid rgba(1,61,209,0.12); box-shadow: 0 1px 4px rgba(0,0,0,0.06); overflow: hidden;">
                <div class="table-responsive">
                    <table class="table table-vcenter table-nowrap mb-0">
                        <thead style="background-color: #F8FAFC;">
                            <tr>
                                <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">No</th>
                                <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Diajukan Oleh</th>
                                <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Tujuan</th>
                                <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Ditujukan Kepada</th>
                                <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Jenis</th>
                                <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Status</th>
                                <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Submitted Date</th>
                                <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;" class="w-1">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $submissionLetters = $letters->filter(fn($l) => in_array($l->status, ['draft', 'pending_approval', 'rejected']));
                                $subIndex = 0;
                            @endphp
                            @forelse($submissionLetters as $letter)
                                <tr>
                                    <td class="text-muted">{{ ++$subIndex }}</td>
                                    <td style="font-weight: 500; color: #1A2744;">{{ $letter->submittedBy->name ?? '-' }}</td>
                                    <td>{{ Str::limit($letter->purpose, 30) }}</td>
                                    <td>{{ Str::limit($letter->addressed_to, 25) }}</td>
                                    <td>
                                        @if($letter->letter_type === 'recommendation')
                                            Recommendation
                                        @elseif($letter->letter_type === 'active_certificate')
                                            Active Certificate
                                        @elseif($letter->letter_type === 'assignment')
                                            Assignment
                                        @else
                                            {{ ucfirst($letter->letter_type) }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($letter->status === 'draft')
                                            <span class="status-badge status-draft">Draf</span>
                                        @elseif($letter->status === 'pending_approval')
                                            <span class="status-badge status-menunggu_approval">Menunggu Persetujuan</span>
                                        @elseif($letter->status === 'rejected')
                                            <span class="status-badge status-ditolak">Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="text-muted">{{ $letter->created_at->format('d M Y') }}</td>
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            @if($letter->status === 'draft')
                                                <a href="{{ route('admin.outgoing-letters.process', $letter->id) }}" class="btn btn-sm btn-primary" style="border-radius: 6px;">Proses</a>
                                            @elseif($letter->status === 'pending_approval')
                                                <a href="{{ route('admin.outgoing-letters.show', $letter->id) }}" class="btn btn-sm btn-outline-info" style="border-radius: 6px;">Lihat</a>
                                            @elseif($letter->status === 'rejected')
                                                <a href="{{ route('admin.outgoing-letters.show', $letter->id) }}" class="btn btn-sm btn-outline-info" style="border-radius: 6px;">Lihat</a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted">
                                        @if(request()->hasAny(['search', 'status', 'type']))
                                            No letters found matching your search.
                                        @else
                                            No letters found.
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Archive Tab -->
        <div class="tab-pane fade" id="archive-pane" role="tabpanel" aria-labelledby="archive-tab">
            <!-- Search & Filter Bar -->
            <div class="card mb-4" style="border-radius: 0 12px 12px 12px; padding: 24px; border: 1px solid rgba(1,61,209,0.12); border-top: none; box-shadow: 0 1px 4px rgba(0,0,0,0.06);">
                <form action="{{ route('admin.outgoing-letters.index') }}" method="GET" class="row g-3 align-items-end">
                    <input type="hidden" name="tab" value="archive">
                    <div class="col-md-4">
                        <label for="search_arc" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Search Keyword</label>
                        <input type="text" name="search" id="search_arc" class="form-control" style="height: 38px; border-radius: 6px;" placeholder="Purpose, addressed to, name..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="status_arc" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Status</label>
                        <select name="status" id="status_arc" class="form-select" style="height: 38px; border-radius: 6px;">
                            <option value="">All Status</option>
                            <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Disetujui</option>
                            <option value="sent" {{ request('status') === 'sent' ? 'selected' : '' }}>Terkirim</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="type_arc" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Jenis</label>
                        <select name="type" id="type_arc" class="form-select" style="height: 38px; border-radius: 6px;">
                            <option value="">All Types</option>
                            <option value="recommendation" {{ request('type') === 'recommendation' ? 'selected' : '' }}>Rekomendasi</option>
                            <option value="active_certificate" {{ request('type') === 'active_certificate' ? 'selected' : '' }}>Keterangan Aktif</option>
                            <option value="assignment" {{ request('type') === 'assignment' ? 'selected' : '' }}>Tugas</option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex">
                        <button type="submit" class="btn btn-secondary w-100 me-2" style="height: 38px; border-radius: 6px;">Filter</button>
                        @if(request()->hasAny(['search', 'status', 'type']))
                            <a href="{{ route('admin.outgoing-letters.index') }}" class="btn btn-outline-danger w-100" style="height: 38px; border-radius: 6px;">Reset</a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Data Table -->
            <div class="card" style="border-radius: 12px; border: 1px solid rgba(1,61,209,0.12); box-shadow: 0 1px 4px rgba(0,0,0,0.06); overflow: hidden;">
                <div class="table-responsive">
                    <table class="table table-vcenter table-nowrap mb-0">
                        <thead style="background-color: #F8FAFC;">
                            <tr>
                                <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">No</th>
                                <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Diajukan Oleh</th>
                                <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Tujuan</th>
                                <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Ditujukan Kepada</th>
                                <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Jenis</th>
                                <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Status</th>
                                <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Submitted Date</th>
                                <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;" class="w-1">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $archiveLetters = $letters->filter(fn($l) => in_array($l->status, ['approved', 'sent']));
                                $arcIndex = 0;
                            @endphp
                            @forelse($archiveLetters as $letter)
                                <tr>
                                    <td class="text-muted">{{ ++$arcIndex }}</td>
                                    <td style="font-weight: 500; color: #1A2744;">{{ $letter->submittedBy->name ?? '-' }}</td>
                                    <td>{{ Str::limit($letter->purpose, 30) }}</td>
                                    <td>{{ Str::limit($letter->addressed_to, 25) }}</td>
                                    <td>
                                        @if($letter->letter_type === 'recommendation')
                                            Recommendation
                                        @elseif($letter->letter_type === 'active_certificate')
                                            Active Certificate
                                        @elseif($letter->letter_type === 'assignment')
                                            Assignment
                                        @else
                                            {{ ucfirst($letter->letter_type) }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($letter->status === 'approved')
                                            <span class="status-badge status-disetujui">Disetujui</span>
                                        @elseif($letter->status === 'sent')
                                            <span class="status-badge status-terkirim">Terkirim</span>
                                        @endif
                                    </td>
                                    <td class="text-muted">{{ $letter->created_at->format('d M Y') }}</td>
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            @if($letter->status === 'approved')
                                                <form action="{{ route('admin.outgoing-letters.sent', $letter->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Mark this letter as sent?');">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-primary" style="border-radius: 6px;">Tandai Terkirim</button>
                                                </form>
                                                <a href="{{ route('admin.outgoing-letters.show', $letter->id) }}" class="btn btn-sm btn-outline-info" style="border-radius: 6px;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                                                        <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                                        <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                                                        <rect x="6" y="14" width="12" height="8"></rect>
                                                    </svg>Cetak</a>
                                            @elseif($letter->status === 'sent')
                                                <a href="{{ route('admin.outgoing-letters.show', $letter->id) }}" class="btn btn-sm btn-outline-info" style="border-radius: 6px;">Lihat</a>
                                                <a href="{{ route('admin.outgoing-letters.show', $letter->id) }}" class="btn btn-sm btn-outline-info" style="border-radius: 6px;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                                                        <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                                        <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                                                        <rect x="6" y="14" width="12" height="8"></rect>
                                                    </svg>Cetak</a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted">
                                        @if(request()->hasAny(['search', 'status', 'type']))
                                            No letters found matching your search.
                                        @else
                                            No letters found.
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination (shared) -->
    @if($letters->hasPages())
        <div class="d-flex align-items-center mt-4">
            {{ $letters->links() }}
        </div>
    @endif
</div>

@push('scripts')
<script>
    // Restore active tab from URL param or localStorage
    document.addEventListener('DOMContentLoaded', function() {
        var urlParams = new URLSearchParams(window.location.search);
        var tab = urlParams.get('tab');
        if (tab === 'archive') {
            var archiveTab = document.getElementById('archive-tab');
            if (archiveTab) {
                var bsTab = new bootstrap.Tab(archiveTab);
                bsTab.show();
            }
        }
    });
</script>
@endpush
@endsection
