<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log in</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="d-flex flex-row vh-100">
    <!-- Session Status -->
    @if (session('status'))
        <div>
            {{ session('status') }}
        </div>
    @endif
    <div class="border mx-auto my-auto ">
        <form method="POST" action="{{ route('login') }}" >
            @csrf
    
            <!-- Email Address -->
            <div>
                <label for="email">{{ __('Email') }}</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                @error('email')
                    <div>{{ $message }}</div>
                @enderror
            </div>
    
            <!-- Password -->
            <div>
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" name="password" required autocomplete="current-password">
                @error('password')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <label for="remember_me">
                <input id="remember_me" type="checkbox" name="remember">
                <span>{{ __('Remember me') }}</span>
            </label>
    
            <!-- Remember Me -->
            <div class="d-flex flex-column mt-3 gap-3 border">
                
                <a href="{{ route('register') }}">
                    {{ __('Belum memiliki akun?') }}
                </a>
                <button type="submit" class="btn btn-primary">
                    {{ __('Log in') }}
                </button>
            </div>
        </form>
    </div>
</body>
</html>

