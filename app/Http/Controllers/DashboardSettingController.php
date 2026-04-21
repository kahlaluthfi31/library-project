<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardSettingController extends Controller
{
    /**
     * @return array<string, string>
     */
    protected function fields(): array
    {
        return [
            'hero_title' => 'Hero - Teks Besar Utama',
            'hero_description' => 'Hero - Deskripsi',
            'hero_image' => 'Hero - URL Gambar',

            'section_explorasi_title' => 'Section Eksplorasi - Header',
            'section_explorasi_description' => 'Section Eksplorasi - Deskripsi',
            'section_layanan_title' => 'Section Layanan - Header',
            'section_layanan_description' => 'Section Layanan - Deskripsi',
            'section_berita_title' => 'Section Berita - Header',
            'section_berita_description' => 'Section Berita - Deskripsi',
            'section_survei_title' => 'Section Survei - Header',
            'section_survei_description' => 'Section Survei - Deskripsi',
            'section_survei_image' => 'Section Survei - URL Gambar',
            'section_survei_button_text' => 'Section Survei - Teks Tombol',
            'section_faq_title' => 'Section FAQ - Header',
            'section_faq_description' => 'Section FAQ - Deskripsi',
            'section_partner_title' => 'Section Partner - Header',
            'section_partner_description' => 'Section Partner - Deskripsi',

            'contact_map_url' => 'Kontak - URL Google Maps',
            'contact_place_name' => 'Kontak - Nama Tempat',
            'contact_email' => 'Kontak - Email',
            'contact_phone' => 'Kontak - Telepon',

            'footer_title' => 'Footer - Judul',
            'footer_description' => 'Footer - Deskripsi',
        ];
    }

    public function index(): View
    {
        $settings = SiteSetting::query()->pluck('value', 'key')->toArray();

        return view('dashboard.superadmin.setting.index', [
            'fields' => $this->fields(),
            'settings' => $settings,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $rules = [];
        foreach (array_keys($this->fields()) as $field) {
            $rules[$field] = ['nullable', 'string'];
        }

        $validated = $request->validate($rules);

        foreach ($validated as $key => $value) {
            SiteSetting::setValue($key, $value);
        }

        return redirect()->route('dashboard.super.settings.index')->with('status', 'Pengaturan berhasil disimpan.');
    }
}
