<?php

namespace App\Http\Controllers;

use App\Services\SummarizerServices;
use Illuminate\Http\Request;

class SummarizerController extends Controller
{
    protected SummarizerServices $_service;

    public function __construct(SummarizerServices $service)
    {
        $this->_service = $service;
    }

    public function index(Request $request)
    {
        set_time_limit(300);

        $file = $request->file('file');
        
        $result = $this->_service->executeSummary($file);

        return response()->json($result);
    }

    public function summary()
    {
        return view("summary");
    }
}
