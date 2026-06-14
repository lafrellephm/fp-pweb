@extends($layout)

@section('page-title', 'Tentang Satu Surat')

@section('page-content')
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-4 mt-3">
        <h2>Tentang Satu Surat</h2>
    </div>

    <div class="row g-4">
        <div class="col-12 col-lg-8">
            <div class="card card-custom h-100">
                <div class="card-body p-5">
                    <h3 class="mb-3" style="color: #1A2744; font-weight: 700;">Visi & Misi</h3>
                    <div class="mb-4">
                        <h5 style="color: #066FD1; font-weight: 600;">Visi</h5>
                        <p style="color: #6A7380; line-height: 1.6;">
                            Menjadi platform manajemen surat dan disposisi yang terpercaya, efisien, dan modern untuk mendukung kelancaran administrasi.
                        </p>
                    </div>
                    <div class="mb-4">
                        <h5 style="color: #066FD1; font-weight: 600;">Misi</h5>
                        <ul style="color: #6A7380; line-height: 1.6; padding-left: 1.2rem;">
                            <li>Menyediakan layanan persuratan digital yang cepat dan akurat.</li>
                            <li>Mempermudah proses tracking surat dan disposisi secara real-time.</li>
                            <li>Meningkatkan transparansi dan akuntabilitas dalam birokrasi persuratan.</li>
                        </ul>
                    </div>

                    <hr style="border-color: #E2E8F0; margin: 32px 0;">

                    <h3 class="mb-3" style="color: #1A2744; font-weight: 700;">Layanan Kami</h3>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3" style="background-color: #F8FAFC; border-radius: 8px;">
                                <div class="d-flex align-items-center mb-2">
                                    <div style="width: 32px; height: 32px; border-radius: 6px; background-color: rgba(6,111,209,0.1); color: #066FD1; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                            <polyline points="22,6 12,13 2,6"></polyline>
                                        </svg>
                                    </div>
                                    <h6 class="mb-0" style="font-weight: 600; color: #1A2744;">Manajemen Surat Masuk</h6>
                                </div>
                                <p style="font-size: 13px; color: #6A7380; margin-bottom: 0;">Pencatatan dan pengarsipan surat yang masuk dari pihak eksternal.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3" style="background-color: #F8FAFC; border-radius: 8px;">
                                <div class="d-flex align-items-center mb-2">
                                    <div style="width: 32px; height: 32px; border-radius: 6px; background-color: rgba(6,111,209,0.1); color: #066FD1; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="22" y1="2" x2="11" y2="13"></line>
                                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                        </svg>
                                    </div>
                                    <h6 class="mb-0" style="font-weight: 600; color: #1A2744;">Manajemen Surat Keluar</h6>
                                </div>
                                <p style="font-size: 13px; color: #6A7380; margin-bottom: 0;">Pengajuan, persetujuan, dan pencetakan surat untuk dikirim keluar.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3" style="background-color: #F8FAFC; border-radius: 8px;">
                                <div class="d-flex align-items-center mb-2">
                                    <div style="width: 32px; height: 32px; border-radius: 6px; background-color: rgba(6,111,209,0.1); color: #066FD1; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                                            <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                                        </svg>
                                    </div>
                                    <h6 class="mb-0" style="font-weight: 600; color: #1A2744;">Sistem Disposisi</h6>
                                </div>
                                <p style="font-size: 13px; color: #6A7380; margin-bottom: 0;">Distribusi tugas dan wewenang secara hierarkis dan terstruktur.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="card card-custom h-100" style="background-color: #1A2744; color: #FFFFFF;">
                <div class="card-body p-5 d-flex flex-column justify-content-center align-items-center text-center relative overflow-hidden">
                    <svg style="position: absolute; right: -20%; bottom: -20%; opacity: 0.05;" width="300" height="300" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                    
                    <div style="width: 64px; height: 64px; border-radius: 50%; background-color: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; margin-bottom: 24px; z-index: 1;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                        </svg>
                    </div>
                    
                    <h3 class="mb-3" style="font-weight: 700; z-index: 1;">Butuh Bantuan?</h3>
                    <p style="color: #A8B5C8; font-size: 15px; line-height: 1.6; margin-bottom: 32px; z-index: 1;">
                        Jika Anda memiliki pertanyaan, kendala, atau masukan mengenai sistem Satu Surat, jangan ragu untuk menghubungi tim administrator kami.
                    </p>
                    
                    <div style="background-color: rgba(255,255,255,0.1); padding: 16px 24px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.2); width: 100%; z-index: 1;">
                        <div style="font-size: 12px; color: #A8B5C8; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Email Kontak Admin</div>
                        <a href="mailto:admin@mail.com" style="color: #FFFFFF; font-size: 18px; font-weight: 600; text-decoration: none; display: flex; align-items: center; justify-content: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                            admin@mail.com
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
