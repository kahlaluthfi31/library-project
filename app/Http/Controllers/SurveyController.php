<?php

namespace App\Http\Controllers;

use App\Models\SurveySubmission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'respondent_status' => ['required', 'string', 'max:255'],
            'needed_collections' => ['nullable', 'array'],
            'needed_collections.*' => ['string', 'max:255'],
            'frequent_services' => ['nullable', 'array'],
            'frequent_services.*' => ['string', 'max:255'],
            'satisfaction' => ['nullable', 'string', 'max:100'],
            'suggestions' => ['nullable', 'array'],
            'suggestions.*' => ['string', 'max:255'],
            'other_suggestion' => ['nullable', 'string'],
        ]);

        SurveySubmission::query()->create($validated);

        return redirect()->route('survei-layanan')->with('survey_submitted', true);
    }
}
