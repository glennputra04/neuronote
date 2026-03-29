<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class SummarizerServices
{
    public function executeSummary($file)
    {
        $mimeType = $file->getMimeType();

        // Handle Video
        if (str_contains($mimeType, 'video')) {
            return $this->summarizeVideo($file);
        }

        // Handle PPT/PDF/PPTX
        if (str_contains($mimeType, 'pdf') || str_contains($mimeType, 'presentation') || str_contains($mimeType, 'powerpoint')) {
            return $this->summarizeDocument($file);
        }

        return [
            'status' => 'error',
            'message' => 'Format file tidak didukung.'
        ];
    }

    private function summarizeDocument($file)
    {
        $baseUrl = config('services.ai_summarizer.base_url'); 
        $url = $baseUrl . '/summarize';
        
        /** @var Response $response */ //
        $response = Http::timeout(300)->attach(
            'file', 
            $file->get(), 
            $file->getClientOriginalName()
        )->post($url);

        return $response->json();
    }

    private function summarizeVideo($file)
    {
       // TODO
    }
}