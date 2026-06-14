@props(['status'])

@if($status === 'draft')
    <span class="status-badge status-draft">Draf</span>
@elseif($status === 'pending_approval')
    <span class="status-badge status-menunggu_approval">Menunggu Persetujuan</span>
@elseif($status === 'approved')
    <span class="status-badge status-disetujui">Disetujui</span>
@elseif($status === 'rejected')
    <span class="status-badge status-ditolak">Ditolak</span>
@elseif($status === 'sent')
    <span class="status-badge status-terkirim">Terkirim</span>
@elseif($status === 'received')
    <span class="status-badge status-diterima">Diterima</span>
@elseif($status === 'selesai')
    <span class="status-badge status-selesai">Selesai</span>
@else
    <span class="status-badge">{{ ucfirst(str_replace('_', ' ', $status)) }}</span>
@endif
