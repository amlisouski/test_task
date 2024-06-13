<?php

namespace App\Services;

use App\Events\SubmissionSaved;
use App\Models\Submission;

class SubmissionProcessor
{
    public static function store(array $submissionData): void
    {
        $submission = Submission::create($submissionData);
        event(new SubmissionSaved($submission));
    }
}