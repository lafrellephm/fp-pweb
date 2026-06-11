@extends('layouts.user')

@section('page-title', 'My Letters')

@section('page-content')
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-4 mt-3">
        <div>
            <h2 style="font-size: 20px; font-weight: 600; color: #4E5967; margin: 0 0 8px 0;">Surat Saya</h2>
            <p style="font-size: 14px; color: #6A7380; margin: 0;">View and manage all your submitted letters.</p>
        </div>
        <a href="{{ route('user.outgoing-letters.create') }}" class="btn btn-primary" style="height: 40px; border-radius: 6px; background-color: #066FD1; border-color: #066FD1;">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>Buat Surat Baru</a>
    </div>

    {{-- Search & Filter Bar --}}
    <div class="card mb-4" style="border-radius: 12px; padding: 24px; border: 1px solid rgba(1,61,209,0.12); box-shadow: 0 1px 4px rgba(0,0,0,0.06);">
        <form action="{{ route('user.outgoing-letters.index') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label for="search" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Search Keyword</label>
                <input type="text" name="search" id="search" class="form-control" style="height: 38px; border-radius: 6px;" placeholder="Purpose, name, recipient..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <label for="status" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Status</label>
                <select name="status" id="status" class="form-select" style="height: 38px; border-radius: 6px;">
                    <option value="">All Status</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draf</option>
                    <option value="pending_approval" {{ request('status') === 'pending_approval' ? 'selected' : '' }}>Menunggu Persetujuan</option>
                    <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Disetujui</option>
                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    <option value="sent" {{ request('status') === 'sent' ? 'selected' : '' }}>Terkirim</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="type" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Jenis</label>
                <select name="type" id="type" class="form-select" style="height: 38px; border-radius: 6px;">
                    <option value="">All Types</option>
                    <option value="recommendation" {{ request('type') === 'recommendation' ? 'selected' : '' }}>Rekomendasi</option>
                    <option value="active_certificate" {{ request('type') === 'active_certificate' ? 'selected' : '' }}>Keterangan Aktif</option>
                    <option value="assignment" {{ request('type') === 'assignment' ? 'selected' : '' }}>Tugas</option>
                </select>
            </div>
            <div class="col-md-3 d-flex">
                <button type="submit" class="btn btn-secondary w-100 me-2" style="height: 38px; border-radius: 6px;">Filter</button>
                @if(request()->hasAny(['search', 'status', 'type']))
                    <a href="{{ route('user.outgoing-letters.index') }}" class="btn btn-outline-danger w-100" style="height: 38px; border-radius: 6px;">Clear</a>
                @endif
            </div>
        </form>
    </div>

    {{-- Data Table --}}
    <div class="card" style="border-radius: 12px; border: 1px solid rgba(1,61,209,0.12); box-shadow: 0 1px 4px rgba(0,0,0,0.06); overflow: hidden;">
        <div class="table-responsive">
            <table class="table table-vcenter table-nowrap mb-0">
                <thead style="background-color: #F8FAFC;">
                    <tr>
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">No</th>
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Tujuan</th>
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Ditujukan Kepada</th>
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Jenis</th>
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Status</th>
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Submitted Date</th>
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;" class="w-1">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($letters as $letter)
                        <tr>
                            <td class="text-muted">{{ $letters->firstItem() + $loop->index }}</td>
                            <td style="font-weight: 500; color: #1A2744;">{{ Str::limit($letter->purpose, 30) }}</td>
                            <td>{{ Str::limit($letter->addressed_to, 25) }}</td>
                            <td>
                                @if($letter->letter_type === 'recommendation')
                                    Recommendation
                                @elseif($letter->letter_type === 'active_certificate')
                                    Active Certificate
                                @elseif($letter->letter_type === 'assignment')
                                    Assignment
                                @endif
                            </td>
                            <td>
                                @if($letter->status === 'draft')
                                    <span class="status-badge status-draft">Draf</span>
                                @elseif($letter->status === 'pending_approval')
                                    <span class="status-badge status-menunggu_approval">Menunggu Persetujuan</span>
                                @elseif($letter->status === 'approved')
                                    <span class="status-badge status-disetujui">Disetujui</span>
                                @elseif($letter->status === 'rejected')
                                    <span class="status-badge status-ditolak">Ditolak</span>
                                @elseif($letter->status === 'sent')
                                    <span class="status-badge status-terkirim">Terkirim</span>
                                @endif
                            </td>
                            <td class="text-muted">{{ $letter->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="btn-list flex-nowrap">
                                    <a href="{{ route('user.outgoing-letters.show', $letter->id) }}" class="btn btn-sm btn-outline-info" style="border-radius: 6px;">Lihat</a>
                                    @if($letter->status === 'draft')
                                        <a href="{{ route('user.outgoing-letters.edit', $letter->id) }}" class="btn btn-sm btn-outline-primary" style="border-radius: 6px;">Edit</a>
                                        <form action="{{ route('user.outgoing-letters.destroy', $letter->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus surat ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius: 6px;">Hapus</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                @if(request()->hasAny(['search', 'status', 'type']))
                                    No letters found matching your search.
                                @else
                                    You have not submitted any letters yet.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($letters->hasPages())
            <div class="card-footer d-flex align-items-center bg-white border-0 mt-2">
                {{ $letters->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
