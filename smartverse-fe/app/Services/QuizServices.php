<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class QuizServices
{
    public function generateQuiz($file)
    {
        $baseUrl = config('services.ai_summarizer.base_url');

        $url = $baseUrl . '/generate-quiz';

        /** @var Response $response */
        $response = Http::timeout(300)->attach(
            'file',
            $file->get(),
            $file->getClientOriginalName()
        )->post($url);

        return $response->json();
    }

    public function normalizeQuestions($quiz)
    {
        $normalizedQuestions = [];

        if (!isset($quiz['questions'])) {
            return [];
        }

        foreach ($quiz['questions'] as $index => $q) {

            $normalizedQuestions[] = [
                'title' => 'Question ' . ($index + 1),

                'text' => $q['question'] ?? '',

                'name' => 'q' . ($index + 1),

                'options' => $q['options'] ?? [],

                'answer' => $q['answer'] ?? ''
            ];
        }

        return $normalizedQuestions;
    }


}