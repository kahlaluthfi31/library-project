<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }} - AmartaLib</title>
    @vite('resources/css/app.css')
</head>

<body class="h-screen bg-slate-50 text-slate-800 overflow-hidden">
    <div class="flex h-screen">
        <aside class="w-64 h-screen bg-[#031C62] text-white hidden lg:flex lg:flex-col overflow-hidden">
            <div class="px-5 py-4 border-b border-white/10">
                <h1 class="text-2xl font-bold mt-1">AmartaLib</h1>
                <p class="text-xs text-blue-100 mt-1">{{ auth()->user()->role === 'super_admin' ? 'Super Admin' : 'Admin' }}</p>
            </div>

            <nav class="flex-1 min-h-0 overflow-y-auto p-3 space-y-1">
                @php
                    $sidebarItems = auth()->user()->role === 'super_admin'
                        ? [
                            ['label' => 'Dashboard', 'url' => route('dashboard.super.index')],
                            ['label' => 'Eksplorasi', 'url' => route('dashboard.super.content.index', 'eksplorasi')],
                            ['label' => 'Layanan', 'url' => route('dashboard.super.content.index', 'layanan')],
                            ['label' => 'Berita', 'url' => route('dashboard.super.content.index', 'berita')],
                            ['label' => 'FAQs', 'url' => route('dashboard.super.content.index', 'faqs')],
                            ['label' => 'Partner', 'url' => route('dashboard.super.content.index', 'partner')],
                            ['label' => 'Profil', 'url' => route('dashboard.super.profile.index')],
                            ['label' => 'Data Survei', 'url' => route('dashboard.super.survey.index')],
                            ['label' => 'Saran & Masukan', 'url' => route('dashboard.super.feedback.index')],
                            ['label' => 'Pengaturan', 'url' => route('dashboard.super.settings.index')],
                        ]
                        : [
                            ['label' => 'Berita', 'url' => route('dashboard.admin.content.index', 'berita')],
                        ];
                @endphp

                @foreach ($sidebarItems as $item)
                    @php
                        $itemUrl = rtrim($item['url'], '/');
                        $currentUrl = rtrim(request()->url(), '/');
                        $isContentMenu = \Illuminate\Support\Str::contains($itemUrl, '/content/');
                        $isActive = $currentUrl === $itemUrl
                            || ($isContentMenu && \Illuminate\Support\Str::startsWith($currentUrl, $itemUrl . '/'));
                    @endphp
                    <a href="{{ $item['url'] }}"
                        class="block rounded-lg px-3 py-2.5 text-[13px] transition {{ $isActive ? 'bg-white text-[#031C62] font-semibold' : 'hover:bg-white/10 text-blue-100' }}">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            <form method="POST" action="{{ route('logout') }}" class="p-4 border-t border-white/10">
                @csrf
                <div class="flex items-center justify-between gap-3 rounded-xl bg-white/10 p-3">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="h-10 w-10 rounded-full bg-white text-[#031C62] font-bold flex items-center justify-center shrink-0">
                            {{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs text-blue-200">{{ auth()->user()->role === 'super_admin' ? 'Super Admin' : 'Admin' }}</p>
                            <p class="text-sm font-semibold text-white truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-blue-100 truncate">{{ auth()->user()->email }}</p>
                        </div>
                    </div>

                    <button type="submit" title="Logout"
                        class="h-10 w-10 rounded-lg bg-white text-[#031C62] hover:bg-blue-100 transition flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                        </svg>
                    </button>
                </div>
            </form>
        </aside>

    <main class="flex-1 h-screen overflow-y-auto">
            <header class="bg-white border-b border-slate-200 px-4 sm:px-6 py-4 flex items-center justify-between">
                <div>
                    <h2 class="text-lg sm:text-xl font-bold text-[#031C62]">{{ $title ?? 'Dashboard' }}</h2>
                    <p class="text-sm text-slate-500">Selamat datang, {{ auth()->user()->name }}</p>
                </div>
            </header>

            <section class="p-4 sm:p-6 lg:p-8">
                @yield('content')
            </section>
        </main>
    </div>
</body>

</html>
