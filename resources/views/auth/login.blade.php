<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Dashboard - AmartaLib</title>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-gradient-to-b from-[#031C62] to-[#021547] flex items-center justify-center px-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl p-8">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-[#031C62]">Dashboard AmartaLib</h1>
            <p class="text-slate-500 text-sm mt-1">Login untuk Super Admin / Admin</p>
        </div>

        @if ($errors->any())
            <div class="mb-4 rounded-lg bg-red-50 text-red-700 px-4 py-3 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.attempt') }}" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                    class="w-full rounded-lg border border-slate-300 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#031C62]">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                <input id="password" name="password" type="password" required
                    class="w-full rounded-lg border border-slate-300 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#031C62]">
            </div>

            <label class="flex items-center gap-2 text-sm text-slate-600">
                <input type="checkbox" name="remember" class="rounded border-slate-300 text-[#031C62] focus:ring-[#031C62]">
                Ingat saya
            </label>

            <button type="submit"
                class="w-full rounded-lg bg-[#031C62] text-white py-2.5 font-semibold hover:bg-[#021547] transition">
                Masuk Dashboard
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-slate-500">
            Kembali ke <a href="{{ route('landing-page') }}" class="text-[#031C62] font-medium hover:underline">Landing Page</a>
        </p>
    </div>
</body>

</html>
