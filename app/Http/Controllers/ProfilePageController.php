<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\View\View;

class ProfilePageController extends Controller
{
    public function index(): View
    {
        $keys = ['tentang', 'visi_misi', 'struktur', 'staff', 'fasilitas', 'peraturan'];
        $profileContent = [];

        foreach ($keys as $key) {
            $profileContent[$key] = SiteSetting::getValue('profile_' . $key . '_content');
        }

        $profileSettings = SiteSetting::query()
            ->where('key', 'like', 'profile_%')
            ->pluck('value', 'key')
            ->toArray();

        return view('profilPerpustakaan', [
            'profileContent' => $profileContent,
            'profileSettings' => $profileSettings,
        ]);
    }
}
