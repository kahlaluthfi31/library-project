@php
    $title = 'Setting Landing Page';
    $menuItems = [
        ['label' => 'Dashboard', 'url' => route('dashboard.super.index')],
        ['label' => 'Eksplorasi', 'url' => route('dashboard.super.content.index', 'eksplorasi')],
        ['label' => 'Layanan', 'url' => route('dashboard.super.content.index', 'layanan')],
        ['label' => 'Berita', 'url' => route('dashboard.super.content.index', 'berita')],
        ['label' => 'FAQs', 'url' => route('dashboard.super.content.index', 'faqs')],
        ['label' => 'Partner', 'url' => route('dashboard.super.content.index', 'partner')],
        ['label' => 'Data Survei', 'url' => route('dashboard.super.survey.index')],
        ['label' => 'Saran & Masukan', 'url' => route('dashboard.super.feedback.index')],
        ['label' => 'Pengaturan', 'url' => route('dashboard.super.settings.index')],
    ];
@endphp

@extends('dashboard.layouts.app')

@section('content')
    @if (session('status'))
        <div class="mb-4 rounded-lg bg-green-50 text-green-700 px-4 py-3 text-sm">{{ session('status') }}</div>
    @endif

    <div class="w-full bg-white border border-slate-200 rounded-xl p-5 sm:p-6">
        <p class="text-sm text-slate-600 mb-5">Kelola hero, section heading/deskripsi landing page, kontak perpustakaan, dan teks footer.</p>

        <form method="POST" action="{{ route('dashboard.super.settings.update') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @csrf
            @foreach ($fields as $key => $label)
                <div class="md:col-span-1 {{ str_contains($key, 'description') ? 'md:col-span-2' : '' }}">
                    <label class="block text-sm font-medium text-slate-700 mb-1">{{ $label }}</label>
                    <textarea name="{{ $key }}" rows="{{ str_contains($key, 'description') ? 3 : 2 }}"
                        class="w-full rounded-lg border border-slate-300 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#031C62]">{{ old($key, $settings[$key] ?? '') }}</textarea>
                    @error($key)
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            @endforeach

            <div class="md:col-span-2 pt-2">
                <button type="submit" class="px-4 py-2.5 rounded-lg bg-[#031C62] text-white font-semibold hover:bg-[#021547]">Simpan Pengaturan</button>
            </div>
        </form>
    </div>
@endsection
