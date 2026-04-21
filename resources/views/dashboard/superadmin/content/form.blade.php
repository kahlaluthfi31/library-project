@php
    $isEdit = filled($item);
    $title = ($isEdit ? 'Edit ' : 'Tambah ') . $config['label'];
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
            ['label' => 'Pengaturan', 'url' => route('dashboard.super.settings.index')],
        ]);
    }
@endphp

@extends('dashboard.layouts.app')

@section('content')
    <div class="w-full bg-white border border-slate-200 rounded-xl p-5 sm:p-6">
        <form method="POST"
            action="{{ $isEdit ? route($routePrefix . '.update', [$module, $item->id]) : route($routePrefix . '.store', $module) }}"
            enctype="multipart/form-data"
            class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            @csrf
            @if($isEdit)
                @method('PUT')
            @endif

            @foreach ($config['fields'] as $field => $meta)
                @php
                    $isWideField = ($meta['type'] ?? 'text') === 'textarea' || in_array($field, ['description', 'excerpt', 'answer'], true);
                @endphp
                <div class="{{ $isWideField ? 'md:col-span-2 xl:col-span-3' : '' }}">
                    <label class="block text-sm font-medium text-slate-700 mb-1">{{ $meta['label'] }}</label>

                    @if ($meta['type'] === 'textarea')
                        <textarea name="{{ $field }}" rows="4"
                            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#031C62]">{{ old($field, $item->{$field} ?? '') }}</textarea>
                    @elseif (($meta['type'] ?? null) === 'select')
                        @php
                            $selectedValue = old($field, $item->{$field} ?? '');
                            $options = $meta['options'] ?? [];
                        @endphp
                        <select name="{{ $field }}"
                            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#031C62]">
                            <option value="">-- Pilih Ikon --</option>
                            @foreach ($options as $optionValue => $optionLabel)
                                <option value="{{ $optionValue }}" {{ $selectedValue === $optionValue ? 'selected' : '' }}>
                                    {{ $optionLabel }} ({{ $optionValue }})
                                </option>
                            @endforeach

                            @if ($selectedValue && !array_key_exists($selectedValue, $options))
                                <option value="{{ $selectedValue }}" selected>
                                    Ikon saat ini ({{ $selectedValue }})
                                </option>
                            @endif
                        </select>
                        <p class="mt-1 text-xs text-slate-500">Pilih ikon dari daftar agar tampilan layanan konsisten.</p>
                    @elseif ($meta['type'] === 'file')
                        <input type="file" name="{{ $field }}" accept="image/*"
                            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#031C62]">
                        @if (!empty($item?->{$field}))
                            <div class="mt-2">
                                <p class="text-xs text-slate-500 mb-2">Gambar saat ini:</p>
                                <img src="{{ $item->{$field} }}" alt="Preview {{ $meta['label'] }}"
                                    class="h-24 w-40 object-cover rounded-lg border border-slate-200"
                                    onerror="this.style.display='none'">
                            </div>
                        @endif
                    @elseif ($meta['type'] === 'checkbox')
                        <label class="inline-flex items-center gap-2 text-sm text-slate-700">
                            <input type="checkbox" name="{{ $field }}" value="1" class="rounded border-slate-300 text-[#031C62] focus:ring-[#031C62]"
                                {{ old($field, $item->{$field} ?? false) ? 'checked' : '' }}>
                            Aktif
                        </label>
                    @else
                        <input type="{{ $meta['type'] }}" name="{{ $field }}"
                            value="{{ old($field, $item->{$field} ?? '') }}"
                            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#031C62]">
                    @endif

                    @error($field)
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            @endforeach

            <div class="flex items-center gap-3 pt-2 md:col-span-2 xl:col-span-3">
                <button type="submit" class="px-4 py-2.5 rounded-lg bg-[#031C62] text-white font-semibold hover:bg-[#021547]">Simpan</button>
                <a href="{{ route($routePrefix . '.index', $module) }}" class="px-4 py-2.5 rounded-lg border border-slate-300 text-slate-700 font-semibold">Batal</a>
            </div>
        </form>
    </div>
@endsection
