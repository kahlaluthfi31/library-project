<?php

namespace App\Http\Controllers;

use App\Models\ExplorationItem;
use App\Models\Faq;
use App\Models\LibraryService;
use App\Models\NewsItem;
use App\Models\Partner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class DashboardContentController extends Controller
{
    /**
     * @return array<string, string>
     */
    protected function iconOptions(): array
    {
        return [
            'fas fa-book-open' => 'Buku Terbuka',
            'fas fa-book' => 'Buku',
            'fas fa-book-reader' => 'Membaca Buku',
            'fas fa-library' => 'Perpustakaan',
            'fas fa-laptop' => 'Laptop',
            'fas fa-desktop' => 'Komputer',
            'fas fa-wifi' => 'WiFi',
            'fas fa-globe' => 'Internet',
            'fas fa-print' => 'Printer',
            'fas fa-copy' => 'Fotokopi',
            'fas fa-headphones' => 'Headphone',
            'fas fa-chalkboard-teacher' => 'Kelas/Pelatihan',
            'fas fa-users' => 'Komunitas/Anggota',
            'fas fa-search' => 'Pencarian',
            'fas fa-newspaper' => 'Berita/Informasi',
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    protected function modules(): array
    {
        return [
            'eksplorasi' => [
                'label' => 'Eksplorasi Perpustakaan Kami',
                'model' => ExplorationItem::class,
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Judul', 'rules' => ['required', 'string', 'max:255']],
                    'description' => ['type' => 'textarea', 'label' => 'Deskripsi', 'rules' => ['nullable', 'string']],
                    'image_url' => ['type' => 'file', 'label' => 'Upload Gambar', 'rules' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:2048']],
                    'link_url' => ['type' => 'text', 'label' => 'URL Link', 'rules' => ['nullable', 'max:2048']],
                    'sort_order' => ['type' => 'number', 'label' => 'Urutan', 'rules' => ['nullable', 'integer', 'min:0']],
                    'is_active' => ['type' => 'checkbox', 'label' => 'Aktif', 'rules' => ['nullable', 'boolean']],
                ],
            ],
            'layanan' => [
                'label' => 'Layanan Perpustakaan',
                'model' => LibraryService::class,
                'fields' => [
                    'slug' => ['type' => 'text', 'label' => 'Slug', 'rules' => ['required', 'string', 'max:255']],
                    'title' => ['type' => 'text', 'label' => 'Judul', 'rules' => ['required', 'string', 'max:255']],
                    'description' => ['type' => 'textarea', 'label' => 'Deskripsi', 'rules' => ['nullable', 'string']],
                    'icon' => [
                        'type' => 'select',
                        'label' => 'Pilih Ikon',
                        'options' => $this->iconOptions(),
                        'rules' => ['nullable', 'string', 'max:255'],
                    ],
                    'sort_order' => ['type' => 'number', 'label' => 'Urutan', 'rules' => ['nullable', 'integer', 'min:0']],
                    'is_active' => ['type' => 'checkbox', 'label' => 'Aktif', 'rules' => ['nullable', 'boolean']],
                ],
            ],
            'berita' => [
                'label' => 'Berita Terbaru',
                'model' => NewsItem::class,
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Judul Berita', 'rules' => ['required', 'string', 'max:255']],
                    'excerpt' => ['type' => 'textarea', 'label' => 'Ringkasan', 'rules' => ['nullable', 'string']],
                    'image_url' => ['type' => 'file', 'label' => 'Upload Gambar', 'rules' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:2048']],
                    'published_at' => ['type' => 'datetime-local', 'label' => 'Tanggal Publikasi', 'rules' => ['nullable', 'date']],
                    'is_active' => ['type' => 'checkbox', 'label' => 'Aktif', 'rules' => ['nullable', 'boolean']],
                ],
            ],
            'faqs' => [
                'label' => 'FAQs',
                'model' => Faq::class,
                'fields' => [
                    'question' => ['type' => 'text', 'label' => 'Pertanyaan', 'rules' => ['required', 'string', 'max:255']],
                    'answer' => ['type' => 'textarea', 'label' => 'Jawaban', 'rules' => ['required', 'string']],
                    'sort_order' => ['type' => 'number', 'label' => 'Urutan', 'rules' => ['nullable', 'integer', 'min:0']],
                    'is_active' => ['type' => 'checkbox', 'label' => 'Aktif', 'rules' => ['nullable', 'boolean']],
                ],
            ],
            'partner' => [
                'label' => 'Partner',
                'model' => Partner::class,
                'fields' => [
                    'name' => ['type' => 'text', 'label' => 'Nama Partner', 'rules' => ['required', 'string', 'max:255']],
                    'logo_url' => ['type' => 'file', 'label' => 'Upload Logo', 'rules' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:2048']],
                    'website_url' => ['type' => 'text', 'label' => 'Website', 'rules' => ['nullable', 'max:2048']],
                    'sort_order' => ['type' => 'number', 'label' => 'Urutan', 'rules' => ['nullable', 'integer', 'min:0']],
                    'is_active' => ['type' => 'checkbox', 'label' => 'Aktif', 'rules' => ['nullable', 'boolean']],
                ],
            ],
        ];
    }

    protected function configFor(string $module): array
    {
        if (Auth::check() && Auth::user()?->role === 'admin' && $module !== 'berita') {
            abort(403);
        }

        $config = $this->modules()[$module] ?? null;

        abort_if(! $config, 404);

        return $config;
    }

    public function index(string $module): View
    {
        $config = $this->configFor($module);
        $modelClass = $config['model'];
        $routePrefix = request()->routeIs('dashboard.admin.*') ? 'dashboard.admin.content' : 'dashboard.super.content';

        $items = $modelClass::query()->latest()->paginate(12);

        return view('dashboard.superadmin.content.index', [
            'module' => $module,
            'config' => $config,
            'items' => $items,
            'routePrefix' => $routePrefix,
        ]);
    }

    public function create(string $module): View
    {
        $config = $this->configFor($module);
        $routePrefix = request()->routeIs('dashboard.admin.*') ? 'dashboard.admin.content' : 'dashboard.super.content';

        return view('dashboard.superadmin.content.form', [
            'module' => $module,
            'config' => $config,
            'item' => null,
            'routePrefix' => $routePrefix,
        ]);
    }

    public function store(Request $request, string $module): RedirectResponse
    {
        $config = $this->configFor($module);
        $modelClass = $config['model'];
        $routePrefix = $request->routeIs('dashboard.admin.*') ? 'dashboard.admin.content' : 'dashboard.super.content';

    $data = $this->validateByModule($request, $module, $config);
        $modelClass::query()->create($data);

        return redirect()
            ->route($routePrefix . '.index', $module)
            ->with('status', 'Data berhasil ditambahkan.');
    }

    public function edit(string $module, int $id): View
    {
        $config = $this->configFor($module);
        $modelClass = $config['model'];
        $routePrefix = request()->routeIs('dashboard.admin.*') ? 'dashboard.admin.content' : 'dashboard.super.content';

        $item = $modelClass::query()->findOrFail($id);

        return view('dashboard.superadmin.content.form', [
            'module' => $module,
            'config' => $config,
            'item' => $item,
            'routePrefix' => $routePrefix,
        ]);
    }

    public function update(Request $request, string $module, int $id): RedirectResponse
    {
        $config = $this->configFor($module);
        $modelClass = $config['model'];
        $routePrefix = $request->routeIs('dashboard.admin.*') ? 'dashboard.admin.content' : 'dashboard.super.content';

        /** @var Model $item */
        $item = $modelClass::query()->findOrFail($id);

    $data = $this->validateByModule($request, $module, $config, $item->id, $item);
        $item->update($data);

        return redirect()
            ->route($routePrefix . '.index', $module)
            ->with('status', 'Data berhasil diperbarui.');
    }

    public function destroy(string $module, int $id): RedirectResponse
    {
        $config = $this->configFor($module);
        $modelClass = $config['model'];
        $routePrefix = request()->routeIs('dashboard.admin.*') ? 'dashboard.admin.content' : 'dashboard.super.content';

        $item = $modelClass::query()->findOrFail($id);
    $this->cleanupManagedImages($item, $config);
        $item->delete();

        return redirect()
            ->route($routePrefix . '.index', $module)
            ->with('status', 'Data berhasil dihapus.');
    }

    protected function validateByModule(Request $request, string $module, array $config, ?int $id = null, ?Model $item = null): array
    {
        $rules = [];

        foreach ($config['fields'] as $field => $fieldConfig) {
            $fieldRules = $fieldConfig['rules'];

            if ($module === 'layanan' && $field === 'slug') {
                $fieldRules[] = Rule::unique('library_services', 'slug')->ignore($id);
            }

            $rules[$field] = $fieldRules;
        }

        $validated = $request->validate($rules);

        if (array_key_exists('is_active', $config['fields'])) {
            $validated['is_active'] = $request->boolean('is_active');
        }

        if (($module === 'layanan') && isset($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        foreach ($config['fields'] as $field => $fieldConfig) {
            if (($fieldConfig['type'] ?? null) !== 'file') {
                continue;
            }

            if (! $request->hasFile($field)) {
                continue;
            }

            $storedPath = $request->file($field)->store('uploads/' . $module, 'public');
            $publicPath = '/storage/' . $storedPath;

            if ($item && $item->{$field}) {
                $this->deleteManagedImagePath($item->{$field});
            }

            $validated[$field] = $publicPath;
        }

        return $validated;
    }

    protected function cleanupManagedImages(Model $item, array $config): void
    {
        foreach ($config['fields'] as $field => $fieldConfig) {
            if (($fieldConfig['type'] ?? null) !== 'file') {
                continue;
            }

            if ($item->{$field}) {
                $this->deleteManagedImagePath($item->{$field});
            }
        }
    }

    protected function deleteManagedImagePath(string $path): void
    {
        if (! Str::startsWith($path, '/storage/uploads/')) {
            return;
        }

        $relativePath = Str::after($path, '/storage/');

        if ($relativePath !== '') {
            Storage::disk('public')->delete($relativePath);
        }
    }
}
