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
            return $this->summarize($file,'/summarize-video');
        }

        // Handle PPT/PDF/PPTX
        if (str_contains($mimeType, 'pdf') || str_contains($mimeType, 'presentation') || str_contains($mimeType, 'powerpoint')) {
            return $this->summarize($file,'/summarize');
        }

        return [
            'status' => 'error',
            'message' => 'Format file tidak didukung.'
        ];
    }

    private function summarize($file,$endpoint)
    {
        $baseUrl = config('services.ai_summarizer.base_url'); 
        $url = $baseUrl . $endpoint;
        
        /** @var Response $response */ //
        $response = Http::timeout(300)->attach(
            'file', 
            $file->get(), 
            $file->getClientOriginalName()
        )->post($url);

        return $response->json();
    }
}