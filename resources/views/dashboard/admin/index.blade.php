@php
    $title = 'Dashboard Admin';
    $menuItems = [
        ['label' => 'Dashboard Admin', 'url' => route('dashboard.admin.index')],
        ['label' => 'Kelola Berita', 'url' => route('dashboard.admin.content.index', 'berita')],
    ];
@endphp

@extends('dashboard.layouts.app')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        @foreach ($menus as $menu)
            <a href="{{ $menu['url'] }}" class="block rounded-xl bg-white border border-slate-200 p-5 shadow-sm hover:shadow-md transition">
                <h3 class="text-lg font-semibold text-[#031C62]">{{ $menu['label'] }}</h3>
                <p class="text-sm text-slate-600 mt-2">{{ $menu['desc'] }}</p>
                <span class="inline-flex mt-4 text-xs font-semibold bg-blue-50 text-[#031C62] px-2.5 py-1 rounded-full">Admin</span>
            </a>
        @endforeach
    </div>
@endsection
