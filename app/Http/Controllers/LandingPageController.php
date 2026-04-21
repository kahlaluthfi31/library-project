<?php

namespace App\Http\Controllers;

use App\Models\ExplorationItem;
use App\Models\Faq;
use App\Models\LibraryService;
use App\Models\NewsItem;
use App\Models\Partner;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class LandingPageController extends Controller
{
    public function index(): View
    {
        $explorationItems = Schema::hasTable('exploration_items')
            ? ExplorationItem::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get()
            : collect();

        $libraryServices = Schema::hasTable('library_services')
            ? LibraryService::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get()
            : collect();

        $newsItems = Schema::hasTable('news_items')
            ? NewsItem::query()
                ->where('is_active', true)
                ->orderByDesc('published_at')
                ->orderByDesc('id')
                ->take(7)
                ->get()
            : collect();

        $featuredNews = $newsItems->first();
        $sideNews = $newsItems->skip(1);

        $faqs = Schema::hasTable('faqs')
            ? Faq::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get()
            : collect();

        $partners = Schema::hasTable('partners')
            ? Partner::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get()
            : collect();

        return view('landingPage', [
            'explorationItems' => $explorationItems,
            'libraryServices' => $libraryServices,
            'featuredNews' => $featuredNews,
            'sideNews' => $sideNews,
            'faqs' => $faqs,
            'partners' => $partners,
        ]);
    }
}
