@extends('layouts.admin')

@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('page-title', 'Surat Masuk')

@section('page-content')
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-4 mt-3">
        <div>
            <h2>Surat Masuk</h2>
            <p class="m-0" style="font-size: 14px; color: #6A7380; ">Manage and track all incoming letters.</p>
        </div>
        <a href="{{ route('admin.incoming-letters.create') }}" class="btn btn-primary" style="height: 40px; border-radius: 6px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>Tambah Surat Masuk</a>
    </div>

    <!-- Cari & Filter Bar -->
    <div class="card mb-4 p-4" style="border-radius: 12px;  border: 1px solid rgba(1,61,209,0.12); box-shadow: 0 1px 4px rgba(0,0,0,0.06);">
        <form action="{{ route('admin.incoming-letters.index') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label for="search" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Cari Keyword</label>
                <input type="text" name="search" id="search" class="form-control" style="height: 38px; border-radius: 6px;" placeholder="Letter number, sender, subject..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <label for="status" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Status</label>
                <select name="status" id="status" class="form-select" style="height: 38px; border-radius: 6px;">
                    <option value="">All Status</option>
                    <option value="unassigned" {{ request('status') === 'unassigned' ? 'selected' : '' }}>Belum diproses</option>
                    <option value="assigned" {{ request('status') === 'assigned' ? 'selected' : '' }}>Menunggu diproses</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="type" class="form-label" style="font-size: 14px; font-weight: 500; color: #4E5967;">Jenis</label>
                <select name="type" id="type" class="form-select" style="height: 38px; border-radius: 6px;">
                    <option value="">All Types</option>
                    <option value="invitation" {{ request('type') === 'invitation' ? 'selected' : '' }}>Undangan</option>
                    <option value="announcement" {{ request('type') === 'announcement' ? 'selected' : '' }}>Pengumuman</option>
                </select>
            </div>
            <div class="col-md-2 d-flex">
                <button type="submit" class="btn btn-secondary w-100 me-2" style="height: 38px; border-radius: 6px;">Filter</button>
                @if(request()->hasAny(['search', 'status', 'type']))
                    <a href="{{ route('admin.incoming-letters.index') }}" class="btn btn-outline-danger w-100" style="height: 38px; border-radius: 6px;">Reset</a>
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
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Nomor Surat</th>
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Pengirim</th>
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Perihal</th>
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Jenis</th>
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Tanggal Diterima</th>
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Status</th>
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Urgensi</th>
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;" class="w-1">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($letters as $letter)
                        <tr>
                            <td class="text-muted">{{ $letters->firstItem() + $loop->index }}</td>
                            <td style="font-weight: 500; color: #1A2744;">{{ $letter->letter_number }}</td>
                            <td>{{ $letter->sender }}</td>
                            <td>{{ Str::limit($letter->subject, 30) }}</td>
                            <td>
                                @if(in_array($letter->letter_type, ['invitation', 'undangan']))
                                    Undangan
                                @elseif(in_array($letter->letter_type, ['announcement', 'pengumuman']))
                                    Pengumuman
                                @else
                                    {{ ucfirst($letter->letter_type) }}
                                @endif
                            </td>
                            <td>{{ $letter->received_date->format('d M Y') }}</td>
                            <td>
                                @if($letter->status === 'unassigned')
                                    <span class="status-badge status-belum_disposisi">Belum diproses</span>
                                @elseif($letter->status === 'assigned')
                                    <span class="status-badge status-sudah_disposisi">Menunggu diproses</span>
                                @elseif($letter->status === 'completed')
                                    <span class="status-badge status-selesai">Selesai</span>
                                @endif
                            </td>
                            <td>
                                @if($letter->urgency === 'critical')
                                    <span class="badge bg-danger">Kritis</span>
                                @elseif($letter->urgency === 'urgent')
                                    <span class="badge bg-warning text-dark">Mendesak</span>
                                @else
                                    <span class="badge bg-secondary">Normal</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <a href="{{ route('admin.incoming-letters.show', $letter->id) }}" class="btn btn-sm btn-primary py-0" >Lihat</a>
                                    <a href="{{ route('admin.incoming-letters.edit', $letter->id) }}" class="btn btn-sm btn-secondary" >Ubah</a>
                                    <form action="{{ route('admin.incoming-letters.destroy', $letter->id) }}" method="POST" class="m-0 d-inline-flex" onsubmit="return confirm('Apakah Anda yakin ingin menghapus surat ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" >Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                @if(request()->hasAny(['search', 'status', 'type']))
                                    No incoming letters found matching your search.
                                @else
                                    No incoming letters found.
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
