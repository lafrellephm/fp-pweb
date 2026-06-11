<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Atur Ulang Kata Sandi</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Kata Sandi Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <label for="email">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
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
            <button type="submit">
                {{ __('Atur Ulang Kata Sandi') }}
            </button>
        </div>
    </form>
</body>
</html>

