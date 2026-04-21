<?php

namespace App\Http\Controllers;

use App\Models\FeedbackSubmission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'kritik' => ['required', 'string'],
            'saran' => ['nullable', 'string'],
        ]);

        FeedbackSubmission::query()->create($validated);

        return redirect()->route('landing-page')->with('feedback_submitted', true);
    }
}
