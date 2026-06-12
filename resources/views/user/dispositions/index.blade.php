@extends('layouts.user')

@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('page-title', 'Disposisi Saya')

@section('page-content')
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-4 mt-3">
        <div>
            <h2>Disposisi Saya</h2>
            <p class="m-0" style="font-size: 14px; color: #6A7380; ">Daftar disposisi yang ditugaskan kepada Anda.</p>
        </div>
    </div>


    <!-- Data Table -->
    <div class="card" style="border-radius: 12px; border: 1px solid rgba(1,61,209,0.12); box-shadow: 0 1px 4px rgba(0,0,0,0.06); overflow: hidden;">
        <div class="table-responsive">
            <table class="table table-vcenter table-nowrap mb-0">
                <thead style="background-color: #F8FAFC;">
                    <tr>
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">No</th>
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Perihal Surat</th>
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Instruksi</th>
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Status</th>
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Catatan Balasan</th>
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Tanggal</th>
                        <th style="font-size: 12px; font-weight: 600; color: #6A7380; text-transform: uppercase;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dispositions as $disposition)
                        <tr>
                            <td class="text-muted">{{ $dispositions->firstItem() + $loop->index }}</td>
                            <td style="font-weight: 500; color: #1A2744;">{{ Str::limit(optional($disposition->incomingLetter)->subject, 35) }}</td>
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
                            <td>{{ $disposition->reply_note ? Str::limit($disposition->reply_note, 40) : '-' }}</td>
                            <td class="text-muted">{{ $disposition->created_at->format('d M Y') }}</td>
                            <td>
                                @if($disposition->status === 'unread')
                                    <form action="{{ route('user.dispositions.status', $disposition->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="read">
                                        <button type="submit" class="btn btn-sm btn-outline-info" style="border-radius: 6px;">Tandai Dibaca</button>
                                    </form>
                                @elseif($disposition->status === 'read')
                                    <button type="button" class="btn btn-sm btn-outline-success" style="border-radius: 6px;" onclick="toggleReplyForm({{ $disposition->id }})">Tandai Selesai</button>

                                    <div id="reply-form-{{ $disposition->id }}" style="display: none; margin-top: 8px; min-width: 260px;">
                                        <form action="{{ route('user.dispositions.status', $disposition->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="completed">
                                            <textarea name="reply_note" class="form-control mb-2" rows="3" placeholder="Tulis catatan balasan..." required style="font-size: 13px;"></textarea>
                                            @error('reply_note')
                                                <div class="text-danger mb-2" style="font-size: 12px;">{{ $message }}</div>
                                            @enderror
                                            <div class="d-flex gap-2">
                                                <button type="submit" class="btn btn-sm btn-primary" style="border-radius: 6px; background-color: #066FD1; border-color: #066FD1;">Kirim</button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary" style="border-radius: 6px;" onclick="toggleReplyForm({{ $disposition->id }})">Batal</button>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                                {{-- completed: no action --}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                Belum ada disposisi untuk Anda.
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

<script>
    function toggleReplyForm(id) {
        var form = document.getElementById('reply-form-' + id);
        if (form.style.display === 'none' || form.style.display === '') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    }
</script>
@endsection
