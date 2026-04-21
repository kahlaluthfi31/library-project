<?php

namespace App\Http\Controllers;

use App\Models\FeedbackSubmission;
use App\Models\SurveySubmission;
use Illuminate\View\View;

class DashboardInboxController extends Controller
{
    public function survey(): View
    {
        $items = SurveySubmission::query()->latest()->paginate(15);

        return view('dashboard.superadmin.inbox.survey', [
            'items' => $items,
        ]);
    }

    public function feedback(): View
    {
        $items = FeedbackSubmission::query()->latest()->paginate(15);

        return view('dashboard.superadmin.inbox.feedback', [
            'items' => $items,
        ]);
    }
}
