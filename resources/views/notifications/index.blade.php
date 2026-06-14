@extends(auth()->user()->role === 'admin' ? 'layouts.admin' : 'layouts.user')

@section('page-title', 'Notifikasi')
@section('title', 'Notifikasi')

@section('page-content')
<div class="card" style="box-shadow: none !important;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Semua Notifikasi</h3>
    </div>

    @if($notifications->isEmpty())
        <div class="text-center py-5">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-3" style="color: #9BA3AF; ">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
            </svg>
            <p style="color: #6A7380; font-size: 14px;">Tidak ada notifikasi saat ini.</p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-vcenter">
                <thead>
                    <tr>
                        <th style="width: 25%">Judul</th>
                        <th style="width: 55%">Pesan</th>
                        <th style="width: 20%">Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notifications as $notification)
                        <tr style="background-color: #FFFFFF; font-weight: 400;">
                            <td style="color: #6A7380;">{{ $notification->title }}</td>
                            <td style="color: #6A7380;">{{ $notification->message }}</td>
                            <td style="color: #6A7380;">{{ $notification->created_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            {{ $notifications->links() }}
        </div>
    @endif
</div>
@endsection
