<?php

namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use App\Http\Services\AI\AIService;
use Illuminate\Http\Request;

class GenerateCampaingController extends Controller
{
    public function __construct(protected AIService $aiService) {
    }

    public function __invoke(Request $request)
    {
        return $this->aiService->createCampaing($request);
    }
}
