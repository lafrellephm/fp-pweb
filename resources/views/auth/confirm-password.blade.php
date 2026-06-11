<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Konfirmasi Kata Sandi</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div>
        {{ __('Ini adalah area aman aplikasi. Silakan konfirmasi kata sandi Anda sebelum melanjutkan.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Kata Sandi -->
        <div>
            <label for="password">{{ __('Kata Sandi') }}</label>
            <input id="password" type="password" name="password" required autocomplete="current-password">
            @error('password')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <button type="submit">
                {{ __('Konfirmasi') }}
            </button>
        </div>
    </form>
</body>
</html>

