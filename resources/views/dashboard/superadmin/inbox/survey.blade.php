@php
    $title = 'Data Pengisi Survei';
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
                    <th class="text-left p-3">Status</th>
                    <th class="text-left p-3">Kepuasan</th>
                    <th class="text-left p-3">Kebutuhan Koleksi</th>
                    <th class="text-left p-3">Saran Lainnya</th>
                    <th class="text-left p-3">Waktu</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr class="border-t border-slate-100 align-top">
                        <td class="p-3">{{ $loop->iteration + ($items->currentPage() - 1) * $items->perPage() }}</td>
                        <td class="p-3">{{ $item->respondent_status }}</td>
                        <td class="p-3">{{ $item->satisfaction ?? '-' }}</td>
                        <td class="p-3">{{ collect($item->needed_collections ?? [])->join(', ') ?: '-' }}</td>
                        <td class="p-3">{{ $item->other_suggestion ?: '-' }}</td>
                        <td class="p-3">{{ $item->created_at?->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-6 text-center text-slate-500">Belum ada data survei.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-slate-200">{{ $items->links() }}</div>
    </div>
@endsection
