<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verifikasi Email - Satu Surat</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-primary vh-100 d-flex flex-column" style="background-image: url(&quot;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='60' height='60' viewBox='0 0 60 60'%3E%3Cpath d='M30 0L60 30L30 60L0 30Z' fill='%23ffffff' fill-opacity='0.03' /%3E%3Cpath d='M0 0L30 30L0 60Z' fill='%23ffffff' fill-opacity='0.01' /%3E%3Cpath d='M60 0L30 30L60 60Z' fill='%23ffffff' fill-opacity='0.01' /%3E%3C/svg%3E&quot;);">
    <!-- Session Status -->
    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success m-3 position-absolute top-0 end-0 z-3">
            {{ __('Tautan verifikasi baru telah dikirimkan ke alamat email yang Anda berikan saat pendaftaran.') }}
        </div>
    @endif

    <div class="row g-0 flex-fill">
        <!-- Left Side (Branding) -->
        <div class="col-md-6 col-sm-12 bg-transparent d-flex flex-column align-items-center justify-content-center text-white p-5">
            <h1 class="display-3 fw-bold text-white" style="font-size: 120px; text-shadow: 0px 4px 15px rgba(0,0,0,0.1);">Satu Surat</h1>
        </div>

        <!-- Right Side (Form) -->
        <div class="col-md-6 col-sm-12 d-flex align-items-center justify-content-center px-4">
            <div class="w-100" style="max-width: 550px;">
                <div class="card shadow-lg border-0 rounded-4" style="min-height: 600px;">
                    <div class="card-body p-5 d-flex flex-column justify-content-center">
                        <h2 class="fw-bold mb-4 text-center" style="font-size: 2.5rem;">Verifikasi Email</h2>
                        
                        <p class="text-muted text-center fs-5 mb-5">
                            {{ __('Terima kasih telah mendaftar! Sebelum memulai, dapatkah Anda memverifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan? Jika Anda tidak menerima email tersebut, kami akan mengirimkan yang baru.') }}
                        </p>
                        
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3">
                            <form method="POST" action="{{ route('verification.send') }}" class="w-100">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-lg w-100 py-3 fs-5 fw-bold">
                                    {{ __('Kirim Ulang Email Verifikasi') }}
                                </button>
                            </form>
                    
                            <form method="POST" action="{{ route('logout') }}" class="w-100">
                                @csrf
                                <button type="submit" class="btn btn-outline-secondary btn-lg w-100 py-3 fs-5 fw-bold">
                                    {{ __('Keluar') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
