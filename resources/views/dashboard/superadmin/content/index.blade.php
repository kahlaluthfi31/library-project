@php
    $title = 'Kelola ' . $config['label'];
    $isSuper = str_contains($routePrefix, 'super');
    $dashboardHome = $isSuper ? route('dashboard.super.index') : route('dashboard.admin.index');
    $menuItems = [
        ['label' => $isSuper ? 'Dashboard' : 'Dashboard Admin', 'url' => $dashboardHome],
        ['label' => 'Berita', 'url' => route($routePrefix . '.index', 'berita')],
    ];

    if ($isSuper) {
        $menuItems = array_merge($menuItems, [
            ['label' => 'Eksplorasi', 'url' => route($routePrefix . '.index', 'eksplorasi')],
            ['label' => 'Layanan', 'url' => route($routePrefix . '.index', 'layanan')],
            ['label' => 'FAQs', 'url' => route($routePrefix . '.index', 'faqs')],
            ['label' => 'Partner', 'url' => route($routePrefix . '.index', 'partner')],
            ['label' => 'Data Survei', 'url' => route('dashboard.super.survey.index')],
            ['label' => 'Saran & Masukan', 'url' => route('dashboard.super.feedback.index')],
            ['label' => 'Setting', 'url' => route('dashboard.super.settings.index')],
        ]);
    }
@endphp

@extends('dashboard.layouts.app')

@section('content')
    @if (session('status'))
        <div class="mb-4 rounded-lg bg-green-50 text-green-700 px-4 py-3 text-sm">{{ session('status') }}</div>
    @endif

    <div class="bg-white border border-slate-200 rounded-xl">
        <div class="p-4 sm:p-5 border-b border-slate-200 flex items-center justify-between">
            <div>
                <h3 class="font-semibold text-[#031C62]">{{ $config['label'] }}</h3>
            </div>
            <a href="{{ route($routePrefix . '.create', $module) }}"
                class="inline-flex items-center px-4 py-2 rounded-lg bg-[#031C62] text-white text-sm font-semibold hover:bg-[#021547]">
                + Tambah Data
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-600">
                    <tr>
                        <th class="text-left p-3">#</th>
                        @foreach($config['fields'] as $field => $meta)
                            <th class="text-left p-3">{{ $meta['label'] ?? $field }}</th>
                        @endforeach
                        <th class="text-left p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr class="border-t border-slate-100">
                            <td class="p-3">{{ $loop->iteration + ($items->currentPage() - 1) * $items->perPage() }}</td>
                            @foreach($config['fields'] as $field => $meta)
                                <td class="p-3 max-w-xs truncate">
                                    @php $value = $item->{$field}; @endphp
                                    @if(is_bool($value))
                                        {{ $value ? 'Ya' : 'Tidak' }}
                                    @else
                                        {{ is_string($value) ? $value : ($value ?? '-') }}
                                    @endif
                                </td>
                            @endforeach
                            <td class="p-3">
                                @php
                                    $deleteLabel = $item->title
                                        ?? $item->name
                                        ?? $item->question
                                        ?? $item->service_name
                                        ?? ('ID #' . $item->id);
                                    $deleteFormId = 'delete-form-' . $module . '-' . $item->id;
                                @endphp
                                <details class="relative inline-block text-left">
                                    <summary
                                        class="list-none cursor-pointer inline-flex items-center justify-center h-8 w-8 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-[#031C62] transition">
                                        <span class="sr-only">Aksi</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                                            <path d="M12 5.25a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3ZM12 13.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3ZM12 21.75a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z" />
                                        </svg>
                                    </summary>

                                    <div class="absolute right-0 mt-2 w-36 rounded-lg border border-slate-200 bg-white shadow-lg z-20 py-1">
                                        <a href="{{ route($routePrefix . '.edit', [$module, $item->id]) }}"
                                            class="block px-3 py-2 text-xs font-medium text-[#031C62] hover:bg-blue-50">Edit</a>

                                        <form id="{{ $deleteFormId }}" method="POST" action="{{ route($routePrefix . '.destroy', [$module, $item->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                data-delete-trigger="true"
                                                data-form-id="{{ $deleteFormId }}"
                                                data-item-name="{{ $deleteLabel }}"
                                                class="w-full text-left px-3 py-2 text-xs font-medium text-red-700 hover:bg-red-50">Hapus</button>
                                        </form>
                                    </div>
                                </details>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="99" class="p-6 text-center text-slate-500">Belum ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-200">
            {{ $items->links() }}
        </div>
    </div>

    <div id="deleteConfirmModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/45" data-delete-backdrop="true"></div>
        <div class="relative min-h-full flex items-center justify-center p-4">
            <div class="w-full max-w-md rounded-2xl bg-white shadow-2xl p-4 sm:p-5 text-center">
                <div class="mx-auto h-12 w-12 rounded-xl bg-red-50 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-6 w-6 text-red-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM12 17.25h.007v.008H12v-.008Z" />
                    </svg>
                </div>

                <h3 class="mt-4 text-xl font-bold text-slate-800">Hapus {{ $config['label'] }}</h3>
                <p class="mt-2 text-sm text-slate-600 leading-relaxed">
                    Yakin ingin menghapus {{ strtolower($config['label']) }}
                    <span class="font-bold text-slate-800">‘<span id="deleteItemName"></span>’</span>?
                </p>
                <p class="mt-2 text-xs text-slate-400">Tindakan ini tidak dapat dibatalkan.</p>

                <div class="mt-5 grid grid-cols-2 gap-2.5">
                    <button type="button" id="cancelDeleteBtn"
                        class="h-10 rounded-lg bg-slate-100 text-slate-600 text-sm font-medium hover:bg-slate-200 transition">
                        Batal
                    </button>
                    <button type="button" id="confirmDeleteBtn"
                        class="h-10 rounded-lg bg-red-600 text-white text-sm font-semibold hover:bg-red-700 transition inline-flex items-center justify-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673A2.25 2.25 0 0 1 15.916 21H8.084a2.25 2.25 0 0 1-2.244-1.327L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0V4.875c0-1.06-.82-1.98-1.876-2.055a51.964 51.964 0 0 0-3.248 0C9.57 2.895 8.75 3.815 8.75 4.875v.915m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                        Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        (() => {
            const modal = document.getElementById('deleteConfirmModal');
            const deleteItemName = document.getElementById('deleteItemName');
            const confirmBtn = document.getElementById('confirmDeleteBtn');
            const cancelBtn = document.getElementById('cancelDeleteBtn');
            const backdrop = modal?.querySelector('[data-delete-backdrop="true"]');
            let selectedFormId = null;

            const openModal = (formId, itemName) => {
                selectedFormId = formId;
                deleteItemName.textContent = itemName || 'data';
                modal.classList.remove('hidden');
            };

            const closeModal = () => {
                selectedFormId = null;
                modal.classList.add('hidden');
            };

            document.querySelectorAll('[data-delete-trigger="true"]').forEach((trigger) => {
                trigger.addEventListener('click', () => {
                    openModal(trigger.dataset.formId, trigger.dataset.itemName);
                });
            });

            confirmBtn?.addEventListener('click', () => {
                if (!selectedFormId) return;
                const form = document.getElementById(selectedFormId);
                if (form) form.submit();
            });

            cancelBtn?.addEventListener('click', closeModal);
            backdrop?.addEventListener('click', closeModal);

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
                    closeModal();
                }
            });
        })();
    </script>
@endsection
