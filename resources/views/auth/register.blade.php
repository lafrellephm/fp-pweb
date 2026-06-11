<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class=" d-flex flex-row vh-100">

    <form method="POST" action="{{ route('register') }}" class="border mx-auto my-auto ">
        @csrf

        <!-- Nama -->
        <div class="">
            <label for="name">{{ __('Nama') }}
            </label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Address -->
        <div>
            <label for="email">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
            @error('email')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <!-- Kata Sandi -->
        <div>
            <label for="password">{{ __('Kata Sandi') }}</label>
            <input id="password" type="password" name="password" required autocomplete="new-password">
            @error('password')
                <div>{{ $message }}</div>
            @enderror
        </div>      

        <!-- Konfirmasi Kata Sandi -->
        <div>
            <label for="password_confirmation">{{ __('Konfirmasi Kata Sandi') }}</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
            @error('password_confirmation')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <a href="{{ route('login') }}" class="">
                {{ __('Sudah punya akun?') }}
            </a>

            <button type="submit">
                {{ __('Daftar') }}
            </button>
        </div>
    </form>
    
</body>
</html>

