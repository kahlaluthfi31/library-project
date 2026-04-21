@php
    $title = 'Dashboard Super Admin';
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
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
        @foreach ($menus as $menu)
            <a href="{{ $menu['url'] }}" class="block rounded-xl bg-white border border-slate-200 p-5 shadow-sm hover:shadow-md transition">
                <h3 class="text-lg font-semibold text-[#031C62]">{{ $menu['label'] }}</h3>
                <p class="text-sm text-slate-600 mt-2">{{ $menu['desc'] }}</p>
                <span class="inline-flex mt-4 text-xs font-semibold bg-blue-50 text-[#031C62] px-2.5 py-1 rounded-full">Super Admin</span>
            </a>
        @endforeach
    </div>
@endsection
