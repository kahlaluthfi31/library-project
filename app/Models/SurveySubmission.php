<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveySubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'respondent_status',
        'needed_collections',
        'frequent_services',
        'satisfaction',
        'suggestions',
        'other_suggestion',
    ];

    protected $casts = [
        'needed_collections' => 'array',
        'frequent_services' => 'array',
        'suggestions' => 'array',
    ];
}
