<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="vh-100 bg-primary overflow-auto col-lg-6 col-md-12 p-5">
    <!-- Session Status -->
    @if (session('status'))
        <div>
            {{ session('status') }}
        </div>
    @endif
    <div class="d-flex flex-column">
        <h1 class="text-primary text-center text-white"> 
            Suratin
        </h1>
        <div class="rounded-3 mt-3 bg-white shadow" style="padding: 3em">
            <h2 class="text-center text-primary mb-5">Masuk</h2>
            <form method="POST" action="{{ route('login') }}" >
                @csrf
        
                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                    @error('email')
                        <div>{{ $message }}</div>
                    @enderror
                </div>
        
                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-lable">{{ __('Kata Sandi') }}</label>
                    <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                    @error('password')
                        <div>{{ $message }}</div>
                    @enderror
                </div>
                <label for="remember_me">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span>{{ __('Ingat saya') }}</span>
                </label>
        
                <!-- Remember Me -->
                <div class="d-flex flex-column mt-3 gap-3 border">
                    
                    <a href="{{ route('register') }}">
                        {{ __('Belum memiliki akun?') }}
                    </a>
                    <button type="submit" class="btn btn-primary">
                        {{ __('Masuk') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

