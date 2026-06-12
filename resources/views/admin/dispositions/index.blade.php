@extends('layouts.admin')

@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('page-title', 'Disposisi')

@section('page-content')
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-4 mt-3">
        <div>
            <h2>Disposisi</h2>
        </div>
        <a href="{{ route('admin.dispositions.create') }}" class="btn btn-primary" style="height: 40px; border-radius: 6px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>Buat Disposisi</a>
    </div>


    <!-- Search Bar -->
    <div class="card mb-4 p-4\" style="border-radius: 12px;  border: 1px solid rgba(1,61,209,0.12); box-shadow: 0 1px 4px rgba(0,0,0,0.06);">
        <form action="{{ route('admin.dispositions.index') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-8">
                <label for="search" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Cari</label>
                <input type="text" name="search" id="search" class="form-control" style="height: 38px; border-radius: 6px;" placeholder="Perihal surat atau nama penerima..." value="{{ request('search') }}">
            </div>
            <div class="col-md-4 d-flex">
                <button type="submit" class="btn btn-secondary w-100 me-2" style="height: 38px; border-radius: 6px;">Cari</button>
                @if(request()->hasAny(['search']))
                    <a href="{{ route('admin.dispositions.index') }}" class="btn btn-outline-danger w-100" style="height: 38px; border-radius: 6px;">Reset</a>
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
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Perihal Surat</th>
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Ditujukan Kepada</th>
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Instruksi</th>
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Status</th>
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Tanggal</th>
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;" class="w-1">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dispositions as $disposition)
                        <tr>
                            <td class="text-muted">{{ $dispositions->firstItem() + $loop->index }}</td>
                            <td style="font-weight: 500; color: #1A2744;">{{ Str::limit(optional($disposition->incomingLetter)->subject, 35) }}</td>
                            <td>{{ optional($disposition->assignedTo)->name ?? '-' }}</td>
                            <td>{{ Str::limit($disposition->instructions, 40) }}</td>
                            <td>
                                @if($disposition->status === 'unread')
                                    <span class="status-badge status-belum_dibaca">Belum Dibaca</span>
                                @elseif($disposition->status === 'read')
                                    <span class="status-badge status-dibaca">Dibaca</span>
                                @elseif($disposition->status === 'completed')
                                    <span class="status-badge status-selesai">Selesai</span>
                                @endif
                            </td>
                            <td class="text-muted">{{ $disposition->created_at->format('d M Y') }}</td>
                            <td>
                                <form action="{{ route('admin.dispositions.destroy', $disposition->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus disposisi ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius: 6px;">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                @if(request()->hasAny(['search']))
                                    Tidak ada disposisi yang sesuai dengan pencarian.
                                @else
                                    Belum ada disposisi.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($dispositions->hasPages())
            <div class="card-footer d-flex align-items-center bg-white border-0 mt-2">
                {{ $dispositions->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
