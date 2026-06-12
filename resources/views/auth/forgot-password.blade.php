<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lupa Kata Sandi - Satu Surat</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-primary vh-100 d-flex flex-column" style="background-image: url(&quot;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='60' height='60' viewBox='0 0 60 60'%3E%3Cpath d='M30 0L60 30L30 60L0 30Z' fill='%23ffffff' fill-opacity='0.03' /%3E%3Cpath d='M0 0L30 30L0 60Z' fill='%23ffffff' fill-opacity='0.01' /%3E%3Cpath d='M60 0L30 30L60 60Z' fill='%23ffffff' fill-opacity='0.01' /%3E%3C/svg%3E&quot;);">
    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success m-3 position-absolute top-0 end-0 z-3">
            {{ session('status') }}
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
                        <h2 class="fw-bold mb-4 text-center" style="font-size: 2.5rem;">Lupa Kata Sandi</h2>
                        
                        <p class="text-muted text-center fs-5 mb-5">
                            {{ __('Lupa kata sandi Anda? Tidak masalah. Beri tahu kami alamat email Anda dan kami akan mengirimkan tautan pengaturan ulang kata sandi yang memungkinkan Anda memilih yang baru.') }}
                        </p>
                        
                        <form method="POST" action="{{ route('password.email') }}" class="d-flex flex-column gap-3">
                            @csrf
                    
                            <!-- Email Address -->
                            <div>
                                <label for="email" class="form-label fw-semibold fs-5">{{ __('Email') }}</label>
                                <input id="email" type="email" class="form-control form-control-lg py-3" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@email.com">
                                @error('email')
                                    <div class="text-danger mt-1 small">{{ $message }}</div>
                                @enderror
                            </div>
                    
                            <!-- Actions -->
                            <div class="d-grid gap-3 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg py-3 fs-5 fw-bold">
                                    {{ __('Kirim Tautan') }}
                                </button>
                                <div class="text-center mt-3">
                                    <a href="{{ route('login') }}" class="text-decoration-none fw-semibold fs-5 text-muted">
                                        {{ __('Kembali ke Log in') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
