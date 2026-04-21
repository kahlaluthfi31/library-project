@php
    $title = 'Kelola Profil Perpustakaan';
@endphp

@extends('dashboard.layouts.app')

@section('content')
    @if (session('status'))
        <div class="mb-4 rounded-lg bg-green-50 text-green-700 px-4 py-3 text-sm">{{ session('status') }}</div>
    @endif

    <div class="w-full bg-white border border-slate-200 rounded-xl p-5 sm:p-6">
        <p class="text-sm text-slate-600 mb-5">
            Kelola data konten halaman profil perpustakaan sesuai section aktif.
        </p>

        <div class="flex flex-wrap gap-2 mb-5 border-b border-slate-200 pb-4">
            @foreach ($tabs as $tabKey => $tabLabel)
                <a href="{{ route('dashboard.super.profile.index', ['tab' => $tabKey]) }}"
                    class="px-3 py-2 rounded-lg text-sm font-medium transition {{ $activeTab === $tabKey ? 'bg-[#031C62] text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                    {{ $tabLabel }}
                </a>
            @endforeach
        </div>

        <form method="POST" action="{{ route('dashboard.super.profile.update', $activeTab) }}" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @csrf

            @if ($activeTab === 'visi-misi')
                @php
                    $decodePoints = function ($jsonValue) {
                        if (! is_string($jsonValue) || trim($jsonValue) === '') {
                            return [];
                        }

                        $decoded = json_decode($jsonValue, true);

                        if (! is_array($decoded)) {
                            return [];
                        }

                        return array_values(array_filter(array_map(static fn($item) => trim((string) $item), $decoded), static fn($item) => $item !== ''));
                    };

                    $visiUsePoints = old('profile_visi_use_points', $values['profile_visi_use_points'] ?? '0') === '1';
                    $misiUsePoints = old('profile_misi_use_points', $values['profile_misi_use_points'] ?? '0') === '1';

                    $visiPoints = old('profile_visi_points');
                    if (! is_array($visiPoints)) {
                        $visiPoints = $decodePoints($values['profile_visi_points_json'] ?? null);
                    }
                    if (count($visiPoints) === 0) {
                        $visiPoints = [''];
                    }

                    $misiPoints = old('profile_misi_points');
                    if (! is_array($misiPoints)) {
                        $misiPoints = $decodePoints($values['profile_misi_points_json'] ?? null);
                    }
                    if (count($misiPoints) === 0) {
                        $misiPoints = [''];
                    }
                @endphp

                <div class="md:col-span-2 grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div class="rounded-xl border border-slate-200 p-4">
                        <h3 class="font-semibold text-[#031C62] mb-3">Card Visi</h3>

                        <label class="block text-sm font-medium text-slate-700 mb-1">Icon Card Visi (contoh: fa-eye)</label>
                        <input type="text" name="profile_visi_icon" value="{{ old('profile_visi_icon', $values['profile_visi_icon'] ?? '') }}"
                            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#031C62] mb-3">

                        <label class="block text-sm font-medium text-slate-700 mb-1">Judul Kartu Visi</label>
                        <input type="text" name="profile_visi_title" value="{{ old('profile_visi_title', $values['profile_visi_title'] ?? '') }}"
                            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#031C62] mb-3">

                        <label class="flex items-center justify-between gap-3 text-sm font-medium text-slate-700 mb-2">
                            <span>Mode input Visi (ON = Point, OFF = Deskripsi)</span>
                            <input type="hidden" name="profile_visi_use_points" value="0">
                            <span class="relative inline-flex h-6 w-11 items-center">
                                <input type="checkbox" name="profile_visi_use_points" value="1" id="visiModeToggle" class="peer sr-only"
                                    {{ $visiUsePoints ? 'checked' : '' }}>
                                <span class="absolute inset-0 rounded-full bg-slate-300 transition peer-checked:bg-[#031C62]"></span>
                                <span class="absolute left-0.5 top-0.5 h-5 w-5 rounded-full bg-white transition-transform peer-checked:translate-x-5"></span>
                            </span>
                        </label>

                        <div id="visiDescriptionWrap" class="space-y-1 {{ $visiUsePoints ? 'hidden' : '' }}">
                            <label class="block text-sm font-medium text-slate-700">Deskripsi Visi</label>
                            <textarea name="profile_visi_description" rows="4"
                                class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#031C62]">{{ old('profile_visi_description', $values['profile_visi_description'] ?? '') }}</textarea>
                            @error('profile_visi_description')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div id="visiPointWrap" class="space-y-2 {{ $visiUsePoints ? '' : 'hidden' }}">
                            <div id="visiPointsList" class="space-y-2">
                                @foreach ($visiPoints as $index => $point)
                                    <div class="flex items-center gap-2 point-row">
                                        <input type="text" name="profile_visi_points[]" value="{{ $point }}"
                                            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#031C62]"
                                            placeholder="Point Visi {{ $index + 1 }}">
                                        <button type="button" class="remove-point-btn px-3 py-2 rounded-lg bg-slate-100 text-slate-700 hover:bg-slate-200">Hapus</button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" id="addVisiPointBtn" class="px-3 py-2 rounded-lg bg-slate-100 text-slate-700 hover:bg-slate-200 text-sm">+ Tambah Point Visi</button>
                            @error('profile_visi_points')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                            @error('profile_visi_points.*')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="rounded-xl border border-slate-200 p-4">
                        <h3 class="font-semibold text-[#031C62] mb-3">Card Misi</h3>

                        <label class="block text-sm font-medium text-slate-700 mb-1">Icon Card Misi (contoh: fa-bullseye)</label>
                        <input type="text" name="profile_misi_icon" value="{{ old('profile_misi_icon', $values['profile_misi_icon'] ?? '') }}"
                            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#031C62] mb-3">

                        <label class="block text-sm font-medium text-slate-700 mb-1">Judul Kartu Misi</label>
                        <input type="text" name="profile_misi_title" value="{{ old('profile_misi_title', $values['profile_misi_title'] ?? '') }}"
                            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#031C62] mb-3">

                        <label class="flex items-center justify-between gap-3 text-sm font-medium text-slate-700 mb-2">
                            <span>Mode input Misi (ON = Point, OFF = Deskripsi)</span>
                            <input type="hidden" name="profile_misi_use_points" value="0">
                            <span class="relative inline-flex h-6 w-11 items-center">
                                <input type="checkbox" name="profile_misi_use_points" value="1" id="misiModeToggle" class="peer sr-only"
                                    {{ $misiUsePoints ? 'checked' : '' }}>
                                <span class="absolute inset-0 rounded-full bg-slate-300 transition peer-checked:bg-[#031C62]"></span>
                                <span class="absolute left-0.5 top-0.5 h-5 w-5 rounded-full bg-white transition-transform peer-checked:translate-x-5"></span>
                            </span>
                        </label>

                        <div id="misiDescriptionWrap" class="space-y-1 {{ $misiUsePoints ? 'hidden' : '' }}">
                            <label class="block text-sm font-medium text-slate-700">Deskripsi Misi</label>
                            <textarea name="profile_misi_description" rows="4"
                                class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#031C62]">{{ old('profile_misi_description', $values['profile_misi_description'] ?? '') }}</textarea>
                            @error('profile_misi_description')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div id="misiPointWrap" class="space-y-2 {{ $misiUsePoints ? '' : 'hidden' }}">
                            <div id="misiPointsList" class="space-y-2">
                                @foreach ($misiPoints as $index => $point)
                                    <div class="flex items-center gap-2 point-row">
                                        <input type="text" name="profile_misi_points[]" value="{{ $point }}"
                                            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#031C62]"
                                            placeholder="Point Misi {{ $index + 1 }}">
                                        <button type="button" class="remove-point-btn px-3 py-2 rounded-lg bg-slate-100 text-slate-700 hover:bg-slate-200">Hapus</button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" id="addMisiPointBtn" class="px-3 py-2 rounded-lg bg-slate-100 text-slate-700 hover:bg-slate-200 text-sm">+ Tambah Point Misi</button>
                            @error('profile_misi_points')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                            @error('profile_misi_points.*')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            @else
                @foreach ($fields as $settingKey => $meta)
                    @php
                        $type = $meta['type'] ?? 'text';
                        $isTextarea = $type === 'textarea';
                        $isFile = $type === 'file';
                        $fieldValue = old($settingKey, $values[$settingKey] ?? '');
                    @endphp
                    <div class="{{ $isTextarea ? 'md:col-span-2' : '' }}">
                        <label class="block text-sm font-medium text-slate-700 mb-1">{{ $meta['label'] }}</label>

                        @if ($isTextarea)
                            <textarea name="{{ $settingKey }}" rows="{{ $meta['rows'] ?? 3 }}"
                                class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#031C62]">{{ $fieldValue }}</textarea>
                        @elseif ($isFile)
                            <input type="file" name="{{ $settingKey }}" accept="image/*"
                                class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#031C62]">
                            @if (!empty($values[$settingKey]))
                                <div class="mt-2">
                                    <p class="text-xs text-slate-500 mb-1">Gambar saat ini:</p>
                                    <img src="{{ $values[$settingKey] }}" alt="Preview {{ $meta['label'] }}"
                                        class="h-20 w-32 object-cover rounded border border-slate-200"
                                        onerror="this.style.display='none'">
                                </div>
                            @endif
                        @else
                            <input type="text" name="{{ $settingKey }}" value="{{ $fieldValue }}"
                                class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#031C62]">
                        @endif

                        @error($settingKey)
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                @endforeach
            @endif

            <div class="pt-1 md:col-span-2">
                <button type="submit" class="px-4 py-2.5 rounded-lg bg-[#031C62] text-white font-semibold hover:bg-[#021547]">
                    Simpan Data {{ $activeTabLabel }}
                </button>
            </div>
        </form>
    </div>

    <script>
        (() => {
            const visiToggle = document.getElementById('visiModeToggle');
            const misiToggle = document.getElementById('misiModeToggle');
            const visiDescriptionWrap = document.getElementById('visiDescriptionWrap');
            const visiPointWrap = document.getElementById('visiPointWrap');
            const misiDescriptionWrap = document.getElementById('misiDescriptionWrap');
            const misiPointWrap = document.getElementById('misiPointWrap');
            const visiPointsList = document.getElementById('visiPointsList');
            const misiPointsList = document.getElementById('misiPointsList');
            const addVisiPointBtn = document.getElementById('addVisiPointBtn');
            const addMisiPointBtn = document.getElementById('addMisiPointBtn');

            const syncMode = (toggle, descriptionWrap, pointWrap) => {
                if (!toggle || !descriptionWrap || !pointWrap) return;
                const isPointMode = toggle.checked;
                descriptionWrap.classList.toggle('hidden', isPointMode);
                pointWrap.classList.toggle('hidden', !isPointMode);
            };

            const createPointRow = (name, placeholder) => {
                const row = document.createElement('div');
                row.className = 'flex items-center gap-2 point-row';
                row.innerHTML = `
                    <input type="text" name="${name}" class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#031C62]" placeholder="${placeholder}">
                    <button type="button" class="remove-point-btn px-3 py-2 rounded-lg bg-slate-100 text-slate-700 hover:bg-slate-200">Hapus</button>
                `;
                return row;
            };

            const bindRemoveEvents = (container) => {
                if (!container) return;

                container.querySelectorAll('.remove-point-btn').forEach((btn) => {
                    btn.onclick = () => {
                        const rows = container.querySelectorAll('.point-row');
                        if (rows.length <= 1) {
                            const input = rows[0]?.querySelector('input');
                            if (input) input.value = '';
                            return;
                        }

                        btn.closest('.point-row')?.remove();
                    };
                });
            };

            if (addVisiPointBtn && visiPointsList) {
                addVisiPointBtn.addEventListener('click', () => {
                    visiPointsList.appendChild(createPointRow('profile_visi_points[]', 'Point Visi'));
                    bindRemoveEvents(visiPointsList);
                });
                bindRemoveEvents(visiPointsList);
            }

            if (addMisiPointBtn && misiPointsList) {
                addMisiPointBtn.addEventListener('click', () => {
                    misiPointsList.appendChild(createPointRow('profile_misi_points[]', 'Point Misi'));
                    bindRemoveEvents(misiPointsList);
                });
                bindRemoveEvents(misiPointsList);
            }

            if (visiToggle) {
                visiToggle.addEventListener('change', () => syncMode(visiToggle, visiDescriptionWrap, visiPointWrap));
                syncMode(visiToggle, visiDescriptionWrap, visiPointWrap);
            }

            if (misiToggle) {
                misiToggle.addEventListener('change', () => syncMode(misiToggle, misiDescriptionWrap, misiPointWrap));
                syncMode(misiToggle, misiDescriptionWrap, misiPointWrap);
            }
        })();
    </script>
@endsection
