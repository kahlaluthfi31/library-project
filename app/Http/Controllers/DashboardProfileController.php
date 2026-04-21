<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class DashboardProfileController extends Controller
{
    /**
     * @return array<string, string>
     */
    protected function tabs(): array
    {
        return [
            'tentang' => 'Tentang',
            'visi-misi' => 'Visi & Misi',
            'struktur' => 'Struktur',
            'staff' => 'Staff',
            'fasilitas' => 'Fasilitas',
            'peraturan' => 'Peraturan',
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    protected function tabFields(): array
    {
        return [
            'tentang' => [
                'profile_tentang_title' => ['label' => 'Judul Tentang', 'type' => 'text'],
                'profile_tentang_image_url' => ['label' => 'Gambar Tentang', 'type' => 'file'],
                'profile_tentang_paragraph_1' => ['label' => 'Paragraf 1', 'type' => 'textarea', 'rows' => 3],
                'profile_tentang_paragraph_2' => ['label' => 'Paragraf 2', 'type' => 'textarea', 'rows' => 3],
                'profile_tentang_paragraph_3' => ['label' => 'Paragraf 3', 'type' => 'textarea', 'rows' => 3],
            ],
            'visi-misi' => [
                'profile_visi_icon' => ['label' => 'Icon Card Visi', 'type' => 'text'],
                'profile_visi_title' => ['label' => 'Judul Kartu Visi', 'type' => 'text'],
                'profile_visi_use_points' => ['label' => 'Mode Input Visi (ON = Point, OFF = Deskripsi)', 'type' => 'toggle'],
                'profile_visi_description' => ['label' => 'Deskripsi Visi', 'type' => 'textarea', 'rows' => 3],
                'profile_visi_points_json' => ['label' => 'Point Visi', 'type' => 'points'],
                'profile_misi_icon' => ['label' => 'Icon Card Misi', 'type' => 'text'],
                'profile_misi_title' => ['label' => 'Judul Kartu Misi', 'type' => 'text'],
                'profile_misi_use_points' => ['label' => 'Mode Input Misi (ON = Point, OFF = Deskripsi)', 'type' => 'toggle'],
                'profile_misi_description' => ['label' => 'Deskripsi Misi', 'type' => 'textarea', 'rows' => 3],
                'profile_misi_points_json' => ['label' => 'Point Misi', 'type' => 'points'],
            ],
            'struktur' => [
                'profile_struktur_badge' => ['label' => 'Badge Section Struktur', 'type' => 'text'],
                'profile_struktur_title' => ['label' => 'Judul Section Struktur', 'type' => 'text'],
                'profile_struktur_description' => ['label' => 'Deskripsi Section Struktur', 'type' => 'textarea', 'rows' => 2],
                'profile_struktur_ketua_name' => ['label' => 'Nama Ketua', 'type' => 'text'],
                'profile_struktur_ketua_position' => ['label' => 'Jabatan Ketua', 'type' => 'text'],
                'profile_struktur_ketua_image' => ['label' => 'Upload Foto Ketua', 'type' => 'file'],
                'profile_struktur_wakil_name' => ['label' => 'Nama Wakil Ketua', 'type' => 'text'],
                'profile_struktur_wakil_position' => ['label' => 'Jabatan Wakil Ketua', 'type' => 'text'],
                'profile_struktur_wakil_image' => ['label' => 'Upload Foto Wakil Ketua', 'type' => 'file'],
                'profile_struktur_sekretaris_name' => ['label' => 'Nama Sekretaris', 'type' => 'text'],
                'profile_struktur_sekretaris_position' => ['label' => 'Jabatan Sekretaris', 'type' => 'text'],
                'profile_struktur_sekretaris_image' => ['label' => 'Upload Foto Sekretaris', 'type' => 'file'],
                'profile_struktur_staff_1_name' => ['label' => 'Nama Staff 1', 'type' => 'text'],
                'profile_struktur_staff_1_position' => ['label' => 'Jabatan Staff 1', 'type' => 'text'],
                'profile_struktur_staff_1_image' => ['label' => 'Upload Foto Staff 1', 'type' => 'file'],
                'profile_struktur_staff_2_name' => ['label' => 'Nama Staff 2', 'type' => 'text'],
                'profile_struktur_staff_2_position' => ['label' => 'Jabatan Staff 2', 'type' => 'text'],
                'profile_struktur_staff_2_image' => ['label' => 'Upload Foto Staff 2', 'type' => 'file'],
                'profile_struktur_staff_3_name' => ['label' => 'Nama Staff 3', 'type' => 'text'],
                'profile_struktur_staff_3_position' => ['label' => 'Jabatan Staff 3', 'type' => 'text'],
                'profile_struktur_staff_3_image' => ['label' => 'Upload Foto Staff 3', 'type' => 'file'],
            ],
            'staff' => [
                'profile_staff_badge' => ['label' => 'Badge Section Staff', 'type' => 'text'],
                'profile_staff_title' => ['label' => 'Judul Section Staff', 'type' => 'text'],
                'profile_staff_description' => ['label' => 'Deskripsi Section Staff', 'type' => 'textarea', 'rows' => 2],
                'profile_staff_1_name' => ['label' => 'Nama Staff 1', 'type' => 'text'],
                'profile_staff_1_position' => ['label' => 'Jabatan Staff 1', 'type' => 'text'],
                'profile_staff_1_description' => ['label' => 'Deskripsi Staff 1', 'type' => 'textarea', 'rows' => 2],
                'profile_staff_1_image' => ['label' => 'Upload Foto Staff 1', 'type' => 'file'],
                'profile_staff_2_name' => ['label' => 'Nama Staff 2', 'type' => 'text'],
                'profile_staff_2_position' => ['label' => 'Jabatan Staff 2', 'type' => 'text'],
                'profile_staff_2_description' => ['label' => 'Deskripsi Staff 2', 'type' => 'textarea', 'rows' => 2],
                'profile_staff_2_image' => ['label' => 'Upload Foto Staff 2', 'type' => 'file'],
                'profile_staff_3_name' => ['label' => 'Nama Staff 3', 'type' => 'text'],
                'profile_staff_3_position' => ['label' => 'Jabatan Staff 3', 'type' => 'text'],
                'profile_staff_3_description' => ['label' => 'Deskripsi Staff 3', 'type' => 'textarea', 'rows' => 2],
                'profile_staff_3_image' => ['label' => 'Upload Foto Staff 3', 'type' => 'file'],
            ],
            'fasilitas' => [
                'profile_fasilitas_badge' => ['label' => 'Badge Section Fasilitas', 'type' => 'text'],
                'profile_fasilitas_title' => ['label' => 'Judul Section Fasilitas', 'type' => 'text'],
                'profile_fasilitas_description' => ['label' => 'Deskripsi Section Fasilitas', 'type' => 'textarea', 'rows' => 2],
                'profile_fasilitas_1_icon' => ['label' => 'Icon Fasilitas 1', 'type' => 'text'],
                'profile_fasilitas_1_title' => ['label' => 'Judul Fasilitas 1', 'type' => 'text'],
                'profile_fasilitas_1_description' => ['label' => 'Deskripsi Fasilitas 1', 'type' => 'textarea', 'rows' => 2],
                'profile_fasilitas_2_icon' => ['label' => 'Icon Fasilitas 2', 'type' => 'text'],
                'profile_fasilitas_2_title' => ['label' => 'Judul Fasilitas 2', 'type' => 'text'],
                'profile_fasilitas_2_description' => ['label' => 'Deskripsi Fasilitas 2', 'type' => 'textarea', 'rows' => 2],
                'profile_fasilitas_3_icon' => ['label' => 'Icon Fasilitas 3', 'type' => 'text'],
                'profile_fasilitas_3_title' => ['label' => 'Judul Fasilitas 3', 'type' => 'text'],
                'profile_fasilitas_3_description' => ['label' => 'Deskripsi Fasilitas 3', 'type' => 'textarea', 'rows' => 2],
                'profile_fasilitas_4_icon' => ['label' => 'Icon Fasilitas 4', 'type' => 'text'],
                'profile_fasilitas_4_title' => ['label' => 'Judul Fasilitas 4', 'type' => 'text'],
                'profile_fasilitas_4_description' => ['label' => 'Deskripsi Fasilitas 4', 'type' => 'textarea', 'rows' => 2],
                'profile_fasilitas_5_icon' => ['label' => 'Icon Fasilitas 5', 'type' => 'text'],
                'profile_fasilitas_5_title' => ['label' => 'Judul Fasilitas 5', 'type' => 'text'],
                'profile_fasilitas_5_description' => ['label' => 'Deskripsi Fasilitas 5', 'type' => 'textarea', 'rows' => 2],
                'profile_fasilitas_6_icon' => ['label' => 'Icon Fasilitas 6', 'type' => 'text'],
                'profile_fasilitas_6_title' => ['label' => 'Judul Fasilitas 6', 'type' => 'text'],
                'profile_fasilitas_6_description' => ['label' => 'Deskripsi Fasilitas 6', 'type' => 'textarea', 'rows' => 2],
            ],
            'peraturan' => [
                'profile_peraturan_badge' => ['label' => 'Badge Section Peraturan', 'type' => 'text'],
                'profile_peraturan_title' => ['label' => 'Judul Section Peraturan', 'type' => 'text'],
                'profile_peraturan_description' => ['label' => 'Deskripsi Section Peraturan', 'type' => 'textarea', 'rows' => 2],
                'profile_peraturan_rule_1_title' => ['label' => 'Judul Rule 1', 'type' => 'text'],
                'profile_peraturan_rule_2_title' => ['label' => 'Judul Rule 2', 'type' => 'text'],
                'profile_peraturan_rule_3_title' => ['label' => 'Judul Rule 3', 'type' => 'text'],
                'profile_peraturan_rule_4_title' => ['label' => 'Judul Rule 4', 'type' => 'text'],
            ],
        ];
    }

    public function index(Request $request): View
    {
        $tabs = $this->tabs();
        $tabFields = $this->tabFields();
        $activeTab = $request->query('tab', 'tentang');
        abort_unless(array_key_exists($activeTab, $tabs), 404);
        abort_unless(array_key_exists($activeTab, $tabFields), 404);

        $fieldsForActiveTab = $tabFields[$activeTab];
        $values = [];
        foreach (array_keys($fieldsForActiveTab) as $settingKey) {
            $values[$settingKey] = SiteSetting::getValue($settingKey);
        }

        return view('dashboard.superadmin.profile.index', [
            'tabs' => $tabs,
            'activeTab' => $activeTab,
            'activeTabLabel' => $tabs[$activeTab],
            'fields' => $fieldsForActiveTab,
            'values' => $values,
        ]);
    }

    public function update(Request $request, string $tab): RedirectResponse
    {
        $tabs = $this->tabs();
        $tabFields = $this->tabFields();
        abort_unless(array_key_exists($tab, $tabs), 404);
        abort_unless(array_key_exists($tab, $tabFields), 404);

        if ($tab === 'visi-misi') {
            $validated = $request->validate([
                'profile_visi_icon' => ['nullable', 'string', 'max:255'],
                'profile_visi_title' => ['required', 'string', 'max:255'],
                'profile_visi_use_points' => ['nullable', 'boolean'],
                'profile_visi_description' => ['nullable', 'string'],
                'profile_visi_points' => ['nullable', 'array'],
                'profile_visi_points.*' => ['nullable', 'string', 'max:255'],

                'profile_misi_icon' => ['nullable', 'string', 'max:255'],
                'profile_misi_title' => ['required', 'string', 'max:255'],
                'profile_misi_use_points' => ['nullable', 'boolean'],
                'profile_misi_description' => ['nullable', 'string'],
                'profile_misi_points' => ['nullable', 'array'],
                'profile_misi_points.*' => ['nullable', 'string', 'max:255'],
            ]);

            $visiUsePoints = $request->boolean('profile_visi_use_points');
            $misiUsePoints = $request->boolean('profile_misi_use_points');

            $visiPoints = collect($validated['profile_visi_points'] ?? [])
                ->map(fn($item) => trim((string) $item))
                ->filter(fn($item) => $item !== '')
                ->values()
                ->all();

            $misiPoints = collect($validated['profile_misi_points'] ?? [])
                ->map(fn($item) => trim((string) $item))
                ->filter(fn($item) => $item !== '')
                ->values()
                ->all();

            if ($visiUsePoints && count($visiPoints) === 0) {
                return back()->withErrors(['profile_visi_points' => 'Minimal isi 1 point untuk Visi.'])->withInput();
            }

            if (! $visiUsePoints && blank($validated['profile_visi_description'] ?? null)) {
                return back()->withErrors(['profile_visi_description' => 'Deskripsi Visi wajib diisi saat mode deskripsi.'])->withInput();
            }

            if ($misiUsePoints && count($misiPoints) === 0) {
                return back()->withErrors(['profile_misi_points' => 'Minimal isi 1 point untuk Misi.'])->withInput();
            }

            if (! $misiUsePoints && blank($validated['profile_misi_description'] ?? null)) {
                return back()->withErrors(['profile_misi_description' => 'Deskripsi Misi wajib diisi saat mode deskripsi.'])->withInput();
            }

            SiteSetting::setValue('profile_visi_icon', $validated['profile_visi_icon'] ?? null);
            SiteSetting::setValue('profile_visi_title', $validated['profile_visi_title']);
            SiteSetting::setValue('profile_visi_use_points', $visiUsePoints ? '1' : '0');
            SiteSetting::setValue('profile_visi_description', $validated['profile_visi_description'] ?? null);
            SiteSetting::setValue('profile_visi_points_json', json_encode($visiPoints));

            SiteSetting::setValue('profile_misi_icon', $validated['profile_misi_icon'] ?? null);
            SiteSetting::setValue('profile_misi_title', $validated['profile_misi_title']);
            SiteSetting::setValue('profile_misi_use_points', $misiUsePoints ? '1' : '0');
            SiteSetting::setValue('profile_misi_description', $validated['profile_misi_description'] ?? null);
            SiteSetting::setValue('profile_misi_points_json', json_encode($misiPoints));

            return redirect()
                ->route('dashboard.super.profile.index', ['tab' => $tab])
                ->with('status', 'Data tab ' . $tabs[$tab] . ' berhasil disimpan.');
        }

        $rules = [];
        foreach ($tabFields[$tab] as $settingKey => $meta) {
            $fieldType = $meta['type'] ?? 'text';

            if ($fieldType === 'file') {
                $rules[$settingKey] = ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:2048'];
            } elseif ($fieldType === 'toggle') {
                $rules[$settingKey] = ['nullable', 'boolean'];
            } elseif ($fieldType === 'points') {
                continue;
            } else {
                $rules[$settingKey] = ['nullable', 'string'];
            }
        }

        $validated = $request->validate($rules);

        foreach (array_keys($tabFields[$tab]) as $settingKey) {
            $fieldType = $tabFields[$tab][$settingKey]['type'] ?? 'text';

            if ($fieldType === 'toggle') {
                SiteSetting::setValue($settingKey, $request->boolean($settingKey) ? '1' : '0');
                continue;
            }

            if ($fieldType === 'file') {
                if ($request->hasFile($settingKey)) {
                    $oldPath = SiteSetting::getValue($settingKey);
                    $storedPath = $request->file($settingKey)->store('uploads/profile/' . str_replace('-', '_', $tab), 'public');
                    $publicPath = '/storage/' . $storedPath;

                    if ($oldPath && $oldPath !== $publicPath) {
                        $this->deleteManagedImagePath($oldPath);
                    }

                    SiteSetting::setValue($settingKey, $publicPath);
                }

                continue;
            }

            SiteSetting::setValue($settingKey, $validated[$settingKey] ?? null);
        }

        return redirect()
            ->route('dashboard.super.profile.index', ['tab' => $tab])
            ->with('status', 'Data tab ' . $tabs[$tab] . ' berhasil disimpan.');
    }

    protected function deleteManagedImagePath(string $path): void
    {
        if (! Str::startsWith($path, '/storage/uploads/profile/')) {
            return;
        }

        $relativePath = Str::after($path, '/storage/');

        if ($relativePath !== '') {
            Storage::disk('public')->delete($relativePath);
        }
    }
}
