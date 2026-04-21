@php
    $title = 'Data Saran & Masukan';
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
    <div class="bg-white border border-slate-200 rounded-xl overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-600">
                <tr>
                    <th class="text-left p-3">#</th>
                    <th class="text-left p-3">Nama</th>
                    <th class="text-left p-3">Kritik</th>
                    <th class="text-left p-3">Saran</th>
                    <th class="text-left p-3">Waktu</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr class="border-t border-slate-100 align-top">
                        <td class="p-3">{{ $loop->iteration + ($items->currentPage() - 1) * $items->perPage() }}</td>
                        <td class="p-3">{{ $item->name ?: 'Anonim' }}</td>
                        <td class="p-3">{{ $item->kritik }}</td>
                        <td class="p-3">{{ $item->saran ?: '-' }}</td>
                        <td class="p-3">{{ $item->created_at?->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-6 text-center text-slate-500">Belum ada data saran & masukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-slate-200">{{ $items->links() }}</div>
    </div>
@endsection
